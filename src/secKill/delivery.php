<?php

require_once './library/db.php';

$db = DB::getInstance()->connect();

// 第三步：订单发货
// 1.把要处理的记录更新为"处理中"
$sql  = "update seckill_orders set delivery_status=1 where delivery_status=0";
$rst  = mysqli_query($db, $sql);
$nums = mysqli_affected_rows($db);
// 2.选择处理中的记录，然后进行配送系统的处理
if ($rst && $nums) {
    // 选择出处理中的订单
    $sql2 = "select * from seckill_orders where delivery_status=1";
    $rst2 = mysqli_query($db, $sql2);
    // todo::然后由配送系统进行配送处理
    // 处理完成之后把订单发货状态更新为"发货完成"
    $sql3 = "update seckill_orders set delivery_status=2,update_time='" . date('Y-m-d H:i:s') . "' where delivery_status=1";
    $rst3 = mysqli_query($db, $sql3);
    if ($rst3) {
        echo "ok";
    } else {
        echo 'error';
    }
} else {
    echo "没有待处理的订单";
}

$db->close();