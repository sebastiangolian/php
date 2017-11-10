<?php
namespace sebastiangolian\php\base;

abstract class Model extends Object implements Validator
{
   public $errors = array();
   
   function validate(){
       
   }
}