// Span eyes
let eye = document.getElementById("show-password")

function handleClick() {
    // Span eyes
    let eye = document.getElementById("show-password")
    // Input password
    let inputType = document.getElementById("inputPassword")
    //Conditions
    if (eye.classList.contains('fa-eye-slash')) {
        eye.classList.replace('fa-eye-slash', 'fa-eye')
        inputType.type = "text"
    } else {
        eye.classList.replace('fa-eye', 'fa-eye-slash')
        inputType.type = "password"
    }
}

const once = {
    once: true
}

eye.addEventListener("click", handleClick, once)