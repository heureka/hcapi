<?php

namespace Hcapi\Codes;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class StoreTypeTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider existCodeProvider
     *
     * @param $code
     * @param $expected
     */
    public function testExistCode($code, $expected)
    {
        $storeTypeCodes = new StoreType();
        $this->assertSame($expected, $storeTypeCodes->isValid($code));
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
                'code' => 2,
                'expected' => true,
            ],
            [
                'code' => 30,
                'expected' => false,
            ]
        ];
    }

}
