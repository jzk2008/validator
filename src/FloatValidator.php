<?php
/**
 * 单精度浮点数校验类
 * User: 苏近之
 * Date: 2018/9/1
 * Time: 9:36
 */

namespace SeeToLight;

class FloatValidator implements ValidatorInterface
{

    /**
     * 校验规则
     * @param mixed $value
     * @param string $rule
     * @return bool
     */
    public function check($value, $rule)
    {
        return boolval(filter_var($value, FILTER_VALIDATE_FLOAT));
    }
}