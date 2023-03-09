
<table width="100%">
	<tr>
<td><a href="index.php">Home</a> </td>
<td><a href="analyze.php">Analyze</a></td>
<td><a href="newMovie.php">Add a movie</a></td>
<td><a href="newMovieBroken.php">Add a movie BROKEN</a></td>
<td><?php
	if(isset($_SESSION['email'])){
		echo '<a href="login.php?logout=t">Logout</a>';
		echo $_SESSION['email'];
	}else{
		echo '<a href="login.php">Login</a>';
	}

?></td>

<td><a href="viewings.php">Search for a movie viewing</a></td>
</tr></table>

