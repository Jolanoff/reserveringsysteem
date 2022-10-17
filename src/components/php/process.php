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
    $sql = $conn->query("SELECT * FROM users");
    $users = array();
    while($row = $sql->fetch_assoc()){
        array_push($users, $row);
    }
    $result['users'] = $users;
}

if($action == 'create'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $sql = $conn->query("INSERT INTO users (username , password, role) VALUES('$username','$password','$role')");
    if($sql){
        $result['message'] = "Medewerker is toegevoegd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het medewerker niet toevoegen";

    }
}

if($action == 'update'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = $conn->query("UPDATE users SET username = '$username', password ='$password' WHERE id = '$id'");
    if($sql){
        $result['message'] = "Medewerker is gewijzigd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het medewerker niet wijzigen";

    }
}
if($action == 'delete'){
    $_POST = json_decode(file_get_contents("php://input"), true);
    $id = $_POST['id'];
    $sql = $conn->query("DELETE FROM users WHERE id = '$id'");
    if($sql){
        $result['message'] = "Medewerker is verwijderd";
    }
    else{
        $result['error'] = true;
        $result['message'] = "we kunnen helaas het medewerker niet verwijderen";
    }
}



$conn -> close();
echo json_encode($result);


?>