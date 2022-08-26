<?php

include("../../connect.php");
session_start();
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if(isset($_POST['bank_name']) && isset($_POST['branch'])){
    // getting post values and 
    // initialize them
    $bankName = $_POST['bank_name'];
    $description =  $_POST['description'];
    $branch = $_POST['branch'];
    // $location = $_POST['location'];
    $primaryContactName = $_POST['pc_name'];
    $primaryContactEmail = $_POST['pc_email'];
    $primaryContactPhone = $_POST['pc_phone'];
    $primaryContactName2 = $_POST['pc_name2'];
    $primaryContactEmail2 = $_POST['pc_email2'];
    $primaryContactPhone2 = $_POST['pc_phone2'];

    $bankData = [
        'name' => $bankName,
        'description' => $description
    ];
    // inserting data into table on the database
    // insert function returns the value of the row inserted into
    $createBank =  insert('banks', $bankData);
    if(!$createBank) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry Could not create Bank! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../banks.php?message1=$randms");
        exit();
    }else{
        // branch data array and
        // inserting branch data into db
        $branchData = [
            'branch_name' => $branch,
            // 'location' => $location,
            'main_branch' => 1,
            'primary_contact_fullname' => $primaryContactName,
            'primary_contact_email' => $primaryContactEmail,
            'primary_contact_phone' => $primaryContactPhone,
            'primary_contact2' => $primaryContactName2,
            'primary_contact_email2' => $primaryContactEmail2,
            'primary_contact_phone2' => $primaryContactPhone2,
            'banks_idbanks' => $createBank
        ]; 
        $createBranch = insert('branches', $branchData);
        if(!$createBranch) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Bank created but could not create Main Branch! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../banks.php?message1=$randms");
            exit();
        }else{
            $_SESSION["feedback"] = "Bank and Main Branch Successfuly created";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../banks.php?message0=$randms");
            exit();
        }
    }
}