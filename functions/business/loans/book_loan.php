<?php

include("../../connect.php");
session_start();
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['transaction_id']) && isset($_POST['principal']) && isset($_POST['interest']) && isset($_POST['repayment'])) {
    // intialize post values
    $client = $_POST['client'];
    $branch = $_POST['branch'];
    $principal = floatval(preg_replace('/[^\d.]/', '', $_POST['principal']));
    $interest = floatval(preg_replace('/[^\d.]/', '', $_POST['interest']));
    $term = $_POST['term'];
    $disbursement = $_POST['disbursement'];
    $upfront = $_POST['upfront'];
    $transactionId =  $_POST['transaction_id'];
    $repaymentDate = $_POST['repayment'];
    $totalDue = floatval(preg_replace('/[^\d.]/', '', $_POST['total_due']));
    $interestAmount = floatval(preg_replace('/[^\d.]/', '', $_POST['interest_amount']));
    $agentCommision = floatval(preg_replace('/[^\d.]/', '', $_POST['agent_percentage']));
    $commissionValue = floatval(preg_replace('/[^\d.]/', '', $_POST['agent_commision_value']));
    $agentUpfront = $_POST['agentupfront'];
    $agentId = $_POST['agentId'];

    // find out if client has existing loan
    $findLoan =  selectOne('loan', ['customers_idcustomers' => $client]);
    if($findLoan){
        $_SESSION["feedback"] = "Client has existing Loan!";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
        exit();
    }

    $loanData = [
        'amount' => $principal,
        'interest_rate' => $interest,
        'tenure' => $term,
        'disbursement_date' => $disbursement,
        'repayment_date' => $repaymentDate,
        'interest_paid' => 0.00,
        'interest_amount' => $interestAmount,
        'amount_paid' => 0.00,
        'fee_paid' => 0.00,
        'upfront' => $upfront,
        'customers_idcustomers' => $client,
        'branches_idbranches' => $branch,
        'isapproved' => 0
    ];
    $bookLoan = insert('loan', $loanData);
    if (!$bookLoan) {
        
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not book Loan! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
        exit();
    } else {
        $agentSettelementData = [
            'commision_percentage' => $agentCommision,
            'commission_value' => $commissionValue,
            'upfront' => $agentUpfront,
            'ispaid' => 0,
            'loanid' => $bookLoan,
            'agentid' => $agentId
        ];
        $storeCommission = insert('agent_commission', $agentSettelementData);
        // echo $error = "Error: \n" . mysqli_error($connection); //checking for errors
        // dd($storeCommission);
        $_SESSION["feedback"] = "Loan Booked Successfully and Awaiting Approval";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../client_view.php?view=$client&message0=$randms");
        exit();
    }
} else {
    // fill in all appropraite data
    $_SESSION["feedback"] = "Fill in all Neccessary Fields";
    $_SESSION["Lack_of_intfund_$randms"] = "10";
    echo header("Location: ../../../client_view.php?view=$client&message1=$randms");
    exit();
}
