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
    $query = "SELECT * FROM compte WHERE nom = ? OR mail = ? ";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $identifiant, $identifiant);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Vérifiez s'il y a une correspondance dans la base de données
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                $user_id = uniqid();
                $_SESSION['user_id'] = $user_id;
                // Obtention des données de l'utilisateur
               // mysqli_stmt_bind_result($stmt, $user_id);
                //mysqli_stmt_fetch($stmt);
                // Insertion de l'identifiant de l'utilisateur dans la table `compte`
                $updateQuery = "UPDATE compte SET user_id = ? WHERE nom = ? OR mail = ?";
                $updateStmt = mysqli_prepare($conn, $updateQuery);

                if ($updateStmt) {
                    mysqli_stmt_bind_param($updateStmt, "iss", $user_id, $identifiant, $identifiant);
                    $updateResult = mysqli_stmt_execute($updateStmt);

                    if ($updateResult) {
                        header("Location: compte.html");
                        exit();
                    } else {
                        echo "Erreur lors de la mise à jour de la table compte : " . mysqli_stmt_error($updateStmt);
                    }

                    mysqli_stmt_close($updateStmt);
                } else {
                    echo "Erreur de préparation de la requête de mise à jour : " . mysqli_error($conn);
                }
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
