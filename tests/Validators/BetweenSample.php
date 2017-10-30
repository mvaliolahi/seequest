<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 7:45 PM
 */

namespace Tests\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

/**
 * Class BetweenSample
 * @package Mvaliolahi\SeeQuest\Validators
 */
class BetweenSample extends Validator
{
    /**
     * @var string
     */
    public $alias = 'between_sample';

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
        return "The {$this->attribute} is not between {$this->option}";
    }
}