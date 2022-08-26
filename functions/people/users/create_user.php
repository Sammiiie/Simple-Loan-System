<?php
include("../../connect.php");
session_start();
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if(isset($_POST['email']) && isset($_POST['firstname'])){
    // initiialize post data
    // username future addition
    // $username =  $_POST['username'];
    // $findUsername = selectAll('users', ['username' => $username]);
    // if($findUsername){
    //     $_SESSION["feedback"] = "Username Already Exists!";
    //     $_SESSION["Lack_of_intfund_$randms"] = "10";
    //     echo header("Location: ../../../users.php?message1=$randms");
    //     exit();
    // }
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname =  $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $findEmail = selectAll('users', ['email' => $email]);
    if($findEmail){
        $_SESSION["feedback"] = "Email is in use by another user!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../users.php?message1=$randms");
        exit();
    }
    $designation = $_POST['designation'];

    $password = "password25";
    $passkey = password_hash($password, PASSWORD_DEFAULT);

    $userData = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'passkey' => $passkey,
        'email' => $email,
        'phone'=> $phone,
        'status' => "Activated",
        'designation_iddesignation' => $designation
    ];
    $createUser =  insert('users', $userData);
    if (!$createUser) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not create User! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../users.php?message1=$randms");
        exit();
    } else {
        $_SESSION["feedback"] = "User Successfuly created - Default Password is. - password25";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../users.php?message0=$randms");
        exit();
    }
}