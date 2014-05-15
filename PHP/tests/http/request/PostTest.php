<?php

class PostTest extends PHPUnit_Framework_TestCase {
    
    private $request;
    private $ssl;
    
    public function setUp() {
        $this->request = new Post(array(
            "q" => "php"
        ), $this->ssl);
    }
    
    public function testSendRequestSSL() {
        $this->ssl = true;
        $this->setUp();
        $this->assertNotEmpty($this->request->sendRequest("www.google.com/search"));
    }
    
    public function testSendRequestNoSSL() {
        $this->ssl = false;
        $this->setUp();
        $this->assertNotEmpty($this->request->sendRequest("www.google.com/search"));
    }
    
}