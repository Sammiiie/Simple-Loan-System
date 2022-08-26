<?php
include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_GET['approve'])) {
    $loanId = $_GET['approve'];
    $findLoan = selectOne('loan', ['idloan' => $loanId]);
    // deduct amount from account
    $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
    $accountId = $findAccount['id'];
    $balance =  $findAccount['account_balance'] - $findLoan['amount'];
    $amount = $findLoan['amount'];
    if ($findAccount['account_balance'] >= $findLoan['amount']) {
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_withdrawal' => $amount]);
        if (!$updateBalance) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to update Company Account - Loan not Approved! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../loan_approval.php?message1=$randms");
            exit();
        }
        // store transaction details
        $transactionData = [
            'amount' => $findLoan['amount'],
            'transaction_type' => 'debit',
            'transaction_date' => $findLoan['disbursement_date'],
            'approved_by' => $userId,
            'loan_idloan' => $loanId,
            'branches_idbranches' => $findLoan['branches_idbranches']
        ];
        $storeTransaction = insert('transactions', $transactionData);
        if (!$storeTransaction) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to store transaction History - Loan not Approved! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../loan_approval.php?message1=$randms");
            exit();
        } else {



            $approveLoan = update('loan', $loanId, 'idloan', ['isapproved' => 1]);
            if (!$approveLoan) {
                $error = "Error: \n" . mysqli_error($connection); //checking for errors
                $_SESSION["feedback"] = "Sorry could not Approve loan! - $error";
                $_SESSION["Lack_of_intfund_$randms"] = "10";
                echo header("Location: ../../../loan_approval.php?message1=$randms");
                exit();
            } else {
                $_SESSION["feedback"] = "Loan Successfuly Approved";
                $_SESSION["Lack_of_intfund_$randms"] = "10";
                echo header("Location: ../../../loan_approval.php?message0=$randms");
                exit();
            }
        }
    } else {
        $_SESSION["feedback"] = "Insufficient Balance can't credit client!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../loan_approval.php?message1=$randms");
        exit();
    }
}
