<?php
// Connexion à la base de données
$host = "localhost";
$usernom = "id21586644_admin";
$password = "Ploup12345#";
$dbnom = "id21586644_ploup";

$conn = mysqli_connect($host, $usernom, $password, $dbnom);

if (mysqli_connect_errno()) {
    echo json_encode(array('error' => 'La connexion à la base de données a échoué.'));
    exit();
}

// Récupération des messages depuis la base de données
$query = "SELECT compte.nom AS nom_utilisateur, messages.poste, messages.heure 
          FROM compte 
          INNER JOIN messages ON compte.id_poste = messages.id_poste 
          ORDER BY messages.id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(array('error' => 'Erreur lors de la récupération des messages depuis la base de données.'));
    exit();
}

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

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
