<?php
session_start();

require_once("../config/config.php");


$kurs = strip_tags($_POST['']);

$kurs = $pdo->prepare("select projekt_ID from kurse where projekte = ? ");
$kurs->execute(array($kurs));
$tenant = $kurs->fetchAll(PDO::FETCH_ASSOC);

 shell_exec('py/nova_bash.sh');
    $datei = file_get_contents('py/data.tmp');
    $array = explode(",", $datei);
    for($i = 0;$i < count($array);$i++){
     if(!($i === 0) && !($i === count($array)-1)){
        $ergebnis[$i]['Server_ID'] = trim(explode(":",$array[$i])[0]);
        $ergebnis[$i]['Tenant_ID'] = trim(explode(":",$array[$i])[1]);
        $ergebnis[$i]['Status'] = trim(explode(":",$array[$i])[2]);
    }
    }




?>