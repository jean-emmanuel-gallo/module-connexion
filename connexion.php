<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <header>
        <nav>
          <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
          </ul>
        </nav>
    </header>
      
    <main>
        <div class="login-block">
            <h1>Connexion</h1>
            <form action="connexion.php" method="post">
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </main>

    <?php
    session_start();

    if (isset($_SESSION['id_utilisateur'])) {
        header("Location: profil.php");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "@Jedeviles88";
    $dbname = "moduleconnexion";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Échec de la connexion à la base de données : " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM user WHERE login='$login'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['id_utilisateur'] = $row['id'];

                if ($row['login'] === 'admin') {
                    $_SESSION['login'] = 'admin';  
                    header("Location: admin.php");
                    exit();
                } else {
                    header("Location: profil.php");
                    exit();
                }
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Login incorrect.";
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
