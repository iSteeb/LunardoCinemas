<?php 
  require_once 'post-validation.php';
  require_once 'tools.php';
  echo top_module("Lunardo Booking Page");

  // redirect to homepage from booking page if movie code invalid
  if((count($_GET) <= 0 || !array_key_exists($_GET['movie'], $moviesArray))) {
    header("Location: index.php");
  }

  // if a form has been submitted, validate its data and send it to the server if valid
  if (count($_POST) > 0) {
    $fieldErrors = validateBooking();

    if (count($fieldErrors) == 0) {
      sendBooking();
    } else {
      header("Location: index.php"); 
    }
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
