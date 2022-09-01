export function initReceipt(booking, movies) {
  var receiptContainer = document.getElementById('receipt');
  var ticketsContainer = document.getElementById('tickets');
  var order = '';
  Object.keys(booking).forEach((key) => {
    if (key.includes('#')) {
      let seatType = key.split('#')[1];
      let quantity = booking[key];
      let subtotal = booking[key.replace('#', '$')];
      if (quantity > 0) {
        order += `
          
          ${quantity}x ${seatType} (\$${subtotal.toFixed(2)})<br>
        `;
      }
    }
  });

  receiptContainer.innerHTML = `
    <h2>Congratulations, your order has been placed!</h2>
    <p><b>Order Date:</b> ${booking['Order Date']}</p>
    <p><b>Name:</b> ${booking['Name']}</p>
    <p><b>Email:</b> ${booking['Email']}</p>
    <p><b>Mobile:</b> ${booking['Mobile']}</p>
    <p><b>Your Order</b><br>${order}</p
    <p><b>TOTAL (incl GST):</b> \$${booking['Total'].toFixed(2)}</p>
    <p><b>GST:</b> \$${booking['GST']}</p>
  `;

  Object.keys(booking).forEach((key) => {
    if (key.includes('#')) {
      let seatType = key.split('#')[1];
      let quantity = booking[key];
      let subtotal = booking[key.replace('#', '$')];
      let movie = movies[booking['Movie Code']];
      if (quantity > 0) {
        for (let i = 0; i < quantity; i++) {
          ticketsContainer.innerHTML += `
            <div class="ticket" style="background: url('../../media/${
              movie.posterURL
            }')">
              <div class="ticket-inner">
                <h3>${movie.name} (${movie.rating})</h3>
                <p>Single Admission (${seatType}) <b>${
            booking['Day of Movie']
          } ${booking['Time of Movie']}</b></p>
                <p>\$${(subtotal / quantity).toFixed(2)}</p>
              </div>
            </div>
          `;
        }
      }
    }
  });
}
