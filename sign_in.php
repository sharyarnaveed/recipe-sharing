<?php
  $login=false;
  $showerror=false;
  $dataexist=false;
if($_SERVER["REQUEST_METHOD"]=="POST") //send the request by post method
{
    include "partials/db_conn.php";
    $username=htmlspecialchars($_POST["username"]);
    $password=htmlspecialchars($_POST["password"]);

$md5pass=md5($password);



$sql="SELECT * FROM `accounts` WHERE `username`=? ";
$stmt=$conn->prepare($sql);

$stmt->bind_param('s',$username);
$stmt->execute();

$result=$stmt->get_result();


$num=mysqli_num_rows($result);


if($num==1)
{
 
    while($row= $result->fetch_assoc())
    {
     $userid=$row['id'];
        if($md5pass==$row['password'])
        {
            $login=true;

            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['userid']=$userid;
            $_SESSION['username']=$username;
            
if(isset($_SESSION['prev_url']))
{
    $prev_url=$_SESSION['prev_url'];

    header("location:$prev_url");
}
else{
    header("location:index.php");
}

            
        }
        else{
            $showerror=true;
        }


    }
    $stmt->close();
                    $conn->close();
}
else
{
    $showerror=true;
}



} ?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/sign_in.css">
    <title>Sign In</title>
</head>
<body>
    <section class="signin_section">
      

<div class="signin_form">
<?php
        if($login)
        {
echo'
        
    <div class="login_sucess" style=" height: 15%;
  background-color: #0e45fc5b;
  display: flex;
  justify-content: center;
  align-items: center;"  >
          <h2 style="font-family: Roboto;
  font-weight: 200;" ><strong>Success!</strong> taking you to Home Page</h2>
        </div>
     ';  
    
     }

   if($showerror)
     {
        echo'
        
    <div class="login_sucess" style=" height: 15%;
    background-color: #ff4545;
  display: flex;
  justify-content: center;
  align-items: center;"  >
          <h2 style="font-family: Roboto;
  font-weight: 200;" ><strong>Error!</strong> No User Found.</h2>
        </div>
     '; 
     
     
     header("refresh:3,url=sign_up.php");
     }
?>
<div class="welcome_text">
    <h1>Welcome!</h1>
    <p>Please sign in to your account.</p>
</div>
<div class="login_form">
    <form class="sign_in_form" action="" method="post" >


<input  class="input_sign_in" type="text" placeholder="User Name" name="username" >
<input  class="input_sign_in" type="password" name="password" placeholder="Password" id="">
<div class="remeber_fogot">
    <div class="remember">
       
            <input  class="input_sign_in" type="checkbox" name="signin"   id="remember_me">
             <h1 class="remember_txt">Remember Me</h1>
            
      
    </div>
  

<div class="forgot">
    <a href="#">
        Forgot Password?
    </a>
    </div>


</div>

<input class="input_sign_in"  type="submit" id="signin_submit"  value="Sign In">
   
<p class="text_sign_up" >Don't have an account? <a class="sign_up_shift" href="sign_up.php">Sign Up</a></p>
</form>
</div>



</div>
<div class="sign_image">
    <img src="content/ikhsan-baihaqi-RwAXb8Hv_sU-unsplash.jpg" alt="">
</div>
    </section>

    <script src="js/sign.js"></script>
</body>
</html>