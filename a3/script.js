/* Insert your javascript here */

// get the element with the id of 'id' helper function
function getid(sP) {
  return document.getElementById(sP);
}

// validate name to contain alphabetic characters or ,.'- only
function nameCheck() {
  var name = getid('booking-name-field').value;
  var patt = /^[a-zA-Z ,.'-]+$/;
  if (patt.test(name)) {
    getid('nameError').innerText = '';
    return true;
  } else {
    getid('nameError').innerText = 'Sorry, your name must be valid.';
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
    getid('mobileError').innerText = '';
    return true;
  } else {
    getid('mobileError').innerText =
      'Sorry, you must provide a valid Australian mobile number.';
    return false;
  }
}

// validate selection: if a price is displayed, assume valid selection is made
// calcPrice() function ensures actual validation
function seatsSelectedCheck() {
  var price = getid('booking-price').innerText;
  if (price.length >= 5) {
    getid('selectionError').innerText = '';
    return true;
  } else {
    getid('selectionError').innerText =
      'Please select a session and at least one seat.';
    return false;
  }
}

export function formValidate(event) {
  var allErrors = document.getElementsByClassName('error');

  var countErrors = 0;

  if (!nameCheck()) countErrors++;

  if (!mobileCheck()) countErrors++;

  if (!seatsSelectedCheck()) countErrors++;

  if (countErrors > 0) {
    event.preventDefault();
    return false;
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
          ]
            .substr(0, 3)
            .toUpperCase()}" id="day-${i}" ${
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

          <input type='text' name='user[email]' value='' placeholder='email' required/>

          <input type='text' id='booking-mobile-field' name='user[mobile]' value='' placeholder='mobile' required />
          <p class='error' id='mobileError'></p>
          
          <h3>Select a session</h3>
          ${dayRadios}
          <h3>Add seats</h3>
          ${seatSelects}
          <input id="submit" class='btn' type='submit' value="submit" />
          <label class='btn' for='submit'>Submit</label>
          <h3 id='booking-price'></p>
          <p class='error' id='selectionError'></p>
        </form>
      `;

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
