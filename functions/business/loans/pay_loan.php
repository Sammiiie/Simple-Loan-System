<?php

include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['principal']) && isset($_POST['total'])) {
    $principal = floatval(preg_replace('/[^\d.]/', '', $_POST['principal']));
    if(isset($_POST['interest'])){
        $interest = floatval(preg_replace('/[^\d.]/', '', $_POST['interest']));
    }else{
        $interest = 0.00;
    }
    
    $total = $_POST['total'];
    $paymentTotal = $principal + $interest;
    if ($paymentTotal > $total) {
        $_SESSION["feedback"] = "Sorry cannot carry out Payment because amount inputted exceeds amount owed!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$clientId&message1=$randms");
        exit();
    }
    $loanId = $_POST['loan'];
    $clientId = $_POST['client'];
    $transactionDate = $_POST['transaction_date'];
    $branchId = $_POST['branch'];

    $transactionData = [
        'amount' => $paymentTotal,
        'transaction_type' => 'credit',
        'transaction_date' => $transactionDate,
        'approved_by' => $userId,
        'loan_idloan' => $loanId,
        'branches_idbranches' => $branchId
    ];
    $storeTransaction = insert('transactions', $transactionData);

    if (!$storeTransaction) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry Failed to store transaction History - Repayment not Complete! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$clientId&message1=$randms");
        exit();
    } else {
        // deduct amount from account
        $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
        $accountId = $findAccount['id'];
        $balance =  $findAccount['account_balance'] + $paymentTotal;
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_deposit' => $paymentTotal]);
        if (!$updateBalance) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to update Company Account - Repayment not complete! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../client_view.php?view=$clientId&message1=$randms");
            exit();
        } else {
            $loanData = [
                'interest_paid' => $interest,
                'amount_paid' => $paymentTotal
            ];
            $payLoan = update('loan', $loanId, 'idloan', $loanData);
            if (!$payLoan) {
                $error = "Error: \n" . mysqli_error($connection); //checking for errors
                $_SESSION["feedback"] = "Sorry could not Complete the process but company account credited! - $error";
                $_SESSION["Lack_of_intfund_$randms"] = "10";
                echo header("Location: ../../../client_view.php?view=$clientId&message1=$randms");
                exit();
            } else {
                $_SESSION["feedback"] = "Loan Successfuly Payed";
                $_SESSION["Lack_of_intfund_$randms"] = "10";
                echo header("Location: ../../../client_view.php?view=$clientId&message0=$randms");
                exit();
            }
        }
    }
} else {
    $_SESSION["feedback"] = "Kindly fill all required fields";
    $_SESSION["Lack_of_intfund_$randms"] = "10";
    echo header("Location: ../../../client_view.php?view=$clientId&message1=$randms");
    exit();
}
