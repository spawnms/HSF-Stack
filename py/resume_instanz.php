<?php
session_start();
require_once("../config/config.php");
$vergleich = "";
$string = "";
//$empfange = strip_tags($_POST['sende']);
$kurs = strip_tags($_POST['kurs']);

if(!empty($kurs)){


$stmt = $pdo->prepare("SELECT projekt_ID FROM kurse where praefix = ?");
$stmt->execute(array($kurs));
$jszuordnung = $stmt->fetchAll(PDO::FETCH_ASSOC);

	shell_exec("/var/www/html/HSF-git/HSF-Stack/py/nova_bash.sh");
	$datei = file_get_contents('/var/www/html/HSF-git/HSF-Stack/py/data.tmp');
    $array = explode(",", $datei);
   for($i = 0;$i < count($array);$i++){
     if(!($i === 0) && !($i === count($array)-1)){
        $ergebnis[$i]['Server_ID'] = trim(explode(":",$array[$i])[0]);
        $ergebnis[$i]['Tenant_ID'] = trim(explode(":",$array[$i])[1]);
        $ergebnis[$i]['Status'] = trim(explode(":",$array[$i])[2]);
    }
    }
   for ($i = 0;$i < count($jszuordnung);$i++){
        for ($j =1;$j<count($ergebnis);$j++){
            if($ergebnis[$j]['Tenant_ID'] == $jszuordnung[$i]['projekt_ID'] && !($ergebnis[$j]['Server_ID'] == $vergleich)){
                $string .= $ergebnis[$j]['Server_ID']." ";
                $vergleich = $ergebnis[$j]['Server_ID'];
            }
        }   
    }

    shell_exec("python resume_instanz.py $string");
	header('Location:../kurs.php');
    session_write_close();
}


?>