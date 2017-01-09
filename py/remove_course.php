<?php
session_start();
require_once ("../config/config.php");
//session_id($_POST['sid']);

$kurs = strip_tags($_POST['kurs']);
$sid = strip_tags($_POST["sid"]);
$string = "";
$string2 = "";
//$schreiben = "Projekt-ID: ".$kurs.", SID: ".$sid;

// $test = fopen("testdatei.txt",c);
// fwrite($test,$schreiben);
// fclose($test);

	$abfrage = $pdo->prepare("SELECT projekt_ID,netzwerk_ID FROM kurse WHERE praefix = ?");
    $abfrage->execute(array($kurs));
    $id = $abfrage->fetchALL(PDO::FETCH_ASSOC);

	for($i=0;$i<count($id);$i++){
      $string .= $id[$i]['projekt_ID']." ";
      $string2 .= $id[$i]['netzwerk_ID']." ";
  }



	shell_exec("python remove_course.py $string"); //$storage muss dann noch eingefügt werden
	shell_exec("python remove_network.py $string2");

	$stmt = $pdo->prepare("DELETE FROM kurse WHERE praefix = ?");
	$stmt->execute(array($kurs));

	header("Location:../kurs.php");

	session_write_close();
?>