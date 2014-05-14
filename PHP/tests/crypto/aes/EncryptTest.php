<?php

class EncryptTest extends PHPUnit_Framework_TestCase {
    
    private $cipher1;
    private $cipher2;
    
    public function setUp() {
        $this->cipher1 = new Encrypt("Some text to decrypt");
        $this->cipher2 = new Encrypt("Some text to decrypt");
    }
    
    public function testGetKey() {
        $this->assertTrue(strlen($this->cipher1->getKey()) == 32);
        $this->assertNotEquals($this->cipher1->getKey(), $this->cipher2->getKey());
    }
    
    public function testGetIv() {
        $this->assertTrue(strlen($this->cipher1->getIv()) == 16);
        $this->assertNotEquals($this->cipher1->getIv(), $this->cipher2->getIv());
    }
    
    public function testEncrypt() {
        $this->assertNotEquals($this->cipher1->getBinary(), $this->cipher2->getBinary());
        $this->assertNotEquals($this->cipher1->getEncoded(), $this->cipher2->getEncoded());
    }
    
}