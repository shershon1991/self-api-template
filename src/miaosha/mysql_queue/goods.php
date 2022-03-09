<?php

include '../include/db.php';

/**
 * 处理落库的订单，修改订单状态
 */
$conn = DB::getInstance()->connect();

// 1.把要处理的记录更新为"等待处理"
$sql = "update order_queue set status=1 where status=0";
$rst = mysqli_query($conn, $sql);

// 2.选择出刚刚更新的记录，然后进行配送系统的处理
if ($rst) {
    // 选择出要处理的订单
    $sql2 = "select * from order_queue where status=1";
    $rst2 = mysqli_query($conn, $sql2);

    // todo::然后由配送系统进行配送处理

    // 处理完成之后把订单更新为"已完成"
    $sql3 = "update order_queue set status=2,update_time='" . date('Y-m-d H:i:s') . "' where status=1";
    $rst3 = mysqli_query($conn, $sql3);
    if ($rst3) {
        echo "OK";
    } else {
        echo 'error';
    }
} else {
    echo "没有待处理的订单";
}