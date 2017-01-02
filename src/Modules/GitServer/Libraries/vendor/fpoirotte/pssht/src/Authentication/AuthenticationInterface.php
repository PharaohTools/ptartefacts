<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Authentication;

/**
 * Interface for an authentication method.
 */
interface AuthenticationInterface extends \fpoirotte\Pssht\Algorithms\AlgorithmInterface
{
    /// The message passed the check.
    const CHECK_OK      = 1;

    /// The message should be rejected.
    const CHECK_REJECT  = 2;

    /// The message should be ignored.
    const CHECK_IGNORE  = 3;


    /// The authentication was successful.
    const AUTH_ACCEPT   = 1;

    /// The authentication failed.
    const AUTH_REJECT   = 2;

    /// The authentication failed and the method should be removed.
    const AUTH_REMOVE   = 3;


    /**
     * Check the contents of an authentication request.
     *
     *  \param fpoirotte::Pssht::Messages::USERAUTH::REQUEST::Base $message
     *      Message to check.
     *
     *  \param fpoirotte::Pssht::Transport $transport
     *      Transport layer the message originated from.
     *
     *  \param array $context
     *      Context for the SSH session.
     *
     *  \retval opaque
     *      Either AuthenticationInterface::CHECK_OK
     *      or AuthenticationInterface::CHECK_REJECT
     *      or AuthenticationInterface::CHECK_IGNORE.
     */
    public function check(
        \fpoirotte\Pssht\Messages\USERAUTH\REQUEST\Base $message,
        \fpoirotte\Pssht\Transport $transport,
        array &$context
    );

    /**
     * Handle an authentication request.
     *
     *  \param fpoirotte::Pssht::Messages::USERAUTH::REQUEST::Base $message
     *      Authenticate request to handle.
     *
     *  \param fpoirotte::Pssht::Transport $transport
     *      Transport layer the message originated from.
     *
     *  \param array $context
     *      Context for the SSH session.
     *
     *  \retval opaque
     *      Either AuthenticationInterface::AUTH_ACCEPT
     *      or AuthenticationInterface::AUTH_REJECT
     *      or AuthenticationInterface::AUTH_REMOVE.
     */
    public function authenticate(
        \fpoirotte\Pssht\Messages\USERAUTH\REQUEST\Base $message,
        \fpoirotte\Pssht\Transport $transport,
        array &$context
    );
}
