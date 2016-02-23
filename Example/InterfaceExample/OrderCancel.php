<?php

namespace Example\InterfaceExample;

use Hcapi\Interfaces\IShopImplementation;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderCancel implements IShopImplementation
{

    /**
     * @param array $receiveData
     *
     * @return array
     */
    public function getResponse($receiveData)
    {
        //Do something with receive data

        return [
            'status' => true,
        ];
    }

}
