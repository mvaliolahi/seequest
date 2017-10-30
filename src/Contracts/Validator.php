<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 5:36 PM
 */

namespace Mvaliolahi\SeeQuest\Contracts;


use Mvaliolahi\SeeQuest\Translation;


/**
 * Class Validator
 * @package Mvaliolahi\SeeQuest\Contracts
 */
abstract class Validator
{
    /**
     * @var
     */
    public $alias;

    /**
     * @var Translation
     */
    protected $translation;

    /**
     * @var
     */
    protected $request;

    /**
     * @var
     */
    protected $attribute;

    /**
     * @var
     */
    protected $value;

    /**
     * @var
     */
    protected $rule;

    /**
     * @var
     */
    protected $option;

    /**
     * Validator constructor.
     * @param $translation
     * @param $request
     * @param $attribute
     * @param $rule
     * @param $option
     */
    function __construct($translation, $request, $attribute, $rule, $option)
    {
        $this->translation = $translation;
        $this->request = $request;
        $this->attribute = $attribute;

        if (array_key_exists($attribute, $request)) {
            $this->value = $request[$attribute];
        }

        $this->rule = $rule;
        $this->option = $option;
    }

    /**
     * @return mixed
     */
    public abstract function validate();

    /**
     * @return mixed
     */
    public abstract function message();
}