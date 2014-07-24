package com.aaronjwood.multilib.crypto.aes;

import org.apache.commons.codec.binary.Base64;
import java.io.UnsupportedEncodingException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.KeyGenerator;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.SecretKey;
import javax.crypto.spec.IvParameterSpec;

public class Encrypt {

    private Cipher encryptCipher;
    private SecretKey key;
    private IvParameterSpec iv;

    private byte[] clearText;
    private byte[] encryptedText;

    /**
     * Encrypts data using AES-128
     *
     * @param clearText The data to be encrypted
     */
    public Encrypt(String clearText) {

        //Generate the IV and key
        this.iv = new IvParameterSpec(this.generateIv());
        this.key = this.generateKey();
        this.encryptCipher = createCipher();
        this.clearText = this.convertClearText(clearText);
        this.encryptedText = this.encrypt();
    }

    /**
     * Converts the clear text passed by the user to an array of bytes
     *
     * @param clearText The clear text passed by the user
     * @return The byte representation of the clear text
     */
    private byte[] convertClearText(String clearText) {

        //Convert the clear text passed by the user into bytes
        try {
            return clearText.getBytes("UTF-8");
        }
        catch (UnsupportedEncodingException ex) {
            Logger.getLogger(Encrypt.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }

    /**
     * Creates an AES cipher using CBC mode with PKCS5 padding
     *
     * @return The cipher used to encrypt data
     */
    private Cipher createCipher() {

        //Create an AES cipher in CBC mode using PKCS5 padding
        try {
            Cipher cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
            cipher.init(Cipher.ENCRYPT_MODE, this.key, this.iv);
            return cipher;
        }
        catch (NoSuchAlgorithmException | NoSuchPaddingException | InvalidKeyException | InvalidAlgorithmParameterException ex) {
            Logger.getLogger(Encrypt.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }

    /**
     * Generates a random IV to be used in the encryption process
     *
     * @return The IV's byte representation
     */
    private byte[] generateIv() {
        SecureRandom random = new SecureRandom();
        byte[] ivBytes = new byte[16];
        random.nextBytes(ivBytes);
        return ivBytes;
    }

    /**
     * Generates a secret key to be used in the encryption process
     *
     * @return The secret key
     */
    private SecretKey generateKey() {
        KeyGenerator keygen;
        try {

            //Java normally doesn't support 256-bit key sizes without an extra installation so stick with a 128-bit key
            keygen = KeyGenerator.getInstance("AES");
            keygen.init(128);
            SecretKey aesKey = keygen.generateKey();
            return aesKey;
        }
        catch (NoSuchAlgorithmException ex) {
            Logger.getLogger(Encrypt.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }

    /**
     * Returns the initialization vector
     *
     * @return The randomly generated IV
     */
    public IvParameterSpec getIv() {
        return this.iv;
    }

    /**
     * Returns the key used for encryption
     *
     * @return The randomly generated secret key
     */
    public SecretKey getKey() {
        return this.key;
    }

    /**
     * Encrypts the data passed during instantiation of this object
     *
     * @return The byte representation of the encrypted data
     */
    private byte[] encrypt() {
        try {
            return this.encryptCipher.doFinal(this.clearText);
        }
        catch (IllegalBlockSizeException | BadPaddingException ex) {
            Logger.getLogger(Encrypt.class.getName()).log(Level.SEVERE, null, ex);
            return null;
        }
    }

    /**
     * Returns the encrypted text as a base64 encoded string
     *
     * @return The encrypted base64 encoded string
     */
    @Override
    public String toString() {
        return Base64.encodeBase64String(encryptedText);
    }

}
