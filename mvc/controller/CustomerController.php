<?php

namespace sebastiangolian\php\mvc\controller;

use sebastiangolian\php\mvc\core\Controller;
use sebastiangolian\php\mvc\core\View;
use sebastiangolian\php\mvc\model\Customer;


class CustomerController extends Controller
{
    public function indexAction()
    {
        $customers = Customer::findAll();
        View::render('customer/index',['customers'=>$customers]);
    }
}
