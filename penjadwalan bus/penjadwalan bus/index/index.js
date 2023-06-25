let formBtn = document.querySelector(".login-link"),
    closeFormBtn = document.querySelector(".close-btn"),
    registerBtn = document.getElementById("registerBtn"),
    loginForm = document.querySelector(".login"),
    registerForm = document.querySelector(".register"),
    loginBtn = document.getElementById("loginBtn");

formBtn.addEventListener("click",function(){
    document.querySelector(".overlay").classList.add("active");
})

closeFormBtn.addEventListener("click",function(){
    document.querySelector(".overlay").classList.remove("active");
})

registerBtn.addEventListener("click",function(){
    loginForm.classList.add("inactive");
    registerForm.classList.remove("inactive");
})

loginBtn.addEventListener("click",function(){
    loginForm.classList.remove("inactive");
    registerForm.classList.add("inactive");
})