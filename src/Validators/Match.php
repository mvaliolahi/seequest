<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 8/30/2017
 * Time: 6:16 PM
 */

namespace Mvaliolahi\SeeQuest\Validators;


use Mvaliolahi\SeeQuest\Contracts\Validator;

/**
 * Class Match
 * @package Mvaliolahi\SeeQuest\Validators
 */
class Match extends Validator
{
    /**
     * @var string
     */
    public $alias = 'regex';

    /**
     *
     */
    public function validate()
    {
        if ((preg_match("/$this->option/", $this->value) == 1)) {
            return $this->message();
        }
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->translation->of($this->alias, [
            'attribute' => $this->attribute,
            'option' => $this->option
        ]);
    }
}