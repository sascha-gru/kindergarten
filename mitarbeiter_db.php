

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <title>Dienstplan</title>
    </head>

<body>
    <?php
        // Verbindung zur Datenbank
        $host      =   'localhost';
        $dbname    =   'login_db';
        $user      =   'root';
        $pass      =   'root';

        try{
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user,$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            die("Verbindung fehlgeschlafen:" . $e->getMessage());
        }

        // Datum aus URL
        $datum = isset($_GET['datum']) ? $_GET['datum'] : date('Y-m-d');

        // 5 zufällige Mitarbeiter abrufen
        $stmt = $pdo->query("SELECT mitarbeiter_vorname, mitarbeiter_nachname FROM mitarbeiter ORDER BY RAND() LIMIT 5");
        $mitarbeiter = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Zwei zufällige Indizes für Teilzeit
        $teilzeitIndizes = array_rand($mitarbeiter, 2);

        $datumObjekt = new DateTime($datum);
        $deutschesDatum = $datumObjekt->format('d.m.Y');
    ?>

    <h1 class="h1">Mitarbeiter Dienstplan</h1>
        <h2><?= htmlspecialchars($deutschesDatum) ?></h2>

    <table class="table_db">
        <tr>
            <th class="th1">Vorname</th>
            <th class="th1">Nachname</th>
            <th class="th1">Startzeit</th>
            <th class="th1">Endzeit</th>
        </tr>
        <?php foreach ($mitarbeiter as $index => $person): ?>
        <tr>
            <td class="td1"><?= htmlspecialchars($person['mitarbeiter_vorname']) ?></td>
            <td class="td1"><?= htmlspecialchars($person['mitarbeiter_nachname']) ?></td>
            <?php if ($index === $teilzeitIndizes[0]): ?>
                <td class="td1">07:30 Uhr</td>
                <td class="td1">11:30 Uhr</td>
            <?php elseif ($index === $teilzeitIndizes[1]): ?>
                <td class="td1">12:00 Uhr</td>
                <td class="td1">16:00 Uhr</td>
            <?php else: ?>
                <td class="td1">07:30 Uhr</td>
                <td class="td1">16:00 Uhr</td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
<a href="mitarbeiter_kalender.php" class="back1">Zurück zum Kalender</a>
</html>
