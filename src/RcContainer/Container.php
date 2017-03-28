<?php

namespace RcContainer;

use Closure;
use RcContainer\Contracts\ContainerInterface;
use RcContainer\Exceptions\FactoryNotFoundException;
use RcContainer\Exceptions\ParameterNotFoundException;
use RcContainer\Exceptions\ServiceNotFoundException;

/**
 * Class Container
 *
 * @package RcContainer
 */
class Container implements ContainerInterface
{
    /**
     * @var array
     */
    private $services;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $factories;

    /**
     * Container constructor.
     */
    function __construct()
    {
        $this->services   = [];
        $this->parameters = [];
        $this->factories  = [];
    }

    /**
     * Registers a service inside of the container
     *
     * @param string $id
     * @param $handler
     * @return mixed|void
     */
    public function registerService(string $id, Closure $handler)
    {
        $this->services[$id] = $handler();
    }

    /**
     * De-Registers a service from the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function deRegisterService(string $id)
    {
        unset($this->services[$id]);
    }

    /**
     * Registers all of the provided services
     *
     * @param array $handlers
     * @return void
     */
    public function registerServices(array $handlers)
    {
        foreach ($handlers as $id => $handler) {
            $this->services[$id] = $handler();
        }
    }

    /**
     * Registers a factory inside of the container
     *
     * @param string $id
     * @param Closure $handler
     * @return mixed|void
     */
    public function registerFactory(string $id, Closure $handler)
    {
        $this->factories[$id] = $handler;
    }

    /**
     * De-Registers a factory from the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function deRegisterFactory(string $id)
    {
        unset($this->factories[$id]);
    }

    /**
     * Registers all of the provided services
     *
     * @param array $handlers
     * @return void
     */
    public function registerFactories(array $handlers)
    {
        foreach ($handlers as $id => $handler) {
            $this->factories[$id] = $handler;
        }
    }

    /**
     * Registers a parameter inside of the container
     *
     * @param string $id
     * @param $handler
     * @return mixed|void
     */
    public function registerParameter(string $id, Closure $handler)
    {
        $this->parameters[$id] = $handler();
    }

    /**
     * De-Registers a parameter inside of the container
     *
     * @param string $id
     * @return mixed|void
     */
    public function deRegisterParameter(string $id)
    {
        unset($this->parameters[$id]);
    }

    /**
     * Registers all of the provided services
     *
     * @param array $handlers
     * @return void
     */
    public function registerParameters(array $handlers)
    {
        foreach ($handlers as $id => $handler) {
            $this->parameters[$id] = $handler();
        }
    }

    /**
     * Returns the service and throws an exception when it doesn't exist
     *
     * @param string $id
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function service(string $id)
    {
        if (!isset($this->services[$id])) {
            throw new ServiceNotFoundException("The service, $id, has not been registered with the container");
        }

        return $this->services[$id];
    }

    /**
     * Returns the parameter and throws an exception when it doesn't exist
     *
     * @param string $id
     * @return mixed
     * @throws ParameterNotFoundException
     */
    public function parameter(string $id)
    {
        if (!isset($this->parameters[$id])) {
            throw new ParameterNotFoundException("The parameter, $id, has not been registered with the container");
        }

        return $this->parameters[$id];
    }

    /**
     * Returns a new instance of the object registered to the factory
     *
     * @param string $id
     * @return mixed
     * @throws FactoryNotFoundException
     */
    public function factory(string $id)
    {
        if (!isset($this->factories[$id])) {
            throw new FactoryNotFoundException("The factory, $id, has not been registered with the container");
        }

        return $this->factories[$id]();
    }
}