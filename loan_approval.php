<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">APPROVE LOAN</h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">LOAN Approval</h6>
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
                                $findLoan = selectAll('loan', ['isapproved' => 0]);
                                foreach ($findLoan as $loan) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $clientId = $loan['customers_idcustomers'];
                                            $findClient = selectOne('customers', ['idcustomers' => $clientId]);
                                            echo $findClient['firstname'] . " " . $findClient['middlename'] . " " . $findClient['lastname']
                                            ?>
                                        </td>
                                        <th><?php echo $loan['amount'] ?></th>
                                        <th><?php echo $loan['interest_rate'] ?></th>
                                        <th><?php echo $loan['amount'] + $loan['interest_amount'] ?></th>
                                        <td><?php echo $loan['repayment_date']; ?></td>
                                        <td>
                                            <a href="functions/business/loans/approve_loan.php?approve=<?php echo $loan['idloan'] ?>" class="btn btn-success btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Approve</span>
                                            </a>
                                            <a href="functions/business/loans/reject_loan.php?reject=<?php echo $loan['idloan'] ?>" class="btn btn-danger btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-hazzard"></i>
                                                </span>
                                                <span class="text">Reject</span>
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