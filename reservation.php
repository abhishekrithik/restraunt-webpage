<?php
 $Name = $_POST['Name'];
 $Phone = $_POST['Phone'];
 $ArrivalDate = $_POST['ArrivalDate'];
 $Timings = $_POST['Timings'];
 $Adults = $_POST['Adults'];
 


if (!empty($Name) || !empty($Phone) || !empty($ArrivalDate)  || !empty($Timings)|| !empty($Adults))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "shree";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Phone From reservation Where Phone = ? Limit 1";
  $INSERT = "INSERT INTO reservation values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("i", $Phone);
     $stmt->execute();
     $stmt->bind_result($Phone);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sissi",$Name,$Phone,$ArrivalDate,$Timings,$Adults);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this phone number";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>