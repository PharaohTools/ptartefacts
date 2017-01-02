<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Messages\USERAUTH;

/**
 * SSH_MSG_USERAUTH_SUCCESS message (RFC 4252).
 */
class SUCCESS extends \fpoirotte\Pssht\Messages\Base
{
    public static function getMessageId()
    {
        return 52;
    }
}
