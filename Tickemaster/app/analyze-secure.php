<html>
<head>
	<title>It works!</title>
</head>

<body>

<?php include("menu.html"); ?>

<?php
	include('db.php');

	// Check to see if they clicked on a sort column.
	// The bindValue doesn't work for table names or database names.
	// See https://stackoverflow.com/questions/182287/can-php-pdo-statements-accept-the-table-or-column-name-as-parameter
	// Below we verify the input to prevent injectino attacks
	$cols = array('id','title','rating','views','director');
	if(isset($_GET['col']) && isset($_GET['order'])){
		// Verify their column specified matches the options.
		
		if(in_array($_GET['col'], $cols)){
			$table = $_GET['col'];
		}else{
			$table = 'id';
		}
		$sql = "SELECT * FROM movies ORDER BY $table "; 
		if($_GET['order'] == 'r'){
			$sql = $sql . " DESC";
		}
		$sql .= ";";
		$statement = $pdo->prepare($sql);
		$ret = $statement->execute();
	}else{
		$sql = "SELECT * FROM movies;";
		
	}

	$statement = $pdo->prepare($sql);
	
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
		// This puts the up and down arrows, with HTML anchors/links
		// that specify GET parameters to sort the column, and
		// if it is normal or reverse sort.
		// Sneaky way to generate column headers and data
		// based on the database query, not hardcoded columns!
		// Note the order of the columns isn't specified.
		// This also may break the sorting due to the input validation
		// above.  Arrows will get generated, but it may not accept
		// that column name.
		foreach ($row as $key => $value) {
			echo "<th>$key<a href=\"?col=$key&order=n\">&uarr;</a>
				 <a href=\"?col=$key&order=r\">&#8595;</a>  </th>";
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
	}else{
		echo "<h2>No data in the table</h2>";
	}
?>

</body>
</html>