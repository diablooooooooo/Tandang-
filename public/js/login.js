const loginForm = document.getElementById('loginForm');
const message = document.getElementById('message');
const forgotLink = document.getElementById('forgotLink');

if (loginForm && message) {
    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        message.classList.remove('success');
        message.textContent = 'Sedang masuk...';

        try {
            const response = await fetch('/web-login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .content
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Email atau kata sandi salah.');
            }

            window.location.href = data.redirect;
        } catch (error) {
            message.textContent = error.message ||
                'Terjadi kesalahan. Silakan coba lagi.';
        }
    });
}

if (forgotLink) {
    forgotLink.addEventListener('click', function (event) {
        event.preventDefault();
        alert('Fitur lupa kata sandi akan kita buat berikutnya.');
    });
}
