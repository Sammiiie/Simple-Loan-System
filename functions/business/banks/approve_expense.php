<?php
include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
$today =  date('Y-m-d');

if (isset($_GET['approve'])) {
    $expenseId = $_GET['approve'];
    $findExpense = selectOne('expense', ['id' => $expenseId]);
    // store transaction details
    $transactionData = [
        'amount' => $findExpense['amount'],
        'transaction_type' => 'debit',
        'transaction_date' => $today,
        'approved_by' => $userId,
        'loan_idloan' => 0,
        'investment_idinvestment' => 0,
        'expense_id' => $expenseId
    ];
    $storeTransaction = insert('transactions', $transactionData);
    if (!$storeTransaction) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry Failed to store transaction History - Expense not Approved! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../expense_approval.php?message1=$randms");
        exit();
    } else {
        // deduct amount from account
        $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
        $accountId = $findAccount['id'];
        $balance =  $findAccount['account_balance'] - $findExpense['amount'];
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_deposit' => $findExpense['amount']]);
        if (!$updateBalance) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry Failed to update Company Account - Expense not Approved! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../expense_approval.php?message1=$randms");
            exit();
        }


        $approveLoan = update('expense', $expenseId, 'id', ['status' => 1]);
        if (!$approveLoan) {
            $error = "Error: \n" . mysqli_error($connection); //checking for errors
            $_SESSION["feedback"] = "Sorry could not Approve Expense! - $error";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../expense_approval.php?message1=$randms");
            exit();
        } else {
            $_SESSION["feedback"] = "Expense Successfuly Approved";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../expense_approval.php?message0=$randms");
            exit();
        }
    }
}
