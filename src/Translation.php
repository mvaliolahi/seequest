<?php
/**
 * Created by PhpStorm.
 * User: m.valiolahi
 * Date: 10/30/2017
 * Time: 8:53 AM
 */

namespace Mvaliolahi\SeeQuest;


/**
 * Class Translation
 * @package Mvaliolahi\SeeQuest
 */
class Translation
{
    /**
     * @var
     */
    protected $locale;

    /**
     * Translation constructor.
     * @param $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param $trans
     * @param array $placeHolders
     * @return string
     */
    public function of($trans, $placeHolders = null)
    {

        $file = explode('.', $trans)[0];
        $key = explode('.', $trans)[1] ?? $file;
        $file = self::defaultFileForGetTranslation($file, $key);

        $translate = self::getTranslate($file)[$key] ?? 'Undefined translation.';

        if ($placeHolders) {
            $keys = array_keys($placeHolders);
            $values = array_values($placeHolders);

            return str_replace(':', '', str_replace( $keys, $values, $translate));
        }

        return $translate;
    }

    /**
     * @param $file
     * @return mixed
     */
    private function getTranslate($file)
    {
        return require __DIR__ . "/../src/Resources/{$this->locale}/{$file}.php";
    }

    /**
     * @param $file
     * @param $key
     * @return string
     */
    private function defaultFileForGetTranslation($file, $key): string
    {
        if ($file == $key) {
            return 'messages';
        }

        return $file;
    }
}