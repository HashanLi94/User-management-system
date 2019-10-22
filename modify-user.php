<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>
<?php require_once('includes/functions.php'); ?>

<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	
 ?>
    


 <?php
    $first_name ='';
    $last_name ='';
    $email = '';
    $password = '';

    if(isset($_GET['user_id'])){
        //getting user info.
        $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);

        //query for select the userid from db
        $query = "SELECT * FROM ums_tb WHERE id={$user_id} LIMIT 1";
        $result_set = mysqli_query($connection, $query);

        if($result_set){
            if(mysqli_num_rows($result_set) == 1){
                //user found from userid and retrieve data
                $result = mysqli_fetch_assoc($result_set);
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];
                $email = $result['email'];
            }else{
                //user not found
            }
        }else{
            //query failed
            header('Location : users.php?err=query_is_failed');
        }

        


    }
    
    
    //checking the fields are okay
    $errors = array();
    if(isset($_POST['submit'])){
        //save the current entered values
        $first_name =$_POST['first_name'];
        $last_name =$_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
       

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

         //checking the data length is correct
         $max_length_field = array('first_name' => 50, 'last_name' => 50, 'email'=> 50, 'password'=>100);

         foreach($max_length_field as $field => $max_length){
            if(strlen(trim($_POST[$field])) > $max_length){
                $errors[] = $field . " should be less than" . $max_length_field. " characters";
            }
         }

         //checking the email address is valid
         if(!is_email($_POST['email'])){
              $errors[] ='Invalid email address...!!!'; 
         }

         //checking the entered email already exists

         $email = mysqli_escape_string($connection, $_POST['email']);

         $query = "SELECT * FROM ums_tb WHERE email ='{$email}' LIMIT 1";
         $result_set = mysqli_query($connection, $query);

         if($result_set){
             if(mysqli_num_rows($result_set) == 1){
                 $errors[] = 'The email address already exists..!!!';
             }
         }

        //add a new user
        if(empty($errors)){
            $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
            $password = mysqli_escape_string($connection, $_POST['password']);

            $hashed_password = sha1($password);

            $query = "INSERT INTO ums_tb(first_name, last_name, email, password, is_deleted) VALUES('{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', 0)";

            $result = mysqli_query($connection, $query);

            if($result){
                //redirect to users page
                echo 'New user added successfully..!!!';
                header('Location : users.php?added_new_user');
                
            }else{
                $errors[] = 'User has not added...!!!';
            }
        }
         




    }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modify-user</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<header>
		<div class="appname">User Management System</div>
		<div class="loggedin">Welcome <?php echo $_SESSION['first_name']; ?> <a href="logout.php">Log Out</a></div>
	</header>

	<main>
        <h1>View/Modify User<span><a href="users.php">< back to Users</a></span></h1>

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
        
        <form action="modify-user.php" class="userform" method="post">
            <p>
                <label for="">First_name</label>
                <input type="text" name=first_name  <?php  echo "value =" .$first_name ?> >
            </p>

            <p>
                <label for="">Last_name</label>
                <input type="text" name="last_name" <?php  echo "value =" .$last_name ?>>
            </p>

            <p>
                <label for="">E-mail address</label>
                <input type="email" name="email" <?php  echo "value =" .$email ?>>
            </p>

            <p>
                <label for="">Passowrd</label>
                <span>*****</span> | <a href="change_pass.php">Change Password here</a>

            <p>
                <label for="">&nbsp;</label>
                <button type="submit" name="submit">Save</button>
            </p>
        </form>

		
    </main>
    <?php require_once('includes/footer.php');?>
	
</body>
</html>