<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>
<?php require_once('includes/functions.php'); ?>


<?php 

	// check for form submission
	if (isset($_POST['submit'])) {

		$errors = array();

		// check if the username and password has been entered
		if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
			$errors[] = 'Username is Missing / Invalid';
		}

		if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
			$errors[] = 'Password is Missing / Invalid';
		}

		// check if there are any errors in the form
		if (empty($errors)) {
			// save username and password into variables
			$email 		= mysqli_real_escape_string($connection, $_POST['email']);
			$password 	= mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);

			// prepare database query
			$query = "SELECT * FROM ums_tb
						WHERE email = '{$email}' 
						AND password = '{$hashed_password}' 
						LIMIT 1";

			$result_set = mysqli_query($connection, $query);

			verify_query($result_set);
				// query succesfful

				if (mysqli_num_rows($result_set) == 1) {
					// valid user found
					$user = mysqli_fetch_assoc($result_set);
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['first_name'] = $user['first_name'];
					
					//checking the login time n date
					$query = "UPDATE ums_tb SET last_login = NOW()";
					$query .= "WHERE id= {$_SESSION['user_id']}";

					$result_set = mysqli_query($connection, $query);

					verify_query($result_set);
					
					// redirect to users.php
					header('Location: users.php');
				} else {
					// user name and password invalid
					$errors[] = 'Invalid Username / Password';
				}
			
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In - User Management System</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="login">

		<form action="index.php" method="post">
			
			<fieldset>
				<legend><img src="img\single-man-hi.png" alt="" width="150px" height="150px"></legend>

				<?php 
					if (isset($errors) && !empty($errors)) {
						echo '<p class="error">Invalid Username / Password</p>';
					}
				?>

				<?php 
					if (isset($_GET['logout'])) {
						echo '<p class="info">You have successfully logged out from the system</p>';
					}
				?>

				<p>
					<label for="">Username:</label>
					<input type="text" name="email" id="" placeholder="Email Address">
				</p>

				<p>
					<label for="">Password:</label>
					<input type="password" name="password" id="" placeholder="Password">
				</p>

				<p>
					<button type="submit" name="submit">Log In</button>
				</p>

			</fieldset>

		</form>		

	</div> <!-- .login -->
	<?php require_once('includes/footer.php');?>
</body>
</html>
<?php mysqli_close($connection); ?>