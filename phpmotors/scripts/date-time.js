let dayOfWeek = [
    "Sun",
    'Mon',
    'Tue',
    "Wed",
    "Thu",
    "Fri",
    "Sat"
];

let _month = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec"
];

const date = new Date();

let day = dayOfWeek[date.getDay()];
let month = _month[date.getMonth()];
let year = date.getFullYear();

const dateFormat = `${day} ${date.getDate()} ${month}, ${year}`;

document.querySelector("#year").textContent = year;
document.querySelector("#updated").textContent = dateFormat;