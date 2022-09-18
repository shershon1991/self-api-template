<?php

namespace common\rpc;

// 客户端example
class YarClient
{
    private \Yar_Client $_client;

    /**
     * 同步调用
     *
     * @return void
     */
    public function syncCall()
    {
        $this->_client = new \Yar_Client("http://47.108.49.196:8080/index.php?c=yar&a=server");
        $this->_client->setOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);
        $this->_client->setOpt(YAR_OPT_HEADER, ["hd1: val", "hd2: val"]);
        var_dump($this->_client->some_method("parameter"));
    }

    /**
     * 并发调用
     *
     * @return void
     */
    public function concurrentCall()
    {
        // 并行调用
        Yar_Concurrent_Client::call("http://47.108.49.196:8080/index.php?c=yar&a=server", "some_method", ["parameters"]);
        Yar_Concurrent_Client::call("http://47.108.49.196:8080/index.php?c=yar&a=server", "some_other_method1", ["parameters"], ['YarClient', 'callback']);
        Yar_Concurrent_Client::call("http://47.108.49.196:8080/index.php?c=yar&a=server", "some_other_method2", ["parameters"], ['YarClient', 'callback'], ['YarClient', 'callError']);
        // 发送请求
        Yar_Concurrent_Client::loop(['YarClient', 'loopCallback'], ['YarClient', 'loopError']);
    }

    /**
     * 持久通话
     *
     * @return void
     */
    public function persistentCall()
    {
        $this->_client->SetOpt(YAR_OPT_PERSISTENT, 1);
        var_dump($this->_client->some_method("parameter"));
        var_dump($this->_client->some_other_method1("parameter"));
        var_dump($this->_client->some_other_method2("parameter"));
        var_dump($this->_client->some_other_method3("parameter"));
    }

    public static function callback($retval, $callinfo)
    {
        echo 'call自己的回调：' . $callinfo['method'] . '，方法返回数据' . $retval . PHP_EOL;
    }

    public static function callError()
    {
        echo '发送rpc出错' . PHP_EOL;
    }

    // 错误回掉函数, 如果设置了, Yar在发送出所有的请求之后立即调用一次这个回掉函数(此时还没有任何请求返回), 调用的时候$callinfo参数是NULL
    public static function loopCallback($retval, $callinfo)
    {
        if (is_null($callinfo)) {
            echo '所有rpc请求发送完毕调用' . PHP_EOL;
        } else {
            echo '调用成功后返回：' . PHP_EOL;
            var_dump($retval);
            var_dump($callinfo);
        }
    }

    // 错误回掉函数, 如果设置了, 那么Yar在出错的时候会调用这个回掉函数
    public static function loopError()
    {
        echo '发送rpc出错' . PHP_EOL;
    }
}