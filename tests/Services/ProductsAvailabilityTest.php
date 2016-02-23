<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class ProductsAvailabilityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider receiveDataProvider
     *
     * @param array $parameters
     * @param array $response
     *
     * @throws ServiceException
     * @throws UndefinedCallbackException
     */
    public function testProcessDataCallable($parameters, $response)
    {
        $productsAvailability = \Mockery::mock('ProductsAvailability');
        $productsAvailability->shouldReceive('getActualData')
            ->with($parameters)
            ->once()
            ->andReturn($response);

        $service = new ProductsAvailability();
        $callback = [$productsAvailability, 'getActualData'];
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
        $productsAvailability = \Mockery::mock('\Hcapi\Interfaces\IShopImplementation');
        $productsAvailability->shouldReceive('getResponse')
            ->with($parameters)
            ->once()
            ->andReturn($response);

        $service = new ProductsAvailability();
        $this->assertNotNull($service->processData($productsAvailability, $parameters));
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
                        'order_id' => 123,
                        'count' => 10,
                    ],
                    [
                        'order_id' => 6,
                        'count' => 5,
                    ],
                ],
                [
                    'products' => [
                        [
                            'id' => 'ABC123',
                            'available' => true,
                            'count' => 1,
                            'delivery' => 0,
                            'name' => 'Diesel Zero Plus Masculine',
                            'price' => 100.00,
                            'related' => [
                                [
                                    'title' => 'Zdarma dárková taška',
                                ],
                            ],
                            'params' => [
                                [
                                    'id' => 2,
                                    'type' => 'input',
                                    'name' => 'Délka',
                                    'unit' => 'm',
                                    'values' => [
                                        [

                                        ],
                                    ],
                                ],
                                [
                                    'id' => 2,
                                    'type' => 'selectbox',
                                    'name' => 'barva',
                                    'unit' => '',
                                    'values' => [
                                        [
                                            'id' => 2,
                                            'default' => false,
                                            'value' => 'cervena',
                                            'price' => 10.60,
                                        ],
                                        [
                                            'id' => 2,
                                            'default' => true,
                                            'value' => 'cerna',
                                            'price' => 0.00,
                                        ],
                                    ],
                                ],
                            ],
                            'priceTotal' => 100.00,
                        ],
                        [
                            'id' => 'ABC124',
                            'available' => true,
                            'count' => 2,
                            'delivery' => 'na dotaz',
                            'name' => 'Mikrovlnná trouba Ariete-Scarlett 933 nerez',
                            'price' => 200.00,
                            'related' => [
                                [
                                    'title' => 'Vynáška do 5. patra zdarma',
                                ],
                                [
                                    'title' => 'Propiska zdarma.',
                                ]
                            ],
                            'priceTotal' => 400.00,
                        ],
                    ],
                    'priceSum' => 500.00,
                ]
            ],
        ];
    }

}
