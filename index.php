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
            margin: 0;
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

 * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',
    'Lucida Sans', Arial, sans-serif;
}

nav {
  height: 80px;
  background: #3399ff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0rem calc((100vw - 1300px) / 2);
}

nav a {
  text-decoration: none;
  color: #000;
  padding: 0 1.5rem;
}

nav a:hover {
  color: #fff;
}

/*dropdown*/

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}



/*stop*/

.logo {
  color: #000;
  font-size: 1rem;
  font-weight: bold;
  font-style: italic;
  padding: 0 2rem;
}
.hero {
    background: #80bfff;
    width: 100%;
    height: 100vh; 
    padding: 50px; 
    box-sizing: border-box; 
}

  
    </style>
</head>
<body>
<nav>
    <div class="logo">Spitalul de Urgență FMI</div>
</nav>
<div class="hero">
<h2>Autentificare</h2>

<form action="process_login.php" method="post">
    <label for="email">Adresa de E-mail:</label>
    <input type="email" name="email" required>

    <label for="parola">Parola:</label>
    <input type="password" name="parola" required>

    <input type="submit" value="Autentificare">
</form>

<p>Nu ai cont? <a href="register.php">Creează unul</a>.</p>
</div>
</body>
</html>
