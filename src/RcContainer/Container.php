<?php

namespace RcContainer;

use RcContainer\Contracts\ContainerInterface;

/**
 * Class Container
 *
 * @package RcContainer
 */
class Container implements ContainerInterface
{
    private $services;

    private $parameters;

    /**
     * Container constructor.
     */
    function __construct()
    {

    }

    /**
     * Registers a service inside of the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function registerService(string $id)
    {

    }

    /**
     * De-Registers a service from the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function deRegisterService(string $id)
    {

    }

    /**
     * Registers a parameter inside of the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function registerParameter(string $id)
    {
        // TODO: Implement registerParameter() method.
    }

    /**
     * De-Registers a parameter inside of the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function deRegisterParameter(string $id)
    {
        // TODO: Implement deRegisterParameter() method.
    }

    /**
     * Returns the service and throws an exception when it doesn't exist
     *
     * @param string $id
     * @return mixed|void
     */
    public function service(string $id)
    {
        // TODO: Implement service() method.
    }

    /**
     * Returns the parameter and throws an exception when it doesn't exist
     *
     * @param string $id
     * @return mixed|void
     */
    public function parameter(string $id)
    {
        // TODO: Implement parameter() method.
    }
}