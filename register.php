<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
</head>
<body>
    <div>
        <h2>Registrierung</h2>
            <form action="check_register.php" method="post">
                <label for="username">Benutzername:</label>
                <input type="text" name="username" required><br><br>

                <label for="email">E-Mail:</label>
                <input type="email" name="email" required><br><br>

                <label for="password">Passwort:</label>
                <input type="password" name="password" required><br><br>

                <label for="password_repeat">Passwort wiederholen:</label>
                <input type="password" name="password_repeat" required><br><br>

                <select name="rolle">
                    <option value="admin">admin</option>
                    <option value="mitarbeiter">mitarbeiter</option>
                    <option value="eltern">eltern</option>
                </select>

                <button type="submit">Registrieren</button><br><br>  
                <button onclick="history.back()">Zurück</button>
            </form>
            
    </div>
</body>
</html>
