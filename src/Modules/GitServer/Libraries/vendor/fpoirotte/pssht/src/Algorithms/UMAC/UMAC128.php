<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Algorithms\UMAC;

/**
 * UMAC algorithm with a 128-bits tag.
 */
class UMAC128 extends Base
{
    public function __construct()
    {
        parent::__construct(MCRYPT_RIJNDAEL_128, 16);
    }
}
