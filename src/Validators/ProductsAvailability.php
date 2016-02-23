<?php

namespace Hcapi\Validators;

use Hcapi\Services\ProductsAvailability AS ProductsAvailabilityService;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class ProductsAvailability extends AbstractValidator
{
    /**
     * @var array
     */
    private $requiredItems = ['products', 'priceSum'];

    /**
     * @var array
     */
    private $requiredProductItems = ['id', 'count', 'available', 'delivery', 'name', 'price', 'priceTotal'];

    /**
     * @var array
     */
    private $requiredRelatedItems = ['title'];

    /**
     * @var array
     */
    private $requiredParamsItems = ['type', 'name', 'unit', 'values'];

    /**
     * @var array
     */
    private $requiredValuesItems = ['id', 'default', 'value', 'price'];

    /**
     * @var array
     */
    private $allowedParamsTypeValues = ['input', 'text', 'selectbox', 'multiselectbox'];

    /**
     * Validates output data for service "products/availability"
     * Checks non empty response
     * Checks required items
     * Checks variables type
     * Validates all products and their total price
     * Checks final price (priceSum)
     *
     * @param $responseData
     *
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
            throw new MissingRequiredDataException('Items products and priceSum are required');
        }

        $this->checkVariableType($responseData[ProductsAvailabilityService::KEY_PRODUCTS], self::TYPE_ARRAY);
        $this->checkVariableType($responseData[ProductsAvailabilityService::KEY_PRICE_SUM], self::TYPE_FLOAT);

        foreach ($responseData[ProductsAvailabilityService::KEY_PRODUCTS] as $product) {
            $this->validateProduct($product);
            $this->validatePriceTotal($product);
        }

        $this->validatePriceSum($responseData);

        return true;
    }

    /**
     * Checks required items
     * Checks variables type
     * If exist related then validates it
     * If exist params then validates it
     *
     * @param $product
     *
     * @throws BadDeliveryTypeException
     * @throws MissingRequiredDataException
     */
    private function validateProduct($product)
    {
        if (!$this->checkRequiredItems($this->requiredProductItems, $product)) {
            throw new MissingRequiredDataException('Product must contain all required data');
        }

        $this->checkVariableType($product[ProductsAvailabilityService::PRODUCT_ID], self::TYPE_STRING);
        $this->checkVariableType($product[ProductsAvailabilityService::PRODUCT_COUNT], self::TYPE_INTEGER);
        $this->checkVariableType($product[ProductsAvailabilityService::PRODUCT_NAME], self::TYPE_STRING);
        $this->checkVariableType($product[ProductsAvailabilityService::PRODUCT_PRICE], self::TYPE_FLOAT);

        if (!is_int($product[ProductsAvailabilityService::PRODUCT_DELIVERY]) && !is_string($product[ProductsAvailabilityService::PRODUCT_DELIVERY])) {
            throw new BadDeliveryTypeException('Product delivery must be string or integer');
        }

        if (array_key_exists(ProductsAvailabilityService::KEY_RELATED, $product)) {
            $this->checkVariableType($product[ProductsAvailabilityService::KEY_RELATED], self::TYPE_ARRAY);

            foreach ($product[ProductsAvailabilityService::KEY_RELATED] as $related) {
                $this->validateRelated($related);
            }
        }

        if (array_key_exists(ProductsAvailabilityService::KEY_PARAMS, $product)) {
            $this->checkVariableType($product[ProductsAvailabilityService::KEY_PARAMS], self::TYPE_ARRAY);

            foreach ($product[ProductsAvailabilityService::KEY_PARAMS] as $params) {
                $this->validateParams($params);
            }
        }
    }

    /**
     * Checks required items
     * Checks variables type
     *
     * @param $related
     *
     * @throws MissingRequiredDataException
     */
    private function validateRelated($related)
    {
        if (!$this->checkRequiredItems($this->requiredRelatedItems, $related)) {
            throw new MissingRequiredDataException('Related must contain all required data');
        }

        $this->checkVariableType($related[ProductsAvailabilityService::RELATED_TITLE], self::TYPE_STRING);
    }

    /**
     * Checks required items
     * Checks variables type
     * Checks type of params
     * Validates values
     *
     * @param $params
     *
     * @throws BadParameterTypeException
     * @throws MissingRequiredDataException
     */
    private function validateParams($params)
    {
        if (!$this->checkRequiredItems($this->requiredParamsItems, $params)) {
            throw new MissingRequiredDataException('Params must contain all required data');
        }

        $this->validateParamsType($params[ProductsAvailabilityService::PARAMS_TYPE]);

        $this->checkVariableType($params[ProductsAvailabilityService::PARAMS_NAME], self::TYPE_STRING);
        $this->checkVariableType($params[ProductsAvailabilityService::PARAMS_UNIT], self::TYPE_STRING);
        $this->checkVariableType($params[ProductsAvailabilityService::PARAMS_VALUES], self::TYPE_ARRAY);

        foreach ($params[ProductsAvailabilityService::PARAMS_VALUES] as $value) {
            if (!empty($value)) {
                $this->validateValues($value);
            }
        }
    }

    /**
     * Checks required items
     * Checks variables type
     *
     * @param $value
     *
     * @throws MissingRequiredDataException
     */
    private function validateValues($value)
    {
        if (!$this->checkRequiredItems($this->requiredValuesItems, $value)) {
            throw new MissingRequiredDataException('Values must contain all required data');
        }

        $this->checkVariableType($value[ProductsAvailabilityService::VALUES_ID], self::TYPE_INTEGER);
        $this->checkVariableType($value[ProductsAvailabilityService::VALUES_DEFAULT], self::TYPE_BOOLEAN);
        $this->checkVariableType($value[ProductsAvailabilityService::VALUES_VALUE], self::TYPE_STRING);
        $this->checkVariableType($value[ProductsAvailabilityService::VALUES_PRICE], self::TYPE_FLOAT);
    }

    /**
     * Checks variable type
     * Checks if final price of product is right
     *
     * @param $product
     *
     * @throws BadTotalPriceException
     */
    private function validatePriceTotal($product)
    {
        $this->checkVariableType($product[ProductsAvailabilityService::PRODUCT_PRICE_TOTAL], self::TYPE_FLOAT);

        if ($product[ProductsAvailabilityService::PRODUCT_COUNT] * $product[ProductsAvailabilityService::PRODUCT_PRICE] !== $product[ProductsAvailabilityService::PRODUCT_PRICE_TOTAL]) {
            throw new BadTotalPriceException('Product ' . $product[ProductsAvailabilityService::PRODUCT_ID] . ' has set bad price');
        }
    }

    /**
     * Checks if final price of products is right
     *
     * @param $responseData
     *
     * @throws BadSumPriceException
     */
    private function validatePriceSum($responseData)
    {
        $tmpPrice = 0;
        foreach ($responseData[ProductsAvailabilityService::KEY_PRODUCTS] as $product) {
            $tmpPrice += $product[ProductsAvailabilityService::PRODUCT_PRICE_TOTAL];
        }

        if ($tmpPrice !== $responseData[ProductsAvailabilityService::KEY_PRICE_SUM]) {
            throw new BadSumPriceException('Price sum is bad');
        }
    }

    /**
     * Checks variable type
     * Checks if type is in allowed values
     *
     * @param $type
     *
     * @throws BadParameterTypeException
     */
    private function validateParamsType($type)
    {
        $this->checkVariableType($type, self::TYPE_STRING);

        if (!in_array($type, $this->allowedParamsTypeValues)) {
            throw new BadParameterTypeException('Disallow parametr type: ' . $type);
        }
    }

}

class BadDeliveryTypeException extends ValidatorException {}

class BadTotalPriceException extends ValidatorException {}

class BadSumPriceException extends ValidatorException {}

class BadParameterTypeException extends ValidatorException {}
