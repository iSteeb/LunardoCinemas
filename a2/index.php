<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lunardo</title>
    
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
        <div id="movie-cards" class="card-container"></div>
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
      import {prices, movies, updatePrices} from './lib.js';

      var showDiscountedPrices = document.getElementById(
        'show-discounted-prices-checkbox'
      );

      updatePrices(showDiscountedPrices.checked);

      // toggle between discounted and full seat prices on checkbox change
      showDiscountedPrices.addEventListener('change', function () {
        updatePrices(this.checked);
      });

      var movieShowtimesContainer = document.getElementById('movie-cards');

      for (let code in movies) {
        let movie = movies[code];
        let movieCard = document.createElement('div');
        movieCard.className = 'movie-card card-template';
        movieCard.innerHTML = `
          <div class="movie-poster">
            <img src="${movie.posterURL}" alt="Movie poster for ${movie.name}">
          </div>
          <div class="movie-details">
            <h2>${movie.name}</h2>
            <p>${movie.rating}</p>
            <p>${movie.synopsis}</p>
            <p>${movie.showings.join('<br>')}</p>
            <a href="booking.php?movie=${code}">Buy Tickets</a>
          </div>
        `;
        movieShowtimesContainer.appendChild(movieCard);
      }
    </script>
  </body>
</html>
