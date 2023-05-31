<?php 

$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

$sql = "INSERT INTO users (email, password) VALUES (?,?);";
$statement = $pdo->prepare($sql);

$email = $argv[1];
$password = $argv[2];

$passwordHash = password_hash($password, PASSWORD_ARGON2ID);

$statement->bindValue(1, $email);
$statement->bindValue(2, $passwordHash);

$statement->execute();



