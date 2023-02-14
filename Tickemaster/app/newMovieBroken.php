<?php
	include('db.php');

	if(isset($_GET['title']) && isset($_GET['rating'])){
		$sql = "INSERT INTO movies (title, rating) ".
		"VALUES (\"" . $_GET['title'] . "\",\"" .
		$_GET['rating'] . "\");";

		echo $sql;
		$statement = $pdo->prepare($sql);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
	}
?>

<html>
<head>
	<title>New Movie</title>
</head>

<body>

	<?php include("menu.html"); ?>
	
	<form method="GET">
		<label>Title:</label><input type="text" name="title"><br>
		<label>Rating:</label><input type="text" name="rating"><br>
		<input type="submit" value="Add it!" >
	</form>

<?php
	

	$sql = "SELECT COUNT(*) FROM movies;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}

	$row = $statement->fetch();
	echo "There are ", $row[0], " rows in the table";
?>


</body>
</html>