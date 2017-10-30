<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 5/25/2017
 * Time: 12:52 PM
 */

namespace Mvaliolahi\SeeQuest;


use Mvaliolahi\SeeQuest\Validators\Between;
use Mvaliolahi\SeeQuest\Validators\Email;
use Mvaliolahi\SeeQuest\Validators\Integer;
use Mvaliolahi\SeeQuest\Validators\Match;
use Mvaliolahi\SeeQuest\Validators\Max;
use Mvaliolahi\SeeQuest\Validators\Min;
use Mvaliolahi\SeeQuest\Validators\Required;


/**
 * Class SeeQuest
 * @package Mvaliolahi\SeeQuest
 */
class SeeQuest
{
    /**
     * @var
     */
    protected static $translation;

    /**
     * @var array
     */
    protected static $errors = [];

    /**
     * @var array
     */
    protected static $_validators = [
        Between::class,
        Email::class,
        Integer::class,
        Match::class,
        Max::class,
        Min::class,
        Required::class,
    ];

    /**
     * SeeQuest constructor.
     * @param string $locale
     * @param array $validators
     */
    function __construct($locale = 'en', $validators = [])
    {
        self::$translation = new Translation($locale);

        if (count($validators) > 0) {
            foreach ($validators as $validator) {
                //TODO :: check for validation type!
                self::$_validators[] = $validator;
            }
        }
    }

    /**
     * This function get a request and array of rules for check rules on request attributes.
     *
     * @param $request
     * @param array $rules
     * @return array|bool|null
     */
    public function check($request, $rules = [])
    {
        foreach ($rules as $attribute => $rule) {

            $isRuleSingle = count($tmp = explode('|', $rule)) > 1 ? false : true;

            if ($isRuleSingle == true) {
                $errors[] = self::checkRuleOnGivenAttribute($request, $attribute, $rule);
            } else {
                $sub_rules = explode('|', $rule);
                foreach ($sub_rules as $_rule) {
                    $errors[] = self::checkRuleOnGivenAttribute($request, $attribute, $_rule);
                }
            }
        }

        self::$errors = array_values(
            self::removeAllEmptyMessagesFromErrors($errors ?? [])
        );

        return count(self::$errors) == 0 ? true : false;
    }

    /**
     * @param $request
     * @param $rule
     * @param $attribute
     * @return bool|null|string
     */
    private static function checkRuleOnGivenAttribute($request, $attribute, $rule)
    {
        $rule = self::extractRuleNameAndOptionAsArray($rule);
        return self::validate($request, $attribute, $rule['rule'], $rule['option']);
    }

    /**
     * This function facilitate checking rule for use in all predefined rules.
     *
     * @param $rule
     * @return array
     */
    private function extractRuleNameAndOptionAsArray($rule)
    {
        $exploded = explode(':', $rule);

        return (count($exploded) == 1) ?
            [   // rule has no option (example: 'required')
                'rule' => $exploded[0],
                'option' => null
            ] :
            [ // rule has option (example: 'max:10')
                'rule' => $exploded[0],
                'option' => $exploded[1]
            ];
    }

    /**
     * This function contains all validation rules,
     * and if we need some new one we should define it!
     *
     * @param $request
     * @param $attribute
     * @param $rule
     * @param $option
     * @return bool|null|string
     */
    private function validate($request, $attribute, $rule, $option)
    {
        $error = [];

        foreach (self::$_validators as $validator) {
            $v = (new $validator(self::$translation, $request, $attribute, $rule, $option));

            // TODO:: check for exist alias that is not the default.

            if ($v->alias === $rule) {
                $error['attribute'] = $attribute;
                $error['message'] = $v->validate();
            }
        }

        return ($error == []) ? true : $error;
    }

    /**
     * @param $errors
     * @return array
     */
    private static function removeAllEmptyMessagesFromErrors($errors): array
    {
        $errors = array_filter($errors, function ($item) {
            return !is_null($item['message']);
        });

        return $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return self::$errors;
    }
}