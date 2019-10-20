<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	$userlist = '';

	$query = "SELECT * FROM ums_tb WHERE is_deleted = 0 ORDER BY first_name";

	$users = mysqli_query($connection, $query);

	if($users){
		while($user = mysqli_fetch_assoc($users)){
			$userlist .="<tr>";
			$userlist .="<td>".$user['first_name']."</td>";
			$userlist .="<td>".$user['last_name']."</td>";
			$userlist .="<td>".$user['last_login']."</td>";
			$userlist .="<td>"." <a href=\"modify-user.php?user_id={$user['id']}\">Edit</a>" . "</td>";
			$userlist .="<td>"." <a href=\"delete-user.php?user_id={$user['id']}\">Delete</a>" . "</td>";



			$userlist .="</tr>";
		}
	}else{
		echo "query is not successful.";
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a></div>
	</header>

	<main>
		<h1>Users<span><a href="add-user.php">+Add_New</a></span></h1>

		<table class="masterlist">
			<tr>
				<th>First_Name</th>
				<th>Last_Name</th>
				<th>Last_Login</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>

			<?php echo $userlist ;?>

			
			
			
			
			

		</table>
	</main>
	<?php require_once('includes/footer.php');?>
	
</body>
</html>