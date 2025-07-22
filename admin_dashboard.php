<?php
session_start();
require 'db.php'; // Verbindung zur Datenbank

// Zugriff nur für Eltern
if ($_SESSION['rolle'] !== 'admin') {
    die("Zugriff verweigert.");
}
 

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="style.css"> -->

</head>
<body>
<h1>Willkommen, <?=$_SESSION['user_id'] ?> <?=$_SESSION['rolle'] ?>!</h1>
<p>Du bist eingeloggt.</p>
<?php if ( $_SESSION['rolle'] == 'admin') {?>
    <div class="container">
        <h2><a href="kinder_verwaltung.php">Kinder Verwaltung</a></h2>
        <h2><a href="eltern_verwaltung.php">Eltern Verwaltung</a></h2>
        <h2><a href="mitarbeitern_verwaltung.php">Mitarbeitern Verwaltung</a></h2>
        <h2><a href="gruppe_verwaltung.php">Gruppen Verwaltung</a></h2>
    </div>
    <?php
}
?>

<a href="logout.php">Logout</a>
</body>
