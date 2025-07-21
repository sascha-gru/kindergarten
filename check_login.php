<?php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];


$stmt = $pdo->prepare("SELECT * FROM users WHERE benutzername = ?");
$stmt->execute([$username]); // <- Fehler passiert hier, wenn du $username vergisst in ein Array zu packen

$user = $stmt->fetch();

    if (!$user) {
        die("Benutzer wurde nicht gefunden!");
    }

    if ($user && password_verify($password, $user['passwort'])) {
        // Passwort stimmt
        $_SESSION['user']   = $user['username'];
        $_SESSION['rolle']  = $user['rolle'];
        $_SESSION['user_id'] = $user['id'];


        if($user['rolle']==='admin'){
            header("Location: admin_dashboard.php");
        }elseif($user['rolle']==='eltern'){
            header("Location: eltern_dashboard.php");
        }elseif($user['rolle']==='mitarbeiter'){
            header("Location: mitarbeiter_dashboard.php");
        }
        exit;
    } else {
        // Falsche Daten
        echo "Falscher Benutzername oder Passwort!";
    }

?>

