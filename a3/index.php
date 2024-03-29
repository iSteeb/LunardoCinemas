<?php 
  require_once 'tools.php';
  echo top_module("Lunardo");
?>

<nav>
  <a class='section-link' href="#about">About</a>
  <a class='section-link' href="#seats">Seats & Pricing</a>
  <a class='section-link' href="#showing">Movies</a>
  <a href="#top" id="go-to-top-button">&uarr;</a>
</nav>

<main>
  <section class='section-anchor' id="about">
    <p>WE ARE BACK</p>
    <p>Bigger and better than ever, after extensive renovations we are excited to be re-opening and bringing you all of our improvements and new technology!  Enjoy our brand new powered reclinable first class seats, listen to the breathtaking sound of <a href="https://professional.dolby.com/cinema/dolby-atmos" target="_blank">Dolby Atmos</a> and revel in the astonishing quality and realism of our <a href="https://professional.dolby.com/cinema/" target="_blank">3D Dolby Vision</a> screens!</p>
  </section>

  <section class='section-anchor' id="seats">
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

    <script type=module>
      import { initPrices } from './script.js';
      var prices = <?php echo json_encode($pricesArray) ?>;
      initPrices(prices);
    </script>
  </section>

  <section class='section-anchor' id="showing">
    <h2>Now Showing</h2>
    <div id="movie-cards" class="card-container"></div>
    <script type=module>
      import { initMovies } from './script.js';
      // import PHP stored movies data object and then render sections with it
      var movies = <?php echo json_encode($moviesArray) ?>;
      initMovies(movies);
    </script>
  </section>
</main>

<script type=module>
  import { initNavHighlighter } from './script.js';
  initNavHighlighter();
</script>

<?php echo bottom_module(); ?>
