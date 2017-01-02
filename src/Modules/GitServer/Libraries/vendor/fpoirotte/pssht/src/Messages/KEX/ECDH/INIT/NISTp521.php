<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Messages\KEX\ECDH\INIT;

/**
 * SSH_MSG_KEX_ECDH_INIT message (RFC 5656).
 */
class NISTp521 extends \fpoirotte\Pssht\Messages\KEX\ECDH\INIT\RFC5656
{
    public static function getCurve()
    {
        return \fpoirotte\Pssht\ECC\Curve::getCurve('nistp521');
    }
}
