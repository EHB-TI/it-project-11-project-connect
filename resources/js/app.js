window.toggleDropdown = function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('hidden');
}

window.toggleNavbar = function() {
    var navbar = document.getElementById('navbar');
    var hamburgerIcon = document.getElementById('hamburger-icon');
    var closeIcon = document.getElementById('close-icon');

    navbar.classList.toggle('hidden');
    navbar.classList.toggle('md:flex');

    hamburgerIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
}
