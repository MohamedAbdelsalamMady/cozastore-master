<?php

//Protecting Code
//In all admin pages
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    exit();
}


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
              <h3 class="fw-bold mb-3">Show Products</h3>
            </div>
          </div>


          <!--Content Here !!!!!!-->


        </div>
      </div>
    </div>

  </div>

  <?php
@include('component/admin_script.php');

?>
</body>

</html>