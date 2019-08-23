<?php
/**
 * 验证接口类
 * User: 苏近之
 * Date: 2018/7/31
 * Time: 22:29
 */
namespace SeeToLight;

interface ValidatorInterface
{
    public function check($value, $rule);
}

