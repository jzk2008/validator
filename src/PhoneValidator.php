<?php
/**
 * Created by PhpStorm.
 * User: 苏近之
 * Date: 2018/7/31
 * Time: 23:24
 */
namespace SeeToLight;

class PhoneValidator implements ValidatorInterface
{

    public function check($value, $rule)
    {
        $pattern = '/^1[23456789][0-9]{9}$/';

        return boolval(preg_match($pattern, $value));
    }
}