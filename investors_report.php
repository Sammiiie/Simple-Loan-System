<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">FUNDING DETAILS</h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div style="float:left">
                        <h6 class="m-0 font-weight-bold text-primary">Funded Clients</h6>
                    </div>
                    <div style="float:right">
                        <a href="#" class="btn btn-info btn-icon-split export" data-export-type="excel">
                            <span class="icon text-white-50">
                                <i class="fas fa-download fa-sm text-white-50"></i>
                            </span>
                            <span class="text">Export EXCEL</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Bank</th>
                                    <th>Account Number</th>
                                    <th>Principal</th>
                                    <th>Interest Rate</th>
                                    <th>Interest Amount</th>
                                    <th>Total Repayment</th>
                                    <th>Amount Paid</th>
                                    <th>Disbursement Date</th>
                                    <th>Repayment Date</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Bank</th>
                                    <th>Account Number</th>
                                    <th>Principal</th>
                                    <th>Interest Rate</th>
                                    <th>Interest Amount</th>
                                    <th>Total Repayment</th>
                                    <th>Amount Paid</th>
                                    <th>Disbursement Date</th>
                                    <th>Repayment Date</th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findLoan = selectAll('investment', ['isapproved' => 1]);
                                foreach ($findLoan as $loan) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $clientid = $loan['fixed_deposit_idfixed_deposit'];
                                            $client = selectOne('fixed_deposit', ['idfixed_deposit' => $clientid]);
                                            echo $client['name'];
                                            ?>
                                        </td>
                                        <td><?php echo $client['phone_no'] . " - " . $client['email'] ?></td>
                                        <td><?php echo $client['bank'] ?></td>
                                        <td><?php echo $client['bank_account'] ?></td>
                                        <td><?php echo number_format($loan['amount'], 2) ?></td>
                                        <td><?php echo $loan['interest_rate'] ?></td>
                                        <td><?php echo number_format($loan['interest_amount'], 2)  ?></td>
                                        <td><?php echo number_format($loan['amount'] + $loan['interest_amount'], 2) ?></td>

                                        <?php
                                        if ($loan['repayment_date'] > $today && $loan['principal_paid'] + $loan['interest_paid'] < $loan['amount'] + $loan['interest_amount']) {
                                        ?>
                                            <td style="background-color: red;"><?php echo number_format($loan['principal_paid'] + $loan['interest_paid'], 2) ?></td>
                                            <td><?php echo $loan['disbursement_date'] ?></td>
                                            <td style="background-color: red;"><?php echo $loan['repayment_date'] ?></td>
                                        <?php
                                        } else if ($loan['principal_paid'] + $loan['interest_paid'] == $loan['amount'] + $loan['interest_amount']) {
                                        ?>
                                            <td style="background-color: green;"><?php echo number_format($loan['principal_paid'] + $loan['interest_paid'], 2) ?></td>
                                            <td><?php echo $loan['disbursement_date'] ?></td>
                                            <td style="background-color: green;"><?php echo $loan['repayment_date'] ?></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td style="background-color: yellow;"><?php echo number_format($loan['principal_paid'] + $loan['interest_paid'], 2) ?></td>
                                            <td><?php echo $loan['disbursement_date'] ?></td>
                                            <td style="background-color: yellow;"><?php echo $loan['repayment_date'] ?></td>
                                        <?php
                                        }
                                        ?>

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
<script>
    $(document).ready(function() {
        $(".export").click(function() {
            var export_type = $(this).data('export-type');
            $('#dataTable').tableExport({
                type: export_type,
                escape: 'false',
                ignoreColumn: []
            });
        });
    });
</script>

<?php

include('footer.php');

?>