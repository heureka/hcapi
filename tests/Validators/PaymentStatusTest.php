<?php

namespace Hcapi\Validators;

use PHPUnit_Framework_TestCase;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentStatusTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider responseDataProvider
     *
     * @param $response
     * @param $expectedException
     *
     * @throws ExpectedResponseDataException
     * @throws MissingRequiredDataException
     */
    public function testIsValid($response, $expectedException)
    {
        if (!empty($expectedException)) {
            $this->setExpectedException($expectedException);
        }
        $validator = new PaymentStatus();

        $this->assertTrue($validator->validate($response));
    }

    /**
     * @return array
     */
    public static function responseDataProvider()
    {
        return [
            [
                [
                    'status' => true,
                ],
                'expectedException' => null,
            ],
            [
                [
                    'status' => false,
                ],
                'expectedException' => null,
            ],
            [
                [
                    'status' => 'badType',
                ],
                'expectedException' => '\Hcapi\Validators\ExpectedBooleanException',
            ]
        ];
    }

}
