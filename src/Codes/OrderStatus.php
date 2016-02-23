<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatus extends AbstractCodes
{

    const STATUS_SHIPPED = 0;
    const STATUS_SENT_TO_SHOP = 1;
    const STATUS_PARTIALLY_COMPLETED = 2;
    const STATUS_SHOP_CONFIRMED = 3;
    const STATUS_CANCEL_SHOP = 4;
    const STATUS_CANCEL_CUSTOMER = 5;
    const STATUS_CANCEL_UNPAID = 6;
    const STATUS_RETURNED = 7;
    const STATUS_COMPLETED_ON_HEUREKA = 8;
    const STATUS_DELIVERED = 9;
    const STATUS_READY_FOR_PICKUP = 10;
    const STATUS_SHIPPED_TO_EXTERNAL_POINT = 11;

    /**
     * Gets constants as array
     *
     * @return array
     */
    function getConstants()
    {
        return [
            self::STATUS_SHIPPED,
            self::STATUS_SENT_TO_SHOP,
            self::STATUS_PARTIALLY_COMPLETED,
            self::STATUS_SHOP_CONFIRMED,
            self::STATUS_CANCEL_SHOP,
            self::STATUS_CANCEL_CUSTOMER,
            self::STATUS_CANCEL_UNPAID,
            self::STATUS_RETURNED,
            self::STATUS_COMPLETED_ON_HEUREKA,
            self::STATUS_DELIVERED,
            self::STATUS_READY_FOR_PICKUP,
            self::STATUS_SHIPPED_TO_EXTERNAL_POINT,
        ];
    }

}
