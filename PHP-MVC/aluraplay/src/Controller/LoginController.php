<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\UserRepository;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class LoginController implements Controller
{
    
    public function __construct( private UserRepository $userRepository)
    {
          
    }

    
    public function processaRequisicao()
    {
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $dataUser = $this->userRepository->getUser($email);


        $correctPassword = $this->userRepository->verifyPassword($password, $dataUser['password']);

        
        if ($correctPassword){
        
            header('location:/');
        } else {
            header('location:/login?sucesso=0');
        }

    }
}