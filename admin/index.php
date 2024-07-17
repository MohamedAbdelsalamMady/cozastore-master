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
              <h3 class="fw-bold mb-3">Dashboard</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <a href="add_product.php" class="btn btn-primary btn-round">Add Product</a>
            </div>
          </div>


          <?php
          @include('component/widget.php')
          ?>

          <div class="row">
            <div class="col-md-12">
              <table class="table table-head-bg-primary mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="card card-round">
                <div class="card-body">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Customers</div>
                    <div class="card-tools">
                      <div class="dropdown">
                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-list py-4">
                    <div class="item-list">
                      <div class="avatar">
                        <img src="assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>
                      <div class="info-user ms-3">
                        <div class="username">Jimmy Denis</div>
                        <div class="status">Graphic Designer</div>
                      </div>
                      <button class="btn btn-icon btn-link op-8 me-1">
                        <i class="far fa-envelope"></i>
                      </button>
                      <button class="btn btn-icon btn-link btn-danger op-8">
                        <i class="fas fa-ban"></i>
                      </button>
                    </div>
                    <div class="item-list">
                      <div class="avatar">
                        <span class="avatar-title rounded-circle border border-white">CF</span>
                      </div>
                      <div class="info-user ms-3">
                        <div class="username">Chandra Felix</div>
                        <div class="status">Sales Promotion</div>
                      </div>
                      <button class="btn btn-icon btn-link op-8 me-1">
                        <i class="far fa-envelope"></i>
                      </button>
                      <button class="btn btn-icon btn-link btn-danger op-8">
                        <i class="fas fa-ban"></i>
                      </button>
                    </div>
                    <div class="item-list">
                      <div class="avatar">
                        <img src="assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>
                      <div class="info-user ms-3">
                        <div class="username">Talha</div>
                        <div class="status">Front End Designer</div>
                      </div>
                      <button class="btn btn-icon btn-link op-8 me-1">
                        <i class="far fa-envelope"></i>
                      </button>
                      <button class="btn btn-icon btn-link btn-danger op-8">
                        <i class="fas fa-ban"></i>
                      </button>
                    </div>
                    <div class="item-list">
                      <div class="avatar">
                        <img src="assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle" />
                      </div>
                      <div class="info-user ms-3">
                        <div class="username">Chad</div>
                        <div class="status">CEO Zeleaf</div>
                      </div>
                      <button class="btn btn-icon btn-link op-8 me-1">
                        <i class="far fa-envelope"></i>
                      </button>
                      <button class="btn btn-icon btn-link btn-danger op-8">
                        <i class="fas fa-ban"></i>
                      </button>
                    </div>
                    <div class="item-list">
                      <div class="avatar">
                        <span class="avatar-title rounded-circle border border-white bg-primary">H</span>
                      </div>
                      <div class="info-user ms-3">
                        <div class="username">Hizrian</div>
                        <div class="status">Web Designer</div>
                      </div>
                      <button class="btn btn-icon btn-link op-8 me-1">
                        <i class="far fa-envelope"></i>
                      </button>
                      <button class="btn btn-icon btn-link btn-danger op-8">
                        <i class="fas fa-ban"></i>
                      </button>
                    </div>
                    <div class="item-list">
                      <div class="avatar">
                        <span class="avatar-title rounded-circle border border-white bg-secondary">F</span>
                      </div>
                      <div class="info-user ms-3">
                        <div class="username">Farrah</div>
                        <div class="status">Marketing</div>
                      </div>
                      <button class="btn btn-icon btn-link op-8 me-1">
                        <i class="far fa-envelope"></i>
                      </button>
                      <button class="btn btn-icon btn-link btn-danger op-8">
                        <i class="fas fa-ban"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Order History</div>
                    <div class="card-tools">

                    </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Payment Number</th>
                          <th scope="col" class="text-end">Date & Time</th>
                          <th scope="col" class="text-end">Amount</th>
                          <th scope="col" class="text-end">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">
                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                              <i class="fa fa-check"></i>
                            </button>
                            Payment from #10231
                          </th>
                          <td class="text-end">Mar 19, 2020, 2.45pm</td>
                          <td class="text-end">$250.00</td>
                          <td class="text-end">
                            <span class="badge badge-success">Completed</span>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        </div>
      </div>


    </div>


  </div>
  <!--   Core JS Files   -->
<?php
@include('component/admin_script.php');

?>
</body>

</html>