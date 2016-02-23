<?php

namespace Hcapi\Validators;

use Hcapi\Services\PaymentStatus AS PaymentStatusService;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentStatus extends AbstractValidator
{

    /**
     * @var array
     */
    private $requiredItems = [PaymentStatusService::KEY_STATUS];

    /**
     * Validates data for Payment/Status service
     * Checks non empty array
     * Checks required items
     * CHecks variables type
     *
     * @param $responseData
     *
     * @return bool
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

        $this->checkVariableType($responseData[PaymentStatusService::KEY_STATUS], self::TYPE_BOOLEAN);

        return true;
    }

}
