<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

$id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
if ($id === false || $id === null){
    header('location: /?sucesso=0');
    exit();
}

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
$video = new Video($url,$titulo);
$video->setId($id);

$repository = new VideoRepository($pdo);


if ($repository->update($video) === false){
    header('location: /?sucesso=0');
} else {
    header('location: /?sucesso=1');
}

//