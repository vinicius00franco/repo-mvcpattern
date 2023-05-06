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

// $sql = "DELETE FROM videos WHERE id=?;";

// $statement = $pdo->prepare($sql);

// $statement->bindValue(1,$id);

$reposository = new VideoRepository($pdo);


if ($reposository->remove($id) === false){
    header('location: /?sucesso=0');
} else {
    header('location: /?sucesso=1');
}

//