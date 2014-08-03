package com.aaronjwood.multilib.crypto.aes;

import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.SecretKey;
import javax.crypto.spec.IvParameterSpec;

public final class Decrypt {

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
     * @throws java.security.NoSuchAlgorithmException
     * @throws javax.crypto.NoSuchPaddingException
     * @throws java.security.InvalidKeyException
     * @throws java.security.InvalidAlgorithmParameterException
     * @throws javax.crypto.IllegalBlockSizeException
     * @throws javax.crypto.BadPaddingException
     */
    public Decrypt(byte[] encryptedText, SecretKey key, IvParameterSpec iv) throws NoSuchAlgorithmException, NoSuchPaddingException, InvalidKeyException, InvalidAlgorithmParameterException, IllegalBlockSizeException, BadPaddingException {
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
    private Cipher createCipher() throws NoSuchAlgorithmException, NoSuchPaddingException, InvalidKeyException, InvalidAlgorithmParameterException {
        Cipher cipher = Cipher.getInstance("AES/CBC/PKCS5Padding");
        cipher.init(Cipher.DECRYPT_MODE, this.key, this.iv);
        return cipher;
    }

    /**
     * Decrypts the data passed during instantiation of this object
     *
     * @return The byte representation of the decrypted text
     */
    private byte[] decrypt() throws IllegalBlockSizeException, BadPaddingException {

        return this.decryptCipher.doFinal(this.encryptedText);

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
