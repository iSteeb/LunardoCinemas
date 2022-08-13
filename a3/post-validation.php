<?php

  require_once 'tools.php';
/* Call this function in the booking page like so: 
   $fieldErrors = validateBooking();
   If the array is empty, then no errors were generated
*/
  function validateBooking() {
    $errors = []; // new empty array to return error messages
    if ($_POST['user']['name'] == '') {
      $errors['user']['name'] = "Name can't be blank";
    } else {
      // more advanced checks here
    }
    if ($_POST['user']['email'] == '') {
      $errors['user']['email'] = "Email can't be blank";
    } else {
      // more advanced checks here
    }
    // ... etc
  }


// 6.3. Booking Form Validation - Server Side
// When the user clicks submit, form data will be submitted to the booking page and all $_POST data should be checked again server side.
// Dishonest users can cause the following errors, so check:
// 1. The movie code is valid. 
// 2. The day is valid and that the movie is playing on that day.
// 3. The seats are blank or integers within the range 1 - 10.
// If these errors occur, redirect the user to the index page as this is clearly a dishonest user modifying fields in the form. 


// It is possible for honest users to cause the following errors, so check:
// 1. At least one seat was selected. 
// 2. Check ALL user text based fields, including email, for valid string data using functions filter_var(), preg_match() etc. 
// If these errors occur, stay on the booking page as this could be an honest user with browser limitations, pre-fill the text based field values and hidden field values with $_POST data, and re-select the day and seat quantities that match the $_POST data.
// If all the data is valid, add the user's $_POST data to the $_SESSION and redirect the user to a new page called receipt.php using the PHP header() function.
?>
