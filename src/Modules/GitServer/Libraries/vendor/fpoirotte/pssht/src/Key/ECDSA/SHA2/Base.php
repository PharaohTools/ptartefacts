<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\Key\ECDSA\SHA2;

/**
 * Abstract class for a Public key using the Elliptic Curve
 * Digital Signature Algorithm (ECDSA).
 */
abstract class Base implements
    \fpoirotte\Pssht\Key\KeyInterface,
    \fpoirotte\Pssht\Key\ECDSA\SHA2\BaseInterface
{
    /// Public key.
    protected $Q;

    /// Private key.
    protected $d;

    /// RNG.
    protected $rng;

    /**
     * Construct a new public/private ECDSA key
     * with the NIST P-256 elliptic curve.
     *
     *  \param Point $Q
     *      GMP resource containing public key Q from ECDSA.
     *
     *  \param resource $d
     *      (optional) GMP resource containing the private key.
     *      If omitted, only the public part of the key is
     *      loaded, meaning that signature generation will be
     *      unavailable.
     */
    public function __construct(\fpoirotte\Pssht\ECC\Point $Q, $d = null)
    {
        $this->Q    = $Q;
        $this->d    = $d;
        $this->rng  = new \fpoirotte\Pssht\Random\OpenSSL();
    }

    public static function getName()
    {
        return 'ecdsa-sha2-' . static::getIdentifier();
    }

    public function serialize(\fpoirotte\Pssht\Wire\Encoder $encoder)
    {
        $encoder->encodeString(static::getName());
        $encoder->encodeString(static::getIdentifier());
        $encoder->encodeString(
            $this->Q->serialize(
                \fpoirotte\Pssht\ECC\Curve::getCurve(static::getIdentifier())
            )
        );
    }

    public static function unserialize(\fpoirotte\Pssht\Wire\Decoder $decoder, $private = null)
    {
        if ($decoder->decodeString() !== static::getIdentifier()) {
            throw new \InvalidArgumentException();
        }
        $Q = \fpoirotte\Pssht\ECC\Point::unserialize(
            \fpoirotte\Pssht\ECC\Curve::getCurve(static::getIdentifier()),
            $decoder->decodeString()
        );
        return new static($Q, $private);
    }

    public function sign($message, $raw_output = false)
    {
        if ($this->d === null) {
            throw new \RuntimeException();
        }

        $curve      = \fpoirotte\Pssht\ECC\Curve::getCurve(static::getIdentifier());
        $mod        = $curve->getOrder();
        $mlen       = gmp_init(strlen(gmp_strval($mod, 2)));
        $mlen       = gmp_intval(gmp_div_q($mlen, 8, GMP_ROUND_PLUSINF));
        $M          = gmp_init(hash($this->getHash(), $message, false), 16);
        $generator  = $curve->getGenerator();

        do {
            do {
                do {
                    $k = gmp_init(bin2hex($this->rng->getBytes($mlen)), 16);
                } while (gmp_cmp($k, gmp_sub($mod, 1)) >= 0);
                $sig1 = $generator->multiply($curve, $k)->x;
            } while (gmp_cmp($sig1, 0) === 0);

            $bezout = gmp_gcdext($k, $mod);
            $k_inv  = gmp_mod(gmp_add($bezout['s'], $mod), $mod);
            $sig2   = gmp_mod(gmp_mul($k_inv, gmp_add($M, gmp_mul($this->d, $sig1))), $mod);
        } while (gmp_cmp($sig2, 0) === 0);

        $encoder = new \fpoirotte\Pssht\Wire\Encoder();
        $encoder->encodeMpint($sig1);
        $encoder->encodeMpint($sig2);
        return $encoder->getBuffer()->get(0);
    }

    public function check($message, $signature)
    {
        $decoder = new \fpoirotte\Pssht\Wire\Decoder(
            new \fpoirotte\Pssht\Buffer($signature)
        );

        $curve  = \fpoirotte\Pssht\ECC\Curve::getCurve(static::getIdentifier());
        $sig1   = $decoder->decodeMpint();
        $sig2   = $decoder->decodeMpint();
        $mod    = $curve->getOrder();
        $M      = gmp_init(hash($this->getHash(), $message, false), 16);
        $bezout = gmp_gcdext($sig2, $mod);
        $w      = gmp_mod(gmp_add($bezout['s'], $mod), $mod);
        $u1     = gmp_mod(gmp_mul($M, $w), $mod);
        $u2     = gmp_mod(gmp_mul($sig1, $w), $mod);
        $R      = \fpoirotte\Pssht\ECC\Point::add(
            $curve,
            $curve->getGenerator()->multiply($curve, $u1),
            $this->Q->multiply($curve, $u2)
        );
        return (gmp_cmp($R->x, $sig1) === 0);
    }

    /**
     * Get the Random Number Generator associated with this key.
     *
     *  \retval fpoirotte::Pssht::Random::RandomInterface
     *      RNG associated with this key.
     */
    public function getRNG()
    {
        return $this->rng;
    }

    /**
     * Set the Random Number Generator to use when
     * signing messages with this key.
     *
     *  \param fpoirotte::Pssht::Random::RandomInterface $rng
     *      New RNG to use.
     */
    public function setRNG(\fpoirotte\Pssht\Random\RandomInterface $rng)
    {
        $this->rng = $rng;
        return $this;
    }

    public function isValid()
    {
        $curve  = \fpoirotte\Pssht\ECC\Curve::getCurve(static::getIdentifier());
        if ($this->Q->isIdentity($curve)) {
            return false;
        }

        $p      = $curve->getModulus();
        if (gmp_cmp($this->Q->x, 0) < 0 || gmp_cmp($this->Q->x, $p) >= 0 ||
            gmp_cmp($this->Q->y, 0) < 0 || gmp_cmp($this->Q->y, $p) >= 0) {
            return false;
        }

        $left   = gmp_mod(gmp_mul($this->Q->y, $this->Q->y), $p);
        $right  = gmp_mod(
            gmp_add(
                gmp_add(
                    gmp_pow($this->Q->x, 3),
                    gmp_mul($curve->getA(), $this->Q->x)
                ),
                $curve->getB()
            ),
            $p
        );
        if (gmp_cmp($left, $right)) {
            return false;
        }

        if ($curve->getCofactor() === 1) {
            return true;
        }

        return $this->Q->multiply($curve->getOrder())->isIdentity();
    }

    public function getPublic()
    {
        return $this->Q;
    }
}
