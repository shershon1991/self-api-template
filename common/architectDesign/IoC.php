<?php

/**
 * @date: 2022/5/15
 * @createTime: 9:57 PM
 */
class IoC
{
    protected static $registry = [];

    //传入类名和类对象实例
    public static function bind($name, callable $resolver)
    {
        static::$registry[$name] = $resolver;
    }

    //静态工厂方法
    public static function make($name)
    {
        if (isset(static::$registry[$name])) {
            $resolver = static::$registry[$name];
            return $resolver; // 实例化
        }
        throw new Exception('Alias does not exist in the IoC registry.');
    }
}