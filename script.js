// Function to validate a form
function validateForm() {
  var nameInput = document.getElementById("name");
  var emailInput = document.getElementById("email");
  var passwordInput = document.getElementById("password");

  var isValid = true;

  if (nameInput.value.trim() === "") {
    nameInput.classList.add("error");
    isValid = false;
  } else {
    nameInput.classList.remove("error");
  }

  if (emailInput.value.trim() === "") {
    emailInput.classList.add("error");
    isValid = false;
  } else {
    emailInput.classList.remove("error");
  }

  if (passwordInput.value.trim() === "") {
    passwordInput.classList.add("error");
    isValid = false;
  } else {
    passwordInput.classList.remove("error");
  }

  return isValid;
}

// Function to display a countdown timer
function countdownTimer(duration, displayElement) {
  var timer = duration;
  var minutes, seconds;

  var interval = setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    displayElement.textContent = minutes + ":" + seconds;

    if (--timer < 0) {
      clearInterval(interval);
      displayElement.textContent = "Time's up!";
    }
  }, 1000);
}

// Function to fetch data from a remote API using Fetch API
function fetchData(url) {
  fetch(url)
    .then(function (response) {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error("Error: " + response.status);
      }
    })
    .then(function (data) {
      console.log(data);
    })
    .catch(function (error) {
      console.log(error);
    });
}

// Example usage of the functions
document.addEventListener("DOMContentLoaded", function () {
  // Validate form on submit
  var form = document.getElementById("my-form");
  form.addEventListener("submit", function (event) {
    if (!validateForm()) {
      event.preventDefault();
    }
  });

  // Start a countdown timer
  var duration = 120; // 2 minutes
  var displayElement = document.getElementById("timer");
  countdownTimer(duration, displayElement);

  // Fetch data from a remote API
  var apiUrl = "https://api.example.com/data";
  fetchData(apiUrl);
});
