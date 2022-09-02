<?php 
  require_once 'tools.php';
  echo top_module("Lunardo Bookings Summary");
?>

<h2>Your Bookings</h2>
<div id='current-bookings-container'>

</div>

  <script type=module>

    import { initCurrentBookings } from './script.js';

    // import stored bookings and then pass data to JS for rendering sections with it
    var bookings = <?php echo json_encode(getCurrentBookings('bookings.txt')) ?>;
    initCurrentBookings(bookings);
  </script>

<?php echo bottom_module(); ?>