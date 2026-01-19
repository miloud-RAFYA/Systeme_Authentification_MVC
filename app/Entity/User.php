<?php 
namespace App\Entity;
use App\Entity\Role;
class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $created_at;

    public function __construct($name,$email,$password){
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
      
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getrole(){
        return $this->role;
    }
    public function getDate(){
        return $this->created_at;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setPassword($password){
        $this->password=$password;
    }
    public function setRole($role){
        $this->role=new Role($role);
    }
    public function setDate($created_at){
        $this->created_at=$created_at;
    }
}