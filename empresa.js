document.getElementById('logoutBtn').addEventListener('click', function () {
    alert('Sesión cerrada.');
    window.location.href = 'index.html';
});

document.getElementById('nuevaVacanteForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const titulo = document.getElementById('titulo').value.trim();
    const ubicacion = document.getElementById('ubicacion').value.trim();

    if (!titulo || !ubicacion) {
        alert('Por favor, completa todos los campos.');
        return;
    }

    alert(`Vacante "${titulo}" publicada (simulación).`);
    document.getElementById('nuevaVacanteForm').reset();
});

const verBtns = document.querySelectorAll('.ver-postulados-btn');
verBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        alert('Mostrando candidatos postulados (simulado).');
    });
});
