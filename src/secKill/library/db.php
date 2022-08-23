<?php

class DB
{
    static public $_instance = NULL;
    private $host;
    private $port;
    private $user;
    private $password;
    private $db;
    private $charset;

    private function __construct()
    {
        $this->host     = "mysql";
        $this->port     = 3306;
        $this->user     = "root";
        $this->password = "root";
        $this->db       = "test";
        $this->charset  = "utf-8";
    }

    //连接数据库
    static public function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function connect()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password);
        mysqli_select_db($conn, $this->db);
        mysqli_set_charset($conn, $this->charset);
        return $conn;
    }
}
