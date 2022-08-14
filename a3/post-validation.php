<?php

  require_once 'tools.php';
/* Call this function in the booking page like so: 
   $fieldErrors = validateBooking();
   If the array is empty, then no errors were generated
*/
  function validateBooking() {
    $errors = []; // new empty array to return error messages

    // 1. The movie code is valid. 
    // if (!array_key_exists($_POST['movie'], ($GLOABLS['moviesArray']))) {
    //   $errors['movie'] = "invalid movie selected";
    // }

    // 2. The day is valid and that the movie is playing on that day.
    // $sanitised_showings = array_map('strtolower', ($GLOABLS['moviesArray'][$_POST['movie']]['showings']));
    // if (!in_array(strtolower($_POST['day']), $sanitised_showings)) {
    //   $errors['session'] = "invalid session selected";
    // }

    // 1. At least one seat was selected. 
    // if ($seats_selected == 0) {
    //   $errors['booking'] = "no seats selected";
    // }

    // 2. Check ALL user text based fields, including email, for valid string data using functions filter_var(), preg_match() etc. 
    // if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    //   $errors['email'] = "invalid email";
    // }

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
    $_SESSION['Booking']['$STA'] = getPrice($_POST['day'], 'STA') * (float) ($_SESSION['Booking']['#STA'] != '' ? $_SESSION['Booking']['#STA'] : '0');
    $_SESSION['Booking']['#STP'] = $_POST['seats']['STP'];
    $_SESSION['Booking']['$STP'] = getPrice($_POST['day'], 'STP') * (float) ($_SESSION['Booking']['#STP'] != '' ? $_SESSION['Booking']['#STP'] : '0');
    $_SESSION['Booking']['#STC'] = $_POST['seats']['STC'];
    $_SESSION['Booking']['$STC'] = getPrice($_POST['day'], 'STC') * (float) ($_SESSION['Booking']['#STC'] != '' ? $_SESSION['Booking']['#STC'] : '0');
    $_SESSION['Booking']['#FCA'] = $_POST['seats']['FCA'];
    $_SESSION['Booking']['$FCA'] = getPrice($_POST['day'], 'FCA') * (float) ($_SESSION['Booking']['#FCA'] != '' ? $_SESSION['Booking']['#FCA'] : '0');
    $_SESSION['Booking']['#FCP'] = $_POST['seats']['FCP'];
    $_SESSION['Booking']['$FCP'] = getPrice($_POST['day'], 'FCP') * (float) ($_SESSION['Booking']['#FCP'] != '' ? $_SESSION['Booking']['#FCP'] : '0');
    $_SESSION['Booking']['#FCC'] = $_POST['seats']['FCC'];
    $_SESSION['Booking']['$FCC'] = getPrice($_POST['day'], 'FCC') * (float) ($_SESSION['Booking']['#FCC'] != '' ? $_SESSION['Booking']['#FCC'] : '0');
    $_SESSION['Booking']['Total'] = round($_SESSION['Booking']['$STA'] + $_SESSION['Booking']['$STP'] + $_SESSION['Booking']['$STC'] + $_SESSION['Booking']['$FCA'] + $_SESSION['Booking']['$FCP'] + $_SESSION['Booking']['$FCC'], 2);
    $_SESSION['Booking']['GST'] = round($_SESSION['Booking']['Total']/11, 2);

    $file = fopen('bookings.txt', 'a');
    $_SESSION['test'] = $file;
    fputcsv($file, $_SESSION['Booking']);
    fclose($file);
    header("Location: receipt.php");
  }

?>
