<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 8/30/2017
 * Time: 6:04 PM
 */

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;


/**
 * Class Email
 * @package Mvaliolahi\SeeQuest\Validators
 */
class Email extends Validator
{
    /**
     * @var string
     */
    public $alias = 'email';

    /**
     * @return mixed
     */
    public function validate()
    {
        if (filter_var($this->value, FILTER_VALIDATE_EMAIL) == false) {
            return $this->message();
        }
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->translation->of($this->alias, ['attribute' => $this->attribute]);
    }
}