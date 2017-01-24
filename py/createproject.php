<?php
session_start();
require_once ("../config/config.php");
//session_id($_POST['sid']);

$auswahl = strip_tags($_POST['auswahl']);
$kurs = strip_tags($_POST['kurs']);
$projekt = strip_tags($_POST['postfix']);
$anzahl = strip_tags(	$_POST['anzahl']);
$netzwerk = strip_tags($_POST['netzwerk']);
$sid = strip_tags($_POST["sid"]);
$netzwerkid = "";
$kurse =array();
$projekte = array();
$netzwerkausgabe = array();


$schreiben = "Auswahl: ".$auswahl.", Name: ".$kurs.", Projekt: ".$projekt.", Netzwerk: ".$netzwerk.", SID: ".$sid;

$test = fopen("createproject.log","c");
fwrite($test,$schreiben);
fclose($test);


$projectquery = $pdo->query("SELECT projekt FROM kurse");
$projectdata = $projectquery->fetchALL(PDO::FETCH_ASSOC);


  for ($k = 0;$k<count($projectdata);$k++){
    array_push($projekte,$projectdata[$k]['projekt']);
  }

  /*#############################################################################################*/
  $stmt = $pdo->prepare("INSERT INTO kurse (praefix, projekt, projekt_ID, netzwerk_ID, subnet_ID, router_name) VALUES (:praefix, :projekt, :projekt_ID, :netzwerk_ID, :subnet_ID, :router_name)");
  if($auswahl === "Kurs"){
    $output2 = shell_exec("python kursanlegen.py $kurs $projekt $anzahl $netzwerk"); //$storage muss dann noch eingefügt werden
    $shell2 = shell_exec("python list_project.py");
    $ausgabe = json_decode($shell2);
  /* $ausnahmen sind in der config.php gespeichert */
  for($i = 0; $i < count($ausgabe);$i++){
              if(!(in_array($ausgabe[$i]->Name,$ausnahmen)) && !(in_array($ausgabe[$i]->Name, $projekte))){
                $praefixdb = strstr($ausgabe[$i]->Name,"_",true);
                $stmt->bindParam(":praefix",$praefixdb,PDO::PARAM_STR);
                $stmt->bindParam(":projekt",$ausgabe[$i]->Name,PDO::PARAM_STR);
                $stmt->bindParam(":projekt_ID",$ausgabe[$i]->ID,PDO::PARAM_STR);

                if ($netzwerk === "true"){
                    $tenant = $ausgabe[$i]->ID;
                    $pname = $ausgabe[$i]->Name;
                    shell_exec("python create_network.py $tenant $pname");
                    shell_exec("python create_subnet.py $tenant $pname");
                    $netzwerkshell = shell_exec("python network_list.py");
                    $netzwerkausgabe = json_decode($netzwerkshell);
            
                    shell_exec("python create_router.py $tenant $pname");
                    $routerdb = $ausgabe[$i]->Name."-Router";
                  }
                for($j = 0; $j < count($netzwerkausgabe);$j++){
                    if($netzwerkausgabe[$j]->name === $ausgabe[$i]->Name){
                      $stmt->bindParam(":netzwerk_ID", $netzwerkausgabe[$j]->id,PDO::PARAM_STR);
                      $stmt->bindParam(":subnet_ID", $netzwerkausgabe[$i]->subnets,PDO::PARAM_STR);
                      $stmt->bindParam(":router_name",$routerdb,PDO::PARAM_STR);
                      $stmt->execute();
                      }
                    } 
                   }

                //$test2 = array('praefix' => strstr($ausgabe[$i]->Name,"_",true), 'projekt' => $ausgabe[$i]->Name, 'projekt_ID' => $ausgabe[$i]->ID, 'netzwerk_ID' => $netzwerkid);
                  //$stmt->execute();

                }
  }

session_write_close();
?>