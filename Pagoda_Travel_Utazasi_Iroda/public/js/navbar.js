//Hamburger menü, csak akkor jelenik meg ha mobil nézetben vagy és vagy összehúzod az ablakot a böngészőben!!!!!
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.getElementById('navbar-links');

    mobileMenu.addEventListener('click', function () {
        navLinks.classList.toggle('active');
    });
});
