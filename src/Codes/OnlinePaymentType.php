<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OnlinePaymentType extends AbstractCodes
{

    const PAYU_BANK_ACCOUNT = 1;
    const PAYU_CARD = 2;
    const PAYU_KOMERCNI_BANKA = 3;
    const PAYU_MBANK = 4;
    const PAYU_FIO = 5;
    const PAYU_GE_MONEY = 6;
    const PAYU_VOLKSBANK = 7;
    const PAYU_RAIFFEISEN = 8;
    const PAYU_CESKA_SPORITELNA = 9;
    const PAYU_CSOB = 10;
    const PAYU_ERA = 11;
    const PAYU_PAYSEC = 12;

    /**
     * Gets constants as array
     *
     * @return array
     */
    function getConstants()
    {
        return [
            self::PAYU_BANK_ACCOUNT,
            self::PAYU_CARD,
            self::PAYU_KOMERCNI_BANKA,
            self::PAYU_MBANK,
            self::PAYU_FIO,
            self::PAYU_GE_MONEY,
            self::PAYU_VOLKSBANK,
            self::PAYU_RAIFFEISEN,
            self::PAYU_CESKA_SPORITELNA,
            self::PAYU_CSOB,
            self::PAYU_ERA,
            self::PAYU_PAYSEC
        ];
    }

}
