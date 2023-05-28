<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
        <div class="settings-block">
            <h2>Modifier les paramètres</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" required>
                </div>
                <div class="form-group">
                    <label for="firstname">Prénom:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Nom:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Enregistrer les modifications</button>
            </form>

            <form action="deconnexion.php" method="post">
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    </main>

    <?php
    session_start(); 

    if (!isset($_SESSION['id_utilisateur'])) {
        header("Location: connexion.php");
        exit();
    }

    $id_utilisateur = $_SESSION['id_utilisateur'];

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
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        $sql = "UPDATE user SET login='$login', firstname='$firstname', lastname='$lastname', password='$hashedPassword' WHERE id='$id_utilisateur'";

        if (mysqli_query($conn, $sql)) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erreur lors de la mise à jour des paramètres : " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
