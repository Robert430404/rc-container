<?php

namespace RcContainer\Tests;

use PHPUnit\Framework\TestCase;
use RcContainer\Container;
use RcContainer\Exceptions\FactoryNotFoundException;
use RcContainer\Exceptions\ParameterNotFoundException;
use RcContainer\Exceptions\ServiceNotFoundException;
use stdClass;

/**
 * Class ContainerTest
 *
 * @package RcContainer\Tests
 */
class ContainerTest extends TestCase
{
    /**
     * Tests to make sure the right exception is thrown when a service
     * is not found
     */
    public function testServiceNotFound()
    {
        $this->expectException(ServiceNotFoundException::class);

        $container = new Container();

        $container->service('test');
    }

    /**
     * Tests multi service declaration
     */
    public function testMultiServiceRegistration()
    {
        $container = new Container();

        $container->registerServices([
            'service' => function () {
                return new stdClass();
            },
            'second-service' => function () {
                return new stdClass();
            }
        ]);

        $service  = $container->service('service');
        $service1 = $container->service('service');

        $this->assertEquals($service instanceof stdClass, true);
        $this->assertEquals($service, $service1);

        $secondService  = $container->service('second-service');
        $secondService1 = $container->service('second-service');

        $this->assertEquals($secondService instanceof stdClass, true);
        $this->assertEquals($secondService, $secondService1);
    }

    /**
     * Tests multi service declaration with just the class name
     */
    public function testMultiServiceRegistrationWithClassName()
    {
        $container = new Container();

        $container->registerServices([
            'service'        => 'stdClass',
            'second-service' => 'stdClass'
        ]);

        $service  = $container->service('service');
        $service1 = $container->service('service');

        $this->assertEquals($service instanceof stdClass, true);
        $this->assertEquals($service, $service1);

        $secondService  = $container->service('second-service');
        $secondService1 = $container->service('second-service');

        $this->assertEquals($secondService instanceof stdClass, true);
        $this->assertEquals($secondService, $secondService1);
    }

    /**
     * Tests to make sure the container resolves the service
     */
    public function testServiceIsFound()
    {
        $container = new Container();

        $container->registerService('test', function () {
            return new stdClass();
        });

        $service  = $container->service('test');
        $service1 = $container->service('test');

        $this->assertEquals($service instanceof stdClass, true);
        $this->assertEquals($service, $service1);
    }

    /**
     * Tests to make sure the container resolves the service when many are
     * present in the container
     */
    public function testMultipleServiceIsFound()
    {
        $container = new Container();

        $container->registerService('test', function () {
            return new stdClass();
        });
        $container->registerService('test1', function () {
            return new stdClass();
        });
        $container->registerService('test2', function () {
            return new stdClass();
        });

        $service  = $container->service('test');
        $service1 = $container->service('test1');
        $service2 = $container->service('test2');

        $this->assertEquals($service  instanceof stdClass, true);
        $this->assertEquals($service1 instanceof stdClass, true);
        $this->assertEquals($service2 instanceof stdClass, true);

        $this->assertEquals($service1 === $service,  false);
        $this->assertEquals($service2 === $service,  false);
        $this->assertEquals($service1 === $service2, false);
    }

    /**
     * Tests to make sure the right exception is thrown when a
     * service is not found after being registered and de-registered
     */
    public function testServiceNotFoundAfterDeRegistered()
    {
        $this->expectException(ServiceNotFoundException::class);

        $container = new Container();

        $container->registerService('test', function () {
            return new stdClass();
        });

        $service = $container->service('test');

        $this->assertEquals($service instanceof stdClass, true);
        $container->deRegisterService('test');
        $container->service('test');
    }

    /**
     * Tests to make sure the right exception is thrown when a
     * parameter is not found
     */
    public function testParameterNotFound()
    {
        $this->expectException(ParameterNotFoundException::class);

        $container = new Container();

        $container->parameter('test');
    }

