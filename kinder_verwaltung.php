<?php 
    session_start();
    require 'db.php';
    $user_id = $_SESSION['user_id'];

    if ($_SESSION['rolle'] !== 'admin') {
        die("Zugriff verweigert.");
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kind löschen
    if (isset($_POST['kind_id'])) {
        $kind_id = $_POST['kind_id'];
        $stmt = $pdo->prepare("DELETE FROM kind WHERE kind_id = ?");
        $stmt->execute([$kind_id]);
        header("Location: kinder_verwaltung.php");
        exit;
    }

    // Kind hinzufügen
    if (isset($_POST['submit'])) {
        // Kind-Daten
        $kind_vorname = $_POST['k_vorname'] ?? '';
        $kind_nachname = $_POST['k_nachname'] ?? '';
    
        // Standort-Daten
        /*$standort_name = $_POST['standort_name'] ?? '';
        $standort_strasse = $_POST['standort_strasse'] ?? '';
        $standort_plz = $_POST['standort_plz'] ?? '';
        $standort_ort = $_POST['standort_ort'] ?? '';*/
    
        // Prüfen ob dieser Standort schon existiert
        /*$stmt = $pdo->prepare("SELECT standort_id FROM standort WHERE name = ? AND adresse = ? AND plz = ? AND ort = ?");
        $stmt->execute([$standort_name, $standort_strasse, $standort_plz, $standort_ort]);
        $standort = $stmt->fetch();
    
        if ($standort) {
            $standort_id = $standort['standort_id'];
        } else {
            // Standort einfügen
            $stmt_insert = $pdo->prepare("INSERT INTO standort (name, adresse, plz, ort) VALUES (?, ?, ?, ?)");
            $stmt_insert->execute([$standort_name, $standort_strasse, $standort_plz, $standort_ort]);
            $standort_id = $pdo->lastInsertId();
        }*/
    
        // Kind einfügen
        $stmt = $pdo->prepare("INSERT INTO kind (user_id, k_vorname, k_nachname) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $kind_vorname, $kind_nachname]);
    
        header("Location: kinder_verwaltung.php");
        exit;
    }
    
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kinder Verwaltung</title>
    <!--<link rel="stylesheet" href="style.css">-->
</head>
<body>
    <h1>Kinder Verwaltung</h1>
    <div class="container2">
        <form action="" method="POST">
            <input type="text" placeholder="vorname" name="kind_vorname"><br>
            <input type="text" placeholder="nachname" name="kind_nachname"><br>
            <button type="submit" name="submit">hinzufügen</button>
        </form>
    </div>

    <a href="admin_dashboard.php">Zurück</a>

    <div class="container1">
        <?php
        
        $stmt = $pdo->prepare("SELECT kind_id, k_vorname, k_nachname FROM kind WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $kinder = $stmt->fetchAll();
        ?>
        <div class="flex">
            <div class="jetz">
                <?php foreach ($kinder as $kind): ?>
                    <p><?php echo htmlspecialchars($kind['k_vorname']); ?>
                    <?php echo htmlspecialchars($kind['k_nachname']); ?>
                </p>
                    <form action="" method="POST">
                        <input type="hidden" name="kind_id" value="<?php echo $kind['kind_id']; ?>">
                        <button type="submit">löschen</button>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
