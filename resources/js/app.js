import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', function () {
    // =========================
    // USER DROPDOWN
    // =========================
    const userDropdownButton = document.getElementById('userDropdownButton');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    if (userDropdownButton && userDropdownMenu) {
        userDropdownButton.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!userDropdownButton.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }

    // =========================
    // MOBILE SIDEBAR
    // =========================
    const sidebar = document.getElementById('sidebar');
    const openSidebar = document.getElementById('openSidebar');
    const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');

    function showSidebar() {
        sidebar?.classList.remove('-translate-x-full');
        mobileSidebarOverlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function hideSidebar() {
        sidebar?.classList.add('-translate-x-full');
        mobileSidebarOverlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    openSidebar?.addEventListener('click', showSidebar);
    mobileSidebarOverlay?.addEventListener('click', hideSidebar);

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            mobileSidebarOverlay?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
});
