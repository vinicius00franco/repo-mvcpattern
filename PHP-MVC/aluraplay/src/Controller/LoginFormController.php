<?php 

namespace Alura\Mvc\Controller;


class LoginFormController implements Controller
{
    
    public function __construct()
    {     
    }

    
    public function processaRequisicao()
    {
        require_once __DIR__ . "/../../views/login-form.php";
    }
}