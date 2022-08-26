<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">CLIENT MANAGEMENT</h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create New Client</h6>
                </div>
                <div class="card-body">
                    <form class="user" autocomplete="off" method="POST" action="functions/people/customers/create_client.php">
                        <!-- <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="username" placeholder="username" required>
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="firstname" placeholder="Firstname" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="middlename" placeholder="Middlename">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="lastname" placeholder="Lastname" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control form-control-user" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="bvn" placeholder="BVN">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="account" placeholder="Account Number" required>
                        </div>
                        <div class="form-group">
                            <label for="">Bank</label>
                            <select name="designation" id="bank" class="form-control">
                                <?php
                                $findDesignation =  selectAll('banks');
                                foreach ($findDesignation as $role) {
                                ?>
                                    <option value="<?php echo $role['idbanks'] ?>"><?php echo $role['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="branch"></div>
                        <script>
                            $(document).ready(function() {
                                $('#bank').on("click", function() {
                                    var bank = $(this).val();
                                    $.ajax({
                                        url: "functions/system/ajax_functions/branches_drop.php",
                                        method: "POST",
                                        data: {
                                            bank: bank
                                        },
                                        success: function(data) {
                                            $('#branch').html(data);
                                        }
                                    })
                                });
                            });
                        </script>
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
                    <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Bank</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Bank</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findclient = selectAll('customers', ['isapproved' => 1]);
                                foreach ($findclient as $client) {
                                ?>
                                    <tr>
                                        <td><?php echo $client['firstname'] . " " . $client['middlename'] . " " . $client['lastname'] ?></td>
                                        <td><?php
                                            $branch = $client['branches_idbranches'];
                                            $findBranch = selectOne('branches',  ['idbranches' => $branch]);
                                            $bank = $findBranch['banks_idbanks'];
                                            $findBank = selectOne('banks',  ['idbanks' => $bank]);
                                            echo $findBank['name']. " - " .$findBranch['branch_name'];
                                            ?></td>
                                        <td>
                                            <a href="client_view.php?view=<?php echo $client['idcustomers'] ?>" class="btn btn-info btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">View</span>
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