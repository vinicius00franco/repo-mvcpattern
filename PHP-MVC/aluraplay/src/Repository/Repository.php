<?php 

namespace Alura\Mvc\Repository;

use PDO;

class Repository
{

    public function __construct
    (
        private PDO $pdo
    )
    {}
}