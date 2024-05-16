<?php
$empty = false;
$wrongformat = false;
$notdone = false;
$done = false; // Add this variable to track successful insertion
session_start();
$_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
  header("location: sign_in.php");
  exit; // Exit after redirect
} else {
  $user_name = $_SESSION['username'];
  $user_id = $_SESSION['userid'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "partials/db_conn.php";

    $title = $_POST["title"];
    $desc = $_POST["description"];
    $recipe = $_POST["recipe"];
$ingredients=$_POST["ingredients"];
    // for image
    $target_dir = "uploads/";
    $target_file = $target_dir . rand(1, 8000000000) . basename($_FILES["image"]["name"]);
    $imagefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if any required field is empty
    if (empty($title) || empty($desc) || empty($recipe) || empty($_FILES["image"]["tmp_name"])) {
      $empty = true;
    } else {
      // Check if the file format is correct
      if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "jpeg") {
        $wrongformat = true;
      } else {
        // Attempt to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          // Insert data into database
          $stmt = $conn->prepare("INSERT INTO add_recipe (`user_id`, `title`, `image`, `description`, `recipe`, `username`,`ingredients`) VALUES (?, ?, ?, ?, ?, ?,?)");
          $stmt->bind_param("sssssss", $user_id, $title, $target_file, $desc, $recipe, $user_name, $ingredients);

          if ($stmt->execute()) {
            $done = true;
          } else {
            echo "Error: " . $stmt->error;
            $notdone = true;
          }

          $stmt->close();
        } else {
          echo "Error uploading file.";
        }
      }
    }
    $conn->close(); // Close database connection
  }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@300&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <title id="title">Recipe</title>
</head>

<body>
  <main class="front_page" id="main_con">

    <aside class="the_nav">


      <?php
      include "components/nav.php";
      ?>


    </aside>

    <section class="the_main_section">
      <?php
      if ($done) {
        echo '
       
   <div class="login_sucess" style=" height: 15%;
 background-color:#187127;
 color:#FFFFFF;
 display: flex;
 justify-content: center;
 align-items: center;
 z-index:1;
 position:absolute;
 top:0;
 width:100%;
 "  >
         <h2 style="font-family: Roboto;
 font-weight: 200;" ><strong>Success!</strong> Record Has Been  Added.</h2>
       </div>
    ';
      }


      if ($notdone) {
        echo '
    
<div class="login_sucess" style=" height: 15%;
background-color: #731616;
color:white;
display: flex;
justify-content: center;
align-items: center;
z-index:1;
position:absolute;
top:0;
width:100%;"  >
      <h2 style="font-family: Roboto;
font-weight: 200;" ><strong>Failed!</strong> Record Has Been Not Added.</h2>
    </div>
 ';
      }

      if ($wrongformat) {
        echo '
    
<div class="login_sucess" style=" height: 15%;
background-color: #731616;
color:white;
display: flex;
justify-content: center;
align-items: center;
z-index:1;
position:absolute;
top:0;
width:100%;"  >
      <h2 style="font-family: Roboto;
font-weight: 200;" ><strong>Failed!</strong> Wrong Image Formate.</h2>
    </div>
 ';
      }

      if ($empty) {
        echo '
 
<div class="login_sucess" style=" height: 15%;
background-color: #731616;
display: flex;
justify-content: center;
align-items: center;
z-index:1;
position:absolute;
top:0;
width:100%;"  >
   <h2 style="font-family: Roboto;
font-weight: 200;" ><strong>Failed!</strong> Fill The Form Compeletly.</h2>
 </div>
';
      }
      ?>
      <div class="add_container">
        <h1>Add Recipe</h1>
        <form class="add_recipe" method="post" enctype="multipart/form-data">
          <input type="text" name="title" placeholder="Title" id="">
          <input type="file" name="image" id="">
          <textarea name="description" id="" cols="30" placeholder="Write Description..." rows="10"></textarea>
          <textarea name="recipe" id="recipe" placeholder="Write Recipe..." cols="30" rows="10"></textarea>
          <textarea name="ingredients" id="ingredients" placeholder="Ingredients.." cols="30" rows="10"></textarea>
          <input type="submit" value="Submit">
        </form>
      </div>








    </section>
  </main>

  <script src="js/index.js"></script>
</body>

</html>