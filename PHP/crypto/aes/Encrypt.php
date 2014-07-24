<?php

class Encrypt {

    private $key;
    private $iv;
    private $clearText;
    private $encryptedText;

    /**
     * Class constructor
     * Generates the key, initialization vector, and encrypts the data
     * @param string $clearText
     */
    public function __construct($clearText) {
        $this->clearText = $clearText;
        $this->key = $this->generateKey();
        $this->iv = $this->generateIv();
        $this->encryptedText = $this->encrypt();
    }

    /**
     * Generates the key used for encryption
     * @return string Secure random bytes as a string
     */
    private function generateKey() {
        return openssl_random_pseudo_bytes(32);
    }

    /**
     * Generates the initialization vector to be used
     * @return string Initialization vector
     */
    private function generateIv() {
        $size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        return mcrypt_create_iv($size, MCRYPT_DEV_URANDOM);
    }
    
    /**
     * Encrypts the data
     * @return string Encrypted data
     */
    private function encrypt() {
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->clearText, MCRYPT_MODE_CBC, $this->iv);
    }

    /**
     * Gets the key that was used to encrypt the data
     * @return string Key used for encryption/decryption
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * Gets the initialization vector that was used when the data was encrypted
     * @return string Initialization vector used during the encryption process
     */
    public function getIv() {
        return $this->iv;
    }

    /**
     * Returns the encrypted data as a base64 string
     * @return string The encrypted data in base64 format
     */
    public function getEncoded() {
        return base64_encode($this->encryptedText);
    }
    
    /**
     * Returns the encrypted data in binary format
     * @return string The encrypted data
     */
    public function getBinary() {
        return $this->encryptedText;
    }
    
    /**
     * Overrides the native method to return the encrypted data as a printable string
     * @return string The encrypted data as a printable string
     */
    public function __toString() {
        return $this->getEncoded();
    }

}

?>