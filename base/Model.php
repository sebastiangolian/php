<?php
namespace sebastiangolian\php\base;

abstract class Model extends Object implements Validator
{
   protected $errors = array();
   
   public static function create()
   {
       return new static();
   }
   
   /**
    * {@inheritDoc}
    * @see \sebastiangolian\php\base\Validator::validate()
    */
   function validate(){
       
   }
}