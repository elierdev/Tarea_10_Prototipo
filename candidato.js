document.getElementById('logoutBtn').addEventListener('click', function () {
    alert('Sesión cerrada.');
    window.location.href = 'index.html'; // vuelve al login
});

const postularBtns = document.querySelectorAll('.job-card button');
postularBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        alert('Postulación simulada. ¡Buena suerte!');
    });
});
