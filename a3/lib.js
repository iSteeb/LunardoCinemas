import { formValidate } from './script.js';

// this file contains only pre-existing (from A2) javascript code.
// some of this code has been extracted from the inline scripts that were used in A2.

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

// movies dictionary
const movies = {
  ACT: {
    name: 'Top Gun: Maverick',
    rating: 'PG-13',
    posterURL: 'maverick.png',
    synopsis:
      "After more than thirty years of service as one of the Navy's top aviators, Pete Mitchell is where he belongs, pushing the envelope as a courageous test pilot and dodging the advancement in rank that would ground him.",
    trailer: 'giXco2jaZ_4',
    actors: 'Tom Cruise, Jennifer Connelly, Miles Teller',
    director: 'Joseph Kosinski',
    showings: [
      'Mon 9pm',
      'Tue 9pm',
      'Wed 9pm',
      'Thu 9pm',
      'Fri 9pm',
      'Sat 6pm',
      'Sun 6pm'
    ]
  },
  RMC: {
    name: 'Mrs Harris goes to Paris',
    rating: 'PG',
    posterURL: 'harris.png',
    synopsis:
      'A widowed cleaning lady in 1950s London falls madly in love with a couture Dior dress, and decides that she must have one of her own.',
    trailer: 'iO9JcPbbmAA',
    actors: 'Lesley Manville, Jason Isaacs, Anna Chancellor',
    director: 'Anthony Fabian',
    showings: ['Wed 12pm', 'Thu 12pm', 'Fri 12pm', 'Sat 3pm', 'Sun 3pm']
  },
  FAM: {
    name: 'Lightyear',
    rating: 'PG',
    posterURL: 'lightyear.png',
    synopsis:
      'While spending years attempting to return home, marooned Space Ranger Buzz Lightyear encounters an army of ruthless robots commanded by Zurg who are attempting to steal his fuel source.',
    trailer: 'wHBBoUtJHhA',
    actors: 'Chris Evans, Keke Palmer, Peter Sohn',
    director: 'Angus MacLane',
    showings: [
      'Mon 12pm',
      'Tue 12pm',
      'Wed 6pm',
      'Thu 6pm',
      'Fri 6pm',
      'Sat 12pm',
      'Sun 12pm'
    ]
  },
  AHF: {
    name: 'Prithviraj',
    rating: 'M',
    posterURL: 'prithviraj.png',
    synopsis:
      'A fearless warrior. An epic love story. Witness the grand saga of Samrat Prithviraj Chauhan.',
    trailer: '33-CQdPHyjw',
    actors: 'Akshay Kumar, Sanjay Dutt, Manushi Chhillar',
    director: 'Chandra Prakash Dwivedi',
    showings: ['Mon 6pm', 'Tue 6pm', 'Sat 9pm', 'Sun 9pm']
  }
};

// seat prices dictionary
const prices = {
  STA: {
    name: 'Standard Adult',
    normal: '20.50',
    discounted: '15.00'
  },
  STP: {
    name: 'Standard Concession',
    normal: '18.00',
    discounted: '13.50'
  },
  STC: {
    name: 'Standard Child',
    normal: '16.50',
    discounted: '12.00'
  },
  FCA: {
    name: 'First Class Adult',
    normal: '30.00',
    discounted: '24.00'
  },
  FCP: {
    name: 'First Class Concession',
    normal: '27.00',
    discounted: '22.50'
  },
  FCC: {
    name: 'First Class Child',
    normal: '24.00',
    discounted: '21.00'
  }
};

function updatePrices(isChecked) {
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

export function initPrices() {
  var showDiscountedPrices = document.getElementById(
    'show-discounted-prices-checkbox'
  );

  updatePrices(showDiscountedPrices.checked);

  // toggle between discounted and full seat prices on checkbox change
  showDiscountedPrices.addEventListener('change', function () {
    updatePrices(this.checked);
  });
}

export function initMovies() {
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

export function initMovieDetails($_GET) {
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
