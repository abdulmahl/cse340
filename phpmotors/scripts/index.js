function toggleMenu() {
    document.querySelector("#primaryNav").classList.toggle("open");
    document.querySelector("#hamBtn").classList.toggle("open");
}

const x = document.querySelector("#hamBtn");
x.onclick = toggleMenu;