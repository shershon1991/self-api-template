<?php

namespace common\rpc;

// 客户端example
class YarClient
{
    private \Yar_Client $_client;

    public function __construct()
    {
        $this->_client = new \Yar_Client("http://localhost:8080/index.php?c=yar&a=server");
    }

    /**
     * 同步调用
     *
     * @return void
     */
    public function syncCall()
    {
        $this->_client->setOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);
        $this->_client->setOpt(YAR_OPT_HEADER, ["hd1: val", "hd2: val"]); //Custom headers, Since 2.0.4
        /* call remote service */
        var_dump($this->_client->some_method("parameter"));
    }

    /**
     * 并发调用
     *
     * @return void
     */
    public function concurrentCall()
    {
        Yar_Concurrent_Client::call("http://localhost:8080/index.php?c=yar&a=server", "some_method", ["parameters"], ['YarClient', 'callback']);
        Yar_Concurrent_Client::call("http://localhost:8080/index.php?c=yar&a=server", "some_method", ["parameters"]); // if the callback is not specificed,callback in loop will be used
        Yar_Concurrent_Client::call("http://127.0.0.1:8081/src/rpc/yar_server.php", "some_method", ["parameters"], ['YarClient', 'callback'], ['YarClient', 'error_callback'], [YAR_OPT_PACKAGER => "json"]);  //this server accept json packager
        Yar_Concurrent_Client::call("http://localhost:8080/index.php?c=yar&a=server", "some_method", ["parameters"], ['YarClient', 'callback'], ['YarClient', 'error_callback'], [YAR_OPT_TIMEOUT => 1]);  //custom timeout
        Yar_Concurrent_Client::loop(['YarClient', 'callback'], ['YarClient', 'error_callback']);
    }

    public function persistentCall()
    {
        $this->_client->SetOpt(YAR_OPT_PERSISTENT, 1);
        var_dump($this->_client->some_method("parameter"));
        /* The following calls will speed up due to keep-alive */
        var_dump($this->_client->some_other_method1("parameter"));
        var_dump($this->_client->some_other_method2("parameter"));
        var_dump($this->_client->some_other_method3("parameter"));
    }

    public static function callback($retval, $callinfo)
    {
        var_dump($retval);
    }

    public static function error_callback($type, $error, $callinfo)
    {
        error_log($error);
    }
}