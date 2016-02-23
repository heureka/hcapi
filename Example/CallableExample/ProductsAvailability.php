<?php

namespace Example\CallableExample;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class ProductsAvailability
{

    /**
     * Obtains data from Heureka, process them and returns response from shop for PRODUCTS/AVAILABILITY
     *
     * @param array $receiveData
     *
     * @return array
     */
    public function getActualData($receiveData)
    {
        //get data from database about products

        return [
            'products' => [
                [
                    'id' => 'ABC123',
                    'available' => true,
                    'count' => 1,
                    'delivery' => 0,
                    'name' => 'Diesel Zero Plus Masculine',
                    'price' => 100.00,
                    'related' => [
                        [
                            'title' => 'Zdarma dárková taška',
                        ],
                    ],
                    'params' => [
                        [
                            'id' => 2,
                            'type' => 'input',
                            'name' => 'Délka',
                            'unit' => 'm',
                            'values' => [
                                [

                                ],
                            ],
                        ],
                        [
                            'id' => 2,
                            'type' => 'selectbox',
                            'name' => 'barva',
                            'unit' => '',
                            'values' => [
                                [
                                    'id' => 2,
                                    'default' => false,
                                    'value' => 'cervena',
                                    'price' => 10.60,
                                ],
                                [
                                    'id' => 2,
                                    'default' => true,
                                    'value' => 'cerna',
                                    'price' => 0.00,
                                ],
                            ],
                        ],
                    ],
                    'priceTotal' => 100.00,
                ],
                [
                    'id' => 'ABC124',
                    'available' => true,
                    'count' => 2,
                    'delivery' => 'na dotaz',
                    'name' => 'Mikrovlnná trouba Ariete-Scarlett 933 nerez',
                    'price' => 200.00,
                    'related' => [
                        [
                            'title' => 'Vynáška do 5. patra zdarma',
                        ],
                        [
                            'title' => 'Propiska zdarma.',
                        ]
                    ],
                    'priceTotal' => 400.00,
                ],
            ],
            'priceSum' => 500.00,
        ];
    }

}
