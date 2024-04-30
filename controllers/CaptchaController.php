<?php

namespace controllers;

use common\Tools\Captcha;

class CaptchaController
{

    // 创建数字验证码
    public function create_number()
    {
        (new Captcha(100, 30))->createNumber();
    }

    //创建数字、字母验证码
    public function create_number_letter()
    {
        (new Captcha(100, 30))->createNumberAndLetter();
    }

    // 创建汉字验证码
    public function create_chinese()
    {
        (new Captcha(200, 60))->createChinese();
    }

    // 创建图片验证码
    public function create_img()
    {
        (new Captcha(200, 60))->createImg();
    }
}