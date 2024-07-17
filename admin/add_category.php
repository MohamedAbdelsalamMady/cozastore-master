<?php
//Protecting Code In all admin pages
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../server/connect.php';

if (isset($_POST['add_category'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);

    $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql = "select * from category where id = ".$id;
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $sql = "delete from category where id=".$id;
    if(mysqli_query($conn, $sql)){
      header('location:add_category.php');
    }
  }
}

$sql = "SELECT * FROM category";
$category_result = mysqli_query($conn, $sql);
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
              <h3 class="fw-bold mb-3">Add Category</h3>
            </div>
          </div>

<div class="add-category">
    <form action="" method="post">
        <div class="row">
        <div class="col">
            <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="" />
                        </div>
        </div>
        <div class="col">
        <button type="submit" name="add_category" class="btn btn-primary" style="margin-top: 8%;">Add Category</button>
        </div>
    </div>
    </form>
    
</div>

<div class="show-category">
<table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($category_result) > 0): ?>
                <?php 
                  $counter = 1;
                  while ($row = mysqli_fetch_assoc($category_result)): ?>
                  <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td>
                    <a href="add_category.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8">No record found</td>
                </tr>
              <?php endif; ?>
                  
                </tbody>
              </table>
</div>
          


        </div>
      </div>
    </div>

  </div>

  <?php
@include('component/admin_script.php');

?>
</body>

</html>