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
    return $errors;
  }

  function sendBooking() {
    date_default_timezone_set('Australia/Sydney');
    $_SESSION['Booking']['Order Date'] = date("d/m/Y H:i");
    $_SESSION['Booking']['Name'] = $_POST['user']['name'];
    $_SESSION['Booking']['Email'] = $_POST['user']['email'];
    $_SESSION['Booking']['Mobile'] = $_POST['user']['mobile'];
    $_SESSION['Booking']['Movie Code'] = $_POST['movie'];
    $_SESSION['Booking']['Day of Movie'] = substr($_POST['day'], 0, 3);
    $_SESSION['Booking']['Time of Movie'] = explode(' ', $_POST['day'])[1];
    $_SESSION['Booking']['#STA'] = $_POST['seats']['STA'];    
    $_SESSION['Booking']['$STA'] = getPrice($_POST['day'], 'STA') * ($_SESSION['Booking']['#STA'] != '') ? $_SESSION['Booking']['#STA'] : 0;
    $_SESSION['Booking']['#STP'] = $_POST['seats']['STP'];
    $_SESSION['Booking']['$STP'] = getPrice($_POST['day'], 'STP') * ($_SESSION['Booking']['#STP'] != '') ? $_SESSION['Booking']['#STP'] : 0;
    $_SESSION['Booking']['#STC'] = $_POST['seats']['STC'];
    $_SESSION['Booking']['$STC'] = getPrice($_POST['day'], 'STC') * ($_SESSION['Booking']['#STC'] != '') ? $_SESSION['Booking']['#STC'] : 0;
    $_SESSION['Booking']['#FCA'] = $_POST['seats']['FCA'];
    $_SESSION['Booking']['$FCA'] = getPrice($_POST['day'], 'FCA') * ($_SESSION['Booking']['#FCA'] != '') ? $_SESSION['Booking']['#FCA'] : 0;
    $_SESSION['Booking']['#FCP'] = $_POST['seats']['FCP'];
    $_SESSION['Booking']['$FCP'] = getPrice($_POST['day'], 'FCP') * ($_SESSION['Booking']['#FCP'] != '') ? $_SESSION['Booking']['#FCP'] : 0;
    $_SESSION['Booking']['#FCC'] = $_POST['seats']['FCC'];
    $_SESSION['Booking']['$FCC'] = getPrice($_POST['day'], 'FCC') * ($_SESSION['Booking']['#FCC'] != '') ? $_SESSION['Booking']['#FCC'] : 0;
    $_SESSION['Booking']['Total'] = round($_SESSION['Booking']['$STA'] + $_SESSION['Booking']['$STP'] + $_SESSION['Booking']['$STC'] + $_SESSION['Booking']['$FCA'] + $_SESSION['Booking']['$FCP'] + $_SESSION['Booking']['$FCC'], 2);
    $_SESSION['Booking']['GST'] = round($_SESSION['Booking']['Total']/11, 2);

    $file = fopen('bookings.txt', 'a');
    fputcsv($file, $_SESSION['Booking']);
    fclose($file);
    header("Location: receipt.php");
  }


// TODO: 6.3. Booking Form Validation - Server Side
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

?>
