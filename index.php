<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Autentificare</h2>

<form action="process_login.php" method="post">
    <label for="email">Adresa de E-mail:</label>
    <input type="email" name="email" required>

    <label for="parola">Parola:</label>
    <input type="password" name="parola" required>

    <input type="submit" value="Autentificare">
</form>

<p>Nu ai cont? <a href="register.php">Creează unul</a>.</p>

</body>
</html>
