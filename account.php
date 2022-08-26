<?php

include('header.php');

$findAccount = selectOne('account', ['account_name' => "INSTITUTION_ACCOUNT"]);


?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> INSTITUTION ACCOUNT </h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="">Account Balance</label>
                            <input type="text" class="form-control form-control-user" value="<?php echo number_format($findAccount['account_balance'], 2) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Last Deposit</label>
                            <input type="text" class="form-control form-control-user" value="<?php echo number_format($findAccount['last_deposit'], 2) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Last Withdrawal</label>
                            <input type="text" class="form-control form-control-user" value="<?php echo number_format($findAccount['last_withdrawal'], 2) ?>" readonly>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <!-- account transactions -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Account Statement</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="transactions" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Person</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Person</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findTransactions = selectAll('transactions');
                                foreach ($findTransactions as $transaction) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($transaction['loan_idloan'] != 0) {
                                                $loanId = $transaction['loan_idloan'];
                                                $findLoan = selectOne('loan', ['idloan' => $loanId]);
                                                $clientId = $findLoan['customers_idcustomers'];
                                                $findClient = selectOne('customers', ['idcustomers' => $clientId]);
                                                echo $findClient['firstname'] . " " . $findClient['middlename'] . " " . $findClient['lastname'];
                                            } else if ($transaction['investment_idinvestment'] != 0) {
                                                $investmentId = $transaction['investment_idinvestment'];
                                                $findInvestment = selectOne('investment', ['idinvestment' => $investmentId]);
                                                $investorId = $findInvestment['fixed_deposit_idfixed_deposit'];
                                                $findInvestor = selectOne('fixed_deposit', ['idfixed_deposit' => $investorId]);
                                                echo $findInvestor['name'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($transaction['loan_idloan'] != 0) {
                                                if ($transaction['transaction_type'] == 'credit') {
                                                    echo 'Funds Repayment';
                                                } else {
                                                    echo "Funds Disburement";
                                                }
                                            } else if ($transaction['investment_idinvestment'] != 0) {
                                                if ($transaction['transaction_type'] == 'credit') {
                                                    echo 'Investment Funding';
                                                } else {
                                                    echo "Investors Repayment";
                                                }
                                            } else if ($transaction['investment_idinvestment'] == 0 && $transaction['loan_idloan'] == 0) {
                                                echo "Expense";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo number_format($transaction['amount'], 2) ?></td>
                                        <td><?php echo $transaction['transaction_type'] ?></td>
                                        <td><?php echo $transaction['transaction_date'] ?></td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /account Transactions -->



    </div>

</div>
<!-- /.container-fluid -->
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#transactions').DataTable({
            "order": [
                [5, "desc"]
            ]
        });
    });
</script>

<?php

include('footer.php');

?>