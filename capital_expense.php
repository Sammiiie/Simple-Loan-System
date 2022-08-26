<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">CAPITAL EXPENSE</h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Record Expense</h6>
                </div>
                <div class="card-body">
                    <form class="user" autocomplete="off" method="POST" action="functions/business/banks/document_expense.php">
                        <!-- <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="username" placeholder="username" required>
                        </div> -->
                        <input type="text" name="expense_type" value="CAPITAL_EXPENSE" hidden>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="amount" name="amount" placeholder="amount" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="description" placeholder="description">
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#amount').on("change blur", function() {
                                    var amount = $(this).val();
                                    $.ajax({
                                        url: "functions/system/converter.php",
                                        method: "POST",
                                        data: {
                                            amount: amount
                                        },
                                        success: function(data) {
                                            $('#amount').val(data);
                                        }
                                    })
                                });

                            });
                        </script>


                        <button type="reset" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Reset</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Submit</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <!-- lists of users -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Capital Expenses</h6>
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
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Documented by</th>
                                    <th>Date</th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findInvestor = selectAll('expense', ['expense_type' => 'CAPITAL_EXPENSE', 'status' => 1]);
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