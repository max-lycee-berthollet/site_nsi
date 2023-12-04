<?php
session_start();

$host = "localhost";
$usernom = "id21586644_admin";
$password = "Ploup12345#";
$dbnom = "id21586644_ploup";

$conn = mysqli_connect($host, $usernom, $password, $dbnom);

if (mysqli_connect_errno()) {
    echo "La connexion n'a pas pu être établie : " . mysqli_connect_error();
} else {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        if (isset($_GET['poste'])) {
             // Utilisation de déclarations préparées pour éviter les injections SQL
                    $poste = $_GET['poste'];
                    $query = "UPDATE `compte` SET `poste` = ? WHERE `user_id` = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    // Vérification de la préparation de la requête
                    if ($stmt) {
                        // Liaison des paramètres
                        mysqli_stmt_bind_param($stmt, "si", $poste, $user_id);
                        // Exécution de la requête
                        $result = mysqli_stmt_execute($stmt);
    
                        if ($result) {
                            header("Location : publier.html");
                        } else {
                            echo "Erreur lors de l'enregistrement : " . mysqli_stmt_error($stmt);
                        }
    
                        // Fermeture de la déclaration préparée
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Erreur de préparation de la requête : " . mysqli_error($conn);
                    }
                }
        
    } else {
        // Rediriger si l'utilisateur n'est pas connecté
        header("Location: compte.html");
        exit();
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
