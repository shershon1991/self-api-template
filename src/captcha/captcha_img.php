<?php

session_start();

$table = array(
    'pic0' => '牛',
    'pic1' => '人',
    'pic2' => '兔',
    'pic3' => '表',
    'pic4' => '狗',
);

$index = rand(0, 4);
$value = $table['pic' . $index];
$_SESSION['authcode'] = $value;

$filename = __DIR__ . '/pic' . $index . '.jpg';
$contents = file_get_contents($filename);

header('content-type:image/jpeg');
echo $contents;