<?php

session_start();
$image   = imagecreatetruecolor(200, 60);
$bgcolor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgcolor);

//创建汉字验证码
$fontface = __DIR__ . '/../../assets/font/msyhbd.ttf';
$str      = "你要加油你是最棒的努力成为自己心目中的那个人";
$strdb    = str_split($str, 3);

$captch_code = '';
for ($i = 0; $i < 4; $i++) {
    $fontcolor = imagecolorallocate($image, rand(0, 120), rand(0, 120), rand(0, 120));

    $index       = rand(0, count($strdb));
    $cn          = $strdb[$index];
    $captch_code .= $cn;

    imagettftext($image, mt_rand(20, 24), mt_rand(-60, 60), (40 * $i + 20), mt_rand(30, 35), $fontcolor, $fontface, $cn);
}

//增加干扰点
for ($i = 0; $i < 200; $i++) {
    $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
    imagesetpixel($image, rand(1, 199), rand(1, 59), $pointcolor);
}

//增加干扰线段
for ($i = 0; $i < 3; $i++) {
    $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
    imageline($image, rand(1, 199), rand(1, 59), rand(1, 199), rand(1, 59), $linecolor);
}

// 保存到session，以便提交表单时进行验证
$_SESSION['authcode'] = $captch_code;

header('content-type:image/png');
imagepng($image);

//imagepng($image, __DIR__ . '/captcha_cn.png');
//imagedestroy($image);