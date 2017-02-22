[![Latest Stable Version](https://poser.pugx.org/robert430404/rc-container/v/stable)](https://packagist.org/packages/robert430404/rc-container)
[![Build Status](https://travis-ci.org/Robert430404/rc-container.svg?branch=master)](https://travis-ci.org/Robert430404/rc-container)
[![codecov](https://codecov.io/gh/Robert430404/rc-container/branch/master/graph/badge.svg)](https://io/gh/Robert430404/rc-container)

### What Is This?

This is RC Container. This is a simple dependency injection container that allows you to register services, parameters,
and factories for your application and then retrieve/de-register them.

### Why Write This?

I did it to flex my brain, and get a full understanding of how DI-Containers work in the PHP space. Rather than just
reading about it and assuming I knew what did what, I wrote this to solidify my knowledge.

### Installing The Package

To install and use this package, install it with composer:

    composer require robert430404/rc-container

### How Does It Work?

The container relies on composer for the autoloading of the classes. You then create a new instance of the Container()
object and start assigning your services/parameters/factories to the instance.

```php
<?php

use RcContainer\Container;

require 'vendor/autoload.php';

$container = new Container();

$container->registerParameter('test-parameter', function () {
    return 'this-is-the-test-param';
});

$container->registerService('test-service', function () {
    return new stdClass();
});

$container->registerFactory('test-factory', function () {
    return new stdClass();
});
```

Once you have your services/parameters/factories defined, you then call the retrieval methods on the container to get
access to your registered services/parameters/factories.

```php
<?php

$container->parameter('test-parameter'); // Returns your param
$container->service('test-service'); // Returns the service (Same Instance)
$container->factory('test-factory'); // Returns the factory's object (New Instance)
```

### What Are Some Of The Features?

The container allows you to bind service, factories, and parameters to it. This allows you to have a central place to
access your dependencies and inject what ever is needed as needed. You can also inject interlocking dependencies via the
container by passing the container into the closure.

```php
<?php

use RcContainer\Container;
use Vendor\SDKObject; // Made Up Namespace

require 'vendor/autoload.php';

$container = new Container();

// Parameters
$container->registerParameter('api-key', function () {
    return '000-000-000-000-0000';
});

// Services
$container->registerService('the-api', function () use ($container) {
    $apiKey = $container->parameter('api-key'); // Retrieves Registered Key
    
    return new SDKObject($apiKey); // Made Up Object
});
```

The same method works to pass around services:

```php
<?php

use RcContainer\Container;
use Vendor\SDKObject; // Made Up Namespace
use Vendor\DataFactory; // Made Up Namespace

require 'vendor/autoload.php';

$container = new Container();

// Parameters
$container->registerParameter('api-key', function () {
    return '000-000-000-000-0000';
});

// Services
$container->registerService('the-api', function () use ($container) {
    $apiKey = $container->parameter('api-key'); // Retrieves Registered Key
    
    return new SDKObject($apiKey); // Made Up Object
});

// Factories
$container->registerFactory('data-factory', function () use ($container) {
    $apiSdk = $container->service('the-api');
    
    return new DataFactory($apiSdk);
});
```

This gives you a robust and easy to use container that should suit most DI needs.