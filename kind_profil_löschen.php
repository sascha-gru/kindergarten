<?php
session_start();
require 'db.php'; // Verbindung zur Datenbank

// Zugriff nur für Eltern
if ($_SESSION['rolle'] !== 'eltern') {
    die("Zugriff verweigert.");
}



// $user_id = $_SESSION['user_id'];
// if (!isset($_SESSION['user_id'])) {
//     die("Fehler: Kein Benutzer eingeloggt.");
// }
if (!isset($_POST['k_abmelden'])) {
    die("Kein Kind ausgewählt.");
}

$kinder_ids = $_POST['k_abmelden']; // Array von IDs

foreach ($kinder_ids as $kind_id) {
    $stmt = $pdo->prepare("DELETE FROM kind WHERE kind_id = ? AND user_id = ?");
    $stmt->execute([$kind_id, $_SESSION['user_id']]);
}

// Zurück zur Übersicht
header("Location: eltern_dashboard.php");
exit;