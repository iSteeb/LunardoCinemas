export function initHistory(booking, movies) {
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
          
          ${quantity}x ${seatType} (\$${subtotal})<br>
        `;
      }
    }
  });

  receiptContainer.innerHTML = `
    <h2>Your Booking</h2>
    <p><b>Order Date:</b> ${booking['Order_Date']}</p>
    <p><b>Name:</b> ${booking['Name']}</p>
    <p><b>Email:</b> ${booking['Email']}</p>
    <p><b>Mobile:</b> ${booking['Mobile']}</p>
    <p><b>Your Order</b><br>${order}</p>
    <p><b>TOTAL (incl GST):</b> \$${booking['Total']}</p>
    <p><b>GST:</b> \$${booking['GST']}</p>
  `;

  Object.keys(booking).forEach((key) => {
    if (key.includes('#')) {
      let seatType = key.split('#')[1];
      let quantity = booking[key];
      let subtotal = booking[key.replace('#', '$')];
      let movie = movies[booking['Movie_Code']];
      if (quantity > 0) {
        for (let i = 0; i < quantity; i++) {
          ticketsContainer.innerHTML += `
            <div class="ticket" style="background: url('../../media/${
              movie.posterURL
            }')">
              <div class="ticket-inner">
                <h3>${movie.name} (${movie.rating})</h3>
                <p>Single Admission (${seatType}) <b>${
            booking['Day_of_Movie']
          } ${booking['Time_of_Movie']}</b></p>
                <p>\$${subtotal / quantity}</p>
              </div>
            </div>
          `;
        }
      }
    }
  });
}
