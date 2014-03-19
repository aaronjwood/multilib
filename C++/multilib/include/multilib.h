// The following ifdef block is the standard way of creating macros which make exporting 
// from a DLL simpler. All files within this DLL are compiled with the MULTILIB_EXPORTS
// symbol defined on the command line. This symbol should not be defined on any project
// that uses this DLL. This way any other project whose source files include this file see 
// MULTILIB_API functions as being imported from a DLL, whereas this DLL sees symbols
// defined with this macro as being exported.
#ifdef MULTILIB_EXPORTS
#define MULTILIB_API __declspec(dllexport)
#else
#define MULTILIB_API __declspec(dllimport)
#endif

// This class is exported from the multilib.dll
class MULTILIB_API Multilib {
public:
	Multilib(void);
	// TODO: add your methods here.
};

extern MULTILIB_API int nmultilib;

MULTILIB_API int fnmultilib(void);
