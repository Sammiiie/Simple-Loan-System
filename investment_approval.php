<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">APPROVE FIXED DEPOSITS</h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Investment Approval</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Interest Rate</th>
                                    <th>Total Due</th>
                                    <th>Repayment Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Interest Rate</th>
                                    <th>Total Due</th>
                                    <th>Repayment Date</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findInvestment = selectAll('investment', ['isapproved' => 0]);
                                foreach ($findInvestment as $investment) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $investorId = $investment['fixed_deposit_idfixed_deposit'];
                                            $findInvestor = selectOne('fixed_deposit', ['idfixed_deposit' => $investorId]);
                                            echo $findInvestor['name'];
                                            ?>
                                        </td>
                                        <th><?php echo number_format($investment['amount'], 2) ?></th>
                                        <th><?php echo $investment['interest_rate']."%" ?></th>
                                        <th><?php echo number_format($investment['amount'] + $investment['interest_amount'], 2) ?></th>
                                        <td><?php echo $investment['repayment_date']; ?></td>
                                        <td>
                                            <a href="functions/business/fixed_deposit/approve_deposit.php?approve=<?php echo $investment['idinvestment'] ?>" class="btn btn-info btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Approve</span>
                                            </a>
                                        </td>

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

    </div>

</div>
<!-- /.container-fluid -->

<?php

include('footer.php');

?>