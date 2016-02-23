<?php

namespace Example\CallableExample;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderCancel
{

    /**
     * Obtains data from Heureka, process them and returns response from shop for ORDER/CANCEL
     *
     * @param array $receiveData
     *
     * @return array
     */
    public function cancelOrder($receiveData)
    {
        //Do something with receive data

        return [
            'status' => true,
        ];
    }

}
