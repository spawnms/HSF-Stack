<?php
session_start();
require_once ("../config/config.php");
session_id($_POST['sid']);

$auswahl = strip_tags($_POST['auswahl']);
$kurs = strip_tags($_POST['benutzername']);
$projekt = strip_tags($_POST['postfix']);
$anzahl = strip_tags(	$_POST['anzahl']);
$netzwerk = strip_tags($_POST['netzwerk']);
$router = strip_tags($_POST['router']);
$storage = strip_tags($_POST['storage']);
$sid = strip_tags($_POST["sid"]);

$kurse =array();
$test3 = array();

$projectquery = $pdo->query("SELECT projekt FROM kurse");
$projectdata = $projectquery->fetchALL(PDO::FETCH_ASSOC);

  for ($k = 0;$k<count($projectdata);$k++){
    array_push($test3,$projectdata[$k]['projekt']);
  }
$stmt = $pdo->prepare("INSERT INTO kurse (praefix, projekt, projekt_ID) VALUES (:praefix, :projekt, :projekt_ID)");

if($auswahl === "Projekt"){
	$output2 = shell_exec("python kursanlegen.py $kurs $projekt $anzahl $netzwerk $router"); //$storage muss dann noch eingefügt werden
	$shell2 = shell_exec("python list_project.py");
    $ausgabe = json_decode($shell2);
	/* $ausnahmen sind in der config.php gespeichert */
	for($i = 0; $i < count($ausgabe);$i++){
              if(!(in_array($ausgabe[$i]->Name,$ausnahmen)) && !(in_array($ausgabe[$i]->Name, $test3))){
              
              	  $test2 = array('praefix' => strstr($ausgabe[$i]->Name,"_",true), 'projekt' => $ausgabe[$i]->Name, 'projekt_ID' => $ausgabe[$i]->ID);
    			        $stmt->execute($test2);
                }
              }
}

?>