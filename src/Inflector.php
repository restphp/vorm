<?php


namespace VORM;


class Inflector
{

    public static function toUnderscore($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        if (isset($matches[0])) {
            $ret = $matches[0];
            foreach ($ret as &$match) {
                $match = $match == mb_strtoupper($match) ? mb_strtolower($match) : lcfirst($match);
            }
            return implode('_', $ret);
        }
        return mb_strtolower($input);
    }


}