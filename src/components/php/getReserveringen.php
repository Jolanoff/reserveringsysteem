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
    $sql = $conn->query("SELECT * FROM bestellingen");
    $plaatsen = array();
    while($row = $sql->fetch_assoc()){
        array_push($plaatsen, $row);
    }
    $result['plaatsen'] = $plaatsen;
}


$conn -> close();
echo json_encode($result);

?>