<?php
// Increase the viewcount by 1
	$sql = "UPDATE visit SET viewCount = viewCount + 1 WHERE url = ?;";

	$statement = $pdo->prepare($sql);
	$statement->bindValue(1, $_SERVER['SCRIPT_NAME']);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	if($statement->rowCount() == 0){
		echo $_SERVER['SCRIPT_NAME'] . " not in DB.";
	}

	// Now get the current view count
	$sql = "SELECT viewCount FROM visit WHERE url = ?;";

	$statement = $pdo->prepare($sql);
	$statement->bindValue(1, $_SERVER['SCRIPT_NAME']);
	try{
		$ret = $statement->execute();
	}catch(Exception $e){
		echo "Error:", $e;
	}
	if($statement->rowCount() == 0){
		echo $_SERVER['SCRIPT_NAME'] . " not in DB.";
	}else{
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		echo "<h3>Page Views: " . $row['viewCount'] . "</h3><br>\n";
	}

?>