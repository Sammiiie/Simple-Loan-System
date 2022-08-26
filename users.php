<?php

include('header.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">USER MANAGEMENT</h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create New User</h6>
                </div>
                <div class="card-body">
                    <form class="user" autocomplete="off" method="POST" action="functions/people/users/create_user.php">
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
                            <label for="">Designation</label>
                            <select name="designation" id="" class="form-control">
                                <?php
                                $findDesignation =  selectAll('designation');
                                foreach ($findDesignation as $role) {
                                ?>
                                    <option value="<?php echo $role['iddesignation'] ?>"><?php echo $role['role'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control form-control-user" name="phone" placeholder="Phone" required>
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
                    <h6 class="m-0 font-weight-bold text-primary">User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th></th>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php
                                $finduser = selectAll('users');
                                foreach ($finduser as $user) {
                                ?>
                                    <tr>
                                        <td><?php echo $user['firstname'] . " " . $user['middlename'] . " " . $user['lastname'] ?></td>
                                        <td><?php
                                            $designation = $user['designation_iddesignation'];
                                            $findRole = selectOne('designation',  ['iddesignation' => $designation]);
                                            echo $findRole['role'];
                                            ?></td>
                                        <td>
                                            <a href="user_view.php?view=<?php echo $user['idusers'] ?>" class="btn btn-info btn-icon-split">
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