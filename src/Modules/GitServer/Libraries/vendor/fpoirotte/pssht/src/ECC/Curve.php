<?php

/*
* This file is part of pssht.
*
* (c) François Poirotte <clicky@erebot.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace fpoirotte\Pssht\ECC;

/**
 * Representation of an elliptic curve.
 */
class Curve
{
    /// Name.
    protected $name;

    /// Modulus.
    protected $p;

    /// "a" value from the elliptic curve equation.
    protected $a;

    /// "b" value from the elliptic curve equation.
    protected $b;

    /// Generator point.
    protected $G;

    /// Curve order.
    protected $n;

    /// Curve co-factor.
    protected $h;

    /// Array with standard curves.
    protected static $curves = array();

    public function __construct($name, $p, $a, $b, \fpoirotte\Pssht\ECC\Point $G, $n, $h)
    {
        $this->name = $name;
        $this->p    = $p;
        $this->a    = $a;
        $this->b    = $b;
        $this->G    = $G;
        $this->n    = $n;
        $this->h    = $h;
    }

    public static function initialize()
    {
        if (count(static::$curves) !== 0) {
            return;
        }

        # (name, p_XXX, a, b, (xG, yG), n, h)
        static::$curves['nistp256'] = new static(
            'nistp256',
            gmp_init('0xffffffff00000001000000000000000000000000ffffffffffffffffffffffff'),
            gmp_init('0xffffffff00000001000000000000000000000000fffffffffffffffffffffffc'),
            gmp_init('0x5ac635d8aa3a93e7b3ebbd55769886bc651d06b0cc53b0f63bce3c3e27d2604b'),
            new \fpoirotte\Pssht\ECC\Point(
                '0x6b17d1f2e12c4247f8bce6e563a440f277037d812deb33a0f4a13945d898c296',
                '0x4fe342e2fe1a7f9b8ee7eb4a7c0f9e162bce33576b315ececbb6406837bf51f5'
            ),
            gmp_init('0xffffffff00000000ffffffffffffffffbce6faada7179e84f3b9cac2fc632551'),
            1
        );
        static::$curves['nistp384'] = new static(
            'nistp384',
            gmp_init(
                '0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFEFFFFFFFF0000000000000000FFFFFFFF'
            ),
            gmp_init(
                '0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFEFFFFFFFF0000000000000000FFFFFFFC'
            ),
            gmp_init(
                '0xB3312FA7E23EE7E4988E056BE3F82D19181D9C6EFE8141120314088F5' .
                '013875AC656398D8A2ED19D2A85C8EDD3EC2AEF'
            ),
            new \fpoirotte\Pssht\ECC\Point(
                '0xAA87CA22BE8B05378EB1C71EF320AD746E1D3B628BA79B9859F741E08' .
                '2542A385502F25DBF55296C3A545E3872760AB7',
                '0x3617DE4A96262C6F5D9E98BF9292DC29F8F41DBD289A147CE9DA3113B' .
                '5F0B8C00A60B1CE1D7E819D7A431D7C90EA0E5F'
            ),
            gmp_init(
                '0xFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFC7634D81F' .
                '4372DDF581A0DB248B0A77AECEC196ACCC52973'
            ),
            1
        );
        static::$curves['nistp521'] = new static(
            'nistp521',
            gmp_init(
                '0x01FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFFFFFFFFFFF'
            ),
            gmp_init(
                '0x01FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFFFFFFFFFFC'
            ),
            gmp_init(
                '0x0051953EB9618E1C9A1F929A21A0B68540EEA2DA725B99B315F3B8B48' .
                '9918EF109E156193951EC7E937B1652C0BD3BB1BF073573DF883D2C34F1' .
                'EF451FD46B503F00'
            ),
            new \fpoirotte\Pssht\ECC\Point(
                '0x00C6858E06B70404E9CD9E3ECB662395B4429C648139053FB521F828A' .
                'F606B4D3DBAA14B5E77EFE75928FE1DC127A2FFA8DE3348B3C1856A429B' .
                'F97E7E31C2E5BD66',
                '0x011839296A789A3BC0045C8A5FB42C7D1BD998F54449579B446817AFB' .
                'D17273E662C97EE72995EF42640C550B9013FAD0761353C7086A272C240' .
                '88BE94769FD16650'
            ),
            gmp_init(
                '0x01FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF' .
                'FFFFFFFFFFA51868783BF2F966B7FCC0148F709A5D03BB5C9B8899C47AE' .
                'BB6FB71E91386409'
            ),
            1
        );
    }

    public static function getCurve($name)
    {
        if (!isset(static::$curves[$name])) {
            throw new \InvalidArgumentException();
        }
        return static::$curves[$name];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getModulus()
    {
        return $this->p;
    }

    public function getA()
    {
        return $this->a;
    }

    public function getB()
    {
        return $this->b;
    }

    public function getGenerator()
    {
        return $this->G;
    }

    public function getOrder()
    {
        return $this->n;
    }

    public function getCofactor()
    {
        return $this->h;
    }
}
