<?php

namespace Hcapi\Codes;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class StockAvailabilityTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerIsValid
     *
     * @param $code
     * @param $expected
     */
    public function testIsValid($code, $expected)
    {
        $stockAvailabilityCodes = new StockAvailability();
        $this->assertSame($expected, $stockAvailabilityCodes->isValid($code));
    }

    /**
     * @return array
     */
    public function providerIsValid()
    {
        return [
            [
                'code' => 0,
                'expected' => true,
            ],
            [
                'code' => -1,
                'expected' => true,
            ],
            [
                'code' => 5,
                'expected' => true,
            ],
            [
                'code' => 'failure',
                'expected' => false,
            ]
        ];
    }

}
