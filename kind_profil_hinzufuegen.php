<?php
session_start();
require 'db.php'; // Verbindung zur Datenbank

// Zugriff nur für Eltern
if ($_SESSION['rolle'] !== 'eltern') {
    die("Zugriff verweigert.");
}
?>

<form action="kind_profil_speichern.php" method="post">
    <label for="vorname">Vorname:</label>
    <input type="text" name="vorname" required>

    <label for="nachname">Nachname:</label>
    <input type="text" name="nachname" required>

    <button type="submit">Speichern</button>
    <button onclick="history.back()">Zurück</button>
</form>