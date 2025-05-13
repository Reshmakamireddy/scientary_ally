console.log("task.js loaded");

// Sidebar toggle functionality (collapse/expand sidebar)
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const header = document.getElementById('header');
const chevronToggle = document.getElementById('chevronToggle');

function toggleSidebar() {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
    header.classList.toggle('collapsed');
    const icon = chevronToggle.querySelector('i');
    icon.classList.toggle('fa-chevron-left');
    icon.classList.toggle('fa-chevron-right');
}

if (chevronToggle) {
    chevronToggle.addEventListener('click', toggleSidebar);
}

// Sidebar menu and submenu toggle
const menuItems = document.querySelectorAll('.sidebar-menu > li');
console.log(`Found menu items: ${menuItems.length}`);

menuItems.forEach((item, index) => {
    const toggleIcon = item.querySelector('.toggle-icon');
    const submenu = item.querySelector('.submenu');
    const menuLink = item.querySelector('.menu-link');

    if (toggleIcon && submenu) {
        // Toggle submenu when clicking the caret icon
        toggleIcon.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent the event from bubbling up to the <a> tag
            console.log(`Toggling submenu for menu item ${index + 1}`);
            submenu.classList.toggle('active');
            toggleIcon.classList.toggle('collapsed');

            // Close other submenus
            menuItems.forEach(otherItem => {
                const otherSubmenu = otherItem.querySelector('.submenu');
                const otherToggleIcon = otherItem.querySelector('.toggle-icon');
                if (otherItem !== item && otherSubmenu && otherToggleIcon) {
                    otherSubmenu.classList.remove('active');
                    otherToggleIcon.classList.remove('collapsed');
                }
            });
        });
    }

    // Handle navigation for top-level menu links
    if (menuLink) {
        menuLink.addEventListener('click', function (e) {
            const href = menuLink.getAttribute('href');
            // If the menu item has a submenu and href is "javascript:void(0)", toggle submenu instead of navigating
            if (href === "javascript:void(0)" && submenu) {
                e.preventDefault();
                console.log(`Toggling submenu for menu item ${index + 1} via menu link`);
                submenu.classList.toggle('active');
                if (toggleIcon) {
                    toggleIcon.classList.toggle('collapsed');
                }

                // Close other submenus
                menuItems.forEach(otherItem => {
                    const otherSubmenu = otherItem.querySelector('.submenu');
                    const otherToggleIcon = otherItem.querySelector('.toggle-icon');
                    if (otherItem !== item && otherSubmenu && otherToggleIcon) {
                        otherSubmenu.classList.remove('active');
                        otherToggleIcon.classList.remove('collapsed');
                    }
                });
            }
            // Otherwise, navigate to the href
            else if (href && href !== '#' && href !== "javascript:void(0)") {
                e.preventDefault(); // Prevent default to control navigation manually
                console.log(`Navigating to: ${href}`);
                window.location.href = href;
            }
        });
    }
});

// Handle submenu link clicks (only for submenu links)
const submenuLinks = document.querySelectorAll('.submenu a');
console.log(`Found submenu links: ${submenuLinks.length}`);

submenuLinks.forEach((link, index) => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const href = link.getAttribute('href');
        console.log(`Submenu link ${index + 1} clicked: ${href}`);
        if (href && href !== '#') {
            window.location.href = href;
        }
    });
});