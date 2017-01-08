<?php
session_start();
require_once ("../config/config.php");
session_id($_POST['sid']);

$tenant = strip_tags($_POST['id']);
$sid = strip_tags($_POST["sid"]);

	$output2 = shell_exec("python remove_project_id.py $tenant"); //$storage muss dann noch eingefügt werden

	$stmt = $pdo->prepare("DELETE FROM kurse WHERE projekt_ID = ?");
	$stmt->execute(array($tenant));

	header("Location:../kurs.php");
	
	session_write_close();
?>