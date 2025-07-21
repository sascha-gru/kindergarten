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
$stmt = $pdo->prepare("SELECT * FROM mitarbeiter WHERE user_id = ?");
$stmt->execute([$user_id]);
$mitarbeiter = $stmt->fetch();

if ($mitarbeiter) {
    // Eintrag existiert → UPDATE
    $update = $pdo->prepare("UPDATE mitarbeiter SET mitarbeiter_vorname = ?, mitarbeiter_nachname = ? WHERE user_id = ?");
    $update->execute([$vorname, $nachname, $user_id]);
} else {
    // Kein Eintrag vorhanden → INSERT
    var_dump($user_id);
    $insert = $pdo->prepare("INSERT INTO mitarbeiter (user_id, mitarbeiter_vorname, mitarbeiter_nachname) VALUES (?, ?, ?)");
    $insert->execute([$user_id, $vorname, $nachname]);
}

// Danach weiterleiten
header("Location: mitarbeiter_db.php");
exit;
