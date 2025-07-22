<?php
session_start();
require 'db.php';

if ($_SESSION['rolle'] !== 'admin') {
    die("Zugriff verweigert.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $kind_id = $_POST['kind_id'] ?? '';
        $e_vorname = $_POST['e_vorname'] ?? '';
        $e_nachname = $_POST['e_nachname'] ?? '';

        if ($kind_id && $e_vorname && $e_nachname) {
            $stmt = $pdo->prepare("INSERT INTO eltern_info (kind_id, e_vorname, e_nachname) VALUES (?, ?, ?)");
            $stmt->execute([$kind_id, $e_vorname, $e_nachname]);
            header("Location: admin_dashboard.php");
            exit;
        }
    }

    if (isset($_POST['delete'])) {
        $eltern_id = $_POST['eltern_id'] ?? '';
        $stmt = $pdo->prepare("DELETE FROM eltern_info WHERE eltern_id = ?");
        $stmt->execute([$eltern_id]);
        header("Location: admin_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Eltern Verwaltung</title>
</head>
<body>

<form action="" method="POST">
    <input type="text" name="e_vorname" placeholder="Vorname" required><br>
    <input type="text" name="e_nachname" placeholder="Nachname" required><br>

    <!-- Kind auswählen -->
    <select name="kind_id" required>
        <?php
        $stmt = $pdo->query("SELECT kind_id, k_vorname, k_nachname FROM kind");
        while ($kind = $stmt->fetch()) {
            echo "<option value='{$kind['kind_id']}'>" . htmlspecialchars($kind['k_vorname'] . " " . $kind['k_nachname']) . "</option>";
        }
        ?>
    </select><br>

    <button type="submit" name="submit">Elternteil hinzufügen</button>
</form>
<h2>Gespeicherte Elternteile</h2>

<?php
$stmt = $pdo->query("
    SELECT eltern_info.*, kind.k_vorname, kind.k_nachname
    FROM eltern_info
    JOIN kind ON eltern_info.kind_id = kind.kind_id
");
$eltern = $stmt->fetchAll();

foreach ($eltern as $row):
?>
    <div style='border:1px solid #ccc; margin:10px; padding:10px;'>
        <strong>Elternteil:</strong> <?= htmlspecialchars($row['e_vorname'] . " " . $row['e_nachname']) ?><br>
        <strong>Kind:</strong> <?= htmlspecialchars($row['k_vorname'] . " " . $row['k_nachname']) ?><br>

        <form method="POST">
            <input type="hidden" name="eltern_id" value="<?= $row['eltern_id'] ?>">
            <button name="delete">Löschen</button>
        </form>
    </div>
<?php endforeach; ?>
    <a href="admin_dashboard.php">Zurück</a>
    
</body>
</html>
