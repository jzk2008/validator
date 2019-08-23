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
        $pattern = '/1(3[0-9]|4[5,7]|5[0-9]|7[01687]|8[0-9])\d{8}/';

        return boolval(preg_match($pattern, $value));
    }
}