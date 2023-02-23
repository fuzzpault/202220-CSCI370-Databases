<html>
<head>
	<title>Search Viewings</title>
</head>

<body>

<?php include("menu.html"); ?>

<form method="GET">
<label>Search Movie Title:</label>
<input type="text" name="title">
<input type="submit" value="Search">
</form>

<?php
	include('db.php');


	if(isset($_GET['title'])){
		$sql = "SELECT * FROM showing
			JOIN movies ON showing.movieId = movies.id
			JOIN venue ON showing.venueID = venue.id
			WHERE movies.title LIKE ?;"; 
		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, "%" . $_GET['title'] . "%");
		$ret = $statement->execute();
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		// To print the headers, attampt to get the first row
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		if($row){
			echo "<table border=\"1\">\n";
			echo '<tr>';
			foreach ($row as $key => $value) {
				echo "<th>$key</th>";
			}
			echo '</tr>';
			while($row){
				echo '<tr>';
				foreach ($row as $key => $value) {
					echo "<td>$value</td>";
				}
				echo '</tr>';
				// Get the next row for the next loop, if there is more data.
				$row = $statement->fetch(PDO::FETCH_ASSOC);
			}
			echo '</table>';
		}
	}else{
		echo "No search given";
		
	}

	
?>

<?php
	include('views.php');
	
?>

</body>
</html>