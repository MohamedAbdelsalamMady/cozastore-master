<?php
@require_once ('server/connect.php');
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
	<title>Coza Store</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<?php
	@include('component/css.php');
	?>

</head>
<body class="animsition">
<!-- Header -->
<?php
@include('component/header-v4.php');
?>



    <div class="container-account">
    <h4 class="mtext-105 cl2 txt-center p-b-30">My Account</h4>
    <form method="post" action="account.php" class="account-form validate-form">
        <div class="wrap-input validate-input m-b-20" data-validate="Enter First name">
            <label class="label-input100" for="first_name">Name</label>
            <input class="input100" type="text" name="first_name" id="first_name" placeholder="Name" value="<?php echo $user['first_name']; ?>" required>
            <span class="focus-input100"></span>
        </div>

		<div class="wrap-input validate-input m-b-20" data-validate="Enter Last name">
            <label class="label-input100" for="last_name">Last Name</label>
            <input class="input100" type="text" name="last_name" id="last_name" placeholder="Name" value="<?php echo $user['last_name']; ?>" required>
            <span class="focus-input100"></span>
        </div>

        <div class="wrap-input validate-input m-b-20" data-validate="Enter email">
            <label class="label-input100" for="email">Email</label>
            <input class="input100" type="email" name="email" id="email" placeholder="Email" value="<?php echo $user['email']; ?>" required>
            <span class="focus-input100"></span>
        </div>

        <div class="wrap-input validate-input m-b-25" data-validate="Enter password">
            <label class="label-input100" for="password">New Password</label>
            <input class="input100" type="password" name="password" id="password" placeholder="New Password">
            <span class="focus-input100"></span>
        </div>

        <div class="container-account-form-btn">
            <button class="account-form-btn">Update Account</button>
        </div>
    </form>
</div>











<?php
@include('component/footer.php')
?>



	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->


<?php
@include('component/js.php');
?>
</body>

</html>