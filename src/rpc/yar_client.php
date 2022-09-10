<?php

// 客户端example

// 1.同步调用
$client = new Yar_Client("http://127.0.0.1:8080/src/rpc/yar_server.php");
$client->setOpt(YAR_OPT_CONNECT_TIMEOUT, 1000);
$client->setOpt(YAR_OPT_HEADER, ["hd1: val", "hd2: val"]); //Custom headers, Since 2.0.4
/* call remote service */
var_dump($client->some_method("parameter"));

// 2.并发调用
function callback($retval, $callinfo)
{
    var_dump($retval);
}

function error_callback($type, $error, $callinfo)
{
    error_log($error);
}

Yar_Concurrent_Client::call("http://127.0.0.1:8080/src/rpc/yar_server.php", "some_method", ["parameters"], "callback");
Yar_Concurrent_Client::call("http://127.0.0.1:8080/src/rpc/yar_server.php", "some_method", ["parameters"]); // if the callback is not specificed,callback in loop will be used
Yar_Concurrent_Client::call("http://127.0.0.1:8081/src/rpc/yar_server.php", "some_method", ["parameters"], "callback", "error_callback", [YAR_OPT_PACKAGER => "json"]);  //this server accept json packager
Yar_Concurrent_Client::call("http://127.0.0.1:8080/src/rpc/yar_server.php", "some_method", ["parameters"], "callback", "error_callback", [YAR_OPT_TIMEOUT => 1]);  //custom timeout
Yar_Concurrent_Client::loop("callback", "error_callback");

// 3.持续通话
$client = new Yar_Client("http://127.0.0.1:8080/src/rpc/yar_server.php");
$client->SetOpt(YAR_OPT_PERSISTENT, 1);
var_dump($client->some_method("parameter"));
/* The following calls will speed up due to keep-alive */
var_dump($client->some_other_method1("parameter"));
var_dump($client->some_other_method2("parameter"));
var_dump($client->some_other_method3("parameter"));


