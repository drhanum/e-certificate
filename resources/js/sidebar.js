const menuBtn = document.getElementById('menuBtn');
const closeBtn = document.getElementById('closeBtn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const cekLink = document.getElementById('cekLink');
const fiturLink = document.getElementById('fiturLink');
const hubungiLink = document.getElementById('hubungiLink');

cekLink?.addEventListener('click', () => {
    sidebar.style.left = '-260px';
    overlay.classList.add('hidden');
});

fiturLink?.addEventListener('click', () => {
    sidebar.style.left = '-260px';
    overlay.classList.add('hidden');
});

hubungiLink?.addEventListener('click', () => {
    sidebar.style.left = '-260px';
    overlay.classList.add('hidden');
});

if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        sidebar.style.left = '0';
        overlay.classList.remove('hidden');
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', closeSidebar);
}

if (overlay) {
    overlay.addEventListener('click', closeSidebar);
}

function closeSidebar() {
    sidebar.style.left = '-260px';
    overlay.classList.add('hidden');
}
