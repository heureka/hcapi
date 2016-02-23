<?php

require_once __DIR__ . '/../../Example/CallableExample/Router.php';
require_once __DIR__ . '/../../Example/InterfaceExample/Router.php';

use Example\CallableExample;
use Example\InterfaceExample;

/**
 * @author Oldrich Taufer <oldrich.taufer@heureka.cz>
 */
class RouteTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider routeDataProvider
     *
     * @param string $routeUrl
     * @param array  $receiveData
     * @param array  $expectedResponse
     */
    public function testCallbackRoutingExample($routeUrl, $receiveData, $expectedResponse)
    {
        $_SERVER['REQUEST_URI'] = $routeUrl;
        $_POST = $receiveData;
        $router = new CallableExample\Router();

        if ($expectedResponse) {
            $this->assertNotNull($router->listenRouteCallbackExample());
        } else {
            $this->assertNull($router->listenRouteCallbackExample());
        }
    }

    /**
     * @dataProvider routeDataProvider
     *
     * @param string $routeUrl
     * @param array  $receiveData
     * @param array  $expectedResponse
     */
    public function testInterfaceRoutingExample($routeUrl, $receiveData, $expectedResponse)
    {
        $_SERVER['REQUEST_URI'] = $routeUrl;
        $_POST = $receiveData;
        $router = new InterfaceExample\Router();

        if ($expectedResponse) {
            $this->assertNotNull($router->listenRouteInterfaceExample());
        } else {
            $this->assertNull($router->listenRouteInterfaceExample());
        }
    }

    /**
     * @return array
     */
    public function routeDataProvider()
    {
        return [
            [
                $routeUrl = '/api/1/products/availability',
                $receiveData = [
                    'products' => [
                        'order_id' => 123,
                        'count' => 10
                    ],
                    [
                        'order_id' => 6,
                        'count' => 5,
                    ],
                ],
                $expectedResponse = true,
            ],
            [
                $routeUrl = '/api/1/payment/delivery',
                $receiveData = [
                    'products' => [
                        'order_id' => 123,
                        'count' => 10,
                    ],
                    [
                        'order_id' => 6,
                        'count' => 5,
                    ]
                ],
                $expectedResponse = true,
            ],
            [
                $routeUrl = '/api/1/order/status',
                $receiveData = [
                    'order_id' => 123,
                ],
                $expectedResponse = true,
            ],
            [
                $routeUrl = '/api/1/order/send',
                $receiveData = [
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
                $expectedResponse = true,
            ],
            [
                $routeUrl = '/api/1/order/cancel',
                $receiveData = [
                    'order_id' => 123,
                    'reason' => 6,
                ],
                $expectedResponse = true,
            ],
            [
                $routeUrl = '/api/1/payment/status',
                $receiveData = [
                    'order_id' => 321,
                ],
                $expectedResponse = true,
            ],
            [
                $routeUrl = 'non/valid/link',
                $receiveData = [
                    'id' => 321,
                ],
                $expectedResponse = false,
            ],
        ];
    }

}


