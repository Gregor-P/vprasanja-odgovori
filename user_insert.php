<?php
include_once './session.php';
include_once './database.php';

$username = $_POST['username'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

//preverim. če je uporabnik pravilno izpolnil obrazec
if (!empty($username) && !empty($email)
        && !empty($pass1) && ($pass1==$pass2)) {
    //vse ok
    $pass = $salt.$pass1;
    $pass = sha1($pass);
    
    $query1 = "SELECT * FROM users WHERE (email='$email')";
    $result = mysqli_query($link, $query1);
    if(mysqli_num_rows($result) <= 0){
        $stmt = $link->prepare("INSERT INTO users (username,name,last_name,email,pass) "
                             . "VALUES (?,?,?,?,?);");
        $stmt->bind_param("sssss", $username, $name, $last_name, $email, $pass);
        $stmt->execute();
    }
    else{
        header("Location: registration.php?error=1");
    }
    
}
else {
    //preusmeritev nazaj
    header("Location: registration.php");
}

header("Location: login.php");

?>