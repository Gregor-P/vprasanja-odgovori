<?php
<<<<<<< HEAD
$salt = 'dglkn349346$%dfh';

=======
$salt = "jdf0s#!#)=#4324";
>>>>>>> 34accd439fe91e46d725a9328c10e59e996b6731
$host = 'localhost';
$db   = 'vprasanja-odgovori';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $opt);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>