<?php 

namespace Alura\Mvc\Repository;

use PDO;

class UserRepository extends Repository
{

    public function __construct
    (
        private PDO $pdo
    )
    {
    }
    
    public function getUser($email): array
    {
        $user = $this->find($email);
        
        return $user;

    }
    public function find($email):array
    {
        
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = ?;");
        $statement->bindValue(1,$email);
        $statement->execute();
        $userData = $statement->fetch(PDO::FETCH_ASSOC);


        return $userData;
    }

    public function verifyPassword($password, $DataUser):bool
    {
        
        $correctPassword = password_verify($password, $DataUser);

        return $correctPassword;
    }
}