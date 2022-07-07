<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lunardo Booking Page</title>
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <script src='../wireframe.js'></script>
  </head>

  <body>

    <header id="top">
      <img id="logo" src="../../media/logo.png" alt="Lunardo logo" />
      <h1 id="title">Lunardo</h1>
    </header>

    <nav>
      <a href="index.php">Home</a>
      <a href="#top" id="go-to-top-button">&uarr;</a>
    </nav>

    <main>
      <section id='movie-info'></section>

      <section id='book'>
        <h2>Booking Form</h2>
        <p>A usable and accessible form with clickable labels where appropriate, good layout and fieldset groups. It should contain and transmit:<br>
* A hidden field to transmit the movie code, eg name="movie" and value="ACT" if the booking is for the action movie. An honest user should not be able to see or modify this field.<br>
* Six drop down boxes for each of the seats group into an array, eg with name="seats[STA]" if this field is for the number of standard adult seats. The first option should be please select and have a blank value, other options should show integers between 1 and 10 and have a matching value. These fields should contain two data attributes that contain the full and discount price for each seat, eg data-fullprice="20.5" and data-discprice="15" for the standard adult seats. UPDATE: Previously a '-sta' seat-type substring was placed here, this was a mistake, you will need to remove it for assignment 3. <br>
* Radio buttons and associated labels for each of the sessions that the movie is playing should be shown, but these should be styled so that the actual radio field is not shown and their associated labels look like 3D buttons in a raised state when not selected and a depressed state when selected. The radio buttons should all have the same name, ie name="day" and different values eg value="WED" if the movie is playing on a Wednesday. All buttons should have a data attribute that represents a full or discount session for the time it is playing, eg for movies playing on a Wednesday data-pricing="discprice" if playing at 12pm, data-pricing="fullprice" for all other times. <br>
* Text-based fields of an appropriate type should collect the following user details and form submission should be blocked ONLY if these are left blank:<br>
    * the full name of the customer, name="user[name]"<br>
    * an email address, name="user[email]"<br>
    * an Australian mobile number, name="user[mobile]"<br>
The form should submit to itself (ie the booking page) using the post method.<br>
Tip: The booking page already has an inbuilt debug area, it shows what has been submitted via GET and POST methods. Make sure that all fields arrive via the correct method and that no illegal values can be submitted by honest users.</p>
      </section>
    </main>

    <footer>
      <div id="contact-cards" class="card-container">
        <div class="contact-card card-template"><p>Email:<br>enquiries@lunardo.com.au</p></div>
        <div class="contact-card card-template"><p>Phone:<br>(02) 6174 4290</p></div>
        <div class="contact-card card-template"><p>Address:<br>30/33 Hibberson St, Gungahlin</p></div>
      </div>
      <div id="footer-copyright">
        <p>&copy; <script>document.write(new Date().getFullYear());</script> Steven Duzevich (s3963525) | Last modified <?= date ("Y F d  H:i", filemtime($_SERVER["SCRIPT_FILENAME"])); ?> | <a href="//github.com/isteeb/wp" target="_blank">GitHub Repo</a></p>
        <p>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</p>
      </div>
    </footer>

    <script type=module defer>
      import {prices, movies} from './lib.js';

      const $_GET = <?php echo json_encode($_GET); ?>;
      const movie = movies[$_GET.movie];
      const movieInfoDiv = document.getElementById('movie-info');

      movieInfoDiv.innerHTML = `
        <h2 id='name'>${movie.name}</h2>
        <img src="${movie.posterURL}" alt="Movie poster for ${movie.name}">
        <p id="rating">${movie.rating}</p>
        <p id="synopsis">${movie.synopsis}</p>
        <div id="trailer">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/${movie.trailer}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p id="actors">${movie.actors}</p>
        <p id="director">${movie.director}</p>
        <p id="showings">${movie.showings.join('<br>')}</p>
      `;
    </script>

    <aside id="debug">
      <hr>
      <h3>Debug Area</h3>
      <pre>
        GET Contains:
        <?php print_r($_GET) ?>
        POST Contains:
        <?php print_r($_POST) ?>
        SESSION Contains:
        <?php print_r($_SESSION) ?>
      </pre>
    </aside>
  </body>
</html>
