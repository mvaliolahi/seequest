<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/30/2017
 * Time: 9:30 AM
 */

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

/**
 * Class Integer
 * @package Mvaliolahi\SeeQuest\Validators
 */
class Integer extends Validator
{
    /**
     * @var string
     */
    public $alias = 'integer';

    /**
     * @return mixed
     */
    public function validate()
    {
        if (!is_numeric($this->value)) {
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