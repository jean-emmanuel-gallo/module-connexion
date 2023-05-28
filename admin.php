<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'administration</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 600px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            display: inline-block;
        }

        input[type="text"] {
            width: 150px;
            margin-right: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <nav>
          <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
          </ul>
        </nav>
    </header>

    <main>
        <h1>Liste des utilisateurs</h1>
        <?php
        session_start();

        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['login'] !== 'admin') {
            header("Location: connexion.php");
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
            $userId = $_POST['user_id'];
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);

            $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname' WHERE id='$userId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Informations mises à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des informations.";
            }
        }

        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Login</th><th>Prénom</th><th>Nom</th><th>Action</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['login']."</td>";
                echo "<td>".$row['firstname']."</td>";
                echo "<td>".$row['lastname']."</td>";
                echo "<td>";
                echo "<form action='admin.php' method='post'>";
                echo "<input type='hidden' name='user_id' value='".$row['id']."'>";
                echo "<input type='text' name='firstname' value='".$row['firstname']."'>";
                echo "<input type='text' name='lastname' value='".$row['lastname']."'>";
                echo "<button type='submit'>Mettre à jour</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Aucun utilisateur trouvé.";
        }

        mysqli_close($conn);
        ?>
    </main>
</body>
</html>
