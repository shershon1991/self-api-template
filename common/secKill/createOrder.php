<?php

require_once "./library/db.php";

$db = DB::getInstance()->connect();

// 第二步：秒杀成功的用户，下单
if (!empty($_GET['mobile'])) {
    $order_id   = rand(10000, 99999);
    $insertData = [
        'order_id'        => $order_id,
        'mobile'          => $_GET['mobile'],
        'create_time'     => date("Y-m-d H:i:s", time()),
        'delivery_status' => 0 // 订单发货状态（0-等待发货 1-处理中 2-已发货）
    ];

    $sql = "insert into seckill_orders(order_id,mobile,create_time,delivery_status) values({$insertData['order_id']},'{$insertData['mobile']}','{$insertData['create_time']}',{$insertData['delivery_status']});";
    $rst = mysqli_query($db, $sql);

    if ($rst) {
        echo 'ok';
    } else {
        echo 'error';
    }
} else {
    echo '请输入秒杀成功的手机号<br>';
}

$db->close();