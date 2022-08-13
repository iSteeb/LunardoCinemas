<?php
  session_start();

/* Put your PHP functions and modules here.
   Many will be provided in the teaching materials,
   keep a look out for them!
*/

function top_module($pageTitle) {
  $html = <<<"OUTPUT"
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>$pageTitle</title>
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id="wireframecss" type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <link id='stylecss' type="text/css" rel="stylesheet" href="flipCardStyle.css?t=<?= filemtime("flipCardStyle.css"); ?>">

    <script src="../wireframe.js"></script>
  </head>

  <body>

    <?php header(); ?>
    <header id="top">
      <img id="logo" src="../../media/logo.png" alt="Lunardo logo" />
      <h1 id="title">Lunardo</h1>
    </header>
OUTPUT;
  echo $html;
}

function bottom_module() {
  $html = <<<"OUTPUT"
    <footer>
      <div id="contact-cards" class="card-container">
        <div class="contact-card card-template"><p><b>EMAIL</b><br>enquiries@lunardo.com.au</p></div>
        <div class="contact-card card-template"><p><b>PHONE</b><br>(02) 6174 4290</p></div>
        <div class="contact-card card-template"><p><b>ADDRESS</b><br>30/33 Hibberson St, Gungahlin</p></div>
      </div>
      <div id="footer-copyright">
        <p>&copy; <script>document.write(new Date().getFullYear());</script> Steven Duzevich (s3963525) | Last modified <?= date ("Y F d  H:i", filemtime(\$_SERVER["SCRIPT_FILENAME"])); ?> | <a href="//github.com/isteeb/wp" target="_blank">GitHub Repo</a></p>
        <p>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</p>
      </div>
    </footer>
  </body>
</html>
}
OUTPUT;
  echo $html;
}

?>