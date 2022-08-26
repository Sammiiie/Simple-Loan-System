<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">INVESTOR MANAGEMENT</h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create New Investor</h6>
                </div>
                <div class="card-body">
                    <form class="user" autocomplete="off" method="POST" action="functions/people/customers/create_investors.php">
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
                            <input type="text" class="form-control form-control-user" name="bank" placeholder="Bank">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="bank_accounr" placeholder="Bank Account">
                        </div>
                

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
                    <h6 class="m-0 font-weight-bold text-primary">Investors</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findInvestor = selectAll('fixed_deposit');
                                foreach ($findInvestor as $investor) {
                                ?>
                                    <tr>
                                        <td><?php echo $investor['name'] ?></td>
                                        <td><?php echo $investor['email'] ?></td>
                                        <td><?php echo $investor['phone_no'] ?></td>
                                        <td>
                                            <a href="investor_view.php?view=<?php echo $investor['idfixed_deposit'] ?>" class="btn btn-info btn-icon-split">
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