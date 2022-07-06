<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lunardo Booking Page</title>
    
    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css?t=<?= filemtime("style.css"); ?>">
    <script src='../wireframe.js'></script>
  </head>

  <body>

    <header id="top">
      <img id="logo" src="../../media/logo.png" alt="Lunardo logo" />
      <h1 id="title">Lunardo</h1>
    </header>

    <nav>
      <a href="index.php">Home</a>
      <a href="#top">Go to Top</a>
    </nav>

    <main>
      <section id='info'>
        <h2>Info</h2>
        <p>This page must have a consistent structure and style of the index page and show all of the details regarding the movie selected mentioned in the index page, along with a full synopsis of the movie, for one of the specified movies (your choice but the following details assumes the "ACT" Action film has been selected). 2 - 3 lead actors and director information should also be included here.<br>
Tip: In the next assignment, the content will adapt based on the movie code supplied in the GET header from the index page.<br>
A video trailer of the movie should be displayed which can either be an embedded video (eg in an iframe from a website like Youtube) or in a video element hosted from Coreteaching in your media folder. Make sure that this is not too big or too small for the type of screen that the user has.<br>
Tip: Do not submit movie trailers or any media to Canvas as part of your assignment submission, all media must be present in your media folder, ie outside of your wp folder.</p>
      </section>
      <section id='book'>
        <h2>Booking Form</h2>
        <p>A usable and accessible form with clickable labels where appropriate, good layout and fieldset groups. It should contain and transmit:<br>
* A hidden field to transmit the movie code, eg name="movie" and value="ACT" if the booking is for the action movie. An honest user should not be able to see or modify this field.<br>
* Six drop down boxes for each of the seats group into an array, eg with name="seats[STA]" if this field is for the number of standard adult seats. The first option should be please select and have a blank value, other options should show integers between 1 and 10 and have a matching value. These fields should contain two data attributes that contain the full and discount price for each seat, eg data-fullprice="20.5" and data-discprice="15" for the standard adult seats. UPDATE: Previously a '-sta' seat-type substring was placed here, this was a mistake, you will need to remove it for assignment 3. <br>
* Radio buttons and associated labels for each of the sessions that the movie is playing should be shown, but these should be styled so that the actual radio field is not shown and their associated labels look like 3D buttons in a raised state when not selected and a depressed state when selected. The radio buttons should all have the same name, ie name="day" and different values eg value="WED" if the movie is playing on a Wednesday. All buttons should have a data attribute that represents a full or discount session for the time it is playing, eg for movies playing on a Wednesday data-pricing="discprice" if playing at 12pm, data-pricing="fullprice" for all other times. <br>
* Text-based fields of an appropriate type should collect the following user details and form submission should be blocked ONLY if these are left blank:<br>
    * the full name of the customer, name="user[name]"<br>
    * an email address, name="user[email]"<br>
    * an Australian mobile number, name="user[mobile]"<br>
The form should submit to itself (ie the booking page) using the post method.<br>
Tip: The booking page already has an inbuilt debug area, it shows what has been submitted via GET and POST methods. Make sure that all fields arrive via the correct method and that no illegal values can be submitted by honest users.</p>
      </section>
    </main>

    <footer>
      <p>A footer element that contains the client's contact email, phone and address details (these can be dummy data). Please put your student name and student id in the footer with a link to your GitHub / BitBucket repository.</p>
      <div>&copy;<script>
        document.write(new Date().getFullYear());
      </script> Put your name(s), student number(s) and group name here. Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
      <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
    </footer>

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

  </body>
</html>
