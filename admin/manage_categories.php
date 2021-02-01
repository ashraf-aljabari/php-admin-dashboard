<?php
require('includes/connection.php');

if (isset($_POST['submit'])) {
    $cat_name = $_POST['cat_name'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/".$filename;


    $query = "INSERT INTO category(category_name, category_image)
	         values('$cat_name', '$filename')";

    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
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
                            <form action="" enctype="multipart/form-data" method="post" class="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clipboard"></i>
                                        </div>
                                        <input type="text" id="cat_name" name="cat_name" placeholder="category name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <input type="file" accept="image/*" id="image" name="image" placeholder="Image" class="form-control">
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
                                <th>category name</th>
                                <th>category image</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "select * from category";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['category_name']}</td>";
                                echo "<td><img size='cover' height='100px' width='100px' src='images/{$row['category_image']}'></td>";
                                echo "<td><a href='category_edit.php?id={$row['category_id']}' class='btn btn-warning'>Edit</a>
                                      <a href='category_delete.php?id={$row['category_id']}' class='btn btn-danger'>Delete</a>
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

