# passport
[![Build Status](https://travis-ci.org/delboy1978uk/passport.png?branch=master)](https://travis-ci.org/delboy1978uk/passport) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/passport/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/passport/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/passport/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/passport/?branch=master) 

An ACL system using Doctrine entities.
## installation
Install via composer:
```
composer require delboy1978uk/passport
```
Run Doctrine Migrations
```
doctrine-migrations diff
doctrine-migrations migrate
```
## usage
```php
<?php

use Del\Passport\PassportControl;

$passportControl = new PassportControl($entityManager); // pass in a doctrine entity manager
```
