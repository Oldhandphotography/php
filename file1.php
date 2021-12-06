<?php
    //connecting to database
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
     //creating database
     $sql = "CREATE TABLE `souvikphp`.`personalinfoone` ( `s.no.` INT NOT NULL ,  `name` TEXT NOT NULL ,  `interests` VARCHAR(150) NOT NULL ,  `gender` VARCHAR(15) NOT NULL ,    PRIMARY KEY  (`s.no.`))";
     $result = mysqli_query($conn,$sql);
     //checking if database created or not
     if($result){
         echo "table creation successful";
     }
     else{
         echo"table created failed";
     }
?>