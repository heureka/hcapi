<?php

namespace Hcapi\Validators;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderCancelTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider responseDataProvider
     *
     * @param $status
     * @param $expectedException
     *
     * @throws ExpectedResponseDataException
     * @throws MissingRequiredDataException
     */
    public function testIsValid($status, $expectedException)
    {
        if (!empty($expectedException)) {
            $this->setExpectedException($expectedException);
        }
        $validator = new OrderCancel();

        $this->assertTrue($validator->validate($status));
    }

    /**
     * @return array
     */
    public static function responseDataProvider()
    {
        return [
            [
                [
                    'status' => false,
                ],
                'expectedException' => null,
            ],
            [
                [
                    'status' => 123,
                ],
                'expectedException' => '\Hcapi\Validators\ExpectedBooleanException',
            ],
            [
                [
                    'status' => null,
                ],
                'expectedException' => '\Hcapi\Validators\ExpectedBooleanException',
            ]
        ];
    }

}
