<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatus extends AbstractService
{

    const KEY_ORDER = 'order_id';
    const KEY_STATUS = 'status';

    public function __construct()
    {
        $this->validator = new \Hcapi\Validators\OrderStatus();
    }

}
