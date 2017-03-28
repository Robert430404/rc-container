<?php

namespace RcContainer\Contracts;

use Closure;

/**
 * Interface ContainerInterface
 *
 * This is the contract that gets implemented on the container it's self. This outlines
 * the basic set of features that the container needs to have in order to function.
 *
 * @package RcContainer\Contracts
 */
interface ContainerInterface
{
    /**
     * Registers new service inside of the container
     *
     * @param string $id
     * @param $handler
     * @return void
     */
    public function registerService(string $id, Closure $handler);

    /**
     * De-Registers a service from the container
     *
     * @param string $id
     * @return void
     */
    public function deRegisterService(string $id);

    /**
     * Registers new service inside of the container
     *
     * @param string $id
     * @param $handler
     * @return void
     */
    public function registerServices(array $handlers);

    /**
     * Registers a factory inside of the container
     *
     * @param string $id
     * @param Closure $handler
     * @return void
     */
    public function registerFactory(string $id, Closure $handler);

    /**
     * De-Registers a factory from the container
     *
     * @param string $id
     * @return void
     */
    public function deRegisterFactory(string $id);

    /**
     * Registers a new parameter inside of the container.
     *
     * @param string $id
     * @param $handler
     * @return void
     */
    public function registerParameter(string $id, Closure $handler);

    /**
     * De-Registers a parameter from the container.
     *
     * @param string $id
     * @return void
     */
    public function deRegisterParameter(string $id);

    /**
     * Returns a registered service and throws an exception when its not found
     *
     * @param string $id
     * @return mixed
     */
    public function service(string $id);

    /**
     * Returns a registered parameter and throws an exception when its not found
     *
     * @param string $id
     * @return mixed
     */
    public function parameter(string $id);

    /**
     * Returns a new instance of the object registered to the factory
     *
     * @param string $id
     * @return mixed
     */
    public function factory(string $id);
}