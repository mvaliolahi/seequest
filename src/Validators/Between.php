<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 7:45 PM
 */

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

/**
 * Class BetweenSample
 * @package Mvaliolahi\SeeQuest\Validators
 */
class Between extends Validator
{
    /**
     * @var string
     */
    public $alias = 'between';

    /**
     * @return mixed|string
     */
    public function validate()
    {
        $number = explode(',', $this->option);

        if (!($this->value >= $number[0] && $this->value <= $number[1])) {
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