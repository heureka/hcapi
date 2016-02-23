<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderSend extends AbstractService
{

    const KEY_ORDER = 'order_id';
    const KEY_INTERNAL = 'internal_id';
    const KEY_VS = 'variableSymbol';

    public function __construct()
    {
        $this->validator = new \Hcapi\Validators\OrderSend();
    }

}
