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
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT kind_id, k_vorname, k_nachname FROM kind WHERE user_id = ?");
$stmt->execute([$user_id]);
//$kind = $stmt->fetch(); // Wenn du nur ein Kind erwartest
$kinder = $stmt->fetchAll();

if(!$kinder){
    echo 'keine kinder';
}

?>

<form action="kind_profil_bearbeiten.php" method="get">
    <label>Kind auswählen:</label>
    <select name="k_id">
        <?php foreach ($kinder as $kind): ?>
            <option value="<?= $kind['kind_id'] ?>">
                <?= htmlspecialchars($kind['k_vorname'] . ' ' . $kind['k_nachname']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Bearbeiten</button>
    <button onclick="history.back()">Zurück</button>
</form>


