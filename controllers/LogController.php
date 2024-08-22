<?php

namespace controllers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogController
{

    public function log()
    {
        $log     = new Logger('name');
        $logPath = '/Users/shershon/ProjectItem/PhpItem/self-api-template/runtime/logs/' . date('Y-m-d') . '.log';
        $log->pushHandler(new StreamHandler($logPath, Logger::WARNING));

        $log->warning('This is a warning record.');
        $log->error('This is a error record.');
    }
}