using System.Security.Cryptography;

namespace Multilib
{
    public class Encrypt
    {

        private RijndaelManaged cipher;
        private byte[] key;
        private byte[] iv;

        private byte[] clearText;
        private byte[] encryptedText;

        public Encrypt()
        {

        }
    }
}

