<?php

namespace App\Repository;

use App\Core\Database;
use App\Entity\User;
use PDO;
use PDOException;

class UserRepository
{
    public function findByUsername(string $username)
    {
        $sql = "SELECT *,r.name as role  FROM users u inner join roles r on u.role_id=r.id WHERE email  = :email ";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute(['email' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insert(User $user)
    {
        try {
            $sql = "INSERT INTO roles (name) values(:name)";
            $stmtr = Database::getConnection()->prepare($sql);
            $stmtr->execute([
                ":name"=>$user->getrole()->getName()
            ]);

            if(!$stmtr){
                throw new PDOException("Erreur pour insertion de user", 1);
            }
            $id= Database::getConnection()->lastInsertId();
            $user->getrole()->setId( $id);
            $query = "INSERT INTO users (name,email,password,role_id) values(:name,:email,:password,:role_id)";
            $stmtu = Database::getConnection()->prepare($query);
            $stmtu->execute([
                ":name"=>$user->getName(),
                ":email"=>$user->getEmail(),
                ":password"=>$user->getPassword(),
                ":role_id"=>$user->getrole()->getId()
            ]);
            return true;
            throw new PDOException("Erreur pour insertion de user", 1);    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
