<?php

namespace Hcapi\Interfaces;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
interface IShopImplementation
{

    /**
     * @param array $receiveData
     *
     * @return array
     */
    public function getResponse($receiveData);

}
