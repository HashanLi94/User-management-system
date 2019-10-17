<?php
    function verify_query($result_set){
        global $connection;

        if(!$result_set){
            die("Query is not successful"). mysqli_error($result_set);
        }
    }


?>