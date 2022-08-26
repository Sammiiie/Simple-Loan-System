<?php
include("../../connect.php");
session_start();
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['phone']) && isset($_POST['firstname']) && isset($_POST['account'])) {

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname =  $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $bvn = $_POST['bvn'];
    $branch = $_POST['branches'];
    $address = $_POST['address'];
    $accountNo = $_POST['account'];
    $findEmail = selectAll('customers', ['account_number' => $accountNo]);
    if ($findEmail) {
        $_SESSION["feedback"] = "Account Number is in use by another client!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../clients.php?message1=$randms");
        exit();
    }
    $agentName = $_POST['agent_name'];
    $agentPhone = $_POST['agent_phone'];
    $agentBank = $_POST['agent_bank'];
    $agentAccountNo = $_POST['agent_account_no'];
    $placement = $_POST['placement'];
    
    // find if agent is registered or not
    // if not register .... register agent
    if ($placement != 2) {
        $findAgent = selectAll('agents', ['bank_account' => $agentAccountNo, 'fullname' => $agentName]);
        
        if (!$findAgent) {
            $agentData = [
                'fullname' => $agentName,
                'phone' => $agentPhone,
                'bank' => $agentBank,
                'bank_account' => $agentAccountNo
            ];
            $createAgent = create('agents', $agentData);
        } else if($placement == 0) {
            $_SESSION["feedback"] = "Agent is Already registered!";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../clients.php?message1=$randms");
            exit();
        }
    }

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
        'isapproved' => 0,
        'branches_idbranches' => $branch
    ];
    $createclient =  insert('customers', $clientData);
    if (!$createclient) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not create client! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../clients.php?message1=$randms");
        exit();
    } else {
        $_SESSION["feedback"] = "Client Successfuly created";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../clients.php?message0=$randms");
        exit();
    }
}
