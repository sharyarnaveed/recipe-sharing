<?php
  $Alert=false;
  $showerror=false;
  $incompleteform=false;
  $dataexist=false;
if($_SERVER["REQUEST_METHOD"]=="POST") //send the request by post method
{

  include "partials/db_conn.php"; // include the data base connection file

//delacring variables

  $firstname= htmlspecialchars( $_POST["fname"]);
  $lastname=htmlspecialchars($_POST["lname"]);
  $email=htmlspecialchars($_POST["email"]);
  $username=htmlspecialchars($_POST["username"]);
  $password=htmlspecialchars($_POST["password"]);
  $repeatpassword=htmlspecialchars($_POST["rpassword"]);

if(!empty($firstname)||!empty($lastname)||!empty($email)||!empty($username)||!empty($password)||!empty($repeatpassword))
{





if (($password==$repeatpassword)) { // check if repeat pass is equal to password or not
  

  $query  = "SELECT * FROM `accounts` WHERE  `username`='$username'"; // to select username from table

  $check = mysqli_query($conn, $query);

if($check->num_rows>0)// checks if user name already exists or not
{
$dataexist=true;

}
else{
  $mdpass=md5($password); // to make password secure





  $sql="INSERT INTO `accounts` (`fname`, `lname`, `email`, `username`, `password`, `time`) VALUES
  ( '$firstname', '$lastname', '$email', '$username', '$mdpass', current_timestamp())"; // to insert data into table 


$result=mysqli_query($conn,$sql);

if($result)
{
  $Alert=true;
}
$conn->close();

}









}
else
{
  $showerror=true;
}


}
else
{
  $incompleteform=true;
}
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/sign_in.css" />
    <title>Sign Up</title>
  </head>
  <body>
    <main class="signup_main">
      <section class="image_sign">
        <img
          src="content/miti-qYreP9QOdrk-unsplash.jpg"
          alt=""
        />
      </section>


      <section class="sign_up_form">

     <?php

if($incompleteform)
{
  echo '
  <div class="login_sucess" style=" height: 15%;
background-color: #ff4545;
display: flex;
justify-content: center;
align-items: center;"  >
    <h2 style="font-family: Roboto;
font-weight: 200;" ><strong>Alert!</strong> Fill The Complete Form</h2>
  </div>

';

}

      if($Alert)
      {

      echo '
        <div class="login_sucess" style=" height: 15%;
  background-color: #32de84;
  display: flex;
  justify-content: center;
  align-items: center;"  >
          <h2 style="font-family: Roboto;
  font-weight: 200;" ><strong>Success!</strong> Your Account has Been Created.</h2>
        </div>
      
      ';

      header("refresh:3,url=sign_in.php");

      }
      else{
        echo '';
      }


      if($dataexist)
      {
        echo '
        <div class="login_sucess" style=" height: 15%;
  background-color: #ff4545;
  display: flex;
  justify-content: center;
  align-items: center;"  >
          <h2 style="font-family: Roboto;
  font-weight: 200;" ><strong>Alert!</strong> User Name Already Exists</h2>
        </div>
      
      ';
      }
?>

        <div class="welcome_text" style="height: 30%">
          <h1>Create Account</h1>
          <p>Fill In The Below Form</p>
        </div>
        <div class="the_form">
          <form class="sign_up" action="" method="post">
            <input
              class="sign_up_input"
              type="text"
              name="fname"
      
              placeholder="First Name"
            />
            <input
              class="sign_up_input"
              type="text"
              name="lname"
              placeholder="Last Name"
             
            />
            <input
              class="sign_up_input"
              type="text"
              name="email"
              placeholder="Email"
         
            />
            <input
              class="sign_up_input"
              type="text"
              name="username"
              placeholder="User Name"
       
            />
            <?php
if($showerror)
{

echo '
            <strong><h4 style="font-family: Roboto;
            font-weight: 500; color:red">* Password Doesnot Match </h4>
            </strong>';
}        else
{
  echo'';
}    ?>
            <input
              class="sign_up_input"
              type="password"
              name="password"
              placeholder="Password"
            
            />

            <input
              class="sign_up_input"
              type="password"
              name="rpassword"
              placeholder="Repeat Password"
            />

            <div class="sign_up_button">
              <input
                type="submit"
                class="sign_up_submit_button"
                value="Sign Up"
                name="submit"
              />
            </div>
          </form>
        </div>
      </section>
    </main>
  </body>
</html>
