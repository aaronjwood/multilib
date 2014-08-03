<?php

class EncryptTest extends PHPUnit_Framework_TestCase {

    protected $cipher1;
    protected $cipher2;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->cipher1 = new Encrypt("Some text to decrypt");
        $this->cipher2 = new Encrypt("Some text to decrypt");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Encrypt::getKey
     */
    public function testGetKey() {
        $this->assertTrue(strlen($this->cipher1->getKey()) == 32);
        $this->assertNotEquals($this->cipher1->getKey(), $this->cipher2->getKey());
    }

    /**
     * @covers Encrypt::getIv
     */
    public function testGetIv() {
        $this->assertTrue(strlen($this->cipher1->getIv()) == 16);
        $this->assertNotEquals($this->cipher1->getIv(), $this->cipher2->getIv());
    }

    /**
     * @covers Encrypt::getEncoded
     */
    public function testGetEncoded() {
        $this->assertNotEquals($this->cipher1->getEncoded(), $this->cipher2->getEncoded());
    }

    /**
     * @covers Encrypt::getRaw
     */
    public function testGetRaw() {
        $this->assertNotEquals($this->cipher1->getRaw(), $this->cipher2->getRaw());
    }

    /**
     * @covers Encrypt::__toString
     */
    public function test__toString() {
        $this->assertNotEmpty(print_r($this->cipher1, true));
    }

}
