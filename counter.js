// JavaScript code to update the counter
console.log(test)
let counter = 0;
const counterElement = document.querySelector('.counter');

setInterval(() => {
  counterElement.textContent = counter;
  counter++;
  if (counter > 999) {
    counter = 0;
  }
}, 100); // update every 100ms