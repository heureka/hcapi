<?php

namespace Example\InterfaceExample;

use Hcapi\Interfaces\IShopImplementation;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderSend implements IShopImplementation
{

    /**
     * @param $receiveData
     *
     * @return array
     */
    public function getResponse($receiveData)
    {
        //Do something with data

        return [
            'order_id' => 2011101001,
            'internal_id' => 'HRK-2012-0001',
            'variableSymbol' => 1234567890,
        ];
    }

}
