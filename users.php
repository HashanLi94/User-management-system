<?php session_start();?>
<?php require_once('includes/connection.php'); ?>
<?php
    if(!isset($_SESSION['user_id'])){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css\main.css">
    <title>UMS-Users_page</title>
</head>
<body>
   <header>
       <div class="appname">
            User-Management-System
       </div>

       <div class="loggedin">
            Welcome! <?php echo $_SESSION['first_name']; ?> <a href="logout.php">Logout</a>
       </div>
   </header>

    


 
    
</body>
</html>
<?php mysqli_close($connection); ?>