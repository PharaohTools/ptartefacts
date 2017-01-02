<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Encryption\CBC;

/**
 * AES cipher in CBC mode with a 128-bit key
 * (RECOMMENDED in RFC 4253).
 */
class AES128 extends AES256
{
    public static function getKeySize()
    {
        return 128 >> 3;
    }
}
