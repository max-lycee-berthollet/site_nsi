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
	<p>Publiez un SocialPoste ! </p>
	<form method="get" action="publier.php">
       <div><label for="poste"></label><textarea type="text" name="poste"></textarea></div>
       <div><input type='submit' value='Publier'></div>
    </form>
</body>
