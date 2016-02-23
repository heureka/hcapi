<?php

namespace Hcapi\Codes;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class DeliveryTypeTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers       DeliveryTypeCodes::isValid
     * @dataProvider existCodeProvider
     *
     * @param $code
     * @param $expected
     */
    public function testExistCode($code, $expected)
    {
        $deliveryCodes = new DeliveryType();
        $this->assertSame($expected, $deliveryCodes->isValid($code));
    }

    /**
     * @return array
     */
    public static function existCodeProvider()
    {
        return [
            [
                'code' => 1,
                'expected' => true,
            ],
            [

                'code' => 6,
                'expected' => true,
            ],
            [
                'code' => 253125,
                'expected' => false,
            ]
        ];
    }

}
