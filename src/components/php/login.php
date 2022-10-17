<?php
error_reporting(0);
ini_set('display_errors', 0);

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'reserveringdb';
$conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
$result = array('error' => false);
$_POST = json_decode(file_get_contents("php://input"), true);
$username = $_POST['username'];  
$password = $_POST['password'];  
    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($conn, $username);  
    $password = mysqli_real_escape_string($conn, $password);  
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
 
    if($count == 1){ 
        echo json_encode(array(
            'username' => $row["username"],
            'password'  => $row["password"],
            'role'  => $row["role"],
        ));
    }  
    else{  
        echo "<h1> Login failed. Invalid username or password.</h1>";  
        
    }     


    $conn -> close();

   



    
?>

