<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 7:02 PM
 */

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

/**
 * Class Min
 * @package Mvaliolahi\SeeQuest\Validators
 */
class Min extends Validator
{
    /**
     * @var string
     */
    public $alias = "min";

    /**
     * @return string
     */
    public function validate()
    {
        if ($this->value < $this->option) {
            return $this->message();
        }
    }

    /**
     * @return string
     */
    public function message()
    {
        return $this->translation->of($this->alias, [
            'attribute' => $this->attribute,
            'option' => $this->option,
        ]);
    }
}