<?php

$username = $_POST['username'];
$num  = $_POST['num'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];




if (!empty($username) || !empty($num) || !empty($password) || !empty($cpassword) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT num From register Where num = ? Limit 1";
  $INSERT = "INSERT Into register (username , num ,password, cpassword )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("i", $num);
     $stmt->execute();
     $stmt->bind_result($num);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
     if($password===$password){
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("siss", $username,$num,$password,$cpassword);
      $stmt->execute();

      header('location:index.html');
     }} else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>