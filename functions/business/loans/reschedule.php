<?php

include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
$client = $_POST['client'];
$today = date('Y-m-d');

if (isset($_POST['new_date']) && isset($_POST['fee']) && isset($_POST['extend'])) {
    $loanId = $_POST['loan'];
    $oldRepaymentDate = $_POST['repayment_date'];
    $newDate = $_POST['new_date'];
    $fee = floatval(preg_replace('/[^\d.]/', '', $_POST['fee']));
    // $isPaid = $_POST['ispaid'];


    $rescheduleData = [
        'fee_paid' => $fee,
        'repayment_date' => $oldRepaymentDate,
        'new_date' => $newDate,
        'is_paid' => 1,
        'loan_idloan' => $loanId
    ];

    $reschedule = insert('reschedule', $rescheduleData);
    if ($reschedule) {
        $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
        $accountId = $findAccount['id'];
        $balance =  $findAccount['account_balance'] + $fee;
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_deposit' => $fee]);
        if (!$updateBalance) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to update Company Account - Loan not Approved! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
            exit();
        }
        // store transaction details
        $transactionData = [
            'amount' => $fee,
            'transaction_type' => 'credit',
            'transaction_date' => $today,
            'approved_by' => $userId,
            'loan_idloan' => $loanId
            // 'branches_idbranches' => 
        ];
        $storeTransaction = insert('transactions', $transactionData);
        if (!$storeTransaction) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to store transaction History - Loan not Approved! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
            exit();
        }
        $updateLoan = update('loan', $loanId, 'idloan', ['repayment_date' => $newDate, 'fee_paid' => $fee]);
        if (!$updateLoan) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry could not reschedule! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
            exit();
        } else {
            $_SESSION["feedback"] = "Successfully rescheduled!";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../client_view.php?view=$client&message0=$randms");
            exit();
        }
    } else {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not reschedule and Store transaction Data! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
        exit();
    }
} else {
    $_SESSION["feedback"] = "Input all necessary data! - $error";
    $_SESSION["Lack_of_intfund_$randms"] = "10";
    echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
    exit();
}
