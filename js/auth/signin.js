// validatePassword.js

function validatePassword() {
    var passwordInput = document.getElementById('password');
    var errorSpan = document.getElementById('passwordError');
    var password = passwordInput.value;

    if (password.length < 8 || password.length > 64) {
        errorSpan.textContent = 'パスワードは8文字以上64文字以下で入力してください';
        passwordInput.setCustomValidity('');
    } else {
        errorSpan.textContent = '';
        passwordInput.setCustomValidity('');
        validatePasswordConfirm(); // Call the function to check password confirmation
    }
}

function validatePasswordConfirm() {
    var passwordInput = document.getElementById('password');
    var passwordConfirmInput = document.getElementById('password_confirm');
    var errorSpan = document.getElementById('passwordConfirmError');
    var password = passwordInput.value;
    var passwordConfirm = passwordConfirmInput.value;

    if (password !== passwordConfirm) {
        errorSpan.textContent = 'パスワードが一致しません';
        passwordConfirmInput.setCustomValidity(''); // Clear the browser's default validation message
    } else {
        errorSpan.textContent = '';
        passwordConfirmInput.setCustomValidity('');
    }
}
