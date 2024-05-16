<?php

$servername="localhost";
$username="root";
$password="";
$dbname="recipe_website";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
 

}
else{
    die("error").mysqli_connect_error();
    // echo "Connection failed: ";
}

?>
