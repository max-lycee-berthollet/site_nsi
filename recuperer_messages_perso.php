<?php
session_start();

// Connexion à la base de données
$host = "localhost";
$usernom = "id21586644_admin";
$password = "Ploup12345#";
$dbnom = "id21586644_ploup";

// Connexion à la base de données
$conn = mysqli_connect($host, $usernom, $password, $dbnom);

if (mysqli_connect_errno()) {
    echo json_encode(array('error' => 'La connexion à la base de données a échoué.'));
    exit();
}

// Récupération de l'ID utilisateur depuis la session
$user_id = $_SESSION['user_id'];

// Préparation de la requête avec une instruction préparée
$query = "SELECT compte.nom AS nom_utilisateur, messages.poste, messages.heure 
          FROM compte 
          INNER JOIN messages ON compte.id_poste = messages.id_poste 
          WHERE compte.user_id = ?
          ORDER BY messages.id DESC";

// Préparation de la requête
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Liaison du paramètre
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    // Exécution de la requête
    mysqli_stmt_execute($stmt);

    // Récupération des résultats
    $result = mysqli_stmt_get_result($stmt);

    // Création d'un tableau pour stocker les messages
    $messages = array();

    // Parcours des résultats et ajout dans le tableau
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = array(
            'nom_utilisateur' => $row['nom_utilisateur'],
            'heure' => $row['heure'],
            'poste' => $row['poste']
        );
    }

    // Envoi des données au format JSON
    echo json_encode($messages);

    // Fermeture du statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('error' => 'Erreur lors de la préparation de la requête.'));
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
