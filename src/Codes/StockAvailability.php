<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class StockAvailability extends AbstractCodes
{

    const AVAILABLE = 0;
    const UNAVAILABLE = -1;

    /**
     * Gets constants as array
     *
     * @return array
     */
    function getConstants()
    {
        return [
            self::AVAILABLE,
            self::UNAVAILABLE,
        ];
    }

    /**
     * Amended existCode function, because shop can determine time (in days) to expedition
     *
     * @param $codeValue
     *
     * @return bool
     */
    function isValid($codeValue)
    {
        if (is_int($codeValue) && $codeValue >= -1) {
            return true;
        }
        return false;
    }

}
