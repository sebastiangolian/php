<?php

namespace sebastiangolian\php\mvc\controller;

use sebastiangolian\php\mvc\core\Controller;
use sebastiangolian\php\mvc\core\View;


class IndexController extends Controller
{
    public function homeAction()
    {
        View::render('index/home');
    }
    
    public function testAction()
    {
        View::render('index/test');
    }
}
