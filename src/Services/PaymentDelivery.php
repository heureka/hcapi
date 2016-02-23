<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentDelivery extends AbstractService
{

    const KEY_TRANSPORT = 'transport';
    const KEY_PAYMENT = 'payment';
    const KEY_BINDING = 'binding';

    const KEY_STORE = 'store';

    const TRANSPORT_ID = 'id';
    const TRANSPORT_TYPE = 'type';
    const TRANSPORT_NAME = 'name';
    const TRANSPORT_PRICE = 'price';
    const TRANSPORT_DESCRIPTION = 'description';

    const STORE_ID = 'id';
    const STORE_TYPE = 'type';

    const PAYMENT_ID = 'id';
    const PAYMENT_TYPE = 'type';
    const PAYMENT_NAME = 'name';
    const PAYMENT_PRICE = 'price';

    const BINDING_ID = 'id';
    const BINDING_TRANSPORT_ID = 'transportId';
    const BINDING_PAYMENT_ID = 'paymentId';

    public function __construct()
    {
        $this->validator = new \Hcapi\Validators\PaymentDelivery();
    }

}
