import '/assets/styles/main/main.scss';
import '/assets/styles/main/navigation/sidebar_menu.scss';
import '/assets/styles/main/_play_banner.scss';
import '/assets/styles/main/navigation/footer.scss';

// NAVIGATION
// Sidebar Menu
const body = document.querySelector("#body_container")
const navWrapper = document.querySelector("#nav_wrapper")
const navSidebar = document.querySelector("#sidebar-wrapper #menu-toggle")
navSidebar.addEventListener('click', function(e) {
    e.preventDefault();
    navWrapper.classList.toggle("toggled");
});
body.addEventListener('click', function(){
    if (navWrapper.classList.contains("toggled"))
        navWrapper.classList.toggle("toggled");
});

// Footer