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
</style>
customer name
customer email
customer mobile
<?php echo bottom_module(); ?>
<!-- 
* Structured list or table with order itemised as number of seats, which types of seat, seat sub-totals and total with a single GST entry showing. Tip: The Australian Tax Office (ATO) recommends that advertised retail prices be inclusive of GST, eg if a cinema seat is advertised to be $25 then the customer pays $25, the cinema keeps $22.72 and puts aside $2.28 for the ATO.
A page break should following the receipt to separate the ticket(s) from the receipt. Tip: look up "page-break-after: always" for more information.
The ticket(s) can either be a group ticket for the party (ie all seats listed on one ticket) for partial marks OR individual tickets for each seat holder for full marks. 
The tickets should be styled to a high standard and they should not break across pages, Tip: look up "page-break-inside: avoid" for more information. -->