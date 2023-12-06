<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $usernom = "id21586644_admin";
    $password = "Ploup12345#";
    $dbnom = "id21586644_ploup";

    $conn = mysqli_connect($host, $usernom, $password, $dbnom);

    if (mysqli_connect_errno()) {
        die("La connexion n'a pas pu être établie : " . mysqli_connect_error());
    }

    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];

    // Utilisation de déclarations préparées pour éviter les injections SQL
    $query = "SELECT * FROM compte WHERE nom = ? OR mail = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $identifiant, $identifiant);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Obtention des données de l'utilisateur
                mysqli_stmt_bind_result($stmt, $user_id, $nom, $mail, $mdp, $id_poste);
                mysqli_stmt_fetch($stmt);

                // Stockage de l'ID de l'utilisateur en session
                $_SESSION['user_id'] = $user_id;
                header("Location: connecte.html");
                
            } else {
                echo "Identifiants invalides.";
            }
        } else {
            echo "Erreur lors de l'exécution de la requête : " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur de préparation de la requête : " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
