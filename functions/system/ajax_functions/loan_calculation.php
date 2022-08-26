<?php

if (isset($_POST['principal']) && isset($_POST['interest']) && isset($_POST['term']) && isset($_POST['upfront'])) {
    $principal = floatval(preg_replace('/[^\d.]/', '', $_POST['principal']));
    $interest = floatval(preg_replace('/[^\d.]/', '', $_POST['interest']));
    $term = $_POST['term'];
    $termMonths = $term / 30;
    $disbursement = $_POST['disbursement'];
    $upfront = $_POST['upfront'];
    $agent_percentage = $_POST['agent_percentage'];

    // find interest amount of the loan
    // and the total interest due
    $interestAmount = $principal * $interest / 100;
    $agentCommision = $principal * $agent_percentage / 100;
    $interestDue = $interestAmount * $termMonths;
    if ($upfront == 0) {
        $totalRepayment =  $principal + $interestDue;
    } else {
        $totalRepayment = $principal;
    }
    
    // find repayment date
    $repaymentDate = date('Y-m-d', strtotime("+" . $term . " days", strtotime($disbursement)));

    // Generate transactionId
    $digits = 9;
    $rando = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
    $trasactionId = "LOAN_". $rando;
?>

    <input type="text" name="transaction_id" value="<?php echo $trasactionId ?>" readonly hidden>
    <div class="form-group">
        <label for="">Interest Due</label>
        <input type="text" class="form-control form-control-user" name="interest_amount" value="<?php echo number_format($interestDue, 2) ?>" readonly required>
    </div>
    <div class="form-group">
        <label for="">Total Repayment</label>
        <input type="text" class="form-control form-control-user" name="total_due" value="<?php echo number_format($totalRepayment, 2) ?>" readonly required>
    </div>
    <div class="form-group">
        <label for="">Repayment Date</label>
        <input type="text" class="form-control form-control-user" name="repayment" value="<?php echo $repaymentDate ?>" readonly required>
    </div>
    <div class="form-group">
        <label for="">Agent's commision value </label>
        <input type="text" class="form-control form-control-user" name="agent_commision_value" value="<?php echo number_format($agentCommision, 2) ?>" readonly required>
    </div>
    
<?php
}else{
    ?>
    <p>
        Kindly Fill all required Fields
    </p>
    <?php
}
