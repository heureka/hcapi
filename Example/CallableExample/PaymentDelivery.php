<?php

namespace Example\CallableExample;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentDelivery
{

    /**
     * Obtains data from Heureka, process them and returns response from shop for PAYMENT/DELIVERY
     *
     * @param array $receiveData
     *
     * @return array
     */
    public function getTransportsPayments($receiveData)
    {
        //find some possibilities for product transports and payments

        return [
            'transport' => [
                [
                    'id' => 1,
                    'type' => 1,
                    'name' => 'PPL',
                    'price' => 120.00,
                    'description' => 'Do 1 - 2 pracovních dní.',
                ],
                [
                    'id' => 2,
                    'type' => 1,
                    'name' => 'Česká pošta - obchodní balík',
                    'price' => 100.00,
                    'description' => 'Do 2 - 3 pracovních dní.',
                ],
                [
                    'id' => 4,
                    'type' => 2,
                    'name' => 'Osobní odběr Ostrava',
                    'price' => 0.00,
                    'description' => 'O tom, že je zboží připraveno k odběru Vás bu...',
                    'store' =>
                        [
                            'id' => 2020,
                            'type' => 1,
                        ],
                ],
            ],
            'payment' => [
                [
                    'id' => 123,
                    'type' => 1,
                    'price' => 30.00,
                    'name' => 'Dobírka Česká pošta',
                ],
                [
                    'id' => 200,
                    'type' => 1,
                    'price' => 33.00,
                    'name' => 'Dobírka PPL',
                ],
                [
                    'id' => 300,
                    'type' => 3,
                    'price' => 0.00,
                    'name' => 'Platba kartou',
                ],
                [
                    'id' => 100,
                    'type' => 2,
                    'price' => 10.00,
                    'name' => 'Platba při převzetí',
                ],
            ],
            'binding' => [
                [
                    'id' => 1,
                    'transportId' => 1,
                    'paymentId' => 200,
                ],
                [
                    'id' => 5,
                    'transportId' => 1,
                    'paymentId' => 300,
                ],
                [
                    'id' => 2,
                    'transportId' => 2,
                    'paymentId' => 123,
                ],
                [
                    'id' => 6,
                    'transportId' => 2,
                    'paymentId' => 300,
                ],
                [
                    'id' => 4,
                    'transportId' => 4,
                    'paymentId' => 300,
                ],
                [
                    'id' => 7,
                    'transportId' => 4,
                    'paymentId' => 100,
                ],
            ],
        ];
    }

}
