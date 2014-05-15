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

    private function decrypt() {
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->encryptedText, MCRYPT_MODE_CBC, $this->iv);
        return rtrim($decrypted, "\0");
    }

    public function __toString() {
        return $this->decryptedText;
    }

}

?>