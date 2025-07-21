<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'];
$k_id = $_GET['k_id'];

// Nur Kind des eingeloggten Nutzers abrufen
$stmt = $pdo->prepare("SELECT * FROM kind WHERE kind_id = ? AND user_id = ?");
$stmt->execute([$k_id, $user_id]);
$kind = $stmt->fetch();

if (!$kind) {
    die("Kind nicht gefunden oder kein Zugriff.");
}
?>

<!-- Bearbeitungsformular -->
<form action="kind_profil_bearbeitet.php" method="post">
    <input type="hidden" name="kind_id" value="<?= $kind['kind_id'] ?>">

    <label>Vorname:</label>
    <input type="text" name="k_vorname" value="<?= htmlspecialchars($kind['k_vorname']) ?>"><br>

    <label>Nachname:</label>
    <input type="text" name="k_nachname" value="<?= htmlspecialchars($kind['k_nachname']) ?>"><br>

    <button type="submit">Speichern</button>
    <button onclick="history.back()">Zurück</button>
</form>
