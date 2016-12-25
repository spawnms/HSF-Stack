<?php
session_start();

session_id($_POST['sid']);

$auswahl = strip_tags($_POST['auswahl']);
$name = strip_tags($_POST['benutzername']);
$postfix = strip_tags($_POST['postfix']);
$anzahl = strip_tags(	$_POST['anzahl']);
$netzwerk = strip_tags($_POST['netzwerk']);
$router = strip_tags($_POST['router']);
$storage = strip_tags($_POST['storage']);
$sid = strip_tags($_POST["sid"]);

$schreiben = "Projekt anlegen:  \nAuswahl: ".$auswahl.", Name: ".$name.", Postfix: ".$postfix.", Anzahl: ".$anzahl.", Netzwerk: ".$netzwerk.", Router: ".$router.", Storage: ".$storage.", SID: ".$sid;

$test = fopen("testdatei.txt",c);
fwrite($test,$schreiben);
fclose($test);

if($auswahl === "Projekt"){
	$output2 = shell_exec("python kursanlegen.py $name $postfix $anzahl $netzwerk $router"); //$storage muss dann noch eingefügt werden
}
session_write_close();
?>