

document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.querySelector('.burger-menu');
    const navLinks = document.querySelector('.navbar');

    burgerMenu.addEventListener('click', function () {
        navLinks.classList.toggle('show');
    });
});






function validate_email(email) {
    if (email == "" ) {
      document.getElementById("email").innerHTML = "";
      document.getElementById("msg").innerHTML ="";
      return;
    }
    let c =email.length;
    if (email != "" && c <= 6) {
      document.getElementById("email").innerHTML = "";
      document.getElementById("msg").innerHTML ="";
      return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
      document.getElementById("msg").innerHTML =this.responseText;
      if (this.responseText.includes("email is taken") ){
              document.getElementById("msg").style.color = "red";
              document.getElementById("email").style.borderBottom = "2px solid red";
             
            }else if (this.responseText.includes("email is not registered")) {
              document.getElementById("msg").style.color = "green";  
     
    }

  }


    xhttp.open("GET", "vemail.php?q=" + email);
   
    xhttp.send();

  }