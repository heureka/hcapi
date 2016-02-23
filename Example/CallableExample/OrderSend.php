<?php

namespace Example\CallableExample;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderSend
{

    /**
     * Obtains data from Heureka, process them and returns response from shop for ORDER/SEND
     *
     * @param array $receiveData
     *
     * @return array
     */
    public function processOrder($receiveData)
    {
        //Do something with data

        return [
            'order_id' => 2011101001,
            'internal_id' => 'HRK-2012-0001',
            'variableSymbol' => 1234567890,
        ];
    }

}
