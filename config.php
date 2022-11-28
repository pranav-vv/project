<?php
    $version = time();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "nikestore";
    // creating a connection
    $conn = mysqli_connect($servername , $username , $password , $database);
    if(!$conn){
        die("Connection to database failed" . mysqli_connect_error());
    }
?>