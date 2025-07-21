<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'];
$k_id = $_POST['kind_id'];
$vorname = $_POST['k_vorname'];
$nachname = $_POST['k_nachname'];

// Sicherheit: Nur das Kind des eingeloggten Nutzers darf bearbeitet werden
$stmt = $pdo->prepare("UPDATE kind SET k_vorname = ?, k_nachname = ? WHERE kind_id = ? AND user_id = ?");
$stmt->execute([$vorname, $nachname, $k_id, $user_id]);

header("Location: eltern_dashboard.php");
exit;
