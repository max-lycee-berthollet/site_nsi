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
        // Récupération de l'id_poste associé à l'utilisateur actuel
        $user_id = $_SESSION['user_id'];
        $query_id = "SELECT `id_poste` FROM `compte` WHERE `user_id` = ?";
        $stmt_id = mysqli_prepare($conn, $query_id);

        if ($stmt_id) {
            mysqli_stmt_bind_param($stmt_id, "s", $user_id);
            mysqli_stmt_execute($stmt_id);
            mysqli_stmt_bind_result($stmt_id, $id_poste);

            if (mysqli_stmt_fetch($stmt_id)) {
                mysqli_stmt_close($stmt_id);

                if (isset($_GET['poste'])) {
                    $poste = $_GET['poste'];
                    $query_insert = "INSERT INTO `messages` (`poste`, `id_poste`) VALUES (?, ?)";
                    $stmt_insert = mysqli_prepare($conn, $query_insert);

                    if ($stmt_insert) {
                        mysqli_stmt_bind_param($stmt_insert, "si", $poste, $id_poste);
                        $result = mysqli_stmt_execute($stmt_insert);

                        if ($result) {
                            header("Location: postes.php");
                            exit();
                        } else {
                            echo "Erreur lors de l'enregistrement : " . mysqli_stmt_error($stmt_insert);
                        }

                        mysqli_stmt_close($stmt_insert);
                    } else {
                        echo "Erreur de préparation de la requête d'insertion : " . mysqli_error($conn);
                    }
                }
            } else {
                echo "Aucun id_poste associé à cet utilisateur.";
            }
        } else {
            echo "Erreur de préparation de la requête de récupération de l'id_poste : " . mysqli_error($conn);
        }
    } else {
        // Redirection si l'utilisateur n'est pas connecté
        header("Location: compte.html");
        exit();
    }

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
    <p></p>
</body>
</html>
