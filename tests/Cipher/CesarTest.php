<?php

namespace Unixslayer\Cryptography;


use PHPUnit\Framework\TestCase;

class CesarTest extends TestCase
{
    /**
     * @var CesarInterface
     */
    private $cesar;

    /**
     * @param string $message
     * @param string $expectedCipher
     *
     * @dataProvider basicTestCipher
     */
    public function testCipher(string $message, string $expectedCipher)
    {
        $cipher = $this->cesar->cypher($message);

        $this->assertEquals($expectedCipher, $cipher);
    }

    /**
     * @param int $shift
     * @param string $alphabet
     * @param string $message
     * @param string $expectedCipher
     *
     * @dataProvider customeCipherDataProvider
     */
    public function testCustomCipher(int $shift, string $alphabet, string $message, string $expectedCipher)
    {
        $cipher = (new Cesar($shift, $alphabet))->cypher($message);

        $this->assertEquals($expectedCipher, $cipher);
    }

    /**
     * @param int $shift
     * @param string $message
     *
     * @dataProvider cipherDecodeDataProvider
     */
    public function testCipherDecode(int $shift, string $message)
    {
        $encoded = (new Cesar($shift))->cypher($message);
        $decoded = (new Cesar(-$shift))->cypher($encoded);

        $this->assertEquals($message, $decoded);
    }

    /**
     * @return array
     */
    public function basicTestCipher(): array
    {
        return [
            ['hello', 'khoor'],
            ['cesar cipher is very simple crypto technique', 'fhvdu flskhu lv yhu1 vlpsoh fu1swr whfkqltxh'],
            ['to be or not to be', 'wr eh ru qrw wr eh'],
        ];
    }

    /**
     * @return array
     */
    public function customeCipherDataProvider(): array
    {
        return [
            [2, 'qwertyuiopasdfghjklzxcvbnm', 'cesar cipher is very simple crypto technique', 'btfdy bpskty pf ntyi fpwsxt byisua utbkqpeot'],
            [6, 'asdfghjklzxcvbnmqwertyuiop', 'cesar cipher is very simple crypto technique', 'wokjp wfhcop fk eops kfyhno wpshag aowctfudo'],
            [9, 'zxcvbnmqwertyuiopasdfghjkl', 'cesar cipher is very simple crypto technique', 'tsxzd tjlnsd jx ysdg xjolws tdglfk fstnijphs'],
        ];
    }

    /**
     * @return array
     */
    public function cipherDecodeDataProvider(): array
    {
        return [
            [2, sha1(rand())],
            [4, sha1(rand())],
            [6, sha1(rand())],
            [7, sha1(rand())],
            [9, sha1(rand())],
            [11, sha1(rand())],
            [15, sha1(rand())],
        ];
    }

    protected function setUp(): void
    {
        $this->cesar = new Cesar();
    }
}
