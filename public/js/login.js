const loginForm = document.getElementById('loginForm');
const message = document.getElementById('message');
const forgotLink = document.getElementById('forgotLink');

if (loginForm && message) {
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

        message.classList.remove('success');
        message.textContent =
            'Tampilan sudah siap. Integrasi login API akan kita sambungkan berikutnya.';
    });
}

if (forgotLink) {
    forgotLink.addEventListener('click', function (event) {
        event.preventDefault();
        alert('Fitur lupa kata sandi akan kita buat berikutnya.');
    });
}
