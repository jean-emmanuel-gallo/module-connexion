<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
        <div class="signup-block">
            <h2>Inscription</h2>
            <form action="inscription.php" method="post">
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
              <div class="form-group">
                <label for="confirm-password">Confirmer le mot de passe:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
              </div>
              <button type="submit">S'inscrire</button>
            </form>
          </div>          
      </main>
      

      <?php
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

    $sql = "INSERT INTO user (login, firstname, lastname, password) VALUES ('$login', '$firstname', '$lastname', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        header("Location: connexion.php");
        exit();
    } else {
        echo "Erreur lors de l'inscription : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


</body>
</html>