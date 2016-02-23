<?php

namespace Hcapi\Validators;

use ErrorException;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
abstract class AbstractValidator
{

    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_ARRAY = 'array';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_NUMERIC = 'numeric';

    abstract function validate($data);

    /**
     * @param array $keys
     * @param array $response
     *
     * @return bool
     */
    protected function checkRequiredItems($keys, $response)
    {
        if (count(array_intersect_key(array_flip($keys), $response)) === count($keys)) {
            return true;
        }
        return false;
    }

    /**
     * @param mixed  $variable
     * @param string $type
     *
     * @throws ExpectedArrayException
     * @throws ExpectedBooleanException
     * @throws ExpectedFloatException
     * @throws ExpectedIntegerException
     * @throws ExpectedNumericException
     * @throws ExpectedStringException
     * @throws UndefinedVariableTypeException
     */
    protected function checkVariableType($variable, $type)
    {
        switch ($type) {
            case self::TYPE_INTEGER:
                $this->checkInteger($variable);
                break;
            case self::TYPE_STRING:
                $this->checkString($variable);
                break;
            case self::TYPE_BOOLEAN:
                $this->checkBoolean($variable);
                break;
            case self::TYPE_FLOAT:
                $this->checkFloat($variable);
                break;
            case self::TYPE_ARRAY:
                $this->checkArray($variable);
                break;
            case self::TYPE_NUMERIC:
                $this->checkNumeric($variable);
                break;
            default:
                throw new UndefinedVariableTypeException('Undefined variable type: ' . $type);
                break;
        }
    }

    private function checkInteger($variable)
    {
        if (!is_int($variable)) {
            throw new ExpectedIntegerException('Variable ' . $variable . ' must be integer');
        }
    }

    private function checkString($variable)
    {
        if (!is_string($variable)) {
            throw new ExpectedStringException('Variable ' . $variable . ' must be string');
        }
    }

    private function checkBoolean($variable)
    {
        if (!is_bool($variable)) {
            throw new ExpectedBooleanException('Variable ' . $variable . ' must be boolean');
        }
    }

    private function checkFloat($variable)
    {
        if (!is_float($variable)) {
            throw new ExpectedFloatException('Variable ' . $variable . ' must be float');
        }
    }

    private function checkArray($variable)
    {
        if (!is_array($variable)) {
            throw new ExpectedArrayException('Variable ' . $variable . ' must be array');
        }
    }

    private function checkNumeric($variable)
    {
        if (!is_numeric($variable)) {
            throw new ExpectedNumericException('Variable ' . $variable . ' must be numeric');
        }
    }

}

class ValidatorException extends ErrorException {}

class ExpectedIntegerException extends ValidatorException {}

class ExpectedStringException extends ValidatorException {}

class ExpectedBooleanException extends ValidatorException {}

class ExpectedFloatException extends ValidatorException {}

class ExpectedArrayException extends ValidatorException {}

class ExpectedNumericException extends ValidatorException {}

class ExpectedResponseDataException extends ValidatorException {}

class UndefinedVariableTypeException extends ValidatorException {}

class MissingRequiredDataException extends ValidatorException {}
