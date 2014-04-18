#include "stdafx.h"

Multilib::Multilib()
{
	prng.GenerateBlock(iv, sizeof(iv));
}