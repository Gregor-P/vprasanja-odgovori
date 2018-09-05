<?php

include_once './session.php';
include_once './database.php';

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$email = $_POST['email'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$user_id = $_SESSION['user_id'];

if (!empty($ime) && !empty($priimek) && !empty($email)
        && !empty($pass1) && ($pass1==$pass2)) {
    //vse ok
    $pass = $salt.$pass1;
    $pass = sha1($pass);

    $stmt = $link->prepare("UPDATE uporabniki SET ime=?, priimek=?, email=?, geslo=? WHERE id=?");
    $stmt->bind_param("ssssi", $ime, $priimek, $email, $pass, $user_id);
    $stmt->execute();

}

header("Location: user.php");