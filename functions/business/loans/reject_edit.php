<?php
include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_GET['reject'])) {
    $loanId = $_GET['reject'];
    // $findLoan = selectOne('loan', ['idloan' => $loanId]);
    // delete loan
    $rejectLoan = delete('edit_cache', $loanId, 'id');
    if ($rejectLoan) {
        $_SESSION["feedback"] = "Edit Rejected!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../edit_approval.php?message0=$randms");
        exit();
    } else {
        $_SESSION["feedback"] = "Sorry Could not reject Edit!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../edit_approval.php?message1=$randms");
        exit();
    }
}
