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
    $sql = $conn->query("SELECT * FROM klanten");
    $klanten = array();
    while($row = $sql->fetch_assoc()){
        array_push($klanten, $row);
    }
    $result['klanten'] = $klanten;
}

if($action == 'create'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $adres = $_POST['adres'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $telefoonNum = $_POST['telefoonNum'];
    
    $sql = $conn->query("INSERT INTO klanten (voornaam, achternaam, adres, postcode, email, telefoonNum) VALUES ('$voornaam', '$achternaam', '$adres', '$postcode', '$email', '$telefoonNum');");
    if($sql){
        $result['message'] = "Klant is toegevoegd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het klant niet toevoegen";

    }
}
if($action == 'delete'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $sql = $conn->query("DELETE FROM klanten WHERE id = '$id'");
    if($sql){
        $result['message'] = "klant is verwijderd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het klant niet verwijderen";
    }
}
if($action == 'update'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $adres = $_POST['adres'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $telefoonNum = $_POST['telefoonNum'];
    
    $sql = $conn->query("UPDATE klanten SET voornaam = '$voornaam', achternaam ='$achternaam', adres= '$adres' , postcode = '$postcode', email ='$email', telefoonNum = '$telefoonNum' WHERE id = '$id'");
    if($sql){
        $result['message'] = "Klant is gewijzigd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het klant niet wijzigen";

    }
}


$conn -> close();
echo json_encode($result);

?>