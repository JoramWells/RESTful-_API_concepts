<?php
$host="localhost";
$user="root";
$password="JoramWells18";
$dbname="vuedb";
$id=" ";

$con=mysqli_connect($host,$user,$password,$dbname);

$condition = "1";
if(isset($_GET['userid'])){
   $condition = " id=".$_GET['userid'];
}
$userData = mysqli_query($con,"select * from contacts WHERE ".$condition);

$response = array();

while($row = mysqli_fetch_assoc($userData)){

   $response[] = $row;
}

echo json_encode($response);
exit;
  $con->close();

?>