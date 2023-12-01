// Function to set a cookie
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + "; " + expires + "; path=/";
}

// Function to get the value of a cookie
function getCookie(name) {
    const cookieName = name + "=";
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(cookieName) === 0) {
            return cookie.substring(cookieName.length, cookie.length);
        }
    }
    return "";
}

function toggleTheme() {
    const body = document.body;
    const themeToggle = document.getElementById('theme-toggle');
    const themeInput = document.getElementById('theme-input');
    const themeForm = document.getElementById('theme-form');

    body.classList.toggle('dark-mode');
    const isDarkMode = body.classList.contains('dark-mode');
    setCookie('theme', isDarkMode ? 'dark' : 'light', 30);

    // Update the form input with the current theme preference
    themeInput.value = isDarkMode ? 'dark' : 'light';

    // Submit the form to store the theme preference in the PHP session
    themeForm.submit();
}

document.addEventListener('DOMContentLoaded', function () {
    // Check for user preference on page load
    const savedTheme = getCookie('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
    }
});
