<?php

namespace Example\InterfaceExample;

use Hcapi\Interfaces\IShopImplementation;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatus implements IShopImplementation
{

    /**
     * @param array $receiveData
     *
     * @return array
     */
    public function getResponse($receiveData)
    {
        //Check status in db for order

        return [
            'order_id' => 2011101001,
            'status' => 0
        ];
    }

}
