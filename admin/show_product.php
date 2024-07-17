<?php

//Protecting Code
//In all admin pages
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    exit();
}
  require_once '../server/connect.php';
  $upload_dir = 'uploadimage/'; // Added trailing slash
  $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $records_per_page = 8;
  $offset = ($page - 1) * $records_per_page;

  $sql = "
    SELECT products.*, category.category_name 
    FROM products 
    JOIN category ON products.category_id = category.id
    WHERE products.product_name LIKE '%$search%'
    OR products.description LIKE '%$search%'
    OR category.category_name LIKE '%$search%'
    LIMIT $offset, $records_per_page
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($conn));
}


  $count_sql = "
  SELECT COUNT(*) as total
  FROM products 
  JOIN category ON products.category_id = category.id
  WHERE products.product_name LIKE '%$search%'
  OR products.description LIKE '%$search%'
  OR category.category_name LIKE '%$search%'
";

$count_result = mysqli_query($conn, $count_sql);

if (!$count_result) {
  die('Error: ' . mysqli_error($conn));
}

$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total'];
$total_pages = ceil($total_records / $records_per_page);

  if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$sql = "select * from products where id = ".$id;
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$image = $row['image'];
			unlink($upload_dir.$image);
			$sql = "delete from products where id=".$id;
			if(mysqli_query($conn, $sql)){
				header('location:show_product.php');
			}
		}
	}

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

<style>
 
</style>
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

        <div class="row">
          <div class="col">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Show Products</h3>
            </div>
          </div>
          </div>
          <div class="col">
            <div class="d-flex align-items-right align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <a href="add_product.php" class="btn btn-primary">Add Product</a>
            </div>
          </div>
          </div>
        </div>

        <form method="GET" action="show_product.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search products..." name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>

        

        <?php if (isset($errorMsg)): ?>
            <div class="alert alert-danger">
              <?php echo $errorMsg; ?>
            </div>
          <?php endif; ?>

          <table class="table table-head-bg-primary mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="font-size: 10px;">Product Name</th>
                <th scope="col" style="font-size: 10px;">Description</th>
                <th scope="col" style="font-size: 10px;">Price</th>
                <th scope="col" style="font-size: 10px;">Color</th>
                <th scope="col" style="font-size: 10px;">Special Offer</th>
                <th scope="col" style="font-size: 10px;">Stock</th>
                <th scope="col" style="font-size: 10px;">Category</th>
                <th scope="col" style="font-size: 10px;">Image</th>
                <th scope="col" style="font-size: 10px;">Action</th>
              </tr>
            </thead>
            <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php 
                                $counter = $offset + 1;
                                while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td style="font-size: 10px;"><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['color']; ?></td>
                                    <td><?php echo $row['special_offer']; ?></td>
                                    <td><?php echo $row['stock']; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td>
                                        <img src="<?php echo $upload_dir . $row['image']; ?>" height="100">
                                    </td>
                                    <td>
                                        <a href="edit_product.php?id=<?php echo $row['id'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
                                        <a href="show_product.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10">No products found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
          </table>

          <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="show_product.php?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>



        </div>
      </div>
    </div>

  </div>

  <?php
@include('component/admin_script.php');

?>
</body>

</html>