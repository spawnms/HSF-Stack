<?php
session_start();

session_id($_POST['sid']);

$auswahl = strip_tags($_POST['auswahl']);
$name = strip_tags($_POST['benutzername']);
$password = strip_tags($_POST["benutzerpasswd"]);
$description = strip_tags($_POST["beschreibung"]);
$projekt = strip_tags($_POST["projekt"]);
$sid = strip_tags($_POST["sid"]);

/*
$schreiben = "Auswahl: ".$auswahl.", Name: ".$name.", Passwort: ".$password."Beschreibung: ".$description.", Projekt: ".$projekt.", SID: ".$sid;

$test = fopen("testdatei.txt",c);
fwrite($test,$schreiben);
fclose($test);
*/

if($auswahl === "Benutzer"){
	$output2 = shell_exec("python createuser.py $name $password $description $projekt");
}
?>