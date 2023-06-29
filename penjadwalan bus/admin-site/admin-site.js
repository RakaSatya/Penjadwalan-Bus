// Dark Mode and Close Nav

// Check if 'darkMode' exists in localStorage, if not, set it to 'false'

if (localStorage.getItem('darkMode') === null) {
    localStorage.setItem('darkMode', 'false');
}

// Get the current dark mode value from localStorage and convert it to a boolean
let darkMode = localStorage.getItem('darkMode') === 'true';

// Apply the dark mode class to the body on page load
document.querySelector("body").classList.toggle("dark", darkMode);

document.querySelector(".mode").addEventListener("click", () => {
    // Toggle the dark mode value
    darkMode = !darkMode;

    // Apply the dark mode class to the body
    document.querySelector("body").classList.toggle("dark", darkMode);

    // Update the dark mode value in localStorage as a string
    localStorage.setItem('darkMode', darkMode.toString());
});

document.querySelector(".close-btn").
addEventListener("click", function(){
    document.querySelector(".nav").classList.toggle("close");
    document.querySelector(".close-btn i").classList.toggle("closed");
})

// Create Calendar

const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".date"),
prevNextIcon = document.querySelectorAll(".month-year i");


// CurrYear -> STRING
// CurrMonth -> STRING

let currYear = localStorage.getItem('currYear') || new Date().getFullYear();
let currMonth = localStorage.getItem('currMonth') || new Date().getMonth();


// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];



const renderCalendar = () => {
    let monthplusone = parseInt(currMonth) + 1;// Convert STRING to INT and then + 1

    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, monthplusone, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { 
        // creating li of previous month last days
        liTag += `<div class="day prev-day">${lastDateofLastMonth - i + 1}</div>`;
    }
    
    for (let i = 1; i <= lastDateofMonth; i++) { 
        // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        liTag += `<div class="day"><button type = "submit" name = "select_date"
        value = "${currYear}-${monthplusone}-${i}">${i}</button></div>`;
    }

    let n = 6;
    if((firstDayofMonth + lastDateofMonth) <= 35){
        n = 13;
    }

    for (let i = lastDayofMonth; i < n; i++) { 
        // creating li of next month first days
        liTag += `<div class="day next-day">${i - lastDayofMonth + 1}</div>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
}   

renderCalendar();

prevNextIcon.forEach(icon => {
     // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        if (icon.id === "prev") {
            currMonth--;
            if (currMonth < 0) {
                currMonth = 11;
                currYear--;
        }
        } else {
            currMonth++;
            if (currMonth > 11) {
                currMonth = 0;
                currYear++;
            }
        }
        localStorage.setItem('currYear', currYear);
        localStorage.setItem('currMonth', currMonth);
        //alert(currYear + "-" + currMonth + "-" + "9");
        renderCalendar(); // calling renderC    alendar function
    });
});

// prevent the currYear and currMonth from getting re-initiate to current realtime date on refresh
window.addEventListener("beforeunload", () => {
    let session = sessionStorage.getItem('register');

    if (session == null) {
        localStorage.removeItem('currYear');
        localStorage.removeItem('currMonth');

    }
    sessionStorage.setItem('register', 1);
});