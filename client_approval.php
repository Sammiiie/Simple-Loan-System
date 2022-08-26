<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">APPROVE CLIENTS</h1>

    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Approval</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Agent Name</th>
                                    <th>Agent Contact</th>
                                    <th>Bank</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Agent Name</th>
                                    <th>Agent Contact</th>
                                    <th>Bank</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findclient = selectAll('customers', ['isapproved' => 0]);
                                foreach ($findclient as $client) {
                                ?>
                                    <tr>
                                        <td><?php echo $client['firstname'] . " " . $client['middlename'] . " " . $client['lastname'] ?></td>
                                        <th><?php echo $client['phone'] . " - " . $client['email'] ?></th>
                                        <th><?php echo $client['agent_name'] ?></th>
                                        <th><?php echo $client['agent_phone'] ?></th>
                                        <td><?php
                                            $branch = $client['branches_idbranches'];
                                            $findBranch = selectOne('branches',  ['idbranches' => $branch]);
                                            $bank = $findBranch['banks_idbanks'];
                                            $findBank = selectOne('banks',  ['idbanks' => $bank]);
                                            echo $findBank['name'] . " - " . $findBranch['branch_name'];
                                            ?></td>
                                        <td>
                                            <!-- <div style="float:left"> -->
                                                <?php
                                                if ($findRights['approval'] == 1) {
                                                ?>
                                                    <a href="functions/people/customers/approve_client.php?approve=<?php echo $client['idcustomers'] ?>" class="btn btn-success btn-circle">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <a href="functions/people/customers/reject_client.php?reject=<?php echo $client['idcustomers'] ?>" class="btn btn-danger btn-circle">
                                                        <i class="fas fa-flag"></i>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            <!-- </div> -->
                                            <!-- <div style="float:right"> -->
                                                <a href="#" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#create<?php echo $client['idcustomers'] ?>">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            <!-- </div> -->
                                            <!-- Modal -->
                                            <form action="functions/people/customers/edit_client.php" method="post" enctype="multipart/form-data">
                                                <div class="modal fade" id="create<?php echo $client['idcustomers'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <input type="text" value="<?php echo $client['idcustomers'] ?>" name="client_id" hidden>
                                                                <div class="form-group">
                                                                    <label for="">Firstname</label>
                                                                    <input type="text" class="form-control form-control-user" name="firstname" value="<?php echo $client['firstname'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Middlename</label>
                                                                    <input type="text" class="form-control form-control-user" name="middlename" value="<?php echo $client['middlename'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Lastname</label>
                                                                    <input type="text" class="form-control form-control-user" name="lastname" value="<?php echo $client['lastname'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Email</label>
                                                                    <input type="text" class="form-control form-control-user" name="email" aria-describedby="emailHelp" value="<?php echo $client['email'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Phone</label>
                                                                    <input type="tel" class="form-control form-control-user" name="phone" value="<?php echo $client['phone'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Address</label>
                                                                    <input type="text" class="form-control form-control-user" name="address" value="<?php echo $client['address'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">BVN</label>
                                                                    <input type="text" class="form-control form-control-user" name="bvn" value="<?php echo $client['bvn'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Account Number</label>
                                                                    <input type="text" class="form-control form-control-user" name="account" value="<?php echo $client['account_number'] ?>" required>
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
                                            <!-- /modal ends here -->
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