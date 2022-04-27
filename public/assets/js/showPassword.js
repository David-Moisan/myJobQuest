function handleClick() {
    addEventListener("click", () => {
        let eye = document.getElementsByClassName("fa-eye-slash")
        
        if (eye.classList.contains('fa-eye-slash')) {
            eye.classList.replace('fa-eye-slash', 'fa-eye')
            console.log(eye);
        } else {
            eye.classList.replace('fa-eye', 'fa-eye-slash')
            console.log(eye);
        }
    })
}