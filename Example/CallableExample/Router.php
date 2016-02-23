<?php

namespace Example\CallableExample;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__ . '/OrderCancel.php';
require_once __DIR__ . '/OrderSend.php';
require_once __DIR__ . '/OrderStatus.php';
require_once __DIR__ . '/PaymentDelivery.php';
require_once __DIR__ . '/PaymentStatus.php';
require_once __DIR__ . '/ProductsAvailability.php';

use Hcapi\Services\OrderCancel;
use Hcapi\Services\OrderSend;
use Hcapi\Services\OrderStatus;
use Hcapi\Services\PaymentDelivery;
use Hcapi\Services\PaymentStatus;
use Hcapi\Services\ProductsAvailability;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class Router
{

    /**
     * @return array|null
     * @throws \Hcapi\Services\ServiceException
     * @throws \Hcapi\Services\UndefinedCallbackException
     */
    function listenRouteCallbackExample()
    {
        /**
         * Specific url required by Heureka
         */
        $routeUrl = $_SERVER['REQUEST_URI'];

        /**
         * Data received from Heureka
         */
        $receiveData = $_POST;

        if ($routeUrl === '/api/1/products/availability') {
            $service = new ProductsAvailability();
            return $service->processData(
                [
                    'Example\CallableExample\ProductsAvailability',
                    'getActualData',
                ],
                $receiveData);
        }

        if ($routeUrl === '/api/1/payment/delivery') {
            $service = new PaymentDelivery();
            return $service->processData(
                [
                    'Example\CallableExample\PaymentDelivery',
                    'getTransportsPayments',
                ],
                $receiveData);
        }

        if ($routeUrl === '/api/1/order/status') {
            $service = new OrderStatus();
            return $service->processData(
                [
                    'Example\CallableExample\OrderStatus',
                    'checkStatus',
                ],
                $receiveData);
        }

        if ($routeUrl === '/api/1/order/send') {
            $service = new OrderSend();
            return $service->processData(
                [
                    'Example\CallableExample\OrderSend',
                    'processOrder',
                ],
                $receiveData);
        }

        if ($routeUrl === '/api/1/order/cancel') {
            $service = new OrderCancel();
            return $service->processData(
                [
                    'Example\CallableExample\OrderCancel',
                    'cancelOrder',
                ],
                $receiveData);
        }

        if ($routeUrl === '/api/1/payment/status') {
            $service = new PaymentStatus();
            return $service->processData(
                [
                    'Example\CallableExample\PaymentStatus',
                    'setPaymentStatus',
                ],
                $receiveData);
        }

        return null;
    }

}
