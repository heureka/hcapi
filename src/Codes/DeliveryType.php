<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class DeliveryType extends AbstractCodes
{

    const DELIVERY_TYPE_PERSONAL_PICKUP = 1;
    const DELIVERY_TYPE_CZECH_POST = 2;
    const DELIVERY_TYPE_PPL_DPD = 3;
    const DELIVERY_TYPE_EXPRESS = 4;
    const DELIVERY_TYPE_SPECIAL = 5;
    const DELIVERY_TYPE_CZECH_POST_SPECIAL = 6;

    /**
     * Gets constants as array
     *
     * @return array
     */
    protected function getConstants()
    {
        return [
            self::DELIVERY_TYPE_PERSONAL_PICKUP,
            self::DELIVERY_TYPE_CZECH_POST,
            self::DELIVERY_TYPE_PPL_DPD,
            self::DELIVERY_TYPE_EXPRESS,
            self::DELIVERY_TYPE_SPECIAL,
            self::DELIVERY_TYPE_CZECH_POST_SPECIAL,
        ];
    }

}
