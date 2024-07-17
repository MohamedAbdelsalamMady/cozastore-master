<?php
//Protecting Code
//In all admin pages
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../server/connect.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (!$result) {
    $errorMsg = 'Error: ' . mysqli_error($conn);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $userType = $_POST['user_type'];

    $sql = "UPDATE users SET user_type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $userType, $userId);

    if ($stmt->execute()) {
        echo 'User type updated successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
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
                            <h3 class="fw-bold mb-3">Show Users</h3>
                        </div>
                    </div>

                    <?php if (isset($errorMsg)) : ?>
                        <div class="alert alert-danger">
                            <?php echo $errorMsg; ?>
                        </div>
                    <?php endif; ?>

                    <table class="table table-head-bg-primary mt-4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Password</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) : ?>
                                <?php
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <form class="update-user-type-form" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                                <select name="user_type" onchange="this.form.submit()">
                                                    <option value="user" <?php if ($row['user_type'] == 'user') echo 'selected'; ?>>User</option>
                                                    <option value="admin" <?php if ($row['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td><?php echo $row['password']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary update-user-type" data-id="<?php echo $row['id']; ?>">Update</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8">No products found</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>

    <?php
    @include('component/admin_script.php');

    ?>
    <script>
        document.querySelectorAll('.update-user-type').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.id;
                const userTypeSelect = document.querySelector(`form input[value="${userId}"]`).closest('form').querySelector('select');

                const formData = new FormData();
                formData.append('user_id', userId);
                formData.append('user_type', userTypeSelect.value);

                fetch('update_user_type.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        alert('User type updated successfully');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating user type');
                    });
            });
        });
    </script>
    <script>
         document.querySelectorAll('.update-user-type-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const userId = formData.get('user_id');
                const userType = formData.get('user_type');

                fetch('update_user_type.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    alert('User type updated successfully');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating user type');
                });
            });
        });
    </script>
</body>

</html>