    /**
     * Tests multi service declaration
     */
    public function testMultiParameterRegistration()
    {
        $container = new Container();

        $container->registerParameters([
            'test' => function () {
                return 'test-param';
            },
            'second-test' => function () {
                return 'second-test-param';
            }
        ]);

        $param  = $container->parameter('test');
        $param1 = $container->parameter('test');

        $this->assertEquals(is_string($param), true);
        $this->assertEquals($param, 'test-param');
        $this->assertEquals($param, $param1);

        $secondParam  = $container->parameter('second-test');
        $secondParam1 = $container->parameter('second-test');

        $this->assertEquals(is_string($secondParam), true);
        $this->assertEquals($secondParam, 'second-test-param');
        $this->assertEquals($secondParam, $secondParam1);
    }

    /**
     * Tests multi service declaration
     */
    public function testMultiParameterRegistrationWithoutCallable()
    {
        $container = new Container();

        $container->registerParameters([
            'test'        => 'test-param',
            'second-test' => 'second-test-param'
        ]);

        $param  = $container->parameter('test');
        $param1 = $container->parameter('test');

        $this->assertEquals(is_string($param), true);
        $this->assertEquals($param, 'test-param');
        $this->assertEquals($param, $param1);

        $secondParam  = $container->parameter('second-test');
        $secondParam1 = $container->parameter('second-test');

        $this->assertEquals(is_string($secondParam), true);
        $this->assertEquals($secondParam, 'second-test-param');
        $this->assertEquals($secondParam, $secondParam1);
    }

    /**
     * Tests to make sure the container resolves the parameter
     */
    public function testSimpleParameterIsFound()
    {
        $container = new Container();

        $container->registerParameter('test', function () {
            return 'test';
        });

        $param  = $container->parameter('test');
        $param1 = $container->parameter('test');

        $this->assertEquals(is_string($param), true);
        $this->assertEquals($param, 'test');
        $this->assertEquals($param, $param1);
    }

    /**
     * Tests to make sure the container resolves the parameter when
     * multiple parameters are present
     */
    public function testMultipleSimpleParameterIsFound()
    {
        $container = new Container();

        $container->registerParameter('test', function () {
            return 'test';
        });
        $container->registerParameter('test1', function () {
            return 'test1';
        });
        $container->registerParameter('test2', function () {
            return 'test2';
        });

        $param  = $container->parameter('test');
        $param1 = $container->parameter('test1');
        $param2 = $container->parameter('test2');

        $this->assertEquals(is_string($param),  true);
        $this->assertEquals(is_string($param1), true);
        $this->assertEquals(is_string($param2), true);

        $this->assertEquals($param, 'test');
        $this->assertEquals($param1, 'test1');
        $this->assertEquals($param2, 'test2');

        $this->assertEquals($param1 === $param,  false);
        $this->assertEquals($param2 === $param,  false);
        $this->assertEquals($param1 === $param2, false);
    }

    /**
     * Tests to make sure the container resolves the parameter
     */
    public function testArrayParameterIsFound()
    {
        $container = new Container();

        $container->registerParameter('test', function () {
            return [
                'test' => 'this-is-a-test',
            ];
        });

        $param  = $container->parameter('test');
        $param1 = $container->parameter('test');

        $this->assertEquals(is_array($param), true);
        $this->assertEquals($param, [ 'test' => 'this-is-a-test' ]);
        $this->assertEquals($param, $param1);
    }

    /**
     * Tests to make sure the container resolves the parameter when
     * multiple parameters are present
     */
    public function testMultipleArrayParameterIsFound()
    {
        $container = new Container();

        $container->registerParameter('test', function () {
            return [
                'test' => 'this-is-a-test',
            ];
        });
        $container->registerParameter('test1', function () {
            return [
                'test' => 'this-is-a-test-1',
            ];
        });
        $container->registerParameter('test2', function () {
            return [
                'test' => 'this-is-a-test-2',
            ];
        });

        $param  = $container->parameter('test');
        $param1 = $container->parameter('test1');
        $param2 = $container->parameter('test2');

        $this->assertEquals(is_array($param),  true);
        $this->assertEquals(is_array($param1), true);
        $this->assertEquals(is_array($param2), true);

        $this->assertEquals($param,  [ 'test' => 'this-is-a-test' ]);
        $this->assertEquals($param1, [ 'test' => 'this-is-a-test-1' ]);
        $this->assertEquals($param2, [ 'test' => 'this-is-a-test-2', ]);

        $this->assertEquals($param1 === $param,  false);
        $this->assertEquals($param2 === $param,  false);
        $this->assertEquals($param1 === $param2, false);
    }

