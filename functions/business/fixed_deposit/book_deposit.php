<?php

include("../../connect.php");
session_start();
$userId = $_SESSION['userid'];
$digits = 7;
$randms = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

if (isset($_POST['transaction_id']) && isset($_POST['principal']) && isset($_POST['interest']) && isset($_POST['repayment'])) {
    // intialize post values
    $investor = $_POST['investment'];
    // $branch = $_POST['branch'];
    $principal = floatval(preg_replace('/[^\d.]/', '', $_POST['principal']));
    $interest = floatval(preg_replace('/[^\d.]/', '', $_POST['interest']));
    $term = $_POST['term'];
    $disbursement = $_POST['disbursement'];
    $upfront = $_POST['upfront'];
    if($upfront == 0){
        $interestPaid = 0.00;
    }else{
        $interestPaid = $interest;
    }
    $transactionId =  $_POST['transaction_id'];
    $repaymentDate = $_POST['repayment'];
    $totalDue = floatval(preg_replace('/[^\d.]/', '', $_POST['total_due']));
    $interestAmount = floatval(preg_replace('/[^\d.]/', '', $_POST['interest_amount']));
    $placement = $_POST['placement'];
    if ($placement != 3) {
        $agentName = $_POST['agent_name'];
        $agentPhone = $_POST['agent_phone'];
        $agentBank = $_POST['agent_bank'];
        $agentAccountNo = $_POST['agent_account_no'];
    }
    $interestAmount = floatval(preg_replace('/[^\d.]/', '', $_POST['interest_amount']));
    $agentCommision = floatval(preg_replace('/[^\d.]/', '', $_POST['agent_percentage']));
    $commissionValue = floatval(preg_replace('/[^\d.]/', '', $_POST['agent_commision_value']));
    $agentUpfront = $_POST['agentupfront'];

    // find if agent is registered or not
    // if not register .... register agent
    if ($placement == 0) {
        $findAgent = selectAll('agents', ['bank_account' => $agentAccountNo, 'fullname' => $agentName]);

        if (!$findAgent) {
            $agentData = [
                'fullname' => $agentName,
                'phone' => $agentPhone,
                'bank' => $agentBank,
                'bank_account' => $agentAccountNo
            ];
            $createAgent = create('agents', $agentData);
            $updateAgentData = [
                'agent_name' => $agentName,
                'agent_bank' => $agentBank,
                'agent_account_no' => $agentAccountNo,
                'agent_phone' => $agentPhone
            ];
            $updatteAgent = update('fixed_deposit', $investor, 'idfixed_deposit', $updateAgentData);
        } else if ($placement == 0) {
            $_SESSION["feedback"] = "Agent is Already registered!";
            $_SESSION["Lack_of_intfund_$randms"] = "10";
            echo header("Location: ../../../investor_view.php?view=$investor&message1=$randms");
            exit();
        }
    } else if ($placement == 1 or $placement == 2) {
        $updateAgentData = [
            'agent_name' => $agentName,
            'agent_bank' => $agentBank,
            'agent_account_no' => $agentAccountNo,
            'agent_phone' => $agentPhone
        ];
        $updatteAgent = update('fixed_deposit', $investor, 'idfixed_deposit', $updateAgentData);
        // dd($investor);
    }

    $loanData = [
        'amount' => $principal,
        'interest_rate' => $interest,
        'tenure' => $term,
        'disbursement_date' => $disbursement,
        'repayment_date' => $repaymentDate,
        'interest_paid' => $interestPaid,
        'interest_amount' => $interestAmount,
        'upfront' => $upfront,
        'principal_paid' => 0.00,
        'fixed_deposit_idfixed_deposit' => $investor,
        'isapproved' => 1
    ];
    // dd($loanData);
    $bookLoan = insert('investment', $loanData);
    if (!$bookLoan) {
        $error = "Error: \n" . mysqli_error($connection); //checking for errors
        $_SESSION["feedback"] = "Sorry could not book Fixed Depsit! - $error";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../investor_view.php?view=$investor&message1=$randms");
        exit();
    } else {
        $agentSettelementData = [
            'commision_percentage' => $agentCommision,
            'commission_value' => $commissionValue,
            'upfront' => $agentUpfront,
            'ispaid' => 0,
            'investmentid' => $bookLoan,
            // 'agentid' => $agentId
        ];
        $storeCommission = insert('agent_commission', $agentSettelementData);
        // store transaction details
        $transactionData = [
            'amount' => $principal,
            'transaction_type' => 'credit',
            'transaction_date' => $disbursement,
            'approved_by' => $userId,
            'loan_idloan' => 0,
            'investment_idinvestment' => $bookLoan
        ];
        $storeTransaction = insert('transactions', $transactionData);

        $findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);
        $accountId = $findAccount['id'];
        $balance =  $findAccount['account_balance'] + $principal;
        $updateBalance = update('account', $accountId, 'id', ['account_balance' => $balance, 'last_deposit' => $principal]);

        $_SESSION["feedback"] = "Fixed Depsit Booked Successfully";
        $_SESSION["Lack_of_intfund_$randms"] = "10";
        echo header("Location: ../../../investor_view.php?view=$investor&message0=$randms");
        exit();
    }
} else {
    // fill in all appropraite data
    $_SESSION["feedback"] = "Fill in all Neccessary Fields";
    $_SESSION["Lack_of_intfund_$randms"] = "10";
    echo header("Location: ../../../investor_view.php?view=$investor&message1=$randms");
    exit();
}
