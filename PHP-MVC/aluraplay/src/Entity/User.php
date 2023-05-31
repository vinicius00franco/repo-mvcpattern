<?php

namespace Alura\Mvc\Entity;


class User
{
    public readonly int $id;

    public function __construct
    (
        
        public readonly string $email,
        private string $password
    )
    {
        $this->setId($this->id);
    }

    public function setEmail(string $email):void 
    {
        if (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            throw new \InvalidArgumentException;
        }

        $this->email = $email;
    }

    public function setPassword(string $password):void 
    {
        if (strlen($password) < 5){
            throw new \LengthException("Sua senha deve contter 4 dígitos");
        }
        $this->password = $password;
    }

    public function setId(int $id):void 
    {
        $this->id = $id;
    }

}
