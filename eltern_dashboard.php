<?php
session_start();
require 'db.php'; // Verbindung zur Datenbank

// Zugriff nur für Eltern
if ($_SESSION['rolle'] !== 'eltern') {
    die("Zugriff verweigert.");
}

//var_dump($user_id = $_SESSION['user_id']);

// $user_id = $_SESSION['user_id'];
// if (!isset($_SESSION['user_id'])) {
//     die("Fehler: Kein Benutzer eingeloggt.");
// }



// Aktuelle user_id holen
$user_id = $_SESSION['user_id']; // ← Diese Variable solltest du beim Login speichern!

// Vorname/Nachname auslesen
$stmt = $pdo->prepare("SELECT e_vorname, e_nachname FROM eltern WHERE user_id = ?");
$stmt->execute([$user_id]);
$eltern = $stmt->fetch();

if (!$eltern || empty($eltern['e_vorname']) || empty($eltern['e_nachname'])) {
    // Weiterleitung auf Formularseite, falls Name leer ist
    header("Location: eltern_profil_ausfuellen.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eltern_Dashboard</title>
    <!--<link rel="stylesheet" href="style.css">-->
</head>
<body>
    <div class="menue_d">
        <h2>Menü</h2>
        <button onclick="window.location.href='logout.php'">logout</button>
        <div class="nav_d">
            <label>Kind hinzufügen</label>
            <button onclick="window.location.href='kind_profil_hinzufuegen.php';">+</button>
        </div>
        <div class="nav_d">
        <label>Kind abmelden</label>
        <button onclick="window.location.href='kind_profil_abmelden.php';">-</button>
        </div>
        <div class="nav_d">
        <label>Kind Einsicht</label>
        <button onclick="window.location.href='kind_profil_einsicht.php';">&#128269;</button>
        </div>
    </div>
</body>
</html>