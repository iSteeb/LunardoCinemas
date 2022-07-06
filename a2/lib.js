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
for (let code in prices) {
  document.getElementById(code).innerHTML =
    prices[code].name + ' (' + code + ') ' + prices[code].normal;
}

// toggle between discounted and full seat prices
var showDiscountedPrices = document.getElementById('test');
showDiscountedPrices.addEventListener('change', function () {
  if (this.checked) {
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
});
