<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class Error404Controller implements Controller
{
    
    public function __construct()
    {     
    }

    
    public function processaRequisicao()
    {
        return http_response_code(404);
    }
}