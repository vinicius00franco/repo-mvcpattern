<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false){
    header('location: /?sucesso=0');
    exit();
}

$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false){
    header('location: /?sucesso=0');
    exit();
}


$repository = new VideoRepository($pdo);

$video = new Video($url,$titulo);


if ($repository->add($video) === false){
    header('location: /?sucesso=0');
} else {
    header('location: /?sucesso=1');
}

//