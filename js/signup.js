var check = function () {
    if (document.getElementById('password').value ===
            document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'yellow';
        document.getElementById('message').innerHTML = '';
        document.getElementById('message').style.fontSize = "small";
    } else {
        document.getElementById('message').style.color = 'black';
        document.getElementById('message').innerHTML = 'Passwords must match';
        document.getElementById('message').style.fontSize = "small";
    }
};