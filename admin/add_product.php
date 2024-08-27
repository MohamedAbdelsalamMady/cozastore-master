<?php
//Protecting Code In all admin pages
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin' ) {
    header("Location: index.php");
    exit();
}

@include '../server/connect.php';

if (isset($_POST['upload'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name'] ?? '');
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $price = mysqli_real_escape_string($conn, $_POST['price'] ?? '');
    $color = mysqli_real_escape_string($conn, $_POST['color'] ?? '');
    $special_offer = mysqli_real_escape_string($conn, $_POST['special_offer'] ?? '');
    $stock = mysqli_real_escape_string($conn, $_POST['stock'] ?? '');
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id'] ?? '');
    $image = $_FILES['image']['name'] ?? '';
    $imgTmp = $_FILES['image']['tmp_name'] ?? '';
    $imgSize = $_FILES['image']['size'] ?? 0;

    $upload_dir = 'uploadimage/';  // Add trailing slash

    if (empty($product_name)) {
        $errorMsg = 'Please input name';
    } elseif (empty($description)) {
        $errorMsg = 'Please input description';
    } elseif (empty($price)) {
        $errorMsg = 'Please input price';
    } elseif (empty($color)) {
        $errorMsg = 'Please input color';
    } elseif (empty($special_offer)) {
        $errorMsg = 'Please input special offer';
    } elseif (empty($stock)) {
        $errorMsg = 'Please input stock';
    } elseif (empty($category_id)) {
        $errorMsg = 'Please select a category';
    } else {
        $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowExt = array('jpeg', 'jpg', 'png', 'gif');
        $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

        if (in_array($imgExt, $allowExt)) {
            if ($imgSize < 5000000) {
                move_uploaded_file($imgTmp, $upload_dir . $userPic);
            } else {
                $errorMsg = 'Image too large';
            }
        } else {
            $errorMsg = 'Please select a valid image';
        }
    }

    if (!isset($errorMsg)) {
        $sql = "INSERT INTO products (product_name, description, price, color, special_offer, stock, image, category_id, created_at, updated_at) 
                VALUES ('$product_name', '$description', '$price', '$color', '$special_offer', '$stock', '$userPic', '$category_id', NOW(), NOW())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $successMsg = 'New record added successfully';
            header('Location: add_product.php');
            exit;  // Ensure no further code is executed
        } else {
            $errorMsg = 'Error ' . mysqli_error($conn);
        }
    }
}

// Fetch categories for the dropdown
$category_result = mysqli_query($conn, "SELECT * FROM category");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Coza Store Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <?php
    @include('component/admin_links.php')
    ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
        @include('component/admin_sidebard.php');
        ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <?php
            @include('component/admin_header.php');
            ?>

            <div class="container">
                <div class="page-inner">

                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Add Products</h3>
                        </div>
                    </div>

                    <?php if (isset($errorMsg)): ?>
                        <div class="alert alert-danger">
                            <?php echo $errorMsg; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($successMsg)): ?>
                        <div class="alert alert-success">
                            <?php echo $successMsg; ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="" />
                        </div>
                        <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" id="category_id" name="category_id">
            <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>

                        <div class="form-group">
                            <label for="comment">Discription</label>
                            <textarea class="form-control" id="description" name="description" rows="5">
                          </textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Color Input</label>
                            <div class="row gutters-xs">
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="Black" class="colorinput-input" />
                                        <span class="colorinput-color bg-black"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" type="radio" value="Regular Blue" class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" id="color" type="radio" value="Violit" class="colorinput-input" />
                                        <span class="colorinput-color bg-secondary"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" id="color" type="radio" value="info" class="colorinput-input" />
                                        <span class="colorinput-color bg-info"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" id="color" type="radio" value="lightblue" class="colorinput-input" />
                                        <span class="colorinput-color bg-success"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" id="color" type="radio" value="green" class="colorinput-input" />
                                        <span class="colorinput-color bg-danger"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" id="color" type="radio" value="red" class="colorinput-input" />
                                        <span class="colorinput-color bg-warning"></span>
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <label class="colorinput">
                                        <input name="color" id="color" type="radio" value="default" class="colorinput-input" />
                                        <span class="colorinput-color bg-light"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price">Special Offer</label>
                            <input type="number" class="form-control" id="special_offer" name="special_offer" placeholder="" />
                        </div>

                        <div class="form-group">
                            <label for="price">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="" />
                        </div>

                        

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" id="exampleFormControlFile1"  />
                        </div>

                        

                        <button class="btn btn-black" type="upload" name="upload">
                            <span class="btn-label">
                                <i class="fa fa-archive"></i>
                            </span>
                           Add Product
                        </button>

                    </form>




                </div>
            </div>
        </div>

    </div>

    <?php
    @include('component/admin_script.php');

    ?>
</body>

</html>