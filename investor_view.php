<?php

include('header.php');

$investorId = $_GET["view"];
$findInvestor = selectOne('fixed_deposit', ['idfixed_deposit' => $investorId]);

$investorNAME = $findInvestor['name'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $findInvestor['name'] ?></h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div style="float: left;">
                        <h6 class="m-0 font-weight-bold text-primary">Bio Info</h6>
                    </div>
                    <div style="float:right">
                        <a href="#" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#client">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                    <!-- Modal -->
                    <form action="functions/people/customers/edit_client2.php" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <input type="text" value="<?php echo $investorId ?>" name="client_id" hidden>
                                        <div class="form-group">
                                            <label for="">Firstname</label>
                                            <input type="text" class="form-control form-control-user" name="firstname" value="<?php echo $findInvestor['firstname'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Middlename</label>
                                            <input type="text" class="form-control form-control-user" name="middlename" value="<?php echo $findInvestor['middlename'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Lastname</label>
                                            <input type="text" class="form-control form-control-user" name="lastname" value="<?php echo $findInvestor['lastname'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control form-control-user" name="email" aria-describedby="emailHelp" value="<?php echo $findInvestor['email'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="tel" class="form-control form-control-user" name="phone" value="<?php echo $findInvestor['phone'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" class="form-control form-control-user" name="address" value="<?php echo $findInvestor['address'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">BVN</label>
                                            <input type="text" class="form-control form-control-user" name="bvn" value="<?php echo $findInvestor['bvn'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Number</label>
                                            <input type="text" class="form-control form-control-user" name="account" value="<?php echo $findInvestor['account_number'] ?>" required>
                                        </div>
                                        <legend>Agent Info</legend>
                                        <div class="form-group">
                                            <label for="">Agent</label>
                                            <input type="text" class="form-control form-control-user" name="agent_name" value="<?php echo $findInvestor['agent_name'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" class="form-control form-control-user" name="agent_phone" value="<?php echo $findInvestor['agent_phone'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bank</label>
                                            <input type="text" class="form-control form-control-user" name="agent_bank" value="<?php echo $findInvestor['agent_bank'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Number</label>
                                            <input type="text" class="form-control form-control-user" name="agent_account_no" value="<?php echo $findInvestor['agent_account_no'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" id="upload-image" class="btn btn-primary">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Contact Details</label>
                                </div>
                                <p>
                                    <i class="fas fa-mobile-alt"></i> : <a href="tel:<?php echo $findInvestor['phone_no'] ?>"><?php echo $findInvestor['phone_no'] ?></a>
                                </p>
                                <p>
                                    <i class="fas fa-envelope"></i> : <a href="mailto:<?php echo $findInvestor['email'] ?>"><?php echo $findInvestor['email'] ?></a>
                                </p>
                                <?php echo $_SESSION['feedback'] ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Agent</label>
                                    <input type="text" class="form-control form-control-user" name="agent_name" value="<?php echo $findInvestor['agent_name'] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control form-control-user" name="agent_phone" value="<?php echo $findInvestor['agent_phone'] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="">Bank</label>
                                    <input type="text" class="form-control form-control-user" name="agent_bank" value="<?php echo $findInvestor['agent_bank'] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="">Account Number</label>
                                    <input type="text" class="form-control form-control-user" name="agent_account_no" value="<?php echo $findInvestor['agent_account_no'] ?>" readonly required>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        <!-- loan info -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div style="float:left">
                        <h6 class="m-0 font-weight-bold text-primary">Investment</h6>
                    </div>
                    <div style="float:right">
                        <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#bookLoan">
                            <span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Book Fixed Deposit</span>
                        </a>
                    </div>
                    <!-- Modal -->
                    <form action="functions/business/fixed_deposit/book_deposit.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="modal fade" id="bookLoan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Book Fixed Deposit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <input type="text" value="<?php echo $investorId ?>" name="investment" hidden>
                                        <input type="text" value="<?php echo $baranchId ?>" name="branch" hidden>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="principal" name="principal" placeholder="Principal...." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="interest" name="interest" placeholder="Interest Rate...." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="term" name="term" placeholder="Tenure...." required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Upfront</label>
                                            <select name="upfront" id="upfront" class="form-control form-control-user">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Disburement Date</label>
                                            <input type="date" class="form-control form-control-user" id="disbursement" name="disbursement" placeholder="Principal...." required>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#principal').on("change blur", function() {
                                                    var amount = $(this).val();
                                                    $.ajax({
                                                        url: "functions/system/converter.php",
                                                        method: "POST",
                                                        data: {
                                                            amount: amount
                                                        },
                                                        success: function(data) {
                                                            $('#principal').val(data);
                                                        }
                                                    })
                                                });

                                                $('#disbursement, #term, #interest, principal, #upfront, #agent_percentage').on("change keyup paste click", function() {
                                                    var disbursement = $('#disbursement').val();
                                                    var term = $('#term').val();
                                                    var interest = $('#interest').val();
                                                    var principal = $('#principal').val();
                                                    var upfront = $('#upfront').val();
                                                    var agent_percentage = $('#agent_percentage').val();
                                                    $.ajax({
                                                        url: "functions/system/ajax_functions/loan_calculation.php",
                                                        method: "POST",
                                                        data: {
                                                            disbursement: disbursement,
                                                            term: term,
                                                            interest: interest,
                                                            principal: principal,
                                                            upfront: upfront,
                                                            agent_percentage: agent_percentage
                                                        },
                                                        success: function(data) {
                                                            $('#loanData').html(data);
                                                        }
                                                    })
                                                });
                                            });
                                        </script>
                                        <div id="loanData"></div>
                                        <div class="form-group">
                                            <label for="">AGENTS</label>
                                            <select name="placement" id="placement" class="form-control ">
                                                <option value="3">None</option>
                                                <option value="0">Not Registered</option>
                                                <option value="1">Registered Agent</option>
                                                <option value="2">Registred Investor</option>
                                            </select>
                                        </div>

                                        <div id="agents"></div>
                                        <div id="regsitered_agent"></div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#placement').on("click", function() {
                                                    var placement = $(this).val();
                                                    $.ajax({
                                                        url: "functions/system/ajax_functions/agents_selection.php",
                                                        method: "POST",
                                                        data: {
                                                            placement: placement
                                                        },
                                                        success: function(data) {
                                                            $('#agents').html(data);
                                                        }
                                                    })
                                                });


                                            });
                                        </script>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="agent_percentage" name="agent_percentage" placeholder="Agent percentage...." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Agent Compensation Upfront?</label>
                                            <select name="agentupfront" id="agentupfront" class="form-control form-control-user">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Book</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /modal ends here -->
                </div>
                <div class="card-body">
                    <?php
                    $findInvestment = selectOne('investment', ['fixed_deposit_idfixed_deposit' => $investorId]);
                    if ($findInvestment) {
                    ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Invested</th>
                                    <th>Interest</th>
                                    <th>Repaid</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Invested</th>
                                    <th>Interest</th>
                                    <th>Repaid</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findInvestor = selectAll('investment', ['fixed_deposit_idfixed_deposit' => $investorId]);
                                foreach ($findInvestor as $investment) {
                                ?>
                                    <tr>
                                        <td><?php echo number_format($investment['amount'], 2) ?></td>
                                        <td><?php echo number_format($investment['interest_amount'], 2) ?></td>
                                        <td><?php echo number_format($investment['principal_paid'] + $investment['interest_paid'], 2) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#showloan<?php echo $investment['idinvestment'] ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">View</span>
                                            </a>
                                            <a href="#" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#editLoan<?php echo $investment['idinvestment'] ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="showloan<?php echo $investment['idinvestment'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Book Fixed Deposit</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Principal</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo number_format($investment['amount'], 2) ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Interest Rate</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo $investment['interest_rate'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Interest Amount</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo number_format($investment['interest_amount'], 2) ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Total Due</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo number_format(($investment['amount'] + $investment['interest_amount']) - ($investment['principal_paid'] + $investment['interest_paid']), 2) ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Total Repaid</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo number_format($investment['principal_paid'] + $investment['interest_paid'], 2) ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Disburement Date</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo $investment['disbursement_date'] ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Repayment Date</label>
                                                                <input type="text" class="form-control form-control-user" name="branch" value="<?php echo $investment['repayment_date'] ?>" readonly>
                                                            </div>

                                                            <?php

                                                            $investmentId = $investment['idinvestment'];
                                                            $findReschedule = selectAll('reschedule', ['idinvestment' => $investmentId]);
                                                            foreach ($findReschedule as $reschedule) {

                                                            ?>
                                                                <div class="card mb-4 py-3 border-left-warning">
                                                                    <div class="card-body">
                                                                        <p>
                                                                            <b>Old date:</b> <?php echo $reschedule['repayment_date'] ?>
                                                                        </p>
                                                                        <p>
                                                                            <b>New date:</b> <?php echo $reschedule['new_date'] ?>
                                                                        </p>
                                                                        <p>
                                                                            <b>Fee Paid:</b> <?php echo number_format($reschedule['fee_paid'], 2) ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            <?php

                                                            }
                                                            if (($investment['interest_paid'] + $investment['principal_paid']) >= ($investment['total_repayment'])) {

                                                            ?>
                                                                <!-- Requirements met hence payment option not shown -->
                                                            <?php
                                                            } else {
                                                            ?>


                                                                <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#payLoan<?php echo $investment['idinvestment'] ?>">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-check"></i>
                                                                    </span>
                                                                    <span class="text">Pay Loan</span>
                                                                </a>
                                                                <a href="#" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#reschedule<?php echo $investment['idinvestment'] ?>">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-recycle"></i>
                                                                    </span>
                                                                    <span class="text">Reschedule</span>
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>
                                                            <!-- pay loan Modal -->
                                                            <form action="functions/business/fixed_deposit/pay_investor.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal fade" id="payLoan<?php echo $investment['idinvestment'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Pay Loan</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <input type="text" value="<?php echo $investorId ?>" name="client" hidden>
                                                                                <input type="text" value="<?php echo $investment['idinvestment'] ?>" name="investment" hidden>
                                                                                <input type="text" value="<?php echo $investment['principal_paid'] ?>" name="principal_paid" hidden>
                                                                                <input type="text" value="<?php echo $investment['interest_paid'] ?>" name="interest_paid" hidden>
                                                                                <input type="text" id="total" name="total" value="<?php echo ($investment['amount'] + $investment['interest_amount']) - ($investment['principal_paid'] + $investment['interest_paid']) ?>" hidden>
                                                                                <div class="form-group">
                                                                                    <label for="">Principal</label>
                                                                                    <input type="text" class="form-control form-control-user" id="principal_pay" name="principal" placeholder="Principal...." required>
                                                                                </div>
                                                                                <?php
                                                                                if ($investment['upfront'] == 0 && $investment['interest_paid'] < $investment['interest_amount']) {
                                                                                ?>
                                                                                    <div class="form-group">
                                                                                        <label for="">Interest</label>
                                                                                        <input type="text" class="form-control form-control-user" id="interest_pay" name="interest" placeholder="Interest...." required>
                                                                                    </div>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <!-- no data needed -->
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <div class="form-group">
                                                                                    <label for="">Transaction Date</label>
                                                                                    <input type="date" class="form-control form-control-user" name="transaction_date" required>
                                                                                </div>

                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        $('#principal_pay').on("change blur", function() {
                                                                                            var amount = $(this).val();
                                                                                            $.ajax({
                                                                                                url: "functions/system/converter.php",
                                                                                                method: "POST",
                                                                                                data: {
                                                                                                    amount: amount
                                                                                                },
                                                                                                success: function(data) {
                                                                                                    $('#principal_pay').val(data);
                                                                                                }
                                                                                            })
                                                                                        });

                                                                                        $('#interest_pay').on("change blur", function() {
                                                                                            var amount = $(this).val();
                                                                                            $.ajax({
                                                                                                url: "functions/system/converter.php",
                                                                                                method: "POST",
                                                                                                data: {
                                                                                                    amount: amount
                                                                                                },
                                                                                                success: function(data) {
                                                                                                    $('#interest_pay').val(data);
                                                                                                }
                                                                                            })
                                                                                        });

                                                                                        $('#principal_pay, #total, #interest_pay').on("change keyup paste click", function() {
                                                                                            var total = $('#total').val();
                                                                                            var interest = $('#interest_pay').val();
                                                                                            var principal = $('#principal_pay').val();

                                                                                            $.ajax({
                                                                                                url: "functions/system/ajax_functions/payment_check.php",
                                                                                                method: "POST",
                                                                                                data: {

                                                                                                    total: total,
                                                                                                    interest: interest,
                                                                                                    principal: principal
                                                                                                },
                                                                                                success: function(data) {
                                                                                                    $('#payData').html(data);
                                                                                                }
                                                                                            })
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                                <div id="payData"></div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Pay</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- /modal ends here -->
                                                            <!-- reschedule modal -->
                                                            <form action="functions/business/fixed_deposit/reschedule.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal fade" id="reschedule<?php echo $investment['idinvestment'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Reschedule Loan</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <input type="text" value="<?php echo $investorId ?>" name="client" hidden>
                                                                                <input type="text" value="<?php echo $investment['idinvestment'] ?>" name="loan" hidden>
                                                                                <input type="text" value="<?php echo $baranchId ?>" name="branch" hidden>
                                                                                <input type="text" id="repayment_date" name="repayment_date" value="<?php echo $investment['repayment_date'] ?>" hidden>

                                                                                <div class="form-group">
                                                                                    <label for="">Extend By</label>
                                                                                    <input type="text" class="form-control form-control-user" id="extend" name="extend" placeholder="days...." required>
                                                                                </div>
                                                                                <div id="newDate"></div>

                                                                                <script>
                                                                                    $(document).ready(function() {
                                                                                        $('#fee').on("change blur", function() {
                                                                                            var amount = $(this).val();
                                                                                            $.ajax({
                                                                                                url: "functions/system/converter.php",
                                                                                                method: "POST",
                                                                                                data: {
                                                                                                    amount: amount
                                                                                                },
                                                                                                success: function(data) {
                                                                                                    $('#fee').val(data);
                                                                                                }
                                                                                            })
                                                                                        });


                                                                                        $('#extend').on("change keyup paste click", function() {
                                                                                            var extend = $('#extend').val();
                                                                                            var repayment_date = $('#repayment_date').val();
                                                                                            $.ajax({
                                                                                                url: "functions/system/ajax_functions/reschedule_date.php",
                                                                                                method: "POST",
                                                                                                data: {
                                                                                                    repayment_date: repayment_date,
                                                                                                    extend: extend
                                                                                                },
                                                                                                success: function(data) {
                                                                                                    $('#newDate').html(data);
                                                                                                }
                                                                                            })
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                                <div id="newDate"></div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Reschedule</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!-- /reschedule ends here -->
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /modal ends here -->
                                            <!-- Modal -->
                                            <form action="functions/business/fixed_deposit/edit_loan.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                <div class="modal fade" id="editLoan<?php echo $investment['idinvestment'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Book Loan</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="text" value="<?php echo $investorNAME ?>" name="client" hidden>
                                                                <input type="text" value="<?php echo $investment['idinvestment'] ?>" name="loan" hidden>
                                                                <div class="form-group">
                                                                    <label for="">Old Principal</label>
                                                                    <input type="text" class="form-control form-control-user" name="old_principal" value="<?php echo number_format($investment['amount'], 2) ?>" readonly>
                                                                </div>
                                                                <div class="form--group">
                                                                    <label for="">Old Interest</label>
                                                                    <input type="text" class="form-control form-control-user" name="old_interest" value="<?php echo number_format($investment['interest_amount'], 2) ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">New Principal</label>
                                                                    <input type="text" class="form-control form-control-user" id="new_principal" name="principal" placeholder="New Principal....">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">New Interest</label>
                                                                    <input type="text" class="form-control form-control-user" id="new_interest" name="interest" placeholder="New Interest Rate....">
                                                                </div>

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $('#new_principal').on("change blur", function() {
                                                                            var amount = $(this).val();
                                                                            $.ajax({
                                                                                url: "functions/system/converter.php",
                                                                                method: "POST",
                                                                                data: {
                                                                                    amount: amount
                                                                                },
                                                                                success: function(data) {
                                                                                    $('#new_principal').val(data);
                                                                                }
                                                                            })
                                                                        });

                                                                        $('#new_interest').on("change blur", function() {
                                                                            var amount = $(this).val();
                                                                            $.ajax({
                                                                                url: "functions/system/converter.php",
                                                                                method: "POST",
                                                                                data: {
                                                                                    amount: amount
                                                                                },
                                                                                success: function(data) {
                                                                                    $('#new_interest').val(data);
                                                                                }
                                                                            })
                                                                        });

                                                                    });
                                                                </script>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- /modal ends here -->
                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>



                    <?php
                    } else {
                    ?>
                        CLIENT HAS NO EXISTING LOANS
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- /loan info -->


        <!-- Add fancyBox -->
        <link rel="stylesheet" href="assets/fancybox-2.1.7/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="assets/fancybox-2.1.7/source/jquery.fancybox.js"></script>
        <script type="text/javascript" src="assets/fancybox-2.1.7/source/jquery.fancybox.pack.js"></script>

        <style>
            .fileinput .thumbnail {
                display: inline-block;
                margin-bottom: 10px;
                overflow: hidden;
                text-align: center;
                vertical-align: middle;
                max-width: 250px;
                box-shadow: 0 10px 30px -12px rgba(0, 0, 0, .42), 0 4px 25px 0 rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
            }

            .thumbnail {
                border: 0 none;
                border-radius: 4px;
                padding: 0;
            }

            .fileinput .thumbnail>img {
                max-height: 100%;
                width: 100%;
            }

            html * {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            .gallery {
                display: inline-block;
            }

            .close-icon {
                border-radius: 50%;
                position: absolute;
                right: 5px;
                top: -10px;
                padding: 0.1px;
                cursor: pointer;
            }
        </style>
        <!-- Documents -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div style="float:left">
                        <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                    </div>
                    <div style="float:right">
                        <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                            <span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Upload file</span>
                        </a>
                    </div>
                    <!-- Modal -->
                    <form action="functions/system/image_upload.php" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Document</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <input type="text" value="<?php echo $investorId ?>" name="client" hidden>
                                        <div class="form-group">
                                            <input type="file" class="form-control form-control-user" name="image" placeholder="" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" id="upload-image" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /modal ends here -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        $findImages = selectAll('images', ['customers_idcustomers' => $investorId]);
                        foreach ($findImages as $image) {
                        ?>
                            <div class='col-md-4 mt-3'>
                                <a class="fancybox" rel="group" href="uploads/<?php echo $image['image_name'] ?>">
                                    <img class="img-fluid" alt="" src="uploads/<?php echo $image['image_name'] ?>" />
                                </a>
                                <form action="functions/system/image_delete.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $image['idimages'] ?>">
                                    <input type="hidden" name="client_id" value="<?php echo $image['customers_idcustomers']; ?>">
                                    <button type="submit" id="delete-image" class="close-icon" onclick="return confirm('Are you sure you want to delete this image?')">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </form>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /documents -->
    </div>

</div>
<!-- /.container-fluid -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });

        $("#delete-image").click(function() {

        });
    });
</script>

<?php

include('footer.php');

?>