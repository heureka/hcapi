<?php

namespace Hcapi\Codes;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OnlinePaymentTypeTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider existCodeProvider
     *
     * @param $code
     * @param $expected
     */
    public function testExistCode($code, $expected)
    {
        $onlinePaymentCodes = new OnlinePaymentType();
        $this->assertSame($expected, $onlinePaymentCodes->isValid($code));
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
                'code' => 11,
                'expected' => true,
            ],
            [
                'code' => 253125,
                'expected' => false,
            ]
        ];
    }

}
