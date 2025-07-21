<?php
session_start();
var_dump($_SESSION);

require 'db.php';

// Fehleranzeige aktivieren
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Variablen setzen
$user_id = $_SESSION['user_id'];
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];

// Prüfen, ob es schon einen Eintrag für diesen user gibt
$stmt = $pdo->prepare("SELECT * FROM eltern WHERE user_id = ?");
$stmt->execute([$user_id]);
$eltern = $stmt->fetch();

if ($eltern) {
    // Eintrag existiert → UPDATE
    $update = $pdo->prepare("UPDATE eltern SET e_vorname = ?, e_nachname = ? WHERE user_id = ?");
    $update->execute([$vorname, $nachname, $user_id]);
} else {
    // Kein Eintrag vorhanden → INSERT
    var_dump($user_id);
    $insert = $pdo->prepare("INSERT INTO eltern (user_id, e_vorname, e_nachname) VALUES (?, ?, ?)");
    $insert->execute([$user_id, $vorname, $nachname]);
}

// Danach weiterleiten
header("Location: eltern_dashboard.php");
exit;
