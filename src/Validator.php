<?php
/**
 * 验证器类
 * User: 苏近之
 * Date: 2018/11/9
 * Time: 10:39
 */

namespace SeeToLight;

class Validator
{
    protected static $data = [];
    protected $ruleMap = [];
    protected $message = [];
    protected $defaultValues = [];
    protected static $lastError = '';

    public function __construct ($data)
    {

        self::$data = $data;
    }

    public function check ()
    {
        if (!count(self::$data)) {
            self::$lastError = '没有接收到传参';
            return false;
        }
        // 遍历规则
        foreach ($this->ruleMap as $field => $rules) {
            // 检查是否必填
            if (in_array('required', $rules) && !isset(self::$data[$field])) {
                if (!isset($this->message[$field])) {
                    self::$lastError = '字段验证错误!';
                    return false;
                }
                self::$lastError = $this->message[$field];
                return false;
            }
            // 如果该字段不存在并且设置了默认值
            if ((!isset(self::$data[$field]) || self::$data[$field] === '')
                && isset($this->defaultValues[$field])) {
                self::$data[$field] = $this->defaultValues[$field];
                continue;
            }
            // 检查其他规则
            if (isset(self::$data[$field])) {
                if (!$this->eachRule($rules, self::$data[$field])) {
                    if (!isset($this->message[$field])) {
                        self::$lastError = '字段校验错误';
                    } else {
                        self::$lastError = self::getLastError() ??$this->message[$field];
                    }
                    return false;
                }
            }
        }
        return true;
    }

    public static function getData ()
    {
        return self::$data;
    }

    /**
     * @param $rules
     * @param $value
     * @return bool
     */
    public function eachRule ($rules, $value)
    {
        foreach ($rules as $index => $rule) {
            if ($rule === 'required') {
                continue;
            }
            // 处理匿名函数
            if (is_array($rule)) {
                return boolval(call_user_func($rule));
            }

            $class = $rule;
            if (strpos($class, ':')) {
                $class = substr($class, 0, strpos($class, ':'));
            }
            $validator = '\\SeeToLight\\' . ucfirst($class) . 'Validator';
            if (!(new $validator)->check($value, $rule)) {
                return false;
            }
        }
        return true;
    }

    /**
     * 获取最近的错误
     * @return string
     */
    public static function getLastError ()
    {
        return self::$lastError;
    }

    /**
     * 自定义错误
     * @param $lastError
     */
    public static function setLastError ($lastError)
    {
        self::$lastError = $lastError;
    }
}