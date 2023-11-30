<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"> 
	
    <link rel="stylesheet" type="text/css" href="css/jeu.css">
	
    <title>mon super jeu</title>
  </head>
  
  <body>
  <p>
    <?php
	$host="localhost";
	$usernom="id21586644_admin";
	$password="Ploup12345#";
	$dbnom="id21586644_ploup";
	
	$conn=mysqli_connect($host, $usernom, $password, $dbnom);
	if(mysqli_connect_errno())
		echo "connection could not established...".mysqli_connect_error();
	else
	{
		echo "Successfully connected... <br>";
		if (isset($_GET['nom']) && isset($_GET['mail'])){	
			$nom = $_GET['nom'];
			$mail = $_GET['mail'];
			$query = "INSERT INTO classement VALUES (?, ?)";
			$result = mysqli_execute_query($conn, $query, [$nom, $mail]);
		}
		$query = "SELECT * FROM classement ORDER BY mail DESC";
		$result = mysqli_execute_query($conn, $query);
	?>	
		<table>
		<thead>
		  <tr>
			<th>nom</th>
			<th>mail</th>
		  </tr>
		</thead>
		<tbody>
		<?php foreach ($result as $row){ ?>
		    <tr>
			    <td><?php echo $row['nom'];?></td>
				<td><?php echo $row['mail'];?></td>
			</tr>
		<?php } ?>
		</tbody>
		</table>
	<?php } ?>

 </p>
  
  </body>
</html>
