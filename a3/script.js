/* Insert your javascript here */

// get the element with the id of 'id' helper function
function getid(sP) {
  return document.getElementById(sP);
}

// clear errors
function clearErrors() {
  var allErrors = document.getElementsByClassName('error');
  for (let error in allErrors) {
    error.innerHTML = '';
  }
}

// validate name to contain alphabetic characters or ,.'- only
function nameCheck() {
  var name = getid('booking-name-field').value;
  var patt = /^[a-zA-Z ,.'-]+$/;
  if (patt.test(name)) {
    return true;
  } else {
    getid('nameError').innerHTML = 'Sorry, your name must be valid.';
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
    return true;
  } else {
    getid('mobileError').innerHTML =
      'Sorry, you must provide a valid Australian mobile number.';
    return false;
  }
}

// validate selection: if a price is displayed, assume valid selection is made
// calcPrice() function in ./lib.js ensures actual validation
function seatsSelectedCheck() {
  var price = getid('booking-price').innerText;
  if (price != '') return true;
  else {
    getid('selectionError').innerHTML =
      'Please select a session and at least one seat.';
    return false;
  }
}

export function formValidate(event) {
  clearErrors();
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
