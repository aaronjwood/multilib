// multilib.cpp : Defines the exported functions for the DLL application.
//

#include "stdafx.h"


// This is an example of an exported variable
MULTILIB_API int nmultilib=0;

// This is an example of an exported function.
MULTILIB_API int fnmultilib(void)
{
	return 42;
}

// This is the constructor of a class that has been exported.
// see multilib.h for the class definition
Multilib::Multilib()
{
	return;
}
