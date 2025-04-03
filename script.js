document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const tipoUsuario = document.getElementById('tipoUsuario').value;

    if (!email || !password || !tipoUsuario) {
        alert('Por favor, completa todos los campos y selecciona un tipo de usuario.');
        return;
    }

    alert('Inicio de sesión simulado con éxito');

    if (tipoUsuario === 'candidato') {
        window.location.href = 'candidato.html';
    } else if (tipoUsuario === 'empresa') {
        window.location.href = 'empresa.html';

    }
});
