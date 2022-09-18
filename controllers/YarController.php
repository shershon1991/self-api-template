<?php

namespace controllers;

use common\rpc\YarClient;
use common\rpc\YarServer;

class YarController
{
    // server服务
    public function server()
    {
        $server = new \Yar_Server(new YarServer());
        $server->handle();
        exit();
    }

    // 同步调用
    public function sync_call()
    {
        (new YarClient())->syncCall();
    }

    // 并发调用
    public function concurrent_call()
    {
        (new YarClient())->concurrentCall();
    }

    // 持久通话
    public function persistent_call()
    {
        (new YarClient())->persistentCall();
    }
}