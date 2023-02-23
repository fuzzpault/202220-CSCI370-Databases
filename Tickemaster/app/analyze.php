<html>
<head>
	<title>It works!</title>
</head>

<body>

<?php include("menu.html"); ?>

<?php
	include('db.php');

	// Check to see if they clicked on a sort column.
	// This is INSECURE as the get parameter is directly sent to
	// the database, so SQL injection attacks are possible.
	$statement = 0;
	if(isset($_GET['col']) && isset($_GET['order'])){
		$sql = "SELECT * FROM movies ORDER BY " . $_GET['col']; 
		if($_GET['order'] == 'r'){
			$sql = $sql . " DESC";
		}
		$sql .= ";";
	}else{
		$sql = "SELECT * FROM movies;";
	}

	$statement = $pdo->prepare($sql);
	$ret = $statement->execute();
	echo $sql;
	
	try{
		//$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	echo "<table border=\"1\">\n";
	echo '<tr>';
	// This puts the up and down arrows, with HTML anchors/links
	// that specify GET parameters to sort the column, and
	// if it is normal or reverse sort.
	echo '<th>ID <a href="?col=id&order=n">&uarr;</a>
			 <a href="?col=id&order=r">&#8595;</a>  </th>';
	echo '<th>Rating <a href="?col=rating&order=n">&uarr;</a>
			 <a href="?col=rating&order=r">&#8595;</a>  </th>';
	echo "<th>Title</th>\n";
	echo "<th>Views</th>\n";
	echo "<th>Director</th>\n";
	echo '</tr>';
	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		echo '<tr>';
		echo '<td>',$row['id'],"</td>\n";
		echo '<td>',$row['rating'],"</td>\n";
		echo '<td>',$row['title'],"</td>\n";
		echo '<td>',$row['views'],"</td>\n";
		echo '<td>',$row['director'],"</td>\n";
		echo '</tr>';
		//var_dump($row);
	}
	echo '</table>';
?>

<?php
	include('views.php');
	
?>

</body>
</html>