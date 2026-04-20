    </main>
</div>
<script>
document.querySelectorAll('[data-confirm]').forEach((element) => {
    element.addEventListener('submit', (event) => {
        const message = element.getAttribute('data-confirm') || '¿Seguro que deseas continuar?';
        if (!window.confirm(message)) {
            event.preventDefault();
        }
    });
});
</script>
</body>
</html>
