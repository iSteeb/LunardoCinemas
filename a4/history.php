<?php 
  require_once 'tools.php';
  // The receipt page should only be available to users who have completed a booking. For this reason, redirect the user to the index page using PHP's header() function if there is no booking data in the $_SESSION.
  echo top_module("Lunardo Booking Confirmation");
?>
<style>
  /* force printer-friendly colours on this page */
  html {
    --primary-color: #fff !important;
    --light-text-color: #000 !important;
  }
  #footer-retrieve-booking {
    display: none;
  }
</style>
<div id='receipt'></div>
<div id='tickets'></div>
  <script type=module>
    import { initHistory } from './historyGenerator.js';
    // import PHP stored booking data object and then render sections with it
    var booking = <?php echo json_encode($_GET) ?>;
    var movies = <?php echo json_encode($moviesArray) ?>;

    initHistory(booking, movies);
  </script>
<?php echo bottom_module(); ?>
