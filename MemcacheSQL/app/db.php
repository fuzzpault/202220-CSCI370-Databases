<?php

$pdo = FALSE;

function connect(){
	$dsn = 'mysql:host=localhost;dbname=ticketmaster';
	$username = 'root';
	$password = '';
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
}

$pdo = connect();

$mem  = new Memcached();
      // List memcache servers
$mem->addServer('host.docker.internal',11211);

if($mem->getVersion() === FALSE){
	echo "<h2>Memcache server connection error</h2>";
}

function doQuery($mem, $pdo, $sql){
	$key = base64_encode($sql);
	$ret = $mem->get($key);
	if($ret !== FALSE){

		echo "<h2>Got $key from cache!</h2>";
		return $ret;
	}else{ // not in memcache!!!!!
		$dec = base64_decode($key);
		echo "<h2>Not in cache: $dec</h2>";
		if($pdo === FALSE){
			connect();
		}
		$statement = $pdo->query($sql);
		$ret = $statement->fetchAll();
		$mem->set($key, $ret, 20);
		echo $mem->getResultMessage();
		return $ret;
	}
	
}

?>