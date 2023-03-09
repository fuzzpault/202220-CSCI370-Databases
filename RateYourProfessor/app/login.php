<?php
	session_start();
	include('db.php');
?>
<html>
<head>
	<title>Login</title>
</head>

<body>



<?php
	$message = "";
	$error = "";

	// Do they want to log out?
	if(isset($_GET['logout'])){
		session_unset();
	}
	
	// Do they want to log in?
	if(isset($_GET['email']) && isset($_GET['password'])){
		$sql = "SELECT * FROM student WHERE email = ?;";
		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['email']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		if($row){
			if($row['password'] == $_GET['password']){
				$message .= "Welcome back";
				$_SESSION['email'] = $_GET['email'];
				$_SESSION['id'] = $row['id'];
			}else{
				$error .= "Password incorrect";
			}
		}else{
			$error .= "Email not found";
		}
	}

	// New account
	if(isset($_GET['new_email']) && isset($_GET['new_password'])){
		$sql = "INSERT INTO student (email,password) VALUES (?,?);";
		$statement = $pdo->prepare($sql);
		$statement->bindValue(1, $_GET['new_email']);
		$statement->bindValue(2, $_GET['new_password']);
		try{
			$ret = $statement->execute();
		}catch(Exception $e){
			echo "Error:", $e;
		}
		$row = $statement->rowCount();
		if($row){
			$message .= "User added!";
		}else{
			$error .= "Something went wrong.";
		}
	}
?>

<?php include("menu.php"); ?>

<?php
	if($error != ''){
		echo '<h2 style="color:red">' . $error . "</h2>";
	}
	if($message != ''){
		echo '<h2>' . $message . "</h2>";
	}
?>
<h1>Please login:</h1>

<form method="GET">
	<label>Email:</label><input type="text" name="email"><br>
	<label>Password:</label><input type="password" name="password"><br>
	<input type="submit" value="Log In">
</form>

<hr>
<h2>New User</h2>
<form method="GET">
	<label>Email:</label><input type="text" name="new_email"><br>
	<label>Password:</label><input type="password" name="new_password"><br>
	<input type="submit" value="Create account">
</form>

</body>
</html>