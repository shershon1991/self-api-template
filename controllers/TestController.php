<?php

namespace controllers;

use common\frame\Response;

class TestController
{

    public function index()
    {
        Response::jsonRtn(200, 'This is a test!', []);
    }
}