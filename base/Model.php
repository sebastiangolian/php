<?php
namespace sebastiangolian\php\base;

abstract class Model extends Object implements Validator
{
    protected $id;

    protected $errors = array();

    public function __construct()
    {
        $this->id = spl_object_hash($this);
    }
    
    public static function create()
    {
        return new static();
    }
    
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * {@inheritdoc}
     * @see \sebastiangolian\php\base\Validator::validate()
     */
    function validate()
    {}
}