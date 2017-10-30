<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/29/2017
 * Time: 8:03 PM
 */

namespace Mvaliolahi\SeeQuest;


/**
 * Class FormRequest
 * @package Mvaliolahi\SeeQuest
 */
abstract class FormRequest
{
    /**
     * @return null
     */
    public static function validate()
    {
        $validation = (new SeeQuest);

        $result = $validation->check(static::request(), static::rules());

        if ($result == false) {
            die(json_encode($validation->getErrors()));
        }

        return null;
    }

    /**
     * @return array
     */
    public abstract function request(): array;

    /**
     * @return mixed
     */
    public abstract function rules(): array;
}