<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "shopping";

$con = mysqli_connect($host, $username, $password, $database);
// if (!$con) {
//     die("Connection failed: " . mysqli_connect_error());
// }
if($con)
{
//    echo "connect to DB";

}
else
{
    echo "Not connected";
}
?>
