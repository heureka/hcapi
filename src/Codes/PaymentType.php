<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentType extends AbstractCodes
{

    const PAYMENT_CASH_ON_DELIVERY = 1;
    const PAYMENT_CASH = 2;
    const PAYMENT_CREDIT_CARD = 3;
    const PAYMENT_BANK_TRANSFER = 4;

    /**
     * Gets constants as array
     *
     * @return array
     */
    function getConstants()
    {
        return [
            self::PAYMENT_CASH_ON_DELIVERY,
            self::PAYMENT_CASH,
            self::PAYMENT_CREDIT_CARD,
            self::PAYMENT_BANK_TRANSFER,
        ];
    }

}
