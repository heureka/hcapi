<?php

namespace Hcapi\Codes;

/**
 * @author Oldřich Taufer <oldrich.taufer@heureka.cz>
 */
abstract class AbstractCodes
{

    /**
     * @var array
     */
    protected $codes;

    public function __construct()
    {
        $this->codes = $this->getConstants();
    }

    /**
     * Checks if value exists in code
     *
     * @param int $codeValue
     *
     * @return bool
     */
    public function isValid($codeValue)
    {
        if (in_array($codeValue, $this->codes, true)) {
            return true;
        }
        return false;
    }

    abstract protected function getConstants();

}
