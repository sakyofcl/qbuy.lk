$(document).ready((e) => {
    let alertCloseBtn = document.getElementById('alert-close-btn');

    if (typeof (alertCloseBtn) != 'undefined' && alertCloseBtn != null) {
        let rootEleAlert = $('#alert-msg')
        alertCloseBtn.addEventListener('click', (e) => {
            rootEleAlert.removeClass('d-flex');
            rootEleAlert.addClass('d-none');
        })
    }
})