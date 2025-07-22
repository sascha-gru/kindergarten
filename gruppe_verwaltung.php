<?php
    include ("db.php") ;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Gruppe hinzufügen
        if (isset($_POST['submit'])) {
            $beschreibung = $_POST['beschreibung'] ?? '';
            $standort_id = $_POST['standort_id'] ?? '';
        
            $stmt = $pdo->prepare("INSERT INTO gruppen (beschreibung, standort_id) VALUES (?, ?)");
            $stmt->execute([$beschreibung, $standort_id]);
        
            header("Location: gruppe_verwaltung.php");
            exit;  }
    if (isset($_POST["delete"])) {
        $stmt = $pdo->prepare("DELETE FROM gruppen WHERE gruppen_id = ?");
        $stmt->execute([$_POST['gruppen_id']]);
        header("Location: gruppe_verwaltung.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gruppen verwaltung </title>
</head>
<body>
    <div class="zurck"><a href="admin_dashboard.php">zurück</a></div>
        <h1>gruppen verwaltung </h1>
        <div class="container2">
            <form action="" method="POST">
                <input type="text" placeholder="beschreibung" name="beschreibung"><br>
                <select name="standort_id" id="">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM standort");
                    while ($standort = $stmt->fetch()) {?>
                    <option value="<?php echo $standort['standort_id']; ?>"><?php echo $standort['name']; ?></option>
                   <?php }
                    ?>
                </select>
                <button type="submit" name="submit">hinzufügen</button>
            </form>
        </div>

        <div class="container1">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM gruppen");
            $stmt->execute();
            $gruppen = $stmt->fetchAll();?>

        <?php foreach ($gruppen as $gruppe):?>
            <div class="flex">
                <div class="jetz">
                    <p><?php echo htmlspecialchars($gruppe['beschreibung']); ?></p>
                    <p><?php echo htmlspecialchars($gruppe['standort_id']); ?></p>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="gruppen_id" value="<?php echo htmlspecialchars($gruppe['gruppen_id']); ?>">
                    <button type="submit" name="delete">löschen</button>
                </form>
            </div>
        <?php endforeach;?>    
        </div>
</body>
</html>