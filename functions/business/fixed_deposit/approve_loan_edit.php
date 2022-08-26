<?php
include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_GET['approve'])) {
    $editId = $_GET['approve'];
    $findEdit = selectOne('edit_cache', ['id' => $editId]);
    $principal = $findEdit['new_principal'];
    $interest = $findEdit['new_interest'];
    $loanId = $findEdit['investment_id'];

    if ($principal == 0.00) {
        $amount = $findEdit['old_principal'];
    } else {
        $amount = $principal;
    }
    if ($interest == 0.00) {
        $interest = $findEdit['old_interest'];
    } else {
        $interest = $interest;
    }

    $loanEdit = [
        'amount' => $amount,
        'interest_amount' => $interest
    ];

    $updateLoan = update('investment', $loanId, 'idinvestment', $loanEdit);
    // dd($updateLoan);
    if (!$updateLoan) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Something went wrong could not edit Investment! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../edit_approval.php?message1=$randms");
            exit();
    } else {
        $approveEdit = update('edit_cache', $editId, 'id', ['status' => 1, 'approved_by' => $userId]);
        if (!$approveEdit) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry could not Approve Investment edit! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../edit_approval.php?message1=$randms");
            exit();
        } else {
            $_SESSION["feedback"] = "Investment Successfuly Edited";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../edit_approval.php?message0=$randms");
            exit();
        }
    }
}
