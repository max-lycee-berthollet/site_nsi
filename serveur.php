<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/jeu.css">
    <title>SocialNexa</title>
</head>

<body>
    <p>
        <?php
        $host = "localhost";
        $usernom = "id21586644_admin";
        $password = "Ploup12345#";
        $dbnom = "id21586644_ploup";

        $conn = mysqli_connect($host, $usernom, $password, $dbnom);

        if (mysqli_connect_errno()) {
            echo "La connexion n'a pas pu être établie : " . mysqli_connect_error();
        } else {
            echo "Connexion établie avec succès... <br>";

            if (isset($_GET['nom']) && isset($_GET['mail']) && isset($_GET['mdp'])) {
                // Utilisation de déclarations préparées pour éviter les injections SQL
                $nom = $_GET['nom'];
                $mail = $_GET['mail'];
                $mdp = $_GET['mdp'];

                $query = "INSERT INTO `compte`(`nom`, `mail`, `mdp`) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);

                // Vérification de la préparation de la requête
                if ($stmt) {
                    // Liaison des paramètres
                    mysqli_stmt_bind_param($stmt, "sss", $nom, $mail, $mdp);

                    // Exécution de la requête
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        echo "Enregistrement réussi.";
                    } else {
                        echo "Erreur lors de l'enregistrement : " . mysqli_stmt_error($stmt);
                    }

                    // Fermeture de la déclaration préparée
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Erreur de préparation de la requête : " . mysqli_error($conn);
                }
            }

            // Fermeture de la connexion
            mysqli_close($conn);
        }
        ?>
    </p>
</body>

</html>
