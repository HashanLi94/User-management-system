<?php
    $dbserver = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "UMS_db";

    $connection = mysqli_connect('localhost', 'root', '', 'UMS_db');

    if(mysqli_connect_errno()){
        die("Connection is not successfull") .mysqli_connect_error();
    }else{
       // echo("Connection is successfull <br>");
    }



?>