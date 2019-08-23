<?php
/**
 * Created by PhpStorm.
 * User: 苏近之
 * Date: 2018/7/31
 * Time: 23:22
 */

namespace SeeToLight;

class StringOrNumberValidator implements ValidatorInterface
{

    public function check($value, $rule)
    {
        return boolval(is_string($value) || is_numeric($value));
    }
}