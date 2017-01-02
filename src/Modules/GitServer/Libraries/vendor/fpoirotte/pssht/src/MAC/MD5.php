<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\MAC;

/**
 * MAC generation using the MD5 hashing algorithm.
 */
class MD5 extends Base
{
    public static function getName()
    {
        return 'hmac-md5';
    }

    public static function getHash()
    {
        return 'md5';
    }
}
