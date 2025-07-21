<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="check_login.php" method="post">
        <label for="username">Benutzername:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Passwort:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Einloggen</button>
    </form>
    <p>Noch kein Konto? <a href="register.php">Jetzt registrieren</a></p>
    
</body>
</html>