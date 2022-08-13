<?php 
  require_once 'tools.php';
  echo top_module("Lunardo Booking Page");
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
  import { initMovieDetails } from './lib.js';

  const $_GET = <?php echo json_encode($_GET); ?>;
  initMovieDetails($_GET);
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

<?php echo bottom_module(); ?>
