<?php
require('includes/connection.php');

// fetch old data
$query  = "select * from category where category_id = {$_GET['id']}";
/** @var TYPE_NAME $conn */
$result = mysqli_query($conn,$query);
$row    = mysqli_fetch_assoc($result);
$image_source = $row['category_image'];

if(isset($_POST['submit'])){
    $cat_name = $_POST['cat_name'];
    if($filename = $_FILES["image"]["name"]) {

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "images/" . $filename;

    }else {
        $filename = $image_source;
    }




    $query = "UPDATE category SET category_name = '$cat_name',
	                           category_image = '$filename'
	                           WHERE category_id = {$_GET['id']}";

    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
    /** @var TYPE_NAME $conn */
    mysqli_query($conn,$query);
    header("location:manage_categories.php");

}



include('includes/admin_header.php');  ?>
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
                                        <input type="text" id="cat_name" value="<?php echo $row['category_name'] ?>" name="cat_name" placeholder="category name" class="form-control">
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
                                <div class="form-group">
                                    <div class="input-group justify-content-center align-items-center">
                                        <img src="images/<?php echo $image_source ?>" width="100px" height="100px">
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



<?php include('includes/admin_footer.php');  ?>

