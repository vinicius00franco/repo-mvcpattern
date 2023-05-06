<?php

$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");
$pdo->exec("CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, titulo TEXT);");