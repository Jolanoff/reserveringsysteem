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


$conn -> close();
echo json_encode($result);

?>