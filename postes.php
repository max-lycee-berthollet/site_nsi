<?php
session_start();

// Vérifier si l'ID utilisateur est présent dans la session
if (!isset($_SESSION['user_id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas authentifié
    header("Location: compte.php");
    exit();
}
?>

<!doctype html>
<html lang="fr">
<head>
  <title>SocialNexa</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <style>
    /* CSS pour la classe .poste */
    .poste {
      margin-bottom: 10px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
  
</head>
<body>
  <main id='tete'><section><img id='logo' src='image.png'></section><section><a href='index.html'>Accueil</a></section><section><a href='postes.php'>Postes</a></section><section><a href='publier_page.php'>Publier</a></section><section><a href='compte.php'>Compte</a></section></main>
	<hr>
	<div id='messages'>
	<?php
	    $host = "localhost";
        $usernom = "id21586644_admin";
        $password = "Ploup12345#";
        $dbnom = "id21586644_ploup";

        $conn = mysqli_connect($host, $usernom, $password, $dbnom);
        if (mysqli_connect_errno()) {
            echo "La connexion n'a pas pu être établie : " . mysqli_connect_error();
        } else {
                
                $query = "SELECT compte.`nom`, messages.`poste`, messages.`heure` FROM `compte` INNER JOIN messages ON compte.`id_poste` = messages.`id_poste` ORDER BY messages.`id` DESC";
                $result = mysqli_query($conn, $query);
                
                // Vérification de la préparation de la requête
                if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()){
                        echo "<div class = 'poste'>" . '<b>'. $row['nom'] .'</b>'." ". $row['heure'] . "<br>"; 
                        echo $row['poste'] . "<br>";
                        echo "</div>" ;
                    
                    }
                    

                    
                } else {
                    echo "Erreur de préparation de la requête : " . mysqli_error($conn);
                }
            }

            // Fermeture de la connexion
            mysqli_close($conn);
        
	    
	?>
	</div>
	<script>
    $(document).ready(function() {
        function fetchData() {
            $.ajax({
                url: 'recuperer_messages.php',
                type: 'GET',
                dataType: 'json', // Définit le type de données attendu dans la réponse
                success: function(data) {
                    $('#messages').empty(); // Vide la div #messages
                    $.each(data, function(index, message) {
                        $('#messages').append('<div class = "poste"><div class="tete">' + '<b>' + message.nom_utilisateur + '</b>' + " " + message.heure + '</div>' + '<div>' + message.poste + '</div>' + '</div>');
                        
                        
                    });
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error); // En cas d'erreur, affichez la console
                }
            });
        }

        // Appel initial
        fetchData();

        // Rafraîchissement toutes les 5 secondes (5000 millisecondes)
        setInterval(fetchData, 5000);
    });
</script>
	
	
</body>
</html>
