//? Toggle between the menu using the hamburger button.
function toggleMenu() {
    document.querySelector("#primaryNav").classList.toggle("open");
    document.querySelector("#hamBtn").classList.toggle("open");
}

const x = document.querySelector("#hamBtn");
x.onclick = toggleMenu;