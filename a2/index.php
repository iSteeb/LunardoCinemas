<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id="wireframecss" type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <script src="../wireframe.js"></script>
  </head>

  <body>
    <header id="top">
      <img id="logo" src="../../media/logo.png" alt="Lunardo logo" />
      <h1 id="title">Lunardo</h1>
    </header>

    <nav>
      <a href="#about">about us</a>
      <a href="#seats">our seats</a>
      <a href="#showing">our movies</a>
      <a href="#top" id="go-to-top-button">&uarr;</a>
    </nav>

    <main>
      <section id="about">
        <h2>about</h2>
        <p>The client wants to target not only their loyal customer from before, but also local cinema goers who would normally drive to modern cinemas in nearby larger towns.
This area should tell customers these things:<br>
* The cinema has reopened after extensive improvements and renovations.<br>
* There are new seats: standard seats and reclinable first class seats<br>
* The projection and sound systems are upgraded with 3D Dolby Vision projection and Dolby Atmos sound.<br>
* See https://professional.<wbr>dolby.com/cinema/ (Links to an external site.) and https://professional.<wbr>dolby.com/cinema/dolby-atmos (Links to an external site.) and http://www.dolby.com/us<wbr>/en/platforms/dolby-cinema.html for more information. (Links to an external site.)</p>
      </section>

      <section id="seats">
        <!-- // todo: two cols on all screens except mobile (single col) and a toggle  -->
        <h2>seats</h2>
        <input id='show-discounted-prices-checkbox' type="checkbox" name="show-discounted-prices-checkbox" checked/>
        <label for='show-discounted-prices-checkbox'>Show discounted prices</label>
        <div id="seat-cards" class="card-container">
          <div id="standard-seating" class="seat-card card-template">
            <img src="../../media/Profern-Standard-Twin.png" alt="Image of standard seating option (Profern Standard Twin)" />
            <p id="STA"></p>
            <p id="STP"></p>
            <p id="STC"></p>
          </div>

          <div id="first-class-seating" class="seat-card card-template">
            <img src="../../media/Profern-Verona-Twin.png" alt="Image of first class seating option (Profern Verona Twin)" />
            <p id="FCA"></p>
            <p id="FCP"></p>
            <p id="FCC"></p>
          </div>
        </div>
      </section>

      <section id="showing">
        <h2>showing</h2>
        <div id="movie-cards" class="card-container">
          <div id="movie-ACT" class="movie-card card-template">
            <p>movie info here</p>
          </div>

          <div id="movie-RMC" class="movie-card card-template">
            <p>movie info here</p>
          </div>

          <div id="movie-FAM" class="movie-card card-template">
            <p>movie info here</p>

          </div>

          <div id="movie-AHF" class="movie-card card-template">
            <p>movie info here</p>

          </div>
        </div>
        <p>This area should have 4 panels that shows details for each movie. These panels will have a "front" and a "back" side which will show different information (details below) and a "flip" effect should be triggered with a :focus pseudo state (and an optional :hover state if you wish).<br>
* On the front: a movie poster, along with the name of the movie and the rating (eg PG, MA, R etc.). Tip: It will help if the poster images are all the same height and width as each other.<br>
* On the back: a short synopsis of the movie plot should be show along with a list of day / times that the movie is playing, and a "book now" hyperlink which should be styled to look like a button. This link should take the user to a booking.php page along with a GET header containing the movie id, eg the action movie link should direct the user to "booking.php?movie=ACT". Tip: This url can be hard coded, but in the next assignment you are expected to create module code to generate these panels.<br>
The content in the movie panels should adapt to large, medium and small screens, the layout for the front of each panel is described below:<br>
* Small / Mobile View: The panels should be displayed "1 up", ie in a single column, internal contents should also be displayed in a single column with the movie poster below the title and rating.<br>
* Medium / Tablet View: The panels should be displayed "1 up" as per the Small / Mobile View but the internal contents should be displayed in two columns, the poster on the left and the title and rating on the right.<br>
* Large / Desktop View: The panels should be displayed "2 up", ie two on one row, with the internal contents displayed in two columns as per the Medium / Tablet View.<br>
The content in the back of each panel should adapt nicely in all screen sizes but no explicit instructions have been provided. This is an analysis and implementation task for you to think about and you may discuss ideas with other students.<br>
The table below shows which movies have been selected by the client and when they are playing:<br>
Movies and Weekly Session Times<br>
Movie Title	CODE	Mon - Tue	Wed - Fri	Sat - Sun	IMDB Link<br>
Top Gun: Maverick	ACT	9pm	9pm	6pm	https://www.imdb.com/title/tt1745960 (Links to an external site.)<br>
Mrs Harris goes to Paris	RMC	-	12pm	3pm	https://www.imdb.com/title/tt5151570 (Links to an external site.)<br>
Lightyear	FAM	12pm	6pm	12pm	https://www.imdb.com/title/tt10298810 (Links to an external site.)<br>
Prithviraj	AHF	6pm	-	9pm	https://www.imdb.com/title/tt9637132 (Links to an external site.)</p>
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
        <p><a href="booking.php">Debugging Booking</a></p>
      </div>
    </footer>

<script src='lib.js' defer></script>
  </body>
</html>
