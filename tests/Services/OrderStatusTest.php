<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatusTest extends \PHPUnit_Framework_TestCase
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
        $orderStatus = \Mockery::mock('OrderStatus');
        $orderStatus->shouldReceive('checkStatus')
            ->with($parameters)
            ->once()
            ->andReturn($response);

        $service = new OrderStatus();
        $callback = [$orderStatus, 'checkStatus'];
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
        $orderStatus = \Mockery::mock('\Hcapi\Interfaces\IShopImplementation');
        $orderStatus->shouldReceive('getResponse')
            ->with($parameters)
            ->once()
            ->andReturn($response);

        $service = new OrderStatus();
        $this->assertNotNull($service->processData($orderStatus, $parameters));
    }

    /**
     * @return array
     */
    public static function receiveDataProvider()
    {
        return [
            [
                [
                    'order_id' => 123,
                ],
                [
                    'order_id' => 2011101001,
                    'status' => 0,
                ],
            ],
        ];
    }

}
