<?php
namespace App\Entity;
class Role {
    private $id ;
    private $name;


    public function __construct($name)
    {
        $this->name=$name;  
    }

    public function getName(){
        return $this->name;
    }
    public function getid(){
        return $this->name;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function setname($name){
        $this->name=$name;
    }
}