<?php 
  require_once 'post-validation.php';
  require_once 'tools.php';

  echo top_module("Lunardo Booking Page");

  $fieldErrors = validateBooking();

  if (false) { // TODO: need better error handling
    header("Location: index.php"); 
  } else {
    sendBooking();
  }
?>

<nav>
  <a href="index.php"><img id="home-icon" src="../../media/home-icon.png" alt="Menubar home icon" /></a>
  <a href="#top" id="go-to-top-button">&uarr;</a>
</nav>

<main>
  <section id='movie-info'></section>
  <section id='book'></section>
</main>

<script type=module>
  import { initMovieDetails } from './script.js';

  const $_GET = <?php echo json_encode($_GET); ?>;
  // import PHP stored movies data object and then render sections with it
  var movies = <?php echo json_encode($moviesArray) ?>;
  var prices = <?php echo json_encode($pricesArray) ?>;

  initMovieDetails($_GET, movies, prices);
</script>

<?php echo bottom_module(); ?>
