<?php

namespace Hcapi\Validators;

use Hcapi\Codes\DeliveryType;
use Hcapi\Codes\PaymentType;
use Hcapi\Codes\StoreType;
use Hcapi\Services\PaymentDelivery AS PaymentDeliveryService;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
class PaymentDelivery extends AbstractValidator
{

    /**
     * @var array
     */
    private $requiredItems = ['transport', 'payment', 'binding'];

    /**
     * @var array
     */
    private $requiredTransportItems = ['id', 'type', 'name', 'price', 'description'];

    /**
     * @var array
     */
    private $requiredStoreItems = ['type', 'id'];

    /**
     * @var array
     */
    private $requiredPaymentItems = ['id', 'type', 'name', 'price'];

    /**
     * @var array
     */
    private $requiredBindingItem = ['id', 'transportId', 'paymentId'];

    /**
     * @var DeliveryType
     */
    private $deliveryTypeCodes;

    /**
     * @var StoreType
     */
    private $storeTypeCodes;

    /**
     * @var PaymentType
     */
    private $paymentTypeCodes;

    public function __construct()
    {
        $this->deliveryTypeCodes = new \Hcapi\Codes\DeliveryType();
        $this->storeTypeCodes = new \Hcapi\Codes\StoreType();
        $this->paymentTypeCodes = new \Hcapi\Codes\PaymentType();
    }

    /**
     * Validates output data for Payment/Delivery service
     * Checks non empty response
     * Checks required items
     * Checks variables type
     * Validates all transports
     * Validates all payments
     * Validates all bindings
     * Checks matched transports and payments in bindings
     *
     * @param $responseData
     *
     * @return bool
     * @throws ExpectedResponseDataException
     * @throws InvalidPaymentTypeException
     * @throws InvalidTransportTypeException
     * @throws MissingRequiredDataException
     * @throws UniqueBindingException
     * @throws UniquePaymentException
     * @throws UniqueTransportException
     */
    public function validate($responseData)
    {
        if (empty($responseData)) {
            throw new ExpectedResponseDataException('Response data cannot be null');
        }

        if (!$this->checkRequiredItems($this->requiredItems, $responseData)) {
            throw new MissingRequiredDataException('Items transport, payment and binding are required');
        }

        foreach ($responseData[PaymentDeliveryService::KEY_TRANSPORT] as $transport) {
            $this->checkVariableType($transport, self::TYPE_ARRAY);
            $this->validateTransport($transport);
        }

        foreach ($responseData[PaymentDeliveryService::KEY_PAYMENT] as $payment) {
            $this->checkVariableType($payment, self::TYPE_ARRAY);
            $this->validatePayment($payment);
        }

        foreach ($responseData[PaymentDeliveryService::KEY_BINDING] as $binding) {
            $this->checkVariableType($binding, self::TYPE_ARRAY);
            $this->validateBinding($binding);
        }

        $this->validateMatched($responseData);

        return true;
    }

    /**
     * Checks required items
     * Checks variables type
     * Checks if exist transport type in code list
     * Checks if exist store and validate it
     *
     * @param $transport
     *
     * @throws InvalidStoreTypeException
     * @throws InvalidTransportTypeException
     * @throws MissingRequiredDataException
     */
    private function validateTransport($transport)
    {
        if (!$this->checkRequiredItems($this->requiredTransportItems, $transport)) {
            throw new MissingRequiredDataException('Transport must contain all required data');
        }

        $this->checkVariableType($transport[PaymentDeliveryService::TRANSPORT_ID], self::TYPE_INTEGER);
        $this->checkVariableType($transport[PaymentDeliveryService::TRANSPORT_TYPE], self::TYPE_INTEGER);
        $this->checkVariableType($transport[PaymentDeliveryService::TRANSPORT_NAME], self::TYPE_STRING);
        $this->checkVariableType($transport[PaymentDeliveryService::TRANSPORT_PRICE], self::TYPE_FLOAT);
        $this->checkVariableType($transport[PaymentDeliveryService::TRANSPORT_DESCRIPTION], self::TYPE_STRING);

        if (!$this->deliveryTypeCodes->isValid($transport[PaymentDeliveryService::TRANSPORT_TYPE])) {
            throw new InvalidTransportTypeException('Cannot found type from transport in code list');
        }

        if (array_key_exists(PaymentDeliveryService::KEY_STORE, $transport)) {
            $this->validateStore($transport[PaymentDeliveryService::KEY_STORE]);
        }
    }

    /**
     * Checks required items
     * Checks variables type
     * Checks if store type exist in code list
     *
     * @param $store
     *
     * @throws InvalidStoreTypeException
     * @throws MissingRequiredDataException
     */
    private function validateStore($store)
    {
        if (!$this->checkRequiredItems($this->requiredStoreItems, $store)) {
            throw new MissingRequiredDataException('Store must contain all required data');
        }

        $this->checkVariableType($store[PaymentDeliveryService::STORE_TYPE], self::TYPE_INTEGER);
        $this->checkVariableType($store[PaymentDeliveryService::STORE_ID], self::TYPE_INTEGER);


        if (!$this->storeTypeCodes->isValid($store[PaymentDeliveryService::STORE_TYPE])) {
            throw new InvalidStoreTypeException('Cannot found type from store in code list');
        }
    }

