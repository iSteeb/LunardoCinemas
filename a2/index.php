<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lunardo</title>
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id="wireframecss" type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <link id='stylecss' type="text/css" rel="stylesheet" href="flipCardStyle.css?t=<?= filemtime("flipCardStyle.css"); ?>">

    <script src="../wireframe.js"></script>
  </head>

  <body>
    <header id="top">
      <img id="logo" src="../../media/logo.png" alt="Lunardo logo" />
      <h1 id="title">Lunardo</h1>
    </header>

    <nav>
      <a href="#about">About</a>
      <a href="#seats">Seats & Pricing</a>
      <a href="#showing">Movies</a>
      <a href="#top" id="go-to-top-button">&uarr;</a>
    </nav>

    <main>
      <section id="about">
        <p>WE ARE BACK</p>
        <p>Bigger and better than ever, after extensive renovations we are excited to be re-opening and bringing you all of our improvements and new technology!  Enjoy our brand new powered reclinable first class seats, listen to the breathtaking sound of <a href="https://professional.dolby.com/cinema/dolby-atmos" target="_blank">Dolby Atmos</a> and revel in the astonishing quality and realism of our <a href="https://professional.dolby.com/cinema/" target="_blank">3D Dolby Vision</a> screens!</p>
      </section>

      <section id="seats">
        <h2>Seats & Pricing</h2>
        
        <input id='show-discounted-prices-checkbox' type="checkbox" name="show-discounted-prices-checkbox" checked/>
        <!-- checkbox is initially checked because cheaper prices will draw people in! -->
        <label class='btn' id='show-discounted-prices-label' for='show-discounted-prices-checkbox'>Show discount</label>
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
        
        <p id='discount-notice' style='text-align:center; display:block'></p>

      </section>

      <section id="showing">
        <h2>Now Showing</h2>
        <div id="movie-cards" class="card-container"></div>
      </section>
    </main>

    <footer>
      <div id="contact-cards" class="card-container">
        <div class="contact-card card-template"><p><b>EMAIL</b><br>enquiries@lunardo.com.au</p></div>
        <div class="contact-card card-template"><p><b>PHONE</b><br>(02) 6174 4290</p></div>
        <div class="contact-card card-template"><p><b>ADDRESS</b><br>30/33 Hibberson St, Gungahlin</p></div>
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
        movieCard.className = 'flip-card';
        movieCard.innerHTML = `
          <div class="flip-card-content">
            <div class="flip-card-front">
              <div class='flip-card-info'><h3>${movie.name}</h3><p>${movie.rating}</p></div>
              <img class='flip-card-poster' src="../../media/${movie.posterURL}" alt="Movie poster for ${movie.name}">
            </div>
            <div class="flip-card-back">
              <p>${movie.synopsis}</p>
              <p>${movie.showings.join('<br>')}</p>
              <a class='btn' href='booking.php?movie=${code}'>Buy Tickets</a>
            </div>
          </div>
        `;
        movieShowtimesContainer.appendChild(movieCard);
      }
    </script>
  </body>
</html>
