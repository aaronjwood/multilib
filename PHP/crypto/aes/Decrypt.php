<?php

class Decrypt {

    private $key;
    private $iv;
    private $encryptedText;
    private $decryptedText;

    /**
     * Class constructor
     * Sets the necessary data for decryption and decrypts the data
     * @param string $encryptedText The encrypted data
     * @param string $key The key used to initially encrypt the data
     * @param string $iv The initialization vector used during the encryption process
     */
    public function __construct($encryptedText, $key, $iv) {
        $this->encryptedText = $encryptedText;
        $this->key = $key;
        $this->iv = $iv;
        $this->decryptedText = $this->decrypt();
    }

    /**
     * Decrypts the encrypted data
     * @return string The decrypted data
     */
    private function decrypt() {
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->encryptedText, MCRYPT_MODE_CBC, $this->iv);
        return rtrim($decrypted, "\0");
    }

    /**
     * Overrides the native method to return the decrypted data as a printable string
     * @return string The decrypted data as a printable string
     */
    public function __toString() {
        return $this->decryptedText;
    }

}

?>