<?php

namespace Hcapi\Validators;

use Hcapi\Services\OrderStatus AS OrderStatusService;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderStatus extends AbstractValidator
{

    /**
     * @var array
     */
    private $requiredItems = [
        OrderStatusService::KEY_ORDER,
        OrderStatusService::KEY_STATUS,
    ];

    /**
     * @var OrderStatusService
     */
    private $orderStatusCodes;

    public function __construct()
    {
        $this->orderStatusCodes = new \Hcapi\Codes\OrderStatus();
    }

    /**
     * Validates output data for Order/Status service
     * Checks non empty response
     * Checks required items
     * Checks variables type
     * Controls status code in code list
     *
     * @param $responseData
     *
     * @return bool
     * @throws ExpectedResponseDataException
     * @throws InvalidStatusTypeException
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

        $this->checkVariableType($responseData[OrderStatusService::KEY_ORDER], self::TYPE_INTEGER);
        $this->checkVariableType($responseData[OrderStatusService::KEY_STATUS], self::TYPE_INTEGER);

        if (!$this->orderStatusCodes->isValid($responseData[OrderStatusService::KEY_STATUS])) {
            throw new InvalidStatusTypeException('Cannot found status in code list');
        }

        return true;
    }

}

class InvalidStatusTypeException extends ValidatorException {}
