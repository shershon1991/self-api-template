<?php

namespace controllers;

use common\rpc\YarServer;

class YarController
{
    // server服务
    public function server()
    {
        $server = new \Yar_Server(new YarServer());
        $server->handle();
    }
}