<?php

namespace Hcapi\Validators;

use Hcapi\Services\OrderSend AS OrderSendService;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class OrderSend extends AbstractValidator
{

    /**
     * @var array
     */
    private $requiredItems = [
        OrderSendService::KEY_ORDER,
        OrderSendService::KEY_INTERNAL,
        OrderSendService::KEY_VS,
    ];

    /**
     * Validates output data for Order/Send service
     * Checks non empty array
     * Checks required items
     * Checks variables type
     * Checks length of variable symbol
     *
     * @param $responseData
     *
     * @return bool
     * @throws ExpectedResponseDataException
     * @throws MissingRequiredDataException
     * @throws VariableSymbolLengthException
     */
    public function validate($responseData)
    {
        if (empty($responseData)) {
            throw new ExpectedResponseDataException('Response data cannot be null');
        }

        if (!$this->checkRequiredItems($this->requiredItems, $responseData)) {
            throw new MissingRequiredDataException('Response must contain all required data');
        }

        $this->checkVariableType($responseData[OrderSendService::KEY_ORDER], self::TYPE_INTEGER);
        $this->checkVariableType($responseData[OrderSendService::KEY_INTERNAL], self::TYPE_STRING);
        $this->checkVariableType($responseData[OrderSendService::KEY_VS], self::TYPE_NUMERIC);


        if ($this->countDigits($responseData[OrderSendService::KEY_VS]) > 10) {
            throw new VariableSymbolLengthException('Max length of variableSymbol is 10');
        }

        return true;
    }

    /**
     * Gets count of digits in number
     *
     * @param $number
     *
     * @return int
     */
    private function countDigits($number)
    {
        return strlen((string)$number);
    }

}

class VariableSymbolLengthException extends ValidatorException {}
