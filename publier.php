<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"> 
	
    <link rel="stylesheet" type="text/css" href="css/jeu.css">
	
    <title>SocialNexa</title>
  </head>
  
  <body>
  <p>
    <?php
	$host="localhost";
	$userposte="id21586644_admin";
	$password="Ploup12345#";
	$dbposte="id21586644_ploup";
	
	$conn=mysqli_connect($host, $userposte, $password, $dbposte);
	if(mysqli_connect_errno())
		echo "connection could not established...".mysqli_connect_error();
	else
	{
		if (isset($_GET['poste']) && isset($_GET['mail'])){	
			$poste = $_GET['poste'];
			$mail = $_GET['mail'];
			$query = "INSERT INTO compte VALUES (?, ?)";
			$result = mysqli_execute_query($conn, $query, [$poste, $mail]);
		}
		$query = "SELECT * FROM compte ORDER BY mail DESC";
		$result = mysqli_execute_query($conn, $query);
	?>	
		<table>
		<thead>
		  <tr>
			<th>poste</th>
			<th>mail</th>
		  </tr>
		</thead>
		<tbody>
		<?php foreach ($result as $row){ ?>
		    <tr>
			    <td><?php echo $row['poste'];?></td>
				<td><?php echo $row['mail'];?></td>
			</tr>
		<?php } ?>
		</tbody>
		</table>
	<?php } ?>

 </p>
  
  </body>
</html>