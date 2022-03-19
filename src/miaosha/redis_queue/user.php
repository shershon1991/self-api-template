<?php

/**
 * 秒杀成功的用户入队
 */
$redis = new Redis();
$redis->connect('redis', 6379);
$redis_name = 'miaosha';

for ($i = 0; $i < 100; $i++) {
    $uid = rand(10000, 99999);
    $num = 10;

    if ($redis->lLen($redis_name) < $num) {
        $redis->rPush($redis_name, $uid . '%' . time());
        echo $uid . '-秒杀成功<br>';
    } else {
        echo '秒杀已结束<br>';
    }
}

$redis->close();