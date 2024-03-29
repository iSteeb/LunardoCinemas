/* Insert your javascript here */

// set the localstorage items to save customer form data
function saveDetails() {
  localStorage.setItem(
    'name',
    document.getElementById('booking-name-field').value
  );
  localStorage.setItem(
    'email',
    document.getElementById('booking-email-field').value
  );
  localStorage.setItem(
    'mobile',
    document.getElementById('booking-mobile-field').value
  );
}

function clearDetails() {
  localStorage.removeItem('name');
  localStorage.removeItem('email');
  localStorage.removeItem('mobile');
  const nameField = document.getElementById('booking-name-field');
  const mobileField = document.getElementById('booking-mobile-field');
  const emailField = document.getElementById('booking-email-field');
  nameField.value = '';
  mobileField.value = '';
  emailField.value = '';
}

// get the element with the id of 'id' helper function
function getid(sP) {
  return document.getElementById(sP);
}

// validate name to contain alphabetic characters or ,.'- only
function nameCheck() {
  var name = getid('booking-name-field').value;
  var patt = /^[a-zA-Z ,.'-]+$/;
  if (patt.test(name)) {
    getid('nameError').replaceChildren();
    return true;
  } else {
    getid('nameError').innerText = 'Please provide a valid name.';
    return false;
  }
}

// validate mobile number
// allow only optional single spaces and numbers
// must begin with 04
// must contain 10 digits
function mobileCheck() {
  var number = getid('booking-mobile-field').value;
  var patt = /^0 ?4 ?([0-9] ?){8}$/;
  if (patt.test(number)) {
    getid('mobileError').replaceChildren();
    return true;
  } else {
    getid('mobileError').innerText =
      'Please provide a valid Australian mobile number.';
    return false;
  }
}

// validate selection: if a price is displayed, assume valid selection is made
// calcPrice() function ensures actual validation
function seatsSelectedCheck() {
  var price = getid('booking-price').innerText;
  if (price.length >= 5) {
    getid('selectionError').replaceChildren();
    return true;
  } else {
    getid('selectionError').innerText =
      'Please select a session and at least one seat.';
    return false;
  }
}

export function formValidate(event) {
  var countErrors = 0;

  if (!nameCheck()) countErrors++;

  if (!mobileCheck()) countErrors++;

  if (!seatsSelectedCheck()) countErrors++;

  if (countErrors > 0) {
    event.preventDefault();
    return false;
  }

  if (localStorage.getItem('rememberMe') === 'true') {
    saveDetails();
  }

  return true;
}

export function initNavHighlighter() {
  window.addEventListener('scroll', function () {
    var sectionLinks = document.querySelectorAll('.section-link');

    sectionLinks.forEach((link) => {
      const href = link.getAttribute('href').split('#')[1];
      const height =
        document.getElementById(href).getBoundingClientRect().bottom -
        document.getElementById(href).getBoundingClientRect().top;

      const scrollPaddingTop = window
        .getComputedStyle(document.querySelector('html'))
        .getPropertyValue('scroll-padding-top')
        .split('px')[0];

      if (
        window.scrollY >=
          document.getElementById(href).offsetTop - scrollPaddingTop &&
        window.scrollY <
          document.getElementById(href).offsetTop + height - scrollPaddingTop
      ) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  });
}

// event listener that controls the display status of the go-to-top-button (show only if scroll position is passed the navbar, and don't block the footer)
document.addEventListener(
  'scroll',
  function () {
    if (
      window.scrollY >=
        document.getElementsByTagName('nav').item(0).offsetTop &&
      window.scrollY + window.innerHeight <
        document.getElementsByTagName('footer').item(0).offsetTop
    ) {
      document.getElementById('go-to-top-button').style.display = 'block';
    } else {
      document.getElementById('go-to-top-button').style.display = 'none';
    }
  },
  true
);

function updatePrices(isChecked, prices) {
  if (isChecked) {
    for (let code in prices) {
      document.getElementById(
        code
      ).innerHTML = `${prices[code].name}<br><span style="font-size:1.5em">$${prices[code].discounted}</span>`;
    }
    document.getElementById('discount-notice').innerHTML =
      'Discounts only apply to 12pm weekday matinée sessions, and all day Monday.';
  } else {
    for (let code in prices) {
      document.getElementById(
        code
      ).innerHTML = `${prices[code].name}<br><span style="font-size:1.5em">$${prices[code].normal}</span>`;
    }
    document.getElementById('discount-notice').innerHTML = '';
  }
}

function isDiscounted(session) {
  if (session.includes('Mon')) return true;
  if (
    session.includes('12pm') &&
    !session.includes('Sat') &&
    !session.includes('Sun')
  )
    return true;
  return false;
}

export function initPrices(prices) {
  var showDiscountedPrices = document.getElementById(
    'show-discounted-prices-checkbox'
  );

  updatePrices(showDiscountedPrices.checked, prices);

  // toggle between discounted and full seat prices on checkbox change
  showDiscountedPrices.addEventListener('change', function () {
    updatePrices(this.checked, prices);
  });
}

export function initMovies(movies) {
  var movieShowtimesContainer = document.getElementById('movie-cards');

  for (let code in movies) {
    let movie = movies[code];
    let movieCard = document.createElement('div');
    movieCard.className = 'flip-card';
    movieCard.innerHTML = `
          <div class="flip-card-content">
            <div class="flip-card-front">
              <div class='flip-card-info'><h3 id='flip-card-name'>${
                movie.name
              } <sub>(${movie.rating})</sub></h3></div>
              <img class='flip-card-poster' src="../../media/${
                movie.posterURL
              }" alt="Movie poster for ${movie.name}">
            </div>
            <div class="flip-card-back">
              <h2 id='flip-card-back-h2'>${movie.name} <sub>(${
      movie.rating
    })</sub></h2>
              <h3>Synopsis</h3>
              <p>${movie.synopsis}</p>
              <h3>Session times</h3>
              <p>${movie.showings.join('<br>')}</p>
              <a class='btn' href='booking.php?movie=${code}'>Buy Tickets</a>
            </div>
          </div>
        `;
    movieShowtimesContainer.appendChild(movieCard);
  }
}

export function initMovieDetails($_GET, movies, prices) {
  const movie = movies[$_GET.movie];
  const movieInfoDiv = document.getElementById('movie-info');
  const bookingDiv = document.getElementById('book');

  movieInfoDiv.innerHTML = `
        <div id="movie-info-heading">
          <h2 id='name'>${movie.name} <sub>(${movie.rating})</sub></h2>
        </div>

        <div id='movie-media-container'>
          <img id='booking-poster' src="../../media/${
            movie.posterURL
          }" alt="Movie poster for ${movie.name}">
          <div id='trailer-container'>
            <iframe id="trailer" src="https://www.youtube.com/embed/${
              movie.trailer
            }" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>

        <p id="synopsis">${movie.synopsis}</p>
        <div id="movie-detail-cards" class="card-container">
          <div class="movie-detail-card card-template"><h3>Director</h3><p id="director">${
            movie.director
          }</p></div>
          <div class="movie-detail-card card-template"><h3>STARS</h3><p id="actors">${
            movie.actors
          }</p></div>
          <div class="movie-detail-card card-template"><h3>Showtimes</h3><p id="showings">${movie.showings.join(
            ', '
          )}</p></div>
        </div>
      `;

  let dayRadios = '';
  for (let i = 0; i < movie.showings.length; i++) {
    dayRadios += `
          <input class='price-variable-input' type="radio" name="day" value="${movie.showings[
            i
          ].toUpperCase()}" id="day-${i}" ${
      i === 0 ? 'checked' : ''
    } data-pricing="${
      isDiscounted(movie.showings[i]) ? 'discprice' : 'fullprice'
    }">
          <label class='btn day-radio-label' for="day-${i}">${
      movie.showings[i]
    }</label>
        `;
  }

  let seatSelects = '';
  for (let code in prices) {
    seatSelects += `
          <label class='seat-selection-label' for="seats-${code}">${prices[code].name} Seats:</label>
          <select class='price-variable-input seat-selector' name="seats[${code}]" id="seats-${code}" data-fullprice="${prices[code].normal}" data-discprice="${prices[code].discounted}">
            <option value="">Please Select</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select><br>
        `;
  }

  bookingDiv.innerHTML = `
        <h2>Book now</h2>
        <form id='booking-form' action='booking.php?movie=${$_GET.movie}' method='post'>
          <input type='hidden' name='movie' value='${$_GET.movie}' />

          <input type='text' id='booking-name-field' name='user[name]' value='' placeholder='name' required/>
          <p class='error' id='nameError'></p>

          <input type='text' id='booking-email-field' name='user[email]' value='' placeholder='email' required/>

          <input type='text' id='booking-mobile-field' name='user[mobile]' value='' placeholder='mobile' required />
          <p class='error' id='mobileError'></p>
          
          <h3>Select a session</h3>
          ${dayRadios}
          <h3>Add seats</h3>
          ${seatSelects}
          <h2 id='booking-price'></h2>
          <input id="remember-me" class='btn' type='checkbox'/>
          <label id="remember-me-label" class='btn' for='remember-me'></label>
          <input id="submit" class='btn' type='submit' value="submit" />
          <label class='btn' for='submit'>Submit</label>
          <p class='error' id='selectionError'></p>
        </form>
      `;

  // initialise the remember me checkbox (or retrieve it's previous state from localstorage if available)
  const rememberMeBox = document.getElementById('remember-me');

  if (localStorage.getItem('rememberMe') === null) {
    rememberMeBox.checked = false;
    localStorage.setItem('rememberMe', 'false');
  } else if (localStorage.getItem('rememberMe') === 'true') {
    rememberMeBox.checked = true;
  } else {
    rememberMeBox.checked = false;
  }

  // listen to changes on the remember me checkbox and update localstorage accordingly
  // if the checkbox is un-set, clear the customer data
  rememberMeBox.addEventListener('change', (event) => {
    if (event.target.checked) {
      localStorage.setItem('rememberMe', 'true');
    } else {
      localStorage.setItem('rememberMe', 'false');
      clearDetails();
    }
    setRememberMeLabel();
  });

  const rememberMeLabel = document.getElementById('remember-me-label');

  // toggle the remember me label to reflect the current state of the checkbox (label indicates the action to be taken when clicked)
  function setRememberMeLabel() {
    rememberMeLabel.innerHTML = rememberMeBox.checked
      ? 'Forget me'
      : 'Remember me';
  }

  // initialise the remember me label
  setRememberMeLabel();

  if (rememberMeBox.checked) {
    const nameField = document.getElementById('booking-name-field');
    const mobileField = document.getElementById('booking-mobile-field');
    const emailField = document.getElementById('booking-email-field');
    nameField.value = localStorage.getItem('name');
    mobileField.value = localStorage.getItem('mobile');
    emailField.value = localStorage.getItem('email');
  }

  const bookingForm = document.getElementById('booking-form');
  bookingForm.addEventListener('submit', formValidate);

  const priceDisplay = document.getElementById('booking-price');

  document
    .querySelectorAll('.price-variable-input')
    .forEach(function (element) {
      element.addEventListener('change', function () {
        priceDisplay.innerHTML = calcPrice();
      });
    });
}

function calcPrice() {
  const pricing = document.querySelector('input[name="day"]:checked').dataset
    .pricing;

  const seats = document.querySelectorAll('.seat-selector');
  let total = 0;

  seats.forEach((element) => {
    let price = element.dataset[pricing];
    let quantity = element.value;

    total += price * quantity;
  });

  if (total == 0) return '';
  else return `Total: $${Number(total).toFixed(2)}`;
}

export function initCurrentBookings(bookings) {
  const currentBookingsContainer = document.getElementById(
    'current-bookings-container'
  );

  if (bookings.length === 0) {
    const bookingDiv = document.createElement('div');
    bookingDiv.classList.add('booking');
    bookingDiv.innerHTML = `
        <p>Sorry, no bookings were found under those details.</p>
      `;
    currentBookingsContainer.appendChild(bookingDiv);
  } else {
    bookings.forEach((booking) => {
      const bookingDiv = document.createElement('div');
      const GET_data = {
        'Order Date': booking[0],
        Name: booking[1],
        Email: booking[2],
        Mobile: booking[3],
        'Movie Code': booking[4],
        'Day of Movie': booking[5],
        'Time of Movie': booking[6],
        '%23STA': booking[7],
        $STA: booking[8],
        '%23STP': booking[9],
        $STP: booking[10],
        '%23STC': booking[11],
        $STC: booking[12],
        '%23FCA': booking[13],
        $FCA: booking[14],
        '%23FCP': booking[15],
        $FCP: booking[16],
        '%23FCC': booking[17],
        $FCC: booking[18],
        Total: booking[19],
        GST: booking[20]
      };

      bookingDiv.classList.add('booking-box');
      bookingDiv.innerHTML = `
          <p><b>Order Date:</b> ${GET_data['Order Date']}</p>
          <p><b>Name:</b> ${GET_data['Name']}</p>
          <p><b>Email:</b> ${GET_data['Email']}</p>
          <p><b>Mobile:</b> ${GET_data['Mobile']}</p>
          <p><b>Your Order</b><br></p>
          <p><b>TOTAL (incl GST):</b> \$${GET_data['Total']}</p>
          <p><b>GST:</b> \$${GET_data['GST']}</p>
          <p><a href='history.php?${Object.keys(GET_data)
            .map((key) => key + '=' + GET_data[key])
            .join('&')}' target="_blank">
            Get Tickets
          </a></p>
      `;
      currentBookingsContainer.appendChild(bookingDiv);
    });
  }
}
