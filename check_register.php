<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$passwordRepeat = $_POST['password_repeat'] ?? '';
$rolle = $_POST['rolle'] ?? '';

if ($password !== $passwordRepeat) {
    echo "Die Passwörter stimmen nicht überein!";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Neuen Benutzer in DB einfügen
$stmt = $pdo->prepare("INSERT INTO users (benutzername, passwort, rolle) VALUES (?, ?, ?)");
$stmt->execute([$username, $hashedPassword, $rolle]);

// Neue user_id holen
$user_id = $pdo->lastInsertId();

// Benutzer aus DB holen (inkl. Rolle)
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Session setzen
$_SESSION['user_id'] = $user['id'];
$_SESSION['rolle']   = $user['rolle'];

// Weiterleitung
if($rolle == 'eltern'){
    header("Location: eltern_dashboard.php");
}elseif($rolle == 'mitarbeiter'){
    header("Location: mitarbeiter_db.php");
}elseif($rolle == 'admin'){
    header('Location: admin_dashboard.php');
}

exit;
 