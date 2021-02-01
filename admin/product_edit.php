<?php
require('includes/connection.php');

// fetch old data
$query = "select * from product where product_id = {$_GET['id']}";

/** @var TYPE_NAME $conn */
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$image_source = $row['product_image'];


$query = "select category_id from category_product where product_id = {$_GET['id']}";

$selected_category = mysqli_query($conn, $query);
$fetched_data = mysqli_fetch_all($selected_category);
//$fetched_data = json_encode($fetched_data);
//echo "<script>console.log($fetched_data)</script>";


if (isset($_POST['submit'])) {
    $cat_name = $_POST['cat_name'];
    $pro_name = $_POST['pro_name'];
    if ($filename = $_FILES["image"]["name"]) {

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "images/" . $filename;

    } else {
        $filename = $image_source;
    }


    $query = "UPDATE product SET product_name = '$pro_name',
	                           product_image = '$filename'
	                           WHERE product_id = {$_GET['id']}";

    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn, $query);

    $query = "DELETE FROM category_product WHERE product_id = {$_GET['id']}";
    mysqli_query($conn, $query);


    $fetched_data = json_encode($_POST['cat_name']);
    echo "<script>console.log($fetched_data)</script>";
    foreach ($_POST['cat_name'] as $value) {
        $query = "INSERT INTO category_product(product_id, category_id)
	         values('{$_GET['id']}', '$value')";
        mysqli_query($conn, $query);
    }

    header("location:manage_products.php");

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
                                        <input type="text" id="pro_name" value="<?php echo $row['product_name'] ?>"
                                               name="pro_name" placeholder="category name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <input type="file" accept="image/*" id="image" name="image" placeholder="Image"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group justify-content-center align-items-center">
                                        <img src="images/<?php echo $image_source ?>" width="100px" height="100px">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="multiple-select" class=" form-control-label">Select Category</label>
                                    </div>
                                    <!--                                                                        if($fetched_data['category_id'] == $row['category_id']) {-->
                                    <!--                                                                        echo "<option selected value='{$row['category_id']}'>{$row['category_name']}</option>";-->
                                    <!--                                                                        }else {-->
                                    <!--                                                                        echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";-->
                                    <!--                                                                        }-->
                                    <div class="col col-md-9">
                                        <select name="cat_name[]" id="multiple-select" multiple="" class="form-control">
                                            <?php
                                            $query = "select * from category";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_all($result);

                                            foreach ($row as $k => $value) {

                                                if (count($fetched_data) != 1) {
                                                    if ($fetched_data[$k][0] == $value[0]) {
                                                        echo 1;
                                                        echo "<option selected value='{$value[0]}'>{$value[1]}</option>";
                                                    } else {
                                                        echo "<option value='{$value[0]}'>{$value[1]}</option>";

                                                    }
                                                } else {
                                                    if ($fetched_data[0][0] == $value[0]) {
                                                        echo 1;
                                                        echo "<option selected value='{$value[0]}'>{$value[1]}</option>";
                                                    } else {
                                                        echo "<option value='{$value[0]}'>{$value[1]}</option>";

                                                    }
                                                }

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

            <!-- END DATA TABLE-->
        </div>
    </div>
</div>
</div>
</div>


<?php include('includes/admin_footer.php'); ?>

