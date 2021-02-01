<?php
require('includes/connection.php');

if (isset($_POST['submit'])) {
    $pro_name = $_POST['pro_name'];
    $cat_id = $_POST['cat_name'];
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/".$filename;

    print_r($_POST['cat_name']);
    $test = json_encode($_POST);
    echo "<script> console.log($test)</script>";


    $query = "INSERT INTO product(product_name, product_image)
	         values('$pro_name', '$filename')";

    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);
    $id =  $conn -> insert_id;
    foreach ($_POST['cat_name'] as $value ) {
        $query = "INSERT INTO category_product(product_id, category_id)
	         values('$id', '$value')";
         mysqli_query($conn, $query);
    }


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
                                        <input type="text" id="pro_name" name="pro_name" placeholder="product name" class="form-control">
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
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="multiple-select" class=" form-control-label">Select Category</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <select name="cat_name[]"  id="multiple-select" multiple="" class="form-control">
                                            <?php
                                            $query = "select * from category";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                            }
                                            ?>
                                        </select>
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
                            $query = "select * from product";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['product_name']}</td>";
                                echo "<td><img size='cover' height='100px' width='100px' src='images/{$row['product_image']}'></td>";
                                echo "<td><a href='product_edit.php?id={$row['product_id']}' class='btn btn-warning'>Edit</a>
                                      <a href='product_delete.php?id={$row['product_id']}' class='btn btn-danger'>Delete</a>
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

