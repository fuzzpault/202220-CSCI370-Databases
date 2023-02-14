<html>
<head>
	<title>It works!</title>
</head>

<body>

<?php include("menu.html"); ?>

<?php
	include('db.php');

	$sql = "SELECT * FROM movies;";

	$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	echo "<table border=\"1\">\n";
	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		echo '<tr>';
		echo '<td>',$row['rating'],"</td>\n";
		echo '<td>',$row['title'],"</td>\n";
		echo '<td>',$row['id'],"</td>\n";
		echo '</tr>';
		//var_dump($row);
	}
	echo '</table>';
?>

<h1>it works</h1>
</body>
</html>