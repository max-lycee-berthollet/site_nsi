<?php
    session_start();
    if (isset($_SESSION['user_id'])){
        header('Location: connecte.html');
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
  <h1>Compte </h1>
  <p style="color: #FF69B4"></p>
  <p>Connectez-vous !</p>
    <form method="post" action="login.php">
        
        <div><label for="identifiant">E-mail :</label>
        <input type="text" id="identifiant" name="identifiant" required></div>
        <br/>
        <div><label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required></div>
        <br/>
        <div><input type="submit" value="Se Connecter"></div>
        <br/>
    </form>
    <p>Pas encore inscrit ?</p>
    
  <p>Inscrivez-vous !</p>
    <form method="get" action="serveur.php">
      <div><label for="nom">Votre prénom</label> : <input type="text" name="nom" required></div>
        <br/>
      <div><label for='mail'>adresse mail</label> : <input type = 'mail' name='mail' required></div>
        <br/>
      <div><label for="mdp">Mot de passe</label> : <input type="password" name="mdp" required></div>
        <br/>
      <input type="submit" value="Inscrivez-vous !" />
        <br/>
        <br/>
    </form>
    


</body>
</html>