    /**
     * Tests to make sure the right exception is thrown when a
     * parameter is not found after being registered and de-registered
     */
    public function testParameterNotFoundAfterDeRegistered()
    {
        $this->expectException(ParameterNotFoundException::class);

        $container = new Container();

        $container->registerParameter('test', function () {
            return 'test';
        });

        $param = $container->parameter('test');

        $this->assertEquals(is_string($param), true);
        $container->deRegisterParameter('test');
        $container->parameter('test');
    }

    /**
     * Tests to make sure the right exception is thrown when a service
     * is not found
     */
    public function testFactoryNotFound()
    {
        $this->expectException(FactoryNotFoundException::class);

        $container = new Container();

        $container->factory('test');
    }

    /**
     * Tests the multi factory registrations
     */
    public function testMultiFactoryRegistration()
    {
        $container = new Container();

        $container->registerFactories([
            'test' => function () {
                return new stdClass();
            },
            'second-test' => function () {
                return new stdClass();
            }
        ]);

        $factory  = $container->factory('test');
        $factory1 = $container->factory('test');

        $this->assertEquals($factory instanceof stdClass, true);
        $this->assertEquals($factory === $factory1, false);

        $secondFactory  = $container->factory('second-test');
        $secondFactory1 = $container->factory('second-test');

        $this->assertEquals($secondFactory instanceof stdClass, true);
        $this->assertEquals($secondFactory === $secondFactory1, false);
    }

    /**
     * Tests multi service declaration with just the class name
     */
    public function testMultiFactoryRegistrationWithClassName()
    {
        $container = new Container();

        $container->registerFactories([
            'test'        => 'stdClass',
            'second-test' => 'stdClass'
        ]);

        $factory  = $container->factory('test');
        $factory1 = $container->factory('test');

        $this->assertEquals($factory instanceof stdClass, true);
        $this->assertEquals($factory === $factory1, false);

        $secondFactory  = $container->factory('second-test');
        $secondFactory1 = $container->factory('second-test');

        $this->assertEquals($secondFactory instanceof stdClass, true);
        $this->assertEquals($secondFactory === $secondFactory1, false);
    }

    /**
     * Tests to make sure the container resolves the service
     */
    public function testFactoryIsFound()
    {
        $container = new Container();

        $container->registerFactory('test', function () {
            return new stdClass();
        });

        $factory  = $container->factory('test');
        $factory1 = $container->factory('test');

        $this->assertEquals($factory instanceof stdClass, true);
        $this->assertEquals($factory === $factory1, false);
    }

    /**
     * Tests to make sure the container resolves the service when many are
     * present in the container
     */
    public function testMultipleFactoryIsFound()
    {
        $container = new Container();

        $container->registerFactory('test', function () {
            return new stdClass();
        });
        $container->registerFactory('test1', function () {
            return new stdClass();
        });
        $container->registerFactory('test2', function () {
            return new stdClass();
        });

        $factory   = $container->factory('test');
        $factoryA  = $container->factory('test');
        $factory1  = $container->factory('test1');
        $factory12 = $container->factory('test1');
        $factory2  = $container->factory('test2');
        $factory22 = $container->factory('test2');

        $this->assertEquals($factory  instanceof stdClass, true);
        $this->assertEquals($factory1 instanceof stdClass, true);
        $this->assertEquals($factory2 instanceof stdClass, true);

        $this->assertEquals($factory1 === $factory,  false);
        $this->assertEquals($factory2 === $factory,  false);
        $this->assertEquals($factory1 === $factory2, false);

        $this->assertEquals($factoryA === $factory,   false);
        $this->assertEquals($factory2 === $factory22, false);
        $this->assertEquals($factory1 === $factory12, false);
    }

    /**
     * Tests to make sure the right exception is thrown when a
     * factory is not found after being registered and de-registered
     */
    public function testFactoryNotFoundAfterDeRegistered()
    {
        $this->expectException(FactoryNotFoundException::class);

        $container = new Container();

        $container->registerFactory('test', function () {
            return new stdClass();
        });

        $factory = $container->factory('test');

        $this->assertEquals($factory instanceof stdClass, true);
        $container->deRegisterFactory('test');
        $container->factory('test');
    }
}