<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\MAC\OpensshCom\EtM\SHA1;

use \fpoirotte\Pssht\MAC\OpensshCom\EtM\EtMInterface;

/**
 * MAC generation using a truncated SHA1 hash in Encrypt-then-MAC mode.
 */
class Len96 extends \fpoirotte\Pssht\MAC\SHA1\Len96 implements EtMInterface
{
    public static function getName()
    {
        return 'hmac-sha1-96-etm@openssh.com';
    }
}
