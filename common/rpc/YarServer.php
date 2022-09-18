<?php

namespace common\rpc;

// 服务器端example
class YarServer
{
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @param $parameter
     * @param string $option
     * @return void
     */
    public function some_method($parameter, $option = "foo")
    {
        return $parameter;
    }

    public function some_other_method1($parameter, $option = "foo")
    {
        return $parameter;
    }

    public function some_other_method2($parameter, $option = "foo")
    {
        return $parameter;
    }

    public function some_other_method3($parameter, $option = "foo")
    {
        return $parameter;
    }

    protected function client_can_not_see()
    {
    }
}