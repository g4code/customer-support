customer-support
======

> customer-support - [php](http://php.net) library

## Install
Install through  [composer](https://getcomposer.org/) package manager.
Find it on [packagist](https://packagist.org/packages/g4/customer-support).

```sh
composer require g4/customer-support
```
## Usage

### Zendesk instance

``` php
<?php
    
$adapter = 'Zendesk';
$options = (new \G4\Gateway\Options())
            ->addHeader('Authorization', 'Basic *********************************')
            ->addHeader('Content-Type', 'application/json');
$gateway = new \G4\Gateway\Http('url', $options);
$data = new Dictionary([
    'name'    =>  'test' 
    'email'   =>  'test@gmail.com' 
    'subject' =>  'test' 
    'comment' =>  'test' 
]);
    
$customerSupport = new (G4\CustomerSupport\CustomerSupportFactory)
$customerSupport
                ->setEmail(new Email($data->get('email')))
                ->setName(new StringLiteral($data->get('name')))
                ->setSubject(new StringLiteral($data->get('subject')))
                ->setComment(new StringLiteral($data->get('comment')))
                ->setGateway($gateway)
                ->setAdapter($adapter);
                ->createInstance()
```

### Install dependencies

```sh
composer install
```

### Run unit tests

```sh
make unit-tests
```

## License

(The MIT License)
see LICENSE file for details...
