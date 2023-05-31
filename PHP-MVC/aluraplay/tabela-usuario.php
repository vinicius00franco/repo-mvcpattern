<?php

$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

if ($pdo->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, email TEXT, password TEXT);") !== false){
    echo "Tabela criada com sucesso";
};