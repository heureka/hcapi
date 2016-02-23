<?php

namespace Hcapi\Services;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderCancel extends AbstractService
{

    const KEY_STATUS = 'status';

    public function __construct()
    {
        $this->validator = new \Hcapi\Validators\OrderCancel();
    }

}
