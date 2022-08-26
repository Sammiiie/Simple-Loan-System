<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">APPROVE EXPENSE</h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Expense Approval</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Documented by</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Documented by</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findInvestor = selectAll('expense', ['status' => 0]);
                                foreach ($findInvestor as $investor) {
                                ?>
                                    <tr>
                                        <td><?php echo $investor['amount'] ?></td>
                                        <td><?php echo $investor['description'] ?></td>
                                        <td>
                                            <?php
                                            $userId = $investor['userid'];
                                            $findUsers = selectOne('users', ['idusers' => $userId]);
                                            echo $findUsers['firstname'] . " " . $findUsers['middlename'] . " " . $findUsers['lastname'];
                                            ?>
                                        </td>
                                        <td><?php echo $investor['transaction_date'] ?></td>
                                        <td>
                                            <a href="functions/business/banks/approve_expense.php?approve=<?php echo $investor['id'] ?>" class="btn btn-info btn-icon-split">
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