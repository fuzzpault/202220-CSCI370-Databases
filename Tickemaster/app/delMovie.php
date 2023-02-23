<?php
	include('db.php');

	if(isset($_GET['del_id'])){
		$sql = "DELETE FROM movies WHERE id = ?; ";

		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['del_id']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		if($statement->rowCount() == 0){
			echo "No rows were deleted!";
		}
	}
?>

<html>
<head>
	<title>Delete a Movie</title>
</head>

<body>

	<?php include("menu.html"); ?>
	
	<h1>Delete a movie</h1>

	

<?php
	$sql = "SELECT * FROM movies;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	// https://stackoverflow.com/questions/15111681/reset-cursor-position-in-pdo
	$results = $statement->fetchAll();
	if(count($results) == 0){
		echo "No movies to show";
	}else{
		echo "<table border=\"1\">\n";
		foreach($results as $row){
			echo '<tr>';
			echo '<td>',$row['rating'],"</td>\n";
			echo '<td>',$row['title'],"</td>\n";
			echo '<td>',$row['id'],"</td>\n";
			echo '</tr>';
			//var_dump($row);
		}
		echo '</table>';
	}

	if(count($results) != 0){

		echo '<form method="GET">
			<label>Choose a movie to delete:</label>
			<select name="del_id">';
				
				foreach($results as $row){
					echo "<option value=\"" . $row['id'].
					'">' . $row['title'] . "</option>\n";
				}
				
			  
			echo '</select>
			<input type="submit" value="Delete it!" >
		</form>';
	}
	?>

<?php
	include('views.php');
	
?>
I'm here.
</body>
</html>