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
if($action == 'read'){
    $sql = $conn->query("SELECT bestellingen.* , klanten.voornaam, plaatsen.naam FROM bestellingen 
    INNER JOIN klanten ON  bestellingen.klant_id = klanten.id 
    INNER JOIN plaatsen ON bestellingen.plaats_id = plaatsen.id 
    WHERE status = 'checked in';");
    $reserveringen = array();
    while($row = $sql->fetch_assoc()){
        array_push($reserveringen, $row);
    }
    $result['reserveringen'] = $reserveringen;
}
if($action == 'delete'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $sql = $conn->query("DELETE FROM bestellingen WHERE bestelling_id = '$id'");
    if($sql){
        $result['message'] = "reservering is verwijderd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het reservering niet verwijderen";
    }
}

if($action == 'update'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $sql = $conn->query("UPDATE bestellingen SET status = 'checked out' WHERE bestelling_id = '$id'");
    if($sql){
        $result['message'] = "plaats is gewijzigd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het plaats niet wijzigen";
    }
}
if($action == 'checkOutPlaats'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $sql = $conn->query("UPDATE plaatsen SET bezit = 'false' WHERE id = '$id'");
    if($sql){
        $result['message'] = "plaats is gewijzigd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het plaats niet wijzigen";
    }
}

if($action == 'readBestellingen'){
    $sql = $conn->query("SELECT bestellingen.* , klanten.voornaam, plaatsen.naam FROM bestellingen 
    INNER JOIN klanten ON  bestellingen.klant_id = klanten.id 
    INNER JOIN plaatsen ON bestellingen.plaats_id = plaatsen.id 
    WHERE status = 'checked out';");
    $reserveringen = array();
    while($row = $sql->fetch_assoc()){
        array_push($reserveringen, $row);
    }
    $result['reserveringen'] = $reserveringen;
}

$conn -> close();
echo json_encode($result);

?>