const container = document.querySelector('.container');
//const seats = document.querySelectorAll('.row .seat:not(.occupied');
const count = document.getElementById('count');
const total = document.getElementById('total');
const movieSelect = document.getElementById('movie');
const selectedSeatCountInput = document.getElementById('selectedSeatCountInput');
const selectedSeatsIndexInput = document.getElementById('selectedSeatsIndexInput');
let selectedSeats = []; 

// Get all seat elements
const seats = document.querySelectorAll('.seat');

seats.forEach(seat => {
  seat.addEventListener('click', function() {
    // Get the seat index (assuming seat_no is a data attribute)
    const seatIndex = parseInt(this.dataset.seatNo); // Adjust selector if needed

    // Update selectedSeats array
    if (this.classList.contains('selected')) {
      // Remove from array if already selected
      selectedSeats.splice(selectedSeats.indexOf(seatIndex), 1);
    } else {
      // Add to array if not selected
      selectedSeats.push(seatIndex);
    }

    // Update class based on selection
    this.classList.toggle('selected');

    // console.log(selectedSeats); Log the updated array

    // Update hidden input fields
    selectedSeatCountInput.value = selectedSeats.length;
    selectedSeatsIndexInput.value = JSON.stringify(selectedSeats);

  });
});
// Add click event listener to each seat
// seats.forEach(seat => {
//   seat.addEventListener('click', function() {
    
//     // Add 'selected' class to the clicked seat
//     this.classList.add('selected');
//     console.log(selectedSeats);

//     // Update hidden input fields
//     selectedSeatCountInput.value = selectedSeats.length;
//     selectedSeatsIndexInput.value = JSON.stringify(selectedSeats);  // Convert array to JSON string

//   });
// });

// populateUI();
// let ticketPrice = +movieSelect.value;

// // Save selected movie index and price
// function setMovieData(movieIndex, moviePrice) {
//   localStorage.setItem('selectedMovieIndex', movieIndex);
//   localStorage.setItem('selectedMoviePrice', moviePrice);
// }

// // update total and count
// function updateSelectedCount() {
//   const selectedSeats = document.querySelectorAll('.row .seat.selected');
//   const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

//   localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

//   // copy selected seats into arr
//   // map through array
//   // return new array of indexes

//   const selectedSeatsCount = selectedSeats.length;

//   count.innerText = selectedSeatsCount;
//   total.innerText = selectedSeatsCount * 1750; // Update total price with ticket price
// }


// // function updateSelectedCount() {
// //   const selectedSeats = document.querySelectorAll('.row .seat.selected');

// //   const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

// //   localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

// //   //copy selected seats into arr
// //   // map through array
// //   //return new array of indexes

// //   const selectedSeatsCount = selectedSeats.length;

// //   count.innerText = selectedSeatsCount;
// //   total.innerText = selectedSeatsCount * 1700;
// // }

// // get data from localstorage and populate ui
// function populateUI() {
//   const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));
//   if (selectedSeats !== null && selectedSeats.length > 0) {
//     seats.forEach((seat, index) => {
//       if (selectedSeats.indexOf(index) > -1) {
//         seat.classList.add('selected');
//       }
//     });
//   }

//   const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

//   if (selectedMovieIndex !== null) {
//     movieSelect.selectedIndex = selectedMovieIndex;
//   }
// }

// // Movie select event
// movieSelect.addEventListener('change', (e) => {
//   ticketPrice = +e.target.value;
//   setMovieData(e.target.selectedIndex, e.target.value);
//   updateSelectedCount();
// });

// // Seat click event
// container.addEventListener('click', (e) => {
//   if (e.target.classList.contains('seat') && !e.target.classList.contains('occupied')) {
//     e.target.classList.toggle('selected');

//     updateSelectedCount();
//   }
// });

// // intial count and total
// updateSelectedCount();