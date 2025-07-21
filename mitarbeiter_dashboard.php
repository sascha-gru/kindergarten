<?php
session_start();
require 'db.php'; // Verbindung zur Datenbank

// Zugriff nur für Eltern
if ($_SESSION['rolle'] !== 'mitarbeiter') {
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
$stmt = $pdo->prepare("SELECT mitarbeiter_vorname, mitarbeiter_nachname FROM mitarbeiter WHERE user_id = ?");
$stmt->execute([$user_id]);
$mitarbeiter = $stmt->fetch();

if (!$mitarbeiter || empty($mitarbeiter['mitarbeiter_vorname']) || empty($mitarbeiter['mitarbeiter_nachname'])) {
    // Weiterleitung auf Formularseite, falls Name leer ist
    header("Location: mitarbeiter_profil_ausfuellen.php");
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
            <label>Kalender</label>
            <button onclick="window.location.href='mitarbeiter_kalender.php';">Anzeigen</button>
        </div>
    </div>
</body>
</html>