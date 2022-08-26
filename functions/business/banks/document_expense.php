<?php

include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['amount']) && isset($_POST['description'])) {
    // getting post values and 
    // initialize them
    $amount = floatval(preg_replace('/[^\d.]/', '', $_POST['amount']));
    $description = $_POST['description'];
    $expenseType = $_POST['expense_type'];
    
    // branch data array and
    // inserting branch data into db
    $expenseData = [
        'amount' => $amount,
        'description' => $description,
        'expense_type' => $expenseType,
        'userid' => $userId,
        'status' => 0
    ];
    // dd($branchData);
    $createExpense = insert('expense', $expenseData);
    if (!$createExpense) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not document expense! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../expense.php?message1=$randms");
        exit();
    } else {
        $_SESSION["feedback"] = "Expense Successfuly Documented";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../expense.php?message0=$randms");
        exit();
    }
}
