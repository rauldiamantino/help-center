function setupToggle() {
    const internSidebarArticle = document.querySelector('.intern-sidebar-article')
    const buttonOpenInternSidebarArticle = document.querySelector('.button-open-intern-sidebar-article')

    if (!buttonOpenInternSidebarArticle || !internSidebarArticle) {
        return
    }

    buttonOpenInternSidebarArticle.addEventListener('click', () => {
        internSidebarArticle.classList.toggle('opacity-0');
        internSidebarArticle.classList.toggle('invisible');
        internSidebarArticle.classList.toggle('opacity-100');
        internSidebarArticle.classList.toggle('visible');
    })
}

document.addEventListener('livewire:load', setupToggle)
document.addEventListener('livewire:navigated', setupToggle)
