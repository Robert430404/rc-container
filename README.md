### What Is This?

This is RC Container. This is a simple dependency injection container that allows you to register services, parameters,
and factories for your application and then retrieve/de-register them.

### Why Write This?

I did it to flex my brain, and get a full understanding of how DI-Containers work in the PHP space. Rather than just
reading about it and assuming I knew what did what, I wrote this to solidify my knowledge.

### Installing The Package

Once it, the tests, and the documentation are complete, it will be available via composer.

### How Does It Work?

This will be a composer package so it relies on composer for the autoloading of the classes. You then create a new
instance of the Container() object and start assigning your services/parameters/factories to the instance.

Once you have your services/parameters/factories defined, you then call the retrieval methods on the container to get
access to your registered services/parameters/factories.

### What Are Some Of The Features?

The container is going to support parameters in string and array form, services, and factories. This is going to give
a relatively full feature set for most applications.