function setupToggle() {
    const sidebar = document.querySelector('.sidebar-category');
    const btnClose = document.querySelector('.button-close-sidebar-category');
    const btnOpen = document.querySelector('.button-open-sidebar-category');

    if (btnClose && sidebar && btnOpen) {
        btnClose.addEventListener('click', () => {
            sidebar.classList.add('hidden');
            btnOpen.classList.remove('hidden');
        });

        btnOpen.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
            btnOpen.classList.add('hidden');
        });
    }
}

document.addEventListener('DOMContentLoaded', setupToggle);
document.addEventListener('livewire:load', setupToggle);
document.addEventListener('livewire:navigated', setupToggle);
