<script>
    const themeToggle = document.querySelector('.theme-toggle');
    const savedTheme = localStorage.getItem('hirehub-theme');

    if (savedTheme === 'night') {
        document.body.classList.add('night-mode');
    }

    const syncThemeIcon = () => {
        const icon = themeToggle?.querySelector('i');
        if (!icon) return;

        icon.className = document.body.classList.contains('night-mode')
            ? 'fa-solid fa-sun'
            : 'fa-solid fa-moon';
    };

    syncThemeIcon();

    themeToggle?.addEventListener('click', () => {
        document.body.classList.toggle('night-mode');
        localStorage.setItem(
            'hirehub-theme',
            document.body.classList.contains('night-mode') ? 'night' : 'day'
        );
        syncThemeIcon();
    });
</script>
</body>

</html>
