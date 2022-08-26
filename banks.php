<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">BANKS MANAGEMENT</h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Bank</h6>
                </div>
                <div class="card-body">
                    <form class="user" autocomplete="off" method="POST" action="functions/business/banks/create_bank.php">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="bank_name" placeholder="Bank Name..." required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="description" placeholder="Description">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="branch" placeholder="Branch" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="location" placeholder="Branch address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="pc_name" placeholder="Primary Contact Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="pc_email" aria-describedby="emailHelp" placeholder="Primary Contact Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="pc_phone" placeholder="Primary Contact Phone" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="pc_name2" placeholder="2nd Primary Contact Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="pc_email2" aria-describedby="emailHelp" placeholder="2nd Primary Contact Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="pc_phone2" placeholder="Primary Contact Phone">
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
        <!-- lists of banks -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Banks</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $findbank = selectAll('banks');
                                foreach ($findbank as $bank) {
                                ?>
                                    <tr>
                                        <td><?php echo $bank['name'] ?></td>
                                        <td><?php echo $bank['description'] ?></td>
                                        <td>
                                            <a href="bank_view.php?view=<?php echo $bank['idbanks'] ?>" class="btn btn-info btn-icon-split">
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