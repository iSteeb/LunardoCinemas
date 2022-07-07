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
      <a href="index.php">home</a>
      <a href="#top" id="go-to-top-button">&uarr;</a>
    </nav>

    <main>
      <section id='movie-info'></section>
      <section id='book'></section>
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
      import {prices, movies, isDiscounted} from './lib.js';

      const $_GET = <?php echo json_encode($_GET); ?>;
      const movie = movies[$_GET.movie];
      const movieInfoDiv = document.getElementById('movie-info');
      const bookingDiv = document.getElementById('book');

      movieInfoDiv.innerHTML = `
        <h2 id='name'>${movie.name}</h2>
        <img src="../../media/${movie.posterURL}" alt="Movie poster for ${movie.name}">
        <p id="rating">${movie.rating}</p>
        <p id="synopsis">${movie.synopsis}</p>
        <div id="trailer">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/${movie.trailer}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p id="actors">${movie.actors}</p>
        <p id="director">${movie.director}</p>
        <p id="showings">${movie.showings.join('<br>')}</p>
      `;

      let dayRadios = '';
      for (let i = 0; i < movie.showings.length; i++) {
        dayRadios += `
          <input type="radio" name="day" value="${movie.showings[i].substr(0,3).toUpperCase()}" id="day-${i}" ${i === 0 ? 'checked' : ''} hidden data-pricing="${isDiscounted(movie.showings[i]) ? 'discprice' : 'fullprice'}">
          <label class='button' for="day-${i}">${movie.showings[i]}</label><br>
        `;
      }

      let seatSelects = '';
      for (let code in prices) {
        seatSelects += `
          <label for="seats-${code}">${prices[code].name} Seats:</label>
          <select name="seats[${code}]" id="seats-${code}" data-fullprice="${prices[code].normal}" data-discprice="${prices[code].discounted}">
            <option value="">Please Select</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select><br>
        `;
      }

      bookingDiv.innerHTML = `
        <h2>Booking Form</h2>
        <form action='booking.php?movie=${$_GET.movie}' method='post'>
          <input type='hidden' name='movie' value='${$_GET.movie}' />

          <input type='text' name='user[name]' value='' placeholder='name' required/>
          <input type='text' name='user[email]' value='' placeholder='email' required/>
          <input type='text' name='user[mobile]' value='' placeholder='mobile' required />
          ${dayRadios}
          ${seatSelects}
          <input class='button' type='submit' value="Submit" />
        </form>
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
