<?php

require_once './library/db.php';

$db    = DB::getInstance()->connect();
$redis = new Redis();
$redis->connect('redis', 6379);
$redis_name = 'miaosha';

// 第一步：秒杀
// 1.秒杀成功，入队
for ($i = 0; $i < 100; $i++) {
    $uid    = rand(10000, 99999);
    $mobile = '13608313311';
    $num    = 10;
    // todo
    // 1）将lLen和rPush两个操作放到lua脚本中，保证原子性
    // 2）将lLen和rPush两个操作放到事务中，保证原子性
    if ($redis->lLen($redis_name) < $num) {
        $redis->rPush($redis_name, $uid . '%' . $mobile);
        echo $uid . ' - 秒杀成功<br>';
    } else {
        echo '秒杀已结束<br>';
    }
}
// 2.落库
while (1) {
    $user = $redis->lPop($redis_name);
    if (!$user || $user == 'nil') {
        break;
    }
    $user_arr    = explode('%', $user);
    $insert_data = [
        'uid'    => $user_arr[0],
        'mobile' => $user_arr[1]
    ];
    $sql         = "insert into seckill_users(uid, mobile) values({$insert_data['uid']}, '{$insert_data['mobile']}')";
    $res         = mysqli_query($db, $sql);
    if (!$res) {
        $redis->lPush($redis_name, $user);
    }
    sleep(1);
}
echo '已全部落库<br>';

$db->close();
$redis->close();