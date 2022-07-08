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
export const movies = {
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
export const prices = {
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

export function updatePrices(isChecked) {
  if (isChecked) {
    for (let code in prices) {
      document.getElementById(
        code
      ).innerHTML = `${prices[code].name} (${code})<br><span style="font-size:1.5em">$${prices[code].discounted}</span>`;
    }
    document.getElementById('discount-notice').innerHTML =
      'Discounts only apply to 12pm weekday matinée sessions, and all day Monday.';
  } else {
    for (let code in prices) {
      document.getElementById(
        code
      ).innerHTML = `${prices[code].name} (${code})<br><span style="font-size:1.5em">$${prices[code].normal}</span>`;
    }
    document.getElementById('discount-notice').innerHTML = '';
  }
}

export function isDiscounted(session) {
  if (session.includes('Mon')) return true;
  if (
    session.includes('12pm') &&
    !session.includes('Sat') &&
    !session.includes('Sun')
  )
    return true;
  return false;
}
