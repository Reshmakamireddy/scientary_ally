document.addEventListener('DOMContentLoaded', function () {
    // Sidebar toggle (chevron)
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

    chevronToggle.addEventListener('click', toggleSidebar);

    // Submenu toggle (caret)
    const menuItems = document.querySelectorAll('.sidebar-menu > li');
    menuItems.forEach(item => {
        const toggleIcon = item.querySelector('.toggle-icon');
        const submenu = item.querySelector('.submenu');
        if (toggleIcon && submenu) {
            toggleIcon.addEventListener('click', function (e) {
                e.preventDefault();
                submenu.classList.toggle('active');
                toggleIcon.classList.toggle('collapsed');
            });
        }
    });

    // Initialize Bootstrap tooltips for header icons
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(tooltipTriggerEl => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});