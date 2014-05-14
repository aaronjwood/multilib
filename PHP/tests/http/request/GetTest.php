<?php

class GetTest extends PHPUnit_Framework_TestCase {
    
    private $request;
    
    public function setUp() {
        $this->request = new Get(array(
            "q" => "php"
        ), true);
    }
    
    public function testSendRequest() {
        $this->assertNotEmpty($this->request->sendRequest("www.google.com/search"));
    }
    
}