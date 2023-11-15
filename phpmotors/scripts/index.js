//? Toggle between the menu using the hamburger button.
function toggleMenu() {
    document.querySelector("#primaryNav").classList.toggle("open");
    document.querySelector("#hamBtn").classList.toggle("open");
}

const x = document.querySelector("#hamBtn");
x.onclick = toggleMenu;

const showPassword = document.querySelector("#show-password");

//? Show password when required.
showPassword.onclick = () => {
    let x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}