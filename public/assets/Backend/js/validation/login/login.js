
$(document).ready(() => {

    let error = { email: true, pass: true };
    $(document).on('focusin', '#email', () => {
        $('#emailError').hide();
    })

    $(document).on('focusout', '#email', () => {
        if (!$('#email').val()) {
            $('#emailError').show();
            error.email = true;
        }
        else {
            $('#emailError').hide();
            error.email = false;
        }
    })
    $(document).on('focusin', '#password', () => {
        $('#passwordError').hide();
    })
    $(document).on('focusout', '#password', () => {
        if (!$('#password').val()) {
            $('#passwordError').show();
            error.pass = true;
        }
        else {
            $('#passwordError').hide();
            error.pass = false;
        }
    })

    $(document).on('keyup', '#email', (e) => {
        const regx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        let input = e.currentTarget.value;
        if (regx.test(input)) {
            $('#invalidemail').hide();
        }
        else {
            $('#invalidemail').show();
        }

    })

    $(document).on('keyup', '#password', (e) => {
        const regx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,15}$/;
        let input = e.currentTarget.value;
        if (regx.test(input)) {
            $('#invalidpass').hide();
        }
        else {
            $('#invalidpass').show();
        }

    } )
    


})