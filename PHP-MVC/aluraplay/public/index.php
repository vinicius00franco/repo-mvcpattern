<?php


use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\VideoListController;

require_once __DIR__ .  '/../vendor/autoload.php' ;


$dbpath = __DIR__ . "/../banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

if ($pdo === true){
    echo "conectei";
}

$videoRepository = new VideoRepository($pdo);
var_dump($videoRepository);

if (!array_key_exists('PATH_INFO', $_SERVER) || ($_SERVER['PATH_INFO'] === '/')){
    $controller = new VideoListController($videoRepository);
    $controller->processaRequisicao();
 
} elseif ($_SERVER['PATH_INFO'] === '/novo-video'){

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once __DIR__ . '/../formulario.php';

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
        require_once __DIR__ . '/../novo-video.php';
    };
} elseif ($_SERVER['PATH_INFO'] === '/editar-video'){
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        require_once __DIR__ . '/../formulario.php';

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
        require_once __DIR__ . '/../editar-video.php';
    };
} elseif ($_SERVER['PATH_INFO'] === '/remover-video'){
    require_once __DIR__ . '/../remover-video.php';

} else {
    http_response_code(404);
}

