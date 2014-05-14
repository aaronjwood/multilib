<?php

class Encrypt {

    private $key;
    private $iv;
    private $clearText;
    private $encryptedText;

    public function __construct($clearText) {
        $this->clearText = $clearText;
        $this->key = $this->generateKey();
        $this->iv = $this->generateIv();
        $this->encryptedText = $this->encrypt();
    }

    private function generateKey() {
        return openssl_random_pseudo_bytes(32);
    }

    private function generateIv() {
        $size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        return mcrypt_create_iv($size, MCRYPT_DEV_URANDOM);
    }
    
    private function encrypt() {
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->clearText, MCRYPT_MODE_CBC, $this->iv);
    }

    public function getKey() {
        return $this->key;
    }

    public function getIv() {
        return $this->iv;
    }

    public function getEncoded() {
        return base64_encode($this->encryptedText);
    }
    
    public function getBinary() {
        return $this->encryptedText;
    }

}

?>