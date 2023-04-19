<?php
	session_start();
?>
<html>
<head>
	<title>Movies</title>
</head>

<body>

<?php include("menu.php"); ?>

<?php
	include('db.php');

	$sql = "SELECT * FROM movies;";

	$ret = doQuery($mem, $pdo, $sql);
	print($ret);
	/*$statement = $pdo->prepare($sql);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	*/
	echo "<table border=\"1\">\n";
	foreach($ret as $row){
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

<?php
	include('views.php');
	
?>

</body>
</html>