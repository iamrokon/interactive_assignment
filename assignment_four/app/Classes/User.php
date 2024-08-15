<?php 
declare(strict_types = 1);
namespace App\Classes;

class User implements Model
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $slug;
    private $type;
    public static function getModelName(): string
    {
        return 'users';
    }
    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }
        return null;
    }
    public function __set($name, $value)
    {
        if(property_exists($this, $name)){
            $this->$name = $value;
        }
    }
}