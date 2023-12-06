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
  <script src="script.js"></script>
</head>
<body>
  <main id='tete'><section><img id='logo' src='image.png'></section><section><a href='index.html'>Accueil</a></section><section><a href='postes.php'>Postes</a></section><section><a href='publier_page.php'>Publier</a></section><section><a href='compte.php'>Compte</a></section></main>
	<hr>
	
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
                        echo $row['nom'] ." ". $row['heure'] . "<br>"; 
                        echo $row['poste'] . "<br>";
                        echo "<br>";
                    
                    }
                    

                    
                } else {
                    echo "Erreur de préparation de la requête : " . mysqli_error($conn);
                }
            }

            // Fermeture de la connexion
            mysqli_close($conn);
        
	    
	?>
	
	
</body>
</html>