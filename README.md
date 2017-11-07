apitoolkits/curl
================


[![Latest Version on Packagist](https://img.shields.io/packagist/v/apitoolkits/curl.svg?style=flat-square)](https://packagist.org/packages/apitoolkits/curl)
[![Total Downloads](https://img.shields.io/packagist/dt/apitoolkits/curl.svg?style=flat-square)](https://packagist.org/packages/apitoolkits/curl)

Custom PHP cURL library for the Laravel 4 or 5 framework - developed by [apitoolkits](http://apitoolkits.com).

The package provides an easy interface for sending cURL requests from your PHP web application. The package provides an 
intuitive, fluent interface similar the Laravel query builder to easily configure the request. Additionally, There are 
several utility methods that allow you to easily add certain options to the request. This makes it easier to create and
use cURL requests and also makes your code more comprehensible.

The provided functionality is completely framework-independent but also contains a Laravel service provider for easy 
integration into your Laravel project.
 

 > Note before posting an issue: When posting an issue for the package, always be sure to provide as much information 
 > regarding the request as possible. This includes the example cURL request you are trying to transfer into the package
 > syntax, your actual package syntax (the full request) and (if possible) an example URL I can use to test the request
 > myself if need be.




## Installation

Pull this package in through Composer.

```js

    {
        "require": {
            "apitoolkits/curl": "1.0.*"
        }
    }

```

or run in terminal:
`composer require apitoolkits/curl`

### Laravel 5.5+ Integration

Laravel's package discovery will take care of integration for you.


### Laravel 5.* Integration

Add the service provider to your `config/app.php` file:

```php

    'providers'     => array(

        //...
        Apitoolkits\Curl\CurlServiceProvider::class,

    ),

```

Add the facade to your `config/app.php` file:

```php

    'aliases'       => array(

        //...
        'Curl'          => Apitoolkits\Curl\Facades\Curl::class,

    ),

```


### Laravel 4.* Integration

Add the service provider to your `app/config/app.php` file:

```php

    'providers'     => array(

        //...
        'Apitoolkits\Curl\CurlServiceProvider',

    ),

```

Add the facade to your `app/config/app.php` file:

```php

    'facades'       => array(

        //...
        'Curl'          => 'Apitoolkits\Curl\Facades\Curl',

    ),

```


### Lumen 5.* integration

In your `bootstrap/app.php`, make sure you've un-commented the following line (around line 26):

```
$app->withFacades();
```

Then, register your class alias:
```
class_alias('Apitoolkits\Curl\Facades\Curl', 'Curl');
```

Finally, you have to register your ServiceProvider (around line 70-80):

```
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register('App\Providers\AppServiceProvider');

// Package service providers
$app->register(Apitoolkits\Curl\CurlServiceProvider::class);
```


### Integration without Laravel

Create a new instance of the `CurlService` where you would like to use the package:

```php

    $curlService = new \Apitoolkits\Curl\CurlService();

```




## Usage

### Laravel usage

The package provides an easy interface for sending cURL requests from your application. The package provides a fluent
interface similar the Laravel query builder to easily configure the request. There are several utility methods that allow
you to easily add certain options to the request. If no utility method applies, you can also use the general `withOption`
method.

### Sending GET requests

In order to send a `GET` request, you need to use the `get()` method that is provided by the package:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a GET request to: http://www.foo.com/bar
    $response = Curl::to('http://www.foo.com/bar')
        ->get();

    // Send a GET request to: http://www.foo.com/bar?foz=baz
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->get();

    // Send a GET request to: http://www.foo.com/bar?foz=baz using JSON
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson()
        ->get();

```


### Sending POST requests

Post requests work similar to `GET` requests, but use the `post()` method instead:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a POST request to: http://www.foo.com/bar
    $response = Curl::to('http://www.foo.com/bar')
        ->post();
    
    // Send a POST request to: http://www.foo.com/bar
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->post();
    
    // Send a POST request to: http://www.foo.com/bar with arguments 'foz' = 'baz' using JSON
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson()
        ->post();
    
    // Send a POST request to: http://www.foo.com/bar with arguments 'foz' = 'baz' using JSON and return as associative array
    $response = Curl::to('http://www.foo.com/bar')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson( true )
        ->post();

```


### Sending PUT requests

Put requests work similar to `POST` requests, but use the `put()` method instead:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a PUT request to: http://www.foo.com/bar/1 with arguments 'foz' = 'baz' using JSON
    $response = Curl::to('http://www.foo.com/bar/1')
       ->withData( array( 'foz' => 'baz' ) )
       ->asJson()
       ->put();

```


### Sending PATCH requests

Patch requests work similar to `POST` requests, but use the `patch()` method instead:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a PATCH request to: http://www.foo.com/bar/1 with arguments 'foz' = 'baz' using JSON
    $response = Curl::to('http://www.foo.com/bar/1')
        ->withData( array( 'foz' => 'baz' ) )
        ->asJson()
        ->patch();

```


### Sending DELETE requests

Delete requests work similar to `GET` requests, but use the `delete()` method instead:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a DELETE request to: http://www.foo.com/bar/1 using JSON
    $response = Curl::to('http://www.foo.com/bar/1')
        ->asJson()
        ->delete();

```


### Sending custom headers

Sending custom headers is easy with the `withHeader()` method. Multiple calls can be chained together to add multiple headers to the request:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a GET request to: http://www.foo.com/bar with 2 custom headers
    $response = Curl::to('http://foo.com/bar')
        ->withHeader('MyFirstHeader: 123')
        ->withHeader('MySecondHeader: 456')
        ->get();

```

Alternatively, you can use the `withHeaders()` to combine multiple headers into one method call:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a GET request to: http://www.foo.com/bar with 2 custom headers
    $response = Curl::to('http://foo.com/bar')
        ->withHeaders( array( 'MyFirstHeader: 123', 'MySecondHeader: 456' ) )
        ->get();

```


### Specifying the content type

Sending custom headers is easy with the `withcontentType()` method. Multiple calls can be chained together to add multiple headers to the request:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a GET request to: http://www.foo.com/bar with a json content type
    $response = Curl::to('http://foo.com/bar')
        ->withContentType('application/json')
        ->get();

```


### Sending files via Curl

For sending files via a POST request, you can use the `withFile` method to correctly format a request before sending:

```php

    use Apitoolkits\Curl\Facades\Curl;

    $response = Curl::to('http://foo.com/bar')
        ->withData( array( 'Foo' => 'Bar' ) )
        ->withFile( 'image_1', '/path/to/dir/image1.png', 'image/png', 'imageName1.png' )
        ->withFile( 'image_2', '/path/to/dir/image2.png', 'image/png', 'imageName2.png' )
        ->post();

```

You can add as many files to the request as you want. A couple of things to keep in mind:

- When submitting files, the `asJson()` method and `asJsonRequest()` method cannot be used. If you do, the files will not be transferred correctly
- The files are added to the data that was provided in the `withData()` method using the first parameter of the `withFile()` method. If this key already exists, it will be overridden.


### Downloading files

For downloading a file, you can use the `download()` method:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Download an image from: file http://www.foo.com/bar.png
    $response = Curl::to('http://foo.com/bar.png')
        ->withContentType('image/png')
        ->download('/path/to/dir/image.png');

```


### Using response objects

By default, the package will only return the content of the request. In some cases, it might also be useful to know
additional request information, such as the HTTP status code and error messages should they occur. In this case, you
can use the `returnResponseObject()` method, which will return an stdClass that contains additional information as 
well as the response content:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a GET request to http://www.foo.com/bar and return a response object with additional information
    $response = Curl::to('http://www.foo.com/bar')
        ->returnResponseObject()
        ->get();
            
    $content = $response->content;

```

The response object will look like this:

```json
{
   "content": "Message content here",
   "status": 200,
   "contentType": "content-type response header (ex: application/json)",
   "error": "Error message goes here (Only added if an error occurs)"
}
```


### Debugging requests

In case a request fails, it might be useful to get debug the request. In this case, you can use the `enableDebug()` method.
This method uses one parameter, which is the name of the file in which the debug information is to be stored:

```php

    use Apitoolkits\Curl\Facades\Curl;

    // Send a GET request to http://www.foo.com/bar and log debug information in /path/to/dir/logFile.txt
    $response = Curl::to('http://www.foo.com/bar')
        ->enableDebug('/path/to/dir/logFile.txt')
        ->get();

```


### Using cURL options

You can add various cURL options to the request using of several utility methods such as `withHeader()` for adding a
header to the request, or use the general `withOption()` method if no utility method applies. The package will
automatically prepend the options with the `CURLOPT_` prefix. It is worth noting that the package does not perform
any validation on the cURL options. Additional information about available cURL options can be found
[here](http://php.net/manual/en/function.curl-setopt.php).

| Method                |  Default value    | Description                                                       |
|-----------------------|-------------------|-------------------------------------------------------------------|
| withTimeout()         |  30 seconds       | Set the timeout of the request (integer or float)                 |
| allowRedirect()       |  false            | Allow the request to be redirected internally                     |
| asJsonRequest()       |  false            | Submit the request data as JSON                                   |
| asJsonResponse()      |  false            | Decode the response data from JSON                                |
| asJson()              |  false            | Utility method to set both `asJsonRequest()` and `asJsonResponse()` at the same time   |
| withHeader()          |  array            | Add an HTTP header to the request                                 |
| withHeaders()         |  array            | Add multiple HTTP headers to the request                          |
| withContentType()     |  none             | Set the content type of the response                              |
| withFile()            |  none             | Add a file to the form data to be sent                            |
| containsFile()        |  false            | Should be used to submit files through forms                      |
| withData()            |  array            | Add an array of data to sent with the request (GET or POST)       |
| setCookieFile()       |  none             | Set a file to read cookies from                                   |
| setCookieJar()        |  none             | Set a file to store cookies in                                    |
| withOption()          |  none             | Generic method to add any cURL option to the request              |

For specific information regarding parameters and return types, I encourage you to take a look at 
`Apitoolkits\curl\src\Apitoolkits\Curl\Builder.php`. This class has extensive doc blocks that contain all the necessary information
for each specific method.



### Usage without Laravel

Usage without Laravel is identical to usage described previously. The only difference is that you will not be able to
use the facades to access the `CurlService`.

```php

    $curlService = new \Apitoolkits\Curl\CurlService();

    // Send a GET request to: http://www.foo.com/bar
    $response = $curlService->to('http://www.foo.com/bar')
        ->get();

    // Send a POST request to: http://www.foo.com/bar
    $response = $curlService->to('http://www.foo.com/bar')
        ->post();

    // Send a PUT request to: http://www.foo.com/bar
    $response = $curlService->to('http://www.foo.com/bar')
        ->put();

    // Send a DELETE request to: http://www.foo.com/bar
    $response = $curlService->to('http://www.foo.com/bar')
        ->delete();

```




## Planning

 - Add additional utility methods for other cURL options
 - Add contract to allow different HTTP providers such as Guzzle




## Support

Help me further develop and maintain this package by supporting me via (http://apitoolkits.com)!!




## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

For package questions, bug, suggestions and/or feature requests, please use the Github issue system and/or submit a pull request. When submitting an issue, always provide a detailed explanation of your problem, any response or feedback your get, log messages that might be relevant as well as a source code example that demonstrates the problem. If not, I will most likely not be able to help you with your problem. Please review the [contribution guidelines](https://github.com/apitoolkits/curl/blob/master/CONTRIBUTING.md) before submitting your issue or pull request.

For any other questions, feel free to use the credentials listed below: 

 (developer)

- Email: webmaster@apitoolkits.com
