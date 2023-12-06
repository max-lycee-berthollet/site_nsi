<?php
$host = "localhost";
$usernom = "id21586644_admin";
$password = "Ploup12345#";
$dbnom = "id21586644_ploup";
$conn = mysqli_connect($host, $usernom, $password, $dbnom);

if (mysqli_connect_errno()) {
    echo "La connexion n'a pas pu être établie : " . mysqli_connect_error();
} else {
    if (isset($_GET['nom']) && isset($_GET['mail']) && isset($_GET['mdp'])) {
        // Récupération de l'ID du dernier poste
        $id_poste_query = "SELECT MAX(`id_poste`) AS max_id FROM `compte`";
        $result = mysqli_query($conn, $id_poste_query);
        if (!$result) {
            echo "Erreur de récupération de l'ID du poste : " . mysqli_error($conn);
        } else {
            $row = mysqli_fetch_assoc($result);
            $id_poste = $row['max_id'] + 1; // Nouvel ID pour le prochain poste
        }

        // Utilisation de déclarations préparées pour éviter les injections SQL
        $nom = $_GET['nom'];
        $mail = $_GET['mail'];
        $mdp = $_GET['mdp'];
        $uuid = mysqli_query($conn, "SELECT UUID()")->fetch_row()[0]; // Générer un UUID
        $query = "INSERT INTO `compte`(`user_id`, `nom`, `mail`, `mdp`, `id_poste`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Vérification de la préparation de la requête
        if ($stmt) {
            // Liaison des paramètres
            mysqli_stmt_bind_param($stmt, "ssssi", $uuid, $nom, $mail, $mdp, $id_poste);
                // Exécution de la requête
            $result = mysqli_stmt_execute($stmt);
                if ($result) {
                header("Location: compte.html");
                exit();
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/jeu.css">
    <title>SocialNexa</title>
</head>
<body>
    <p>
    </p>
</body>
</html>
