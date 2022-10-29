<?php
error_reporting(0);
ini_set('display_errors', 0);

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'reserveringdb';
$conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
$result = array('error' => false);
$action = '';
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
if($action == 'getKlantID'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $achternaam = $_POST['achternaam'];
    $sql = $conn->query("SELECT klanten.id FROM klanten WHERE klanten.achternaam = '$achternaam'");
    $klanten = array();
    while($row = $sql->fetch_assoc()){
        array_push($klanten, $row);
    }
    $result['klanten'] = $klanten;
}
if($action == 'getPlekkenID'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $plekNaam = $_POST['naam'];
    $sql = $conn->query("SELECT plaatsen.id, soort_plaatsen.prijs FROM plaatsen INNER JOIN soort_plaatsen WHERE plaatsen.soort_id = soort_plaatsen.soort_id AND plaatsen.naam = '$plekNaam'"); 
    $plekken = array();
    while($row = $sql->fetch_assoc()){
        array_push($plekken, $row);
    }
    $result['plekken'] = $plekken;
}

if($action == 'create'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $checkIn = $_POST['checkin'];
    $checkOut = $_POST['checkout'];
    $plaats = $_POST['plaats_id'];
    $sql1 = $conn->query("SELECT * FROM bestellingen WHERE '$checkIn' BETWEEN checkin AND checkout AND plaats_id = '$plaats'");
    $bestelling = array();
    while($row = $sql1->fetch_assoc()){
        array_push($bestelling, $row);
    }
        if (sizeof($bestelling) > 0) {
            $result['best'] = "het is vol";
        }
        else {
            $klant = $_POST['klant_id'];
            $plaats = $_POST['plaats_id'];
            $checkIn = $_POST['checkin'];
            $dagen = $_POST['dagen'];
            $volwassenen = $_POST['volwassenen'];
            $kinderen12 = $_POST['kinderen12'];
            $kinderen4 = $_POST['kinderen4'];
            $hond = $_POST['hond'];
            $elektriciteit = $_POST['elektriciteit'];
            $bezoekers = $_POST['bezoekers'];
            $douche = $_POST['douche'];
            $wasmachine = $_POST['wasmachine'];
            $wasdroger = $_POST['wasdroger'];
            $auto = $_POST['auto'];
            $kosten = $_POST['kosten'];
            
            $sql = $conn->query("INSERT INTO bestellingen ( klant_id, plaats_id, checkin, checkout, dagen, volwassenen, kinderen12, kinderen4, hond, elektriciteit, bezoekers, douche, wasmachine, wasdroger, auto, kosten , status) VALUES
            ( '$klant', '$plaats', '$checkIn','$checkOut' , '$dagen', '$volwassenen', '$kinderen12', '$kinderen4', '$hond', '$elektriciteit', '$bezoekers', '$douche', '$wasmachine', '$wasdroger', '$auto', '$kosten' , 'checked in')");
            if($sql){
                $result['message'] = "Klant is toegevoegd";
            }
            else{
                $result['error'] = true;
                $result['message'] = "we kunnen helaas het klant niet toevoegen";
        
            }
        }
}
if($action == 'checkPlek'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $checkIn = $_POST['checkin'];
    $checkOut = $_POST['checkout'];
    $plaats = $_POST['plaats_id'];
    $sql1 = $conn->query("SELECT * FROM bestellingen WHERE '$checkIn' BETWEEN checkin AND checkout AND plaats_id = '$plaats'");
    $bestelling = array();
    while($row = $sql1->fetch_assoc()){
        array_push($bestelling, $row);
    }
        if (sizeof($bestelling) > 0) {
            $result['plek'] = "het is vol";
        }
        else{
             $result['plek'] = "plek beshickbaar";
        }
}

 /*    if($action == 'plaatsBezitten'){
        $_POST = json_decode(file_get_contents("php://input"), true);
        $id = $_POST['id'];
        $startDate =  $_POST['startDate']; 
        $endDate =  $_POST['endDate']; 
        $result['message'] = "asdasd";
        $sql = $conn->query("SELECT * FROM plaatsen WHERE id = '$id' ");
        while($row = $sql->fetch_assoc()){
            $date = $row["date"]; 
            array_push($date,  ',{ "startDate":"'.$startDate '"endDate":"' .$endDate '"}');
            $sql1 = $conn->query("UPDATE plaatsen SET date = '$date' WHERE id = '$id'");
        }
            
   
    }
   */

      /*   $sql = $conn->query("UPDATE plaatsen SET bezit = 'true' WHERE id = '$id'");
        if($sql){
            $result['message'] = "plaats is gewijzigd";
        }
        else{
            $result['error'] = true;
            $result['message'] = "we kunnen helaas het plaats niet wijzigen";
        }
    } */
    
  

$conn -> close();
echo json_encode($result);

?>