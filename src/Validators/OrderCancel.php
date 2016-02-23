<?php

namespace Hcapi\Validators;

use Hcapi\Services\OrderCancel AS OrderCancelService;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderCancel extends AbstractValidator
{

    /**
     * @var array
     */
    private $requiredItems = [OrderCancelService::KEY_STATUS];

    /**
     * Validates output data for service "order/cancel"
     * Checks non empty array
     * Checks required items
     * Checks variables type
     *
     * @param $responseData
     * @return Bool
     * @throws ExpectedResponseDataException
     * @throws MissingRequiredDataException
     */
    public function validate($responseData)
    {
        if (empty($responseData)) {
            throw new ExpectedResponseDataException('Response data cannot be null');
        }

        if (!$this->checkRequiredItems($this->requiredItems, $responseData)) {
            throw new MissingRequiredDataException('Response must contain all required data');
        }

        $this->checkVariableType($responseData[OrderCancelService::KEY_STATUS], self::TYPE_BOOLEAN);

        return true;
    }

}
