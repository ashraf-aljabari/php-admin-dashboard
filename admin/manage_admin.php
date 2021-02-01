<?php
require('includes/connection.php');

if (isset($_POST['submit'])) {
    // fetch data from form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];


    $query = "INSERT INTO admin(admin_email,admin_password,admin_fullname)
	         values('$email','$password','$fullname')";
    mysqli_query($conn, $query);

}


include('includes/admin_header.php'); ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Example Form</div>
                    <div class="card-body card-block">
                        <form action="" method="post" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-asterisk"></i>
                                    </div>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block"
                                        name="submit">Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="row m-t-30 justify-content-center">
                <div class="col-md-8">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Full name</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "select * from admin";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['admin_email']}</td>";
                                echo "<td>{$row['admin_fullname']}</td>";
                                echo "<td><a href='edit_admin.php?id={$row['admin_id']}' class='btn btn-warning'>Edit</a>
                                      <a href='delete_admin.php?id={$row['admin_id']}' class='btn btn-danger'>Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->

                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/admin_footer.php'); ?>

