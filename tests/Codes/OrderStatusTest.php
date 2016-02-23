<?php

namespace Hcapi\Codes;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatusTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider existCodeProvider
     *
     * @param $code
     * @param $expected
     */
    public function testExistCode($code, $expected)
    {
        $orderStatusCodes = new OrderStatus();
        $this->assertSame($expected, $orderStatusCodes->isValid($code));
    }

    public static function existCodeProvider()
    {
        return [
            [
                'code' => 0,
                'expected' => true,
            ],
            [
                'code' => 7,
                'expected' => true,
            ],
            [
                'code' => 253125,
                'expected' => false,
            ]
        ];
    }

}
