<?php


namespace Self\Test\Cases;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogTest extends AbstractTestCase {

    public function testLog(){
        //die('fk');
        $log = new Logger('name');
        $logPath = '/Users/shershon/WorkItem/www-php/php-api-template/logs/' . date('Y-m-d') . '.log';
        $log->pushHandler(new StreamHandler($logPath, Logger::WARNING));

        $log->warning('This is a warning record.');
        $log->error('This is a error record.');
    }
}
