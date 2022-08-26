<?php

include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['principal']) && isset($_POST['total'])) {
    $clientId = $_POST['client'];
    $principal = floatval(preg_replace('/[^\d.]/', '', $_POST['principal']));
    if (isset($_POST['interest'])) {
        $interest = floatval(preg_replace('/[^\d.]/', '', $_POST['interest']));
    } else {
        $interest = 0.00;
    }
    $interest_paid = $_POST['interest_paid'];
    $principal_paid = $_POST['principal_paid'];
    $total = $_POST['total'];
    // $total = $principal_paid + $interest_paid;
    $paymentTotal = $principal + $interest;
    if ($paymentTotal > $total) {
        $_SESSION["feedback"] = "Sorry cannot carry out Payment because amount inputted exceeds amount owed!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../investor_view.php?view=$clientId&message1=$randms");
        exit();
    }
    $investmentId = $_POST['investment'];
    $transactionDate = $_POST['transaction_date'];

    $transactionData = [
        'amount' => $paymentTotal,
        'transaction_type' => 'debit',
        'transaction_date' => $transactionDate,
        'approved_by' => $userId,
        'investment_idinvestment' => $investmentId
    ];

    $storeTransaction = insert('transactions', $transactionData);
    // dd($storeTransaction);

    if (!$storeTransaction) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry Failed to store transaction History - Repayment not Complete! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../investor_view.php?view=$clientId&message1=$randms");
        exit();
    } else {
        // deduct amount from account
        $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
        $accountId = $findAccount['id'];
        $balance =  $findAccount['account_balance'] - $paymentTotal;
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_withdrawal' => $paymentTotal]);
        if (!$updateBalance) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to update Company Account - Repayment not complete! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../investor_view.php?view=$clientId&message1=$randms");
            exit();
        } else {
            $interestToPay = $interest_paid + $interest;
            $principalToPay = $principal_paid + $principal;
            $loanData = [
                'interest_paid' => $interestToPay,
                'principal_paid' => $principalToPay
            ];
            $payLoan = update('investment', $investmentId, 'idinvestment', $loanData);
            if (!$payLoan) {
                $error = "Error: \n" . mysqli_error($connection); //checking for errors
                $_SESSION["feedback"] = "Sorry could not Complete the process but company account credited! - $error";
                $_SESSION["Lack_of_intfund_$randms"] = "10";
                echo header("Location: ../../../investor_view.php?view=$clientId&message1=$randms");
                exit();
            } else {
                $_SESSION["feedback"] = "Loan Successfuly Payed";
                $_SESSION["Lack_of_intfund_$randms"] = "10";
                echo header("Location: ../../../investor_view.php?view=$clientId&message0=$randms");
                exit();
            }
        }
    }
} else {
    $_SESSION["feedback"] = "Kindly fill all required fields";
    $_SESSION["Lack_of_intfund_$randms"] = "10";
    echo header("Location: ../../../investor_view.php?view=$clientId&message1=$randms");
    exit();
}
