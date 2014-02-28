<?php
/*
* OneTimePaste
*
* @author Alberto Gonzalez Iniesta
* @copyright 2014 Alberto Gonzalez Iniesta <agi@inittab.org>
*
*     This program is free software: you can redistribute it and/or modify
*     it under the terms of the GNU General Public License as published by
*     the Free Software Foundation, either version 3 of the License, or
*     (at your option) any later version.
*
*     This program is distributed in the hope that it will be useful,
*     but WITHOUT ANY WARRANTY; without even the implied warranty of
*     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*     GNU General Public License for more details.
*
*     You should have received a copy of the GNU General Public License
*     along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
*/
include "config.php";
# Do not use cookies
ini_set("session.use_cookies",0);
ini_set("session.use_only_cookies",0);
include "templates/head.php";

if(isset($_GET["id"]) && strlen($_GET["id"]) > 0) {
	include "recover_msg.php";
} elseif (isset($_POST["message"])) {
	# Check session to avoid spaming the DB
	ini_set("session.use_trans_sid",0); # Disallow sending php_session_id via request
	session_start();
	$_SESSION['count'] += 1; # Increase session counter

	if (isset($_SESSION['count']) && $_SESSION['count'] > 1) {
		include "templates/save_foot.php";
	} else {
		include "save_msg.php";
	}
} else {
	# Start session to control multiple posts
	ini_set("session.use_trans_sid",1); # Allow sending php_session_id via request
	session_start();
	$_SESSION['count'] = 0; # Init session counter

	include "enter_msg.php";
}

include "templates/foot.php";
?>
