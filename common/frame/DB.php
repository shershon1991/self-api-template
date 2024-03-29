<?php

namespace common\frame;

class DB
{
    private static $_instance;//存储单例对象
    private static $_connectSource;//存储连接资源
    private $_dbConfig = array();

    public function __construct()
    {
        $this->_dbConfig['server']      = '192.168.0.133';
        $this->_dbConfig['connectInfo'] = array('Database' => 'FinanceDatabase',
                                                'UID'      => 'sa',
                                                'PWD'      => '123456');
    }

    //单例
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    //连接sql server数据库
    public function connect()
    {
        if (!self::$_connectSource) {
            self::$_connectSource = sqlsrv_connect($this->_dbConfig['server'], $this->_dbConfig['connectInfo']);
            if (!self::$_connectSource) {
                // echo "sqlserver connect error:<br />";
                // die(print_r(sqlsrv_errors()));
                throw new Exception("connect error");
            }
        }
        return self::$_connectSource;
    }

    //自定义连接
    public function selfConnect($server, $db, $uid, $pwd)
    {
        $_connectSource = sqlsrv_connect($server, ['Database' => $db, 'UID' => $uid, 'PWD' => $pwd]);
        return $_connectSource;
    }
}

/*$connect = Db::getInstance()->connect();
$sql = "select * from columnInfo";
$result = sqlsrv_query($connect, $sql);
while($row = sqlsrv_fetch_array($result)){
	echo iconv('gbk', 'utf-8', $row['Lmname']) . "<br />";
}*/



