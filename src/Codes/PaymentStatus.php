<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentStatus extends AbstractCodes
{

    const PAID = 1;
    const UNPAID = -1;

    /**
     * Gets constants as array
     *
     * @return array
     */
    function getConstants()
    {
        return [
            self::PAID,
            self::UNPAID,
        ];
    }

}
