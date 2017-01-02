<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Handlers;

/**
 * Handler for SSH_MSG_DISCONNECT messages.
 */
class DISCONNECT implements \fpoirotte\Pssht\Handlers\HandlerInterface
{
    // SSH_MSG_DISCONNECT = 1
    public function handle(
        $msgType,
        \fpoirotte\Pssht\Wire\Decoder $decoder,
        \fpoirotte\Pssht\Transport $transport,
        array &$context
    ) {
        $message = \fpoirotte\Pssht\Messages\DISCONNECT::unserialize($decoder);
        throw new $message;
    }
}
