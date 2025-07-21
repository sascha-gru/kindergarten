<?php
session_start();
require 'db.php';

// Fehleranzeige aktivieren
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Variablen setzen
$user_id = $_SESSION['user_id'];
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];


$insert = $pdo->prepare("INSERT INTO kind (user_id, k_vorname, k_nachname) VALUES (?, ?, ?)");
$insert->execute([$user_id, $vorname, $nachname]);


// Danach weiterleiten
header("Location: eltern_dashboard.php");
exit;
