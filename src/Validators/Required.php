<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 6:01 PM
 */

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

/**
 * Class Required
 * @package Mvaliolahi\SeeQuest\Validators
 */
class Required extends Validator
{
    /**
     * @var string
     */
    public $alias = 'required';

    /**
     * @return mixed
     */
    public function validate()
    {
        if (!(isset($this->value) && strlen($this->value) > 0)) {
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