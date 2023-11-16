
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