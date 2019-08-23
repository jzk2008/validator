<?php
/**
 * 数值校验类
 * User: 苏近之
 * Date: 2018/7/31
 * Time: 22:33
 */
namespace SeeToLight;

class NumberValidator implements ValidatorInterface
{

    public function check($value, $rule)
    {
       return is_numeric($value);
    }
}