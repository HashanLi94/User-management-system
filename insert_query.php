<?php include_once('includes/connection.php');?>

<?php
    $first_name = 'Hashan';
    $last_name = 'Liyanage';
    $email = 'hashanduplessis@gmail.com';
    $password = 'reebok6996';
    $is_deleted = 0;

    $hashed_password = sha1($password);
    //echo $hashed_password;

   $query = "INSERT INTO ums_tb(first_name, last_name, email, password, is_deleted) VALUES('{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', {$is_deleted})";

    $result = mysqli_query($connection, $query);

    if($result){
        echo"1 record is done";
    }else{
        echo"The record is not done";
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert_query</title>
</head>
<body>
    
</body>
</html>

<?php mysqli_close($connection);?>