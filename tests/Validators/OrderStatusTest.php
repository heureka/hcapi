<?php

namespace Hcapi\Validators;

use PHPUnit_Framework_TestCase;
use \Hcapi\Codes\OrderStatus AS OrderStatusCodes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatusTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider responseDataProvider
     *
     * @param $response
     * @param $expectedException
     *
     * @throws ExpectedResponseDataException
     * @throws InvalidStatusTypeException
     * @throws MissingRequiredDataException
     */
    public function testIsValid($response, $expectedException)
    {
        if (!empty($expectedException)) {
            $this->setExpectedException($expectedException);
        }
        $validator = new OrderStatus();

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
                    'order_id' => 54684131,
                    'status' => OrderStatusCodes::STATUS_COMPLETED_ON_HEUREKA,
                ],
                'expectedException' => null
            ],
            [
                [
                    'order_id' => 468132,
                ],
                'expectedException' => '\Hcapi\Validators\MissingRequiredDataException',
            ],
            [
                [
                    'order_id' => 54684131,
                    'status' => 'bad_status',
                ],
                'expectedException' => '\Hcapi\Validators\ExpectedIntegerException',
            ],
            [
                [
                    'order_id' => 54684131,
                    'status' => 64641684,
                ],
                'expectedException' => '\Hcapi\Validators\InvalidStatusTypeException',
            ]
        ];
    }

}
