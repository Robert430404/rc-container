<?php

namespace RcContainer\Contracts;

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
     * @return mixed
     */
    public function registerService(string $id);

    /**
     * De-Registers a service from the container
     *
     * @param string $id
     * @return mixed
     */
    public function deRegisterService(string $id);

    /**
     * Registers a new parameter inside of the container.
     *
     * @param string $id
     * @return mixed
     */
    public function registerParameter(string $id);

    /**
     * De-Registers a parameter from the container.
     *
     * @param string $id
     * @return mixed
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
}