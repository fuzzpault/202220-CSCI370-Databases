<?php
	include('db.php');

	// SQL injection example
	// The query below is vulnerable to SQL injection
	// attacks.

	// Here is an example title input that will drop a table:
	// a","a");DROP TABLE movies;

	// See newMovie.php for the fix - use bindValue!
	
	if(isset($_GET['title']) && isset($_GET['rating'])){
		$title = $_GET['title'];
		$additions = ['the','database','jedi','panda','die','hard','christmas','movie','scary','love','the sequel','the SQL'];
		$rating = ['G','PG','PG-13','R','NC-17'];
		for($i = 0; $i < $_GET['numentries']; $i++){
			$ndx = rand(0,count($additions) - 1);
			$ndx1 = rand(0,count($additions) - 1);
			$ndx2 = rand(0,count($additions) - 1);
			$ndx3 = rand(0,count($additions) - 1);
			$rndx = rand(0,count($rating) - 1);
			$newtitle = $title . "_" . $additions[$ndx] . "_" . $additions[$ndx1] . "_" . $additions[$ndx2] . "_" . $additions[$ndx3];

			$sql = "INSERT INTO movies (title, rating) ".
			"VALUES (\"" . $newtitle . "\",\"" .
			$rating[$rndx] . "\");";

			echo $sql;
			echo "<br>";
			$statement = $pdo->prepare($sql);
			try{
				$ret = $statement->execute();
			}catch(Exception $e){
				echo "Error:", $e;
			}
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
		<label>Num entries:</label><input type="number" name="numentries"><br>
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