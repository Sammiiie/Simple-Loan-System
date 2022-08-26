<?php
include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_GET['approve'])) {
    $depositId = $_GET['approve'];
    $findInvestment = selectOne('investment', ['idinvestment' => $depositId]);
    // store transaction details
    $transactionData = [
        'amount' => $findInvestment['amount'],
        'transaction_type' => 'credit',
        'transaction_date' => $findInvestment['disbursement_date'],
        'approved_by' => $userId,
        'loan_idloan' => 0,
        'investment_idinvestment' => $depositId
    ];
    $storeTransaction = insert('transactions', $transactionData);
    if (!$storeTransaction) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry Failed to store transaction History - Investment not Approved! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../Investment_approval.php?message1=$randms");
        exit();
    } else {
        // deduct amount from account
        $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
        $accountId = $findAccount['id'];
        $balance =  $findAccount['account_balance'] + $findInvestment['amount'];
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_deposit' => $balance]);
        if (!$updateBalance) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to update Company Account - Investment not Approved! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../Investment_approval.php?message1=$randms");
            exit();
        }


        $approveLoan = update('investment', $depositId, 'idinvestment', ['isapproved' => 1]);
        if (!$approveLoan) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry could not Approve Investment! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../Investment_approval.php?message1=$randms");
            exit();
        } else {
            $_SESSION["feedback"] = "Investment Successfuly Approved";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../Investment_approval.php?message0=$randms");
            exit();
        }
    }
}
