<?php

namespace Example\InterfaceExample;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/OrderCancel.php';
require_once __DIR__ . '/OrderSend.php';
require_once __DIR__ . '/OrderStatus.php';
require_once __DIR__ . '/PaymentDelivery.php';
require_once __DIR__ . '/PaymentStatus.php';
require_once __DIR__ . '/ProductsAvailability.php';

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
    function listenRouteInterfaceExample()
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
            $service = new \Hcapi\Services\ProductsAvailability();
            $productsAvailability = new \Example\InterfaceExample\ProductsAvailability();

            return $service->processData($productsAvailability, $receiveData);
        }

        if ($routeUrl === '/api/1/payment/delivery') {
            $service = new \Hcapi\Services\PaymentDelivery();
            $paymentDelivery = new \Example\InterfaceExample\PaymentDelivery();

            return $service->processData($paymentDelivery, $receiveData);
        }

        if ($routeUrl === '/api/1/order/status') {
            $service = new \Hcapi\Services\OrderStatus();
            $orderStatus = new \Example\InterfaceExample\OrderStatus();

            return $service->processData($orderStatus, $receiveData);
        }

        if ($routeUrl === '/api/1/order/send') {
            $service = new \Hcapi\Services\OrderSend();
            $orderSend = new \Example\InterfaceExample\OrderSend();

            return $service->processData($orderSend, $receiveData);
        }

        if ($routeUrl === '/api/1/order/cancel') {
            $service = new \Hcapi\Services\OrderCancel();
            $orderCancel = new \Example\InterfaceExample\OrderCancel();

            return $service->processData($orderCancel, $receiveData);
        }

        if ($routeUrl === '/api/1/payment/status') {
            $service = new \Hcapi\Services\PaymentStatus();
            $paymentStatus = new \Example\InterfaceExample\PaymentStatus();

            return $service->processData($paymentStatus, $receiveData);
        }

        return null;
    }

}
