<?php
session_start();

session_id($_POST['sid']);

$tenant = strip_tags($_POST['id']);
$sid = strip_tags($_POST["sid"]);

$schreiben = "Projekt-ID: ".$tenant.", SID: ".$sid;

$test = fopen("testdatei.txt",c);
fwrite($test,$schreiben);
fclose($test);

	$output2 = shell_exec("python remove_user_id.py $tenant"); //$storage muss dann noch eingefügt werden

	session_write_close();
?>