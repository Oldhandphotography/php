<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "souvikphp";
     //create connection
     $conn = mysqli_connect($servername,$username,$password,$database);
     // die if connection was not successfull
     if(!$conn){
         die("sorry connection failed".mysqli_connect_error());
     }
     else{
         echo"connection was successful";
     }
     $sql= "SELECT * FROM `information`";
     $result = mysqli_query($conn,$sql);
     ?>