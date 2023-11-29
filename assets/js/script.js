// $(document).ready(function(){
//     $('.burgermenu').on('click', function(){
//         $(' .show').toggle();
//     })
// });



document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.querySelector('.burger-menu');
    const navLinks = document.querySelector('.navbar');

    burgerMenu.addEventListener('click', function () {
        navLinks.classList.toggle('show');
    });
});
