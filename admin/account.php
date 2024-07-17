<?php

//Protecting Code
//In all admin pages
@require_once ('../server/connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $first_name, $last_name, $email, $user_id);

    if ($stmt->execute()) {
        echo 'Account updated successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }
    $stmt->close();
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
              <h3 class="fw-bold mb-3">Accout Settings</h3>
            </div>
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