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
if($action == 'read_bb'){
    $sql = $conn->query("SELECT plaatsen.naam, plaatsen.soort_id, plaatsen.bezit, soort_plaatsen.soort_id ,soort_plaatsen.soort, soort_plaatsen.prijs FROM plaatsen 
    INNER JOIN soort_plaatsen 
    WHERE plaatsen.soort_id = soort_plaatsen.soort_id AND plaatsen.bezit = 'false'");
    $plaatsen = array();
    while($row = $sql->fetch_assoc()){
        array_push($plaatsen, $row);
    }
    $result['plaatsen'] = $plaatsen;
}
// SELECT klanten.id FROM klanten WHERE klanten.achternaam = 'Abou Zid';

$conn -> close();
echo json_encode($result);

?>