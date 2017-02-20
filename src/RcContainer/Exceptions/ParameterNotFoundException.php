<?php

namespace RcContainer\Exceptions;

use Exception;

/**
 * Class ParameterNotFoundException
 *
 * Thrown when a parameter is not found inside of the container
 *
 * @package RcContainer\Exceptions
 */
class ParameterNotFoundException extends Exception
{
    /**
     * ParameterNotFoundException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}