<?php



session_start();
$_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
if(!isset( $_SESSION['loggedin'] )||$_SESSION['loggedin']!=true) {

    header("location:sign_in.php");
    exit;

}
else
{
    include "partials/db_conn.php";


    
 
 


    // $encrypted_recipe_id = base64_encode((($data*123456*9876)/9876));


    if(isset($_GET['recipe'])&&!empty($_GET['recipe']))
    {

$encrypted_recipe_id = $_GET['recipe'];

$decrypted_recipe_id_p = base64_decode(urldecode($encrypted_recipe_id));
$decrypted_recipe_id1= (($decrypted_recipe_id_p*9876)/123456/9876) ;
        $recipe_id=$decrypted_recipe_id1;
        // echo $recipe_id;

    $detail_recipe="SELECT * FROM `add_recipe` WHERE `recipe_id`='$recipe_id' ";
    $query=mysqli_query($conn,$detail_recipe);

    $num_rows=mysqli_num_rows($query);

if($num_rows>0)
{
    $recipe_data=mysqli_fetch_assoc( $query );
    $title= ucwords($recipe_data['title']);
    $username=$recipe_data['username'];
    $desc=$recipe_data['description'];
    $image=$recipe_data['image'];
$recipe_whole=$recipe_data['recipe'];
    $ingredients=$recipe_data['ingredients'];
}

    }
    else
    {
        echo "error";
    }
}


?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Title</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/recipe_display.css">
</head>
<body>
    <main>
    <section class="recipeimage">
     <?php  echo' <img src="'.$image.'" alt="">'
?>    </section>
    <section class="text_container">
        <div class="recipe_text">
          <?php
          
         echo ' 
          <h2>'.$title.'</h2>';
         echo' <h4> By '.$username.'</h4>';
        echo '   <p>'.$desc.'</p>'

       
        ?>

</div>

        <div class="proceeed">
           <button  class="button" id="readmore">Read Recipe</button> 
           <button class="button" id="goback">Go Back</button>
        </div>
    </section>
</main>


<section id="read_all" class="recipe">
    <div class="ingridents">
        <h1>Ingredients</h1>
        <?php
  echo ' <p>'.$ingredients.'</p>';
    ?>
    </div>
    <div class="recipe_text_contain">
        
        
        <h1>Recipe</h1>
        <?php
 echo '   <p>'.$recipe_whole.'</p>'
    ?>
    </div>
</section>




<script>
    let back=document.getElementById("goback");
    back.addEventListener("click",()=>{
        window.location.href="recipe_card_load.php";
    })


    let readmore=document.getElementById("readmore");
    
    readmore.addEventListener("click",()=>{
        let read=document.getElementById("read_all")
        read.style.display="flex";
        move

    })
</script>
<!-- <section class="recipe">recipe</section> -->
</body>
</html>