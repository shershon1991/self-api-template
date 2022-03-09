<?php
/**
 * @date: 2022/3/9
 * @createTime: 6:47 PM
 */
$host = 'mysql';
$dbUser = 'root';
$dbPwd = 'root';
$db = 'test';

if (!empty($_POST)) {
    $nickName = $_POST['nickname'];
    $pwd = $_POST['password'];

    $connect = mysqli_connect($host, $dbUser, $dbPwd);
    mysqli_set_charset($connect, 'UTF-8');
    mysqli_select_db($connect, $db);

    $sql = "select * from app_user where nick_name='{$nickName}' and password='{$pwd}'";
    $rst = mysqli_query($connect, $sql);

    if (!empty($rst->num_rows)) {
        echo '登录成功';
    } else {
        echo '登录失败';
    }
}