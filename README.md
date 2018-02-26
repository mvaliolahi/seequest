## PHP Request Validator

Validate request in easiest way!

#### Install

    `composer require mvaliolahi/seequest`
    
##### usage

```php   
$validator = new SeeQuest('en');

bool | $result = $validation->check($request, [
    'name' => 'required',
    'email' => 'required|email'
    'age'=> 'required|between:1,25',
    'score' => 'min:10',
    'high_score'=> 'max:600' 
]);

$err = $validator->getErrors();
```
    
##### Create custom validator

Create a class and extends from `Mvaliolahi\SeeQuest\Contracts\Validator`, it done! just implement validate() method.

you have access to :
    
Request => $this->request
Attribute => $this->attribute
Value => $this->value
Rule => $this->rule
Rule-Option => $this->option
 
        
######example:
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