    /**
     * Checks required items
     * Checks variables type
     * Checks if payment type exist in code list
     *
     * @param $payment
     *
     * @throws InvalidPaymentTypeException
     * @throws MissingRequiredDataException
     */
    private function validatePayment($payment)
    {
        if (!$this->checkRequiredItems($this->requiredPaymentItems, $payment)) {
            throw new MissingRequiredDataException('Payment must contain all required data');
        }

        $this->checkVariableType($payment[PaymentDeliveryService::PAYMENT_ID], self::TYPE_INTEGER);
        $this->checkVariableType($payment[PaymentDeliveryService::PAYMENT_TYPE], self::TYPE_INTEGER);
        $this->checkVariableType($payment[PaymentDeliveryService::PAYMENT_NAME], self::TYPE_STRING);
        $this->checkVariableType($payment[PaymentDeliveryService::PAYMENT_PRICE], self::TYPE_FLOAT);

        if (!$this->paymentTypeCodes->isValid($payment[PaymentDeliveryService::PAYMENT_TYPE])) {
            throw new InvalidPaymentTypeException('Cannot found type from payment in code list');
        }
    }

    /**
     * Checks required items
     * Checks variables type
     *
     * @param $binding
     *
     * @throws MissingRequiredDataException
     */
    private function validateBinding($binding)
    {
        if (!$this->checkRequiredItems($this->requiredBindingItem, $binding)) {
            throw new MissingRequiredDataException('Binding must contain all required data);');
        }

        $this->checkVariableType($binding[PaymentDeliveryService::BINDING_ID], self::TYPE_INTEGER);
        $this->checkVariableType($binding[PaymentDeliveryService::BINDING_TRANSPORT_ID], self::TYPE_INTEGER);
        $this->checkVariableType($binding[PaymentDeliveryService::BINDING_PAYMENT_ID], self::TYPE_INTEGER);
    }

    /**
     * Gets ids from transports, payments and bindings
     * Checks duplicity
     * Checks if all transports and payments are paired in bindings
     *
     * @param $responseData
     *
     * @throws UniqueBindingException
     * @throws UniquePaymentException
     * @throws UniqueTransportException
     * @throws UnusedPaymentException
     * @throws UnusedTransportException
     */
    private function validateMatched($responseData)
    {
        $transportIds = array();
        $paymentIds = array();
        $bindingIds = array();

        foreach ($responseData[PaymentDeliveryService::KEY_TRANSPORT] as $transport) {
            array_push($transportIds, $transport[PaymentDeliveryService::TRANSPORT_ID]);
        }

        foreach ($responseData[PaymentDeliveryService::KEY_PAYMENT] as $payment) {
            array_push($paymentIds, $payment[PaymentDeliveryService::PAYMENT_ID]);
        }

        foreach ($responseData[PaymentDeliveryService::KEY_BINDING] as $binding) {
            array_push($bindingIds, $binding[PaymentDeliveryService::BINDING_ID]);
        }

        if ($this->arrayHasDupes($transportIds)) {
            throw new UniqueTransportException('Id`s in transport are not unique');
        }

        if ($this->arrayHasDupes($paymentIds)) {
            throw new UniquePaymentException('Id`s in payment are not unique');
        }

        if ($this->arrayHasDupes($bindingIds)) {
            throw new UniqueBindingException('Id`s in binding are not unique');
        }

        $this->validatePairing($transportIds, $paymentIds, $responseData[PaymentDeliveryService::KEY_BINDING]);
    }

    /**
     * Checks if all ids are unique in array
     *
     * @param $array
     *
     * @return bool
     */
    private function arrayHasDupes($array)
    {
        return count($array) !== count(array_unique($array));
    }

    /**
     * Checks if all transports and payments are paired in bindings
     *
     * @param $transportIds
     * @param $paymentIds
     * @param $bindings
     *
     * @throws BindingException
     * @throws UnusedPaymentException
     * @throws UnusedTransportException
     */
    private function validatePairing($transportIds, $paymentIds, $bindings)
    {
        $unusedTransports = $transportIds;
        $unusedPayments = $paymentIds;

        foreach ($bindings as $binding) {
            $key = $this->findId($binding[PaymentDeliveryService::BINDING_TRANSPORT_ID], $transportIds, 'Transport');

            if (array_key_exists($key, $unusedTransports)) {
                unset($unusedTransports[$key]);
            }

            $key = $this->findId($binding[PaymentDeliveryService::BINDING_PAYMENT_ID], $paymentIds, 'Payment');

            if (array_key_exists($key, $unusedPayments)) {
                unset($unusedPayments[$key]);
            }
        }

        if (count($unusedTransports) !== 0) {
            throw new UnusedTransportException('Transport with id ' . reset($unusedTransports) . ' is not paired in binding');
        }

        if (count($unusedPayments) !== 0) {
            throw new UnusedPaymentException('Payment with id ' . reset($unusedPayments) . ' is not paired in binding');
        }

    }

    /**
     * Checks if id is in select group
     *
     * @param $id
     * @param $definedIds
     * @param $group
     *
     * @return int
     * @throws BindingException
     */
    private function findId($id, $definedIds, $group)
    {
        $key = array_search($id, $definedIds);

        if ($key === false) {
            throw new BindingException($group . ' id ' . $id . ' is not defined');
        }

        return $key;
    }

}

class InvalidTransportTypeException extends ValidatorException {}

class InvalidStoreTypeException extends ValidatorException {}

class InvalidPaymentTypeException extends ValidatorException {}

class UniqueTransportException extends ValidatorException {}

class UniquePaymentException extends ValidatorException {}

class UniqueBindingException extends ValidatorException {}

class UnusedTransportException extends ValidatorException {}

class UnusedPaymentException extends ValidatorException {}

class BindingException extends ValidatorException {}
