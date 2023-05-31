<?php

use Alura\Mvc\Controller\Error404Controller;
use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Repository\UserRepository;

require_once __DIR__ .  '/../vendor/autoload.php' ;


$dbpath = __DIR__ . "/../banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

/**
 * @var ?Alura\Mvc\Controller\Controller $controller
 */

$videoRepository = new VideoRepository($pdo);
$userRepository = new UserRepository($pdo);

$routes = require_once __DIR__ . "/../config/routes.php";

// vou receber o path info ou nulo 
$pathInfo = $_SERVER['PATH_INFO'] ?? "/";
// receber o request

$httpMethod = $_SERVER['REQUEST_METHOD'];
// array da minhas rotas


session_start();
//var_dump(!array_key_exists('logado', $_SESSION));
//exit();





$isLoginRoute = $pathInfo === '/login';
//loop de redirecionamento do login
if (!array_key_exists('name', $_SESSION) && !$isLoginRoute){
    header('Location:/login');
    return;
}


var_dump($_SERVER['PATH_INFO']);

var_dump($_SERVER['REQUEST_METHOD']);


var_dump($_SESSION);
exit();


$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)){
    $controllerClass = $routes[$key];
    // ao indicar a key requisitada, é o passa o classe (valor) correspondente a ela
    //var_dump($controllerClass);
    if ($pathInfo !=="/login"){
        $controller = new $controllerClass($videoRepository);
    }else {
        $controller = new $controllerClass($userRepository);
    }
} else {
    $controller = new Error404Controller();
}

/**
 * @var Controller $controller
 */
$controller->processaRequisicao();
