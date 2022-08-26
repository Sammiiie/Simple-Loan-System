<?php

include("../../connect.php");
session_start();
$userId =  $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if(isset($_POST['principal']) or isset($_POST['interest'])){
    $principal = floatval(preg_replace('/[^\d.]/', '', $_POST['principal']));
    $interest = floatval(preg_replace('/[^\d.]/', '', $_POST['interest']));
    $oldPrincipal = floatval(preg_replace('/[^\d.]/', '', $_POST['old_principal']));
    $oldInterest = floatval(preg_replace('/[^\d.]/', '', $_POST['old_interest']));
    $loanId = $_POST['loan'];
    $clientName = $_POST['client'];

    $editData = [
        'old_principal' => $oldPrincipal,
        'new_principal' => $principal,
        'old_interest' => $oldInterest,
        'new_interest' => $interest,
        'person_name' => $clientName,
        'altered_by' => $userId,
        'loan_id' => $loanId,
        'status' => 0
    ];

    $storeEdit = insert('edit_cache', $editData);
    if ($storeEdit) {
        $_SESSION["feedback"] = "Edit sent for Approval!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../edit_approval.php?message0=$randms");
        exit();
    } else {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry Could edit Loan! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../edit_approval.php?message1=$randms");
        exit();
    }
}

?>