### Seams-CMS delivery SDK for PHP

[![Packagist](https://img.shields.io/packagist/v/seams-cms/delivery-sdk.svg)](https://packagist.org/packages/seams-cms/delivery-sdk)
[![Build Status](https://travis-ci.org/seams-cms/php-delivery-sdk.svg?branch=master)](https://travis-ci.org/seams-cms/php-delivery-sdk)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/seams-cms/php-delivery-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/seams-cms/php-delivery-sdk/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/seams-cms/php-delivery-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/seams-cms/php-delivery-sdk/?branch=master)

This repository hosts the SDK for the Seams-CMS delivery API.



### Usage

> Before installing, make sure you have an Seams-CMS account with an API key. This information is needed in the SDK.


    $factory = new SeamsCMS\Delivery\ClientFactory(<apiKey>, <workspace>);
    $client = $factory->build();
   
    $collection = $client->getWorkspaceCollection();
    echo "Your workspace name: " . $collection->getEntries()[0]->getName() . PHP_EOL;



#### Using the image builder

The image builder allows you to simply generate images based on your assets. It consists of a 
fluent interface that allows you to simple add commands to the builder. When calling `getSourceUrl`, 
the builder will take all commands and generate a URL that points to the actual image.

    $imageSrc = $imageBuilder::fromPath(<workspace>, <asset>)
        ->width(100)
        ->height(100)
        ->negate()
        ->getSourceUrl()
    ;
    
    echo "<img src=\"$imageSrc\">";


### Contributing

Please read the [CONTRIBUTION](CONTRIBUTION.md) file for more information on how to contribute.


### Running tests

Note that when running tests, you must install all the composer packages first. Run `composer install` 
in the current directory to install all (development) packages before running the tests. 

Running all tests:

    composer tests

To run only the unit-tests:

    ./vendor/bin/phpunit
