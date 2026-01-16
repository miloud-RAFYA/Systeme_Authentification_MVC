<?php

namespace App\Repository;

use App\Core\Database;
use PDO;

class UserRepository
{
    public function findByUsername (string $username )
    {
        $sql = "SELECT * FROM users WHERE email  = :email ";
        $stmt = Database::getConnection()->prepare($sql);
        $stmt->execute(['email' => $username ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
