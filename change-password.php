<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	$errors = array();
	$user_id = '';
	$first_name = '';
	$last_name = '';
	$email = '';

	if (isset($_GET['user_id'])) {
		// getting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		$query = "SELECT * FROM ums_tb WHERE id = {$user_id} LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// user found
				$result = mysqli_fetch_assoc($result_set);
				$first_name = $result['first_name'];
				$last_name = $result['last_name'];
				$email = $result['email'];
			} else {
				// user not found
				header('Location: users.php?err=user_not_found');	
			}
		} else {
			// query unsuccessful
			header('Location: users.php?err=query_failed');
		}
	}

	if (isset($_POST['submit'])) {
		$user_id = $_POST['user_id'];
		$password =	$_POST['password'];
		// checking required fields
		$req_fields = array('user_id', 'password');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('password' => 100);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		// // checking email address
		// if (!is_email($_POST['email'])) {
		// 	$errors[] = 'Email address is invalid.';
		// }

		// // checking if email address already exists
		// $email = mysqli_real_escape_string($connection, $_POST['email']);
		// $query = "SELECT * FROM ums_tb WHERE email = '{$email}' AND id != {$user_id} LIMIT 1";

		// $result_set = mysqli_query($connection, $query);

		// if ($result_set) {
		// 	if (mysqli_num_rows($result_set) == 1) {
		// 		$errors[] = 'Email address already exists';
		// 	}
		// }

		if (empty($errors)) {
			// no errors found... adding new record
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);
			// $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			// email address is already sanitized

			$query = "UPDATE ums_tb SET ";
			$query .= "password = '{$hashed_password}' ";
			$query .= "WHERE id = {$user_id} LIMIT 1";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: users.php?password_changed=true');
			} else {
				$errors[] = 'Failed to update the password.';
			}


		}



	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change-passsword</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div>
	</header>

	<main>
		<h1><img src="img\Login.png" alt="" height="80px" width="80px"> Modify a User<span> <a href="users.php">< Back to User List</a></span></h1>

		<?php 

			if (!empty($errors)) {
				display_errors($errors);
			}

		 ?>

		<form action="change-password.php" method="post" class="userform">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<p>
				<label for="">First Name:</label>
				<input type="text" name="first_name" <?php echo 'value="' . $first_name . '"'; ?> disabled>
			</p>

			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" <?php echo 'value="' . $last_name . '"'; ?> disabled>
			</p>

			<p>
				<label for="">Email Address:</label>
				<input type="text" name="email" <?php echo 'value="' . $email . '"'; ?> disabled>
			</p>

			<p>
				<label for="">New Password:</label>
				 <input type="password" name="password" id="password" >
			</p>

			<p>
				<label for="">Show the password</label>
				<input type="checkbox" name="showpassword" id="showpassword"  style="width :20px; height:20px;" >
			</p>

			<p>
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Update </button>
			</p>

		</form>

		
		
	</main>
	<script src="js/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$('#showpassword').click(function(){
				if($('#showpassword').is(':checked')){
					$('#password').attr('type', 'text');
				}else{
					$('#password').attr('type', 'password');
				}
			});
		});
	</script>
    <?php require_once('includes/footer.php'); ?>

</body>
</html>