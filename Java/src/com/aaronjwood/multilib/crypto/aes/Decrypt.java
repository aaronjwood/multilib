package com.aaronjwood.multilib.crypto.aes;

import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.SecretKey;
import javax.crypto.spec.IvParameterSpec;

public class Decrypt {

    private Cipher decryptCipher;
    private SecretKey key;
    private IvParameterSpec iv;

    private byte[] encryptedText;
    private byte[] decryptedText;

    /**
     * Decrypts data using AES-128
     *
     * @param encryptedText The data to be decrypted
     * @param key The secret key to decrypt the data
     * @param iv The IV that was used during the encryption phase
     */
    public Decrypt(byte[] encryptedText, SecretKey key, IvParameterSpec iv) {
        this.key = key;
        this.iv = iv;
        this.decryptCipher = this.createCipher();
        this.encryptedText = encryptedText;
        this.decryptedText = this.decrypt();
    }

    /**
     * Creates an AES cipher using CBC mode with PKCS5 padding
     *
     * @return The cipher used to decrypt data
     */
    private Cipher createCipher() {
        try {
            Cipher cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
            cipher.init(Cipher.DECRYPT_MODE, this.key, this.iv);
            return cipher;
        }
        catch (NoSuchAlgorithmException | NoSuchPaddingException | InvalidKeyException | InvalidAlgorithmParameterException ex) {
            Logger.getLogger(Decrypt.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }

    /**
     * Decrypts the data passed during instantiation of this object
     *
     * @return The byte representation of the decrypted text
     */
    public byte[] decrypt() {
        try {
            return this.decryptCipher.doFinal(this.encryptedText);
        }
        catch (IllegalBlockSizeException | BadPaddingException ex) {
            Logger.getLogger(Decrypt.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }

    /**
     * Returns the decrypted text
     *
     * @return The decrypted text as a string
     */
    @Override
    public String toString() {
        return new String(this.decryptedText);
    }

}
