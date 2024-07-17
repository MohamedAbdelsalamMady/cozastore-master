<?php
// Protecting Code In all admin pages
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    exit();
}

@include '../server/connect.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    header("Location: show_product.php");
    exit();
}

// Fetch product data
$product_sql = "SELECT * FROM products WHERE id = $product_id";
$product_result = mysqli_query($conn, $product_sql);

if (mysqli_num_rows($product_result) == 0) {
    header("Location: show_product.php");
    exit();
}

$product = mysqli_fetch_assoc($product_result);

// Define upload directory
$upload_dir = 'uploadimage/';

if (isset($_POST['update'])) {
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
        if (!empty($image)) {
            $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            $allowExt = array('jpeg', 'jpg', 'png', 'gif');
            $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

            if (in_array($imgExt, $allowExt)) {
                if ($imgSize < 5000000) {
                    move_uploaded_file($imgTmp, $upload_dir . $userPic);
                    if (!empty($product['image']) && file_exists($upload_dir . $product['image'])) {
                        unlink($upload_dir . $product['image']);
                    }
                } else {
                    $errorMsg = 'Image too large';
                }
            } else {
                $errorMsg = 'Please select a valid image';
            }
        } else {
            $userPic = $product['image'];
        }
    }

    if (!isset($errorMsg)) {
        $sql = "UPDATE products 
                SET product_name = '$product_name', description = '$description', price = '$price', color = '$color', 
                    special_offer = '$special_offer', stock = '$stock', image = '$userPic', category_id = '$category_id', updated_at = NOW() 
                WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $successMsg = 'Record updated successfully';
            header('Location: edit_product.php?id=' . $product_id);
            exit();
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
              <h3 class="fw-bold mb-3">Edit Products</h3>
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
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" />
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                                    <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                                        <?php echo $category['category_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Color Input</label>
                            <div class="row gutters-xs">
                                <?php
                                $colors = ['Black', 'Regular Blue', 'Violit', 'info', 'lightblue', 'green', 'red', 'default'];
                                foreach ($colors as $color) {
                                    $checked = $product['color'] == $color ? 'checked' : '';
                                    echo "
                                    <div class='col-auto'>
                                        <label class='colorinput'>
                                            <input name='color' type='radio' value='$color' class='colorinput-input' $checked />
                                            <span class='colorinput-color bg-$color'></span>
                                        </label>
                                    </div>
                                    ";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="special_offer">Special Offer</label>
                            <input type="number" class="form-control" id="special_offer" name="special_offer" value="<?php echo htmlspecialchars($product['special_offer']); ?>" />
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" />
                        </div>

                        <div class="form-group">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" />
                            <?php if (!empty($product['image'])): ?>
                                <img src="<?php echo $upload_dir . $product['image']; ?>" height="100">
                            <?php endif; ?>
                        </div>

                        <button class="btn btn-black" type="submit" name="update">
                            <span class="btn-label">
                                <i class="fa fa-save"></i>
                            </span>
                            Update Product
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