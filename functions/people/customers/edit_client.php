<?php
include("../../connect.php");
session_start();
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['phone']) && isset($_POST['firstname']) && isset($_POST['account'])) {

    $clientId = $_POST['client_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname =  $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $bvn = $_POST['bvn'];
    $address = $_POST['address'];
    $accountNo = $_POST['account'];
    
    $clientData = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'account_number' => $accountNo,
        'address' => $address,
        'bvn' => $bvn,
        'email' => $email,
        'phone' => $phone,
        'isapproved' => 0,
    ];
    $updateClient =  update('customers', $clientId, 'idcustomers', $clientData);
    if (!$updateClient) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not edit client! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_approval.php?message1=$randms");
        exit();
    } else {
        $_SESSION["feedback"] = "Client Successfuly editted";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_approval.php?message0=$randms");
        exit();
    }
}
