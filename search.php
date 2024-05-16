
<?php
include "partials/db_conn.php";
$noresult=true;
$search_value=$_GET["search"];
$recieve_data = "Select * FROM add_recipe WHERE MATCH (title,description) against ('$search_value')";
$result = mysqli_query($conn, $recieve_data);

$cards = array();
if (mysqli_num_rows($result) > 0) {

  while ($row = $result->fetch_assoc()) {

    $recipe_id = $row["recipe_id"];
    $cards[$recipe_id] = array(
      'title' => $row['title'],
      'image' => $row['image'],
      'recipeid' => $row['recipe_id']
    );
    $noresult=false;
  }
}





?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@300&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Search</title>
</head>
<body>
<main class="front_page" id="main_con">
      <aside class="the_nav">
      
<?php
include "components/nav.php";
?>
      </aside>

      <section class="the_main_section">
      <div class="search_bar_conatiner">
        <form class="search_bar_form" action="search.php" method="get">
        <input class="search_recipe_input" type="Search" placeholder="Search Recipe..." name="search">
        <input type="submit" class="search_button" value="Search">
        </form>
      </div>


      <div class="recipe_container">
      <?php

foreach ($cards as $key) {

  echo ' <div class="recipe_card">';
  $data=$key['recipeid'];

  $encrypted_recipe_id = base64_encode((($data*123456*9876)/9876));
  echo '<a href="recipe_display.php?recipe=' . urlencode($encrypted_recipe_id) . '" class="recipe_card_a">';
  
  echo ' <div class="card_image">';
  echo '<img src="' . $key['image'] . '" alt="">';
  echo ' </div>';

  echo '<div class="text_contain">';
  echo '<h3>' . ucwords($key['title']) . '</h3>';
  echo ' </div>';
  echo ' </a>';
  echo ' </div>';
}


if($noresult)
{
    echo '
 
    <div style=" height: 88%;
    background-color: transparent;
    display: flex;
    justify-content: center;
    align-items: center;
  
    width:100%;"  >
       <h2 style="font-family: Roboto;
    font-weight: 200; color:white; font-size:120px;" ><strong>No Results</strong> </h2>
     </div>
    ';
    
}

?>
     </div>




      </section>
    </main>
</body>
</html>