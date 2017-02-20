<?php

namespace RcContainer\Exceptions;

use Exception;

/**
 * Class ServiceNotFoundException
 *
 * Thrown when a service is not found in the container
 *
 * @package RcContainer\Exceptions
 */
class ServiceNotFoundException extends Exception
{
    /**
     * ServiceNotFoundException constructor.
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