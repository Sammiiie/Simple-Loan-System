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
    $agentName = $_POST['agent_name'];
    $agentPhone = $_POST['agent_phone'];
    $agentBank = $_POST['agent_bank'];
    $agentAccountNo = $_POST['agent_account_no'];
    
    $clientData = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'account_number' => $accountNo,
        'address' => $address,
        'agent_name' => $agentName,
        'agent_bank' => $agentBank,
        'agent_phone' => $agentPhone,
        'agent_account_no' => $agentAccountNo,
        'bvn' => $bvn,
        'email' => $email,
        'phone' => $phone,
        'isapproved' => 1,
    ];
    $updateClient =  update('customers', $clientId, 'idcustomers', $clientData);
    if (!$updateClient) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not edit client! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$clientId&message1=$randms");
        exit();
    } else {
        $_SESSION["feedback"] = "Client Successfuly editted";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$clientId&message0=$randms");
        exit();
    }
}
