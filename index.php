<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title id="title">Home</title>
  </head>

  <body>
    <main class="front_page" id="main_con">
      <aside class="the_nav">
      
<?php
include "components/nav.php";
?>
      </aside>

      <section class="the_main_section">
         <div class="welcome_text">
      <h2>Where </h2>    <h2 id="element"></h2>

          <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
          <script>
     
                var typed = new Typed("#element", {
              strings: [" Flavors Unite", " Stories Come Alive."],
              typeSpeed: 90,
            });  
      
         
          </script>
        </div> 



        





      </section>
    </main>

    <script src="js/index.js"></script>
  </body>
</html>
