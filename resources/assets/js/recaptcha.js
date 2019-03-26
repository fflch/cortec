window.onSubmit = function () {
    grecaptcha.execute();
    return false;
}
window.reCaptcha = function (token) {
    document.getElementById('form_step2').submit();
}
