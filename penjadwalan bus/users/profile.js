let profileBtn = document.querySelector(".open-profile"),
    securityBtn = document.querySelector(".open-security");

profileBtn.addEventListener("click", function(){
    document.querySelector(".change-profile").classList.remove("inactive");
    document.querySelector(".change-security").classList.add("inactive");
    profileBtn.classList.add("selected");
    securityBtn.classList.remove("selected");
})

securityBtn.addEventListener("click", function(){
    document.querySelector(".change-profile").classList.add("inactive");
    document.querySelector(".change-security").classList.remove("inactive");
    profileBtn.classList.remove("selected");
    securityBtn.classList.add("selected");
})