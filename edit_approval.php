<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">APPROVE EDITS</h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Approve Funding and Investment Edits</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Transaction Type</th>
                                    <th>Old Principal Amount</th>
                                    <th>New Principal Amount</th>
                                    <th>Old Interest Amount</th>
                                    <th>New Interest Amount</th>
                                    <th>Changed by</th>
                                    <th>Changed on</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Transaction Type</th>
                                    <th>Old Principal Amount</th>
                                    <th>New Principal Amount</th>
                                    <th>Old Interest Amount</th>
                                    <th>New Interest Amount</th>
                                    <th>Changed by</th>
                                    <th>Changed on</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findEdit = selectAll('edit_cache', ['status' => 0]);
                                foreach ($findEdit as $edit) {
                                ?>
                                    <tr>
                                        <td><?php echo $edit['person_name'] ?></td>
                                        <td>
                                            <?php
                                            if ($edit['loan_id'] != "") {
                                                $type = "Funding";
                                            } else {
                                                $type = "Investment";
                                            }
                                            echo $type;
                                            ?>
                                        </td>
                                        <td><?php echo $edit['old_principal'] ?></td>
                                        <td><?php echo $edit['new_principal'] ?></td>
                                        <td><?php echo $edit['old_interest'] ?></td>
                                        <td><?php echo $edit['new_interest'] ?></td>
                                        <td>
                                            <?php
                                            $userId = $edit['altered_by'];
                                            $findUsers = selectOne('users', ['idusers' => $userId]);
                                            echo $findUsers['firstname'] . " " . $findUsers['middlename'] . " " . $findUsers['lastname'];
                                            ?>
                                        </td>
                                        <td><?php echo $edit['edited_on'] ?></td>
                                        <td>
                                            <?php
                                            if ($type == "Funding") {
                                            ?>
                                                <a href="functions/business/loans/approve_loan_edit.php?approve=<?php echo $edit['id'] ?>" class="btn btn-primary">Approve</a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="functions/business/fixed_deposit/approve_loan_edit.php?approve=<?php echo $edit['id'] ?>" class="btn btn-primary">Approve</a>
                                            <?php
                                            }
                                            ?>
                                            <a href="functions/business/loans/reject_edit.php?reject=<?php echo $edit['id'] ?>" class="btn btn-danger">Reject</a>

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