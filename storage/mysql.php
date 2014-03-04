<?php
# php > 5.1
# Must provide: read_msg, save_msg and purge_old

include_once "$backend.config.php";

function db_connect() {
	global $mysql_host, $mysql_db, $mysql_user, $mysql_pass;
	return new PDO("mysql:host=$mysql_host;dbname=$mysql_db", $mysql_user, $mysql_pass, array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function delete_msg($id='') {
	try {
		$dbh = db_connect();
		$sth = $dbh->prepare('DELETE FROM pastes WHERE id=:id');
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->execute();
	} catch (PDOException $e) {
		#print  "<div class=\"error\">Message deletion failed</div>";
		return false;
	}
	return True;
}

function save_msg($message='',$id='') {
	try {
		$dbh = db_connect();
		$sth = $dbh->prepare('INSERT INTO pastes (id, message, time) VALUES (:id, :message, NOW())');
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->bindParam(':message', $message, PDO::PARAM_STR);
		$sth->execute();
	} catch (PDOException $e) {
		#print  "<div class=\"error\">Message storage failed</div>";
		return false;
	}
	return True;
}

function read_msg($id='') {
	try {
		$dbh = db_connect();
		$sth = $dbh->prepare('SELECT id, message, time FROM pastes WHERE id=:id');
		$sth->bindParam(':id', $id, PDO::PARAM_STR);
		$sth->execute();

		if($sth->rowCount() == 1) {
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			delete_msg($id);
			return $result["message"];
		} else{
			return false;
		}
	} catch (PDOException $e) {
		#print  "<div class=\"error\">Message storage failed</div>";
		return false;
	}
}

function purge_old() {
	global $hours_expire;
	try {
		$dbh = db_connect();
		$sth = $dbh->prepare('DELETE FROM pastes WHERE time < (NOW() - INTERVAL :hours HOUR)');
		$sth->bindParam(':hours', $hours_expire, PDO::PARAM_INT);
		$sth->execute();
	} catch (PDOException $e) {
		print  "<div class=\"error\">Message deletion failed</div>";
		return false;
	}
	return True;
}
?>
