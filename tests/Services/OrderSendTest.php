<?php

namespace Hcapi\Services;
use Mockery\Mock;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderSendTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider receiveDataProvider
     *
     * @param array $parameters
     * @param array $response
     *
     * @throws ServiceException
     * @throws UndefinedCallbackException
     *
     */
    public function testProcessDataCallable($parameters, $response)
    {
        $orderSend = \Mockery::mock('OrderSend');
        $orderSend->shouldReceive('processOrder')
            ->with($parameters)
            ->once()
            ->andReturn($response);

        $service = new OrderSend();
        $callback = [$orderSend, 'processOrder'];
        $this->assertNotNull($service->processData($callback, $parameters));
    }

    /**
     * @dataProvider receiveDataProvider
     *
     * @param array $parameters
     * @param array $response
     *
     * @throws ServiceException
     * @throws UndefinedCallbackException
     */
    public function testProcessDataInterface($parameters, $response)
    {
        $orderSend = \Mockery::mock('\Hcapi\Interfaces\IShopImplementation');
        $orderSend->shouldReceive('getResponse')
            ->with($parameters)
            ->once()
            ->andReturn($response);

        $service = new OrderSend();
        $this->assertNotNull($service->processData($orderSend, $parameters));
    }

    /**
     * @return array
     */
    public static function receiveDataProvider()
    {
        return [
            [
                [
                    'products' => [
                        [
                            'id' => '180732',
                            'count' => 1,
                            'price' => 5350,
                            'totalPrice' => 5350,
                        ],
                    ],
                    'customer' => [
                        'firstname' => 'Test',
                        'lastname' => 'Heureka',
                        'street' => 'Liberecka',
                        'phone' => '728000000',
                        'city' => 'Jablonec',
                        'company' => '',
                        'postCode' => '46601',
                        'state' => 'CZ',
                        'email' => 'test.kosik@heureka.cz',
                    ],
                    'deliveryAddress' => [
                        'firstname' => 'Test',
                        'lastname' => 'Heureka',
                        'street' => 'Liberecka 999',
                        'city' => 'Jablonec',
                        'company' => '',
                        'postCode' => '46601',
                        'state' => 'CZ',
                        'note' => 'Poznamka TEST Heureka',
                    ],
                    'note' => 'Poznamka TEST Heureka',
                    'deliveryId' => 101,
                    'paymentId' => 203,
                    'heureka_id' => 0,
                    'eLicence' => false,
                    'deliveryPrice' => 100,
                    'paymentPrice' => 0,
                    'productsTotalPrice' => 5350,
                    'paymentOnlineType' => [
                        'title' => 'Testovaci online platba',
                        'id' => 1,
                    ],
                ],
                [
                    'order_id' => 2011101001,
                    'internal_id' => 'HRK-2012-0001',
                    'variableSymbol' => 1234567890,
                ],
            ],
        ];
    }

}
