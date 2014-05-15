<?php

class DecryptTest extends PHPUnit_Framework_TestCase {

    private $cipher;
    private $decrypt;
    
    public function setUp() {
        $this->cipher = new Encrypt("Some text to decrypt");
        $this->decrypt = new Decrypt($this->cipher->getBinary(), $this->cipher->getKey(), $this->cipher->getIv());
    }
    
    public function testDecrypt() {
        $this->assertEquals("Some text to decrypt", $this->decrypt);
    }
    
}