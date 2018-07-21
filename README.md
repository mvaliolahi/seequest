## PHP Request Validator

[![Latest Stable Version](https://poser.pugx.org/mvaliolahi/seequest/v/stable)](https://packagist.org/packages/mvaliolahi/scheduler)
[![Total Downloads](https://poser.pugx.org/mvaliolahi/seequest/downloads)](https://packagist.org/packages/mvaliolahi/seequest)
[![Build Status](https://travis-ci.org/mvaliolahi/seequest.svg?branch=master)](https://travis-ci.org/mvaliolahi/seequest)
[![StyleCI](https://github.styleci.io/repos/108822055/shield?style=flat)](https://github.styleci.io/repos/108822055)
[![PHP-Eye](https://php-eye.com/badge/mvaliolahi/seequest/tested.svg?style=flat)](https://php-eye.com/package/mvaliolahi/seequest)


Validate requests in easiest way!

#### Install

    `composer require mvaliolahi/seequest`
    
##### usage

```php   
$validator = new SeeQuest('en');

$result = $validation->check($request, [
    'name' => 'required',
    'email' => 'required|email'
    'age'=> 'required|between:1,25',
    'score' => 'min:10',
    'high_score'=> 'max:600' 
]);

$err = $validator->getErrors();
```
    
##### Create custom validator

Create a class and extends from `Mvaliolahi\SeeQuest\Contracts\Validator`, it done!

just implement validate() method.

you have access to :

```php    
Request => $this->request
Attribute => $this->attribute
Value => $this->value
Rule => $this->rule
Rule-Option => $this->option
``` 
        
###### example:

```php
<?php

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

class Between extends Validator
{
    public $alias = 'between';

    public function validate()
    {
        $number = explode(',', $this->option);

        if (!($this->value >= $number[0] && $this->value <= $number[1])) {
            return $this->message();
        }
    }

    public function message()
    {
        return $this->translation->of($this->alias, [
            'attribute' => $this->attribute,
            'option' => $this->option,
        ]);
    }
}
```
        
After define your custom validator you should pass it to the Validator class:
```php
$validator = new SeeQuest('en', [ BetweenSample::class ]);
```          
#### Form Request
          
There is another class to create FormRequest, its very simple! you can use it to create amazing validation form! just look at the source code.          
