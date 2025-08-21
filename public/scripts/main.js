let menuClosed = false;
const menuToggle = document.querySelector('.menu_toggle');
const website_content = document.querySelector('.website_content');
const mobile_menu = document.querySelector('.mobile_menu');
const footer = document.querySelector('.footer_section');
const body = document.querySelector('body');

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1160) {
        menuToggle.innerHTML = '<i class="bi bi-list"></i>';
        menuClosed = false;

        body.style.backgroundColor = "var(--background_color)";
        mobile_menu.style.display = "none";
        website_content.style.display = 'flex';
        footer.style.display = 'block';
    }
});

function toggleMenu() {

    if (menuClosed) {

        menuToggle.innerHTML = '<i class="bi bi-list"></i>';
        menuClosed = false;

        mobile_menu.style.display = "none";
        body.style.backgroundColor = "var(--background_color)";
        website_content.style.display = 'flex';
        footer.style.display = 'block';

    } else {

        menuToggle.innerHTML = '<i class="bi bi-x-lg"></i>';
        menuClosed = true;

        body.style.backgroundColor = "#ffffffff";

        mobile_menu.style.display = "flex";
        website_content.style.display = 'none';
        footer.style.display = 'none';

    }

}