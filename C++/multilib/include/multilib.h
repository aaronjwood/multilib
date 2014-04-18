#ifdef MULTILIB_EXPORTS
#define MULTILIB_API __declspec(dllexport)
#else
#define MULTILIB_API __declspec(dllimport)
#endif
#include <aes.h>
#include <osrng.h>
using std::string;
using CryptoPP::AutoSeededRandomPool;
using CryptoPP::SecByteBlock;
using CryptoPP::AES;

class MULTILIB_API Multilib {
private:
	AutoSeededRandomPool prng;
	SecByteBlock key[AES::DEFAULT_KEYLENGTH];
	byte iv[AES::BLOCKSIZE];
public:
	Multilib(void);
	void encrypt(string);
};
