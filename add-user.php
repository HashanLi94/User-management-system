<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>

<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	
 ?>

 <?php
    //checking the fields are okay
    $errors = array();
    if(isset($_POST['submit'])){
       

        if(trim(empty($_POST['first_name']))){
              $errors[] = 'First name is required..!!!';
        }

        if(trim(empty($_POST['last_name']))){
            $errors[] = 'Last_name required..!!!';
        }

        if(trim(empty($_POST['email']))){
            $errors[] = 'email is required..!!!';
        }

        if(trim(empty($_POST['password']))){
            $errors[] = 'Password is required..!!!';
         }

         //using foreach loop
         /*$req_fields = array('first_name', 'last_name', 'email', 'password');

         foreach($req_fields as $filed){
            if(trim(empty($_POST['$filed']))){
                $errors[] = $filed . " is required";
            }
         }*/

    }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add-New-Users</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?> <a href="logout.php">Log Out</a></div>
	</header>

	<main>
        <h1>Add New User<span><a href="users.php">< back to Users</a></span></h1>

        <?php
            if(!empty($errors)){
                echo '<div class = "errmsgs">';
                echo "<b>There was an error in the filling.</b> <br>";
                foreach($errors as $error){
                    echo "-". $error ."<br>";
                }
                echo '</div>';
            }
        ?>
        
        <form action="add-user.php" class="userform" method="post">
            <p>
                <label for="">First_name</label>
                <input type="text" name=first_name >
            </p>

            <p>
                <label for="">Last_name</label>
                <input type="text" name="last_name" >
            </p>

            <p>
                <label for="">E-mail address</label>
                <input type="email" name="email" >
            </p>

            <p>
                <label for="">Passowrd</label>
                <input type="password" name="password">

            <p>
                <label for="">&nbsp;</label>
                <button type="submit" name="submit">Save</button>
            </p>
        </form>

		
    </main>
    <?php require_once('includes/footer.php');?>
	
</body>
</html>