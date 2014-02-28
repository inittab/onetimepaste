<?php
# php > 5.1
# Must provide: read_msg, save_msg and purge_old

include_once "$backend.config.php";

function db_connect() {
	global $mysql_host, $mysql_db, $mysql_user, $mysql_pass;
	return new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user, $mysql_pass, array(PDO::ATTR_PERSISTENT => true));
}

function read_msg($id) {
	$dbh = db_connect();
	$sth = $dbh->prepare('SELECT id, message, time FROM pastes
                      WHERE id=:id');
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->execute();

	if($sth->rowCount() == 1) {
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$message = $result["message"];
		#$time=$result["time"];
		$sth = $dbh->prepare('DELETE FROM pastes WHERE id=:id');
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->execute();
		$error=$sth->errorInfo();
		if($error[0] != "00000") {
			## TODO error handling
			print "ewwwww";
			return False;
		}
		return $message;
	} else {
		return False;
	}
}

function save_msg($message,$id) {
	$dbh = db_connect();
	$sth = $dbh->prepare('INSERT INTO pastes (id, message, time) 
                    VALUES (:id, :message, NOW())');
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->bindParam(':message', $message, PDO::PARAM_STR);
	# insert it!
	$sth->execute();

	## TODO error handling
	$error=$sth->errorInfo();
	if($error[0] == "00000") {
		return True;
	} else {
		return False;
	}
}

function purge_old() {
	global $hours_expire;
	$dbh = db_connect();
	$sth = $dbh->prepare('DELETE FROM pastes WHERE time < (NOW() - INTERVAL :hours HOUR)');
	$sth->bindParam(':hours', $hours_expire, PDO::PARAM_INT);
	$sth->execute();
	$error=$sth->errorInfo();
	if($error[0] != "00000") {
		## TODO error handling
		print "ewwwww";
		return False;
	}
	return True;
}
?>
