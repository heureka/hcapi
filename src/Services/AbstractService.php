<?php

namespace Hcapi\Services;

use ErrorException;
use Hcapi\Interfaces\IShopImplementation;
use Hcapi\Validators\AbstractValidator;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
abstract class AbstractService
{

    /**
     * @var AbstractValidator
     */
    protected $validator;

    /**
     * Calls callback for obtain the required data, validates them and prepares them to be sent back to the Heureka.
     *
     * @param       $callback
     * @param array $receiveData
     *
     * @return array
     * @throws ServiceException
     */
    public function processData($callback, $receiveData)
    {
        if (empty($callback) || empty ($receiveData)) {
            throw new ServiceException('Callback and parameter receiveData must be fill.');
        }

        if ($callback instanceof IShopImplementation) {
            $responseData = $callback->getResponse($receiveData);
        } else if (is_callable($callback, true)) {
            $responseData = call_user_func($callback, $receiveData);
        } else {
            throw new UndefinedCallbackException('Undefined callback type');
        }

        $this->validateData($responseData);

        return json_encode($responseData);
    }

    /**
     * Validate response data
     *
     * @param array $responseData
     *
     * @return array
     */
    private function validateData($responseData)
    {
        return $this->validator->validate($responseData);
    }

}

class ServiceException extends ErrorException
{

}

class UndefinedCallbackException extends ServiceException
{

}
