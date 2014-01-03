<?php

class Decrypt {

    private $key;
    private $iv;
    private $encryptedText;
    private $decryptedText;

    public function __construct($encryptedText, $key, $iv) {
        $this->encryptedText = $encryptedText;
        $this->key = $key;
        $this->iv = $iv;
        $this->decryptedText = $this->decrypt();
    }

    public function decrypt() {
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->encryptedText, MCRYPT_MODE_CBC, $this->iv);
    }

    public function toString() {
        return $this->decrypt();
    }

}

?>