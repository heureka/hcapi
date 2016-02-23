<?php

namespace Example\CallableExample;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentStatus
{

    /**
     * Obtains data from Heureka, process them and returns response from shop for PAYMENT/STATUS
     *
     * @param array $receiveData
     *
     * @return array
     */
    public function setPaymentStatus($receiveData)
    {
        //set payment status for order

        return [
            'status' => false,
        ];
    }

}
