<?php
  session_start();

  /* Put your PHP functions and modules here.
   Many will be provided in the teaching materials,
   keep a look out for them!
*/

// prices and movie data are stored in the PHP arrays as per assignment specification
// however Javascript is more powerful in rendering pages dynamically, so whilst the
// data is stored server-side in PHP, it is passed to the Javascript as JSON.
// nonetheless, the PHP storage is essential for the client-side functions to work.
$pricesArray = [
   "STA" => [
         "name" => "Standard Adult", 
         "normal" => "20.50", 
         "discounted" => "15.00" 
      ], 
   "STP" => [
            "name" => "Standard Concession", 
            "normal" => "18.00", 
            "discounted" => "13.50" 
         ], 
   "STC" => [
               "name" => "Standard Child", 
               "normal" => "16.50", 
               "discounted" => "12.00" 
            ], 
   "FCA" => [
                  "name" => "First Class Adult", 
                  "normal" => "30.00", 
                  "discounted" => "24.00" 
               ], 
   "FCP" => [
                     "name" => "First Class Concession", 
                     "normal" => "27.00", 
                     "discounted" => "22.50" 
                  ], 
   "FCC" => [
                        "name" => "First Class Child", 
                        "normal" => "24.00", 
                        "discounted" => "21.00" 
                     ] 
];
 
  $moviesArray = [
    "ACT" => [
          "name" => "Top Gun: Maverick", 
          "rating" => "PG-13", 
          "posterURL" => "maverick.png", 
          "synopsis" => "After more than thirty years of service as one of the Navy's top aviators, Pete Mitchell is where he belongs, pushing the envelope as a courageous test pilot and dodging the advancement in rank that would ground him.", 
          "trailer" => "giXco2jaZ_4", 
          "actors" => "Tom Cruise, Jennifer Connelly, Miles Teller", 
          "director" => "Joseph Kosinski", 
          "showings" => [
              "Mon 9pm", 
              "Tue 9pm", 
              "Wed 9pm", 
              "Thu 9pm", 
              "Fri 9pm", 
              "Sat 6pm", 
              "Sun 6pm" 
          ] 
        ], 
    "RMC" => [
                "name" => "Mrs Harris goes to Paris", 
                "rating" => "PG", 
                "posterURL" => "harris.png", 
                "synopsis" => "A widowed cleaning lady in 1950s London falls madly in love with a couture Dior dress, and decides that she must have one of her own.", 
                "trailer" => "iO9JcPbbmAA", 
                "actors" => "Lesley Manville, Jason Isaacs, Anna Chancellor", 
                "director" => "Anthony Fabian", 
                "showings" => [
                    "Wed 12pm", 
                    "Thu 12pm", 
                    "Fri 12pm", 
                    "Sat 3pm", 
                    "Sun 3pm" 
                ] 
              ], 
    "FAM" => [
                      "name" => "Lightyear", 
                      "rating" => "PG", 
                      "posterURL" => "lightyear.png", 
                      "synopsis" => "While spending years attempting to return home, marooned Space Ranger Buzz Lightyear encounters an army of ruthless robots commanded by Zurg who are attempting to steal his fuel source.", 
                      "trailer" => "wHBBoUtJHhA", 
                      "actors" => "Chris Evans, Keke Palmer, Peter Sohn", 
                      "director" => "Angus MacLane", 
                      "showings" => [
                          "Mon 12pm", 
                          "Tue 12pm", 
                          "Wed 6pm", 
                          "Thu 6pm", 
                          "Fri 6pm", 
                          "Sat 12pm", 
                          "Sun 12pm" 
                      ] 
                    ], 
    "AHF" => [
                            "name" => "Prithviraj", 
                            "rating" => "M", 
                            "posterURL" => "prithviraj.png", 
                            "synopsis" => "A fearless warrior. An epic love story. Witness the grand saga of Samrat Prithviraj Chauhan.", 
                            "trailer" => "33-CQdPHyjw", 
                            "actors" => "Akshay Kumar, Sanjay Dutt, Manushi Chhillar", 
                            "director" => "Chandra Prakash Dwivedi", 
                            "showings" => [
                                "Mon 6pm", 
                                "Tue 6pm", 
                                "Sat 9pm", 
                                "Sun 9pm" 
                            ] 
                          ] 
  ];
 
  function isDiscounted($session) {
  if (str_contains($session, 'Mon')) return true;
  if (
    str_contains($session, '12pm') &&
    !str_contains($session, 'Sat') &&
    !str_contains($session, 'Sun')
  )
    return true;
  return false;
  }

  // redirect to homepage from booking page if movie code invalid
  if(basename($_SERVER['PHP_SELF']) == 'booking.php' && (count($_GET) <= 0 || !array_key_exists($_GET['movie'], $moviesArray))) {
    header("Location: index.php");
  }

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