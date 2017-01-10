<?php
session_start();
require_once ("../config/config.php");
//session_id($_POST['sid']);

$kurs = strip_tags($_POST['kurs']);
$sid = strip_tags($_POST["sid"]);
$string = "";
$string2 = "";
$string3 = "";
//$schreiben = "Projekt-ID: ".$kurs.", SID: ".$sid;

// $test = fopen("testdatei.txt",c);
// fwrite($test,$schreiben);
// fclose($test);

	$abfrage = $pdo->prepare("SELECT projekt,projekt_ID,netzwerk_ID, subnet_ID FROM kurse WHERE praefix = ?");
    $abfrage->execute(array($kurs));
    $id = $abfrage->fetchALL(PDO::FETCH_ASSOC);

	for($i=0;$i<count($id);$i++){
      $string .= $id[$i]['projekt_ID']." ";
      $string2 .= $id[$i]['netzwerk_ID']." ";
      $string3 .= $id[$i]['projekt']." ";
  }



	shell_exec("python remove_router.py $string3");
	shell_exec("python remove_network.py $string2");
	shell_exec("python remove_course.py $string"); //$storage muss dann noch eingefügt werden


	$stmt = $pdo->prepare("DELETE FROM kurse WHERE praefix = ?");
	$stmt->execute(array($kurs));

	header("Location:../kurs.php");

	session_write_close();
?>