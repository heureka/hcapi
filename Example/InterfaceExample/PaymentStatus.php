<?php

namespace Example\InterfaceExample;

use Hcapi\Interfaces\IShopImplementation;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentStatus implements IShopImplementation
{

    /**
     * @param array $receiveData
     *
     * @return array
     */
    public function getResponse($receiveData)
    {
        //set payment status for order

        return [
            'status' => false,
        ];
    }

}
