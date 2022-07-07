// event listener that controls the display status of the go-to-top-button (show only if scroll position is passed the navbar)
document.addEventListener(
  'scroll',
  function (e) {
    if (window.scrollY > document.getElementById('about').offsetTop) {
      document.getElementById('go-to-top-button').style.display = 'block';
    } else {
      document.getElementById('go-to-top-button').style.display = 'none';
    }
  },
  true
);

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
      document.getElementById(code).innerHTML =
        prices[code].name + ' (' + code + ') ' + prices[code].discounted;
    }
  } else {
    for (let code in prices) {
      document.getElementById(code).innerHTML =
        prices[code].name + ' (' + code + ') ' + prices[code].normal;
    }
  }
}

// initialise prices on load
var showDiscountedPrices = document.getElementById(
  'show-discounted-prices-checkbox'
);

updatePrices(showDiscountedPrices.checked);

// toggle between discounted and full seat prices on checkbox change
showDiscountedPrices.addEventListener('change', function () {
  updatePrices(this.checked);
});

// movies dictionary
const movies = {
  ACT: {
    name: 'Top Gun: Maverick',
    rating: 'PG-13',
    posterURL:
      'https://m.media-amazon.com/images/M/MV5BOWQwOTA1ZDQtNzk3Yi00ZmVmLWFiZGYtNjdjNThiYjJhNzRjXkEyXkFqcGdeQXVyODE5NzE3OTE@._V1_FMjpg_UX988_.jpg',
    synopsis:
      "After more than thirty years of service as one of the Navy's top aviators, Pete Mitchell is where he belongs, pushing the envelope as a courageous test pilot and dodging the advancement in rank that would ground him.",
    showings: ['Mon - Tue 9pm', 'Wed - Fri 9pm', 'Sat - Sun 6pm']
  },
  RMC: {
    name: 'Mrs Harris goes to Paris',
    rating: 'PG',
    posterURL:
      'https://m.media-amazon.com/images/M/MV5BY2UyOWJjMWEtNmIwYS00ZjM5LWEyYjMtMTI4NDBhMzViNmIyXkEyXkFqcGdeQXVyMDA4NzMyOA@@._V1_.jpg',
    synopsis:
      'A widowed cleaning lady in 1950s London falls madly in love with a couture Dior dress, and decides that she must have one of her own.',
    showings: ['Wed - Fri 12pm', 'Sat - Sun 3pm']
  },
  FAM: {
    name: 'Lightyear',
    rating: 'PG',
    posterURL:
      'https://m.media-amazon.com/images/M/MV5BYTg2Zjk0ZTctM2ZmMi00MDRmLWJjOGYtNWM0YjBmZTBjMjRkXkEyXkFqcGdeQXVyMTM1MTE1NDMx._V1_.jpg',
    synopsis:
      'While spending years attempting to return home, marooned Space Ranger Buzz Lightyear encounters an army of ruthless robots commanded by Zurg who are attempting to steal his fuel source.',
    showings: ['Mon - Tue 12pm', 'Wed - Fri 6pm', 'Sat - Sun 12pm']
  },
  AHF: {
    name: 'Prithviraj',
    rating: 'M',
    posterURL:
      'https://m.media-amazon.com/images/M/MV5BNzlkZjI3ZDctNTEzMy00MjUxLWI5YjQtYjg0ODNjNzdjZjg0XkEyXkFqcGdeQXVyNTkzNDQ4ODc@._V1_FMjpg_UX300_.jpg',
    synopsis:
      'A fearless warrior. An epic love story. Witness the grand saga of Samrat Prithviraj Chauhan.',
    showings: ['Mon - Tue 6pm', 'Sat - Sun 9pm']
  }
};

function updatePrices(isChecked) {
  if (isChecked) {
    for (let code in prices) {
      document.getElementById(code).innerHTML =
        prices[code].name + ' (' + code + ') ' + prices[code].discounted;
    }
  } else {
    for (let code in prices) {
      document.getElementById(code).innerHTML =
        prices[code].name + ' (' + code + ') ' + prices[code].normal;
    }
  }
}

// insert movies on load
var movieShowtimesContainer = document.getElementById('movie-cards');

for (let code in movies) {
  let movie = movies[code];
  let movieCard = document.createElement('div');
  movieCard.className = 'movie-card card-template';
  movieCard.innerHTML = `
    <div class="movie-poster">
      <img src="${movie.posterURL}" alt="${movie.name}">
    </div>
    <div class="movie-details">
      <h2>${movie.name}</h2>
      <p>${movie.synopsis}</p>
      <p>${movie.rating}</p>
      <p>${movie.showings.join('<br>')}</p>
      <a href="booking.php?movie=${code}">Buy Tickets</a>
    </div>
  `;
  movieShowtimesContainer.appendChild(movieCard);
}
