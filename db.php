<?php

$host       =   'localhost';
$dbname    =   'login_db';
$user       =   'root';
$pass       =   'root';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    die("Verbindung fehlgeschlafen:" . $e->getMessage());
}

?>