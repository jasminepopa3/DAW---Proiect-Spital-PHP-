<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creare Cont</title>
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

        input, select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
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

<h2>Creare Cont</h2>

<form action="process_register.php" method="post">
    <label for="email">Adresa de E-mail:</label>
    <input type="email" name="email" required>

    <label for="parola">Parola:</label>
    <input type="password" name="parola" required>
    
    <label for="nume_utilizator">Nume utilizator:</label>
    <input type="text" name="nume_utilizator" required>

    <label for="cnp">CNP:</label>
    <input type="text" name="cnp" required>

    <!-- <label for="rol">Rol:</label>
    <select name="rol" required>
        <option value="admin">Administrator</option>
        <option value="medic">Medic</option>
        <option value="asistent">Asistent(ă) medical(ă)</option>
        <option value="receptionist">Recepționist(ă)</option>
        <option value="manager">Manager</option>
     </select> -->


    <input type="submit" value="Înregistrare">
</form>

<p>Ai deja un cont? <a href="index.php">Autentificare</a>.</p>

</body>
</html>
