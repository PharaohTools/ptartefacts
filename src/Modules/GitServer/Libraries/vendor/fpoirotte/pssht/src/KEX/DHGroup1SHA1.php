<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\KEX;

/**
 * Diffie-Hellman key exchange with SHA-1 as HASH,
 * and Oakley Group 2 [RFC2409] (1024-bit MODP Group);
 * REQUIRED in RFC 4253.
 */
class DHGroup1SHA1 extends \fpoirotte\Pssht\KEX\DHGroupSHA1Base
{
    public static function getName()
    {
        return 'diffie-hellman-group1-sha1';
    }

    public static function getGenerator()
    {
        return 2;
    }

    public static function getPrime()
    {
        return str_replace(
            "\r\n ",
            '',
            '
            FFFFFFFF FFFFFFFF C90FDAA2 2168C234 C4C6628B 80DC1CD1
            29024E08 8A67CC74 020BBEA6 3B139B22 514A0879 8E3404DD
            EF9519B3 CD3A431B 302B0A6D F25F1437 4FE1356D 6D51C245
            E485B576 625E7EC6 F44C42E9 A637ED6B 0BFF5CB6 F406B7ED
            EE386BFB 5A899FA5 AE9F2411 7C4B1FE6 49286651 ECE65381
            FFFFFFFF FFFFFFFF'
        );
    }
}
