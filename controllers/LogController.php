<?php

namespace controllers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogController
{

    public function log()
    {
        $log     = new Logger('name');
        $logPath = './runtime/logs/' . date('Y-m-d') . '.log';
        $log->pushHandler(new StreamHandler($logPath, Logger::WARNING));

        $log->warning('This is a warning record.');
        $log->error('This is a error record.');
    }
}