<?php

namespace Example\CallableExample;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatus
{

    /**
     * Obtains data from Heureka, process them and returns response from shop for ORDER/STATUS
     *
     * @param array $receiveData
     *
     * @return array
     */
    public function checkStatus($receiveData)
    {
        //Check status in db for order

        return [
            'order_id' => 2011101001,
            'status' => 0,
        ];
    }

}
