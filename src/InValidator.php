<?php
/**
 * 区间 校验类
 * User: 苏近之
 * Date: 2018/7/31
 * Time: 23:26
 */
namespace SeeToLight;

class InValidator implements ValidatorInterface
{

    public function check($value, $rule)
    {
        $range = mb_strcut($rule, (strpos($rule, ':') + 1));
        $rangeArr = explode(',', $range);

        return boolval(in_array($value, $rangeArr));
    }

}