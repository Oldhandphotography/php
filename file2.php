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

     //find number of rows returned
     $echo = mysqli_num_rows($result);
    //  echo $echo;

     //displays the row returned by the sql query
    //  if($echo>0){
    //      $row = mysqli_fetch_assoc($result);
    //      echo var_dump($row);
    //      echo "<br>";
    //  }

     while($row = mysqli_fetch_assoc($result)){
         echo "<br>";
        echo var_dump($row);
        echo "<br>";
     }
?>