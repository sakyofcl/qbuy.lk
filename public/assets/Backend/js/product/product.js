$(document).ready((e) => {

    //image preview code
    let imageInput = $('#image');
    let showImage = $('#show-img');
    let imgPrevWrapper = $('#img-preview');
    let imgPrevCancel = $('#img-preview-cancel');

    function showAndHide(ele, show, hide) {
        ele.addClass(show)
        ele.removeClass(hide)
    }

    function previewImage(prewEle, prewWrapper, eve) {
        if (eve.target.files.length >= 1) {
            showAndHide(prewWrapper, 'd-block', 'd-none');
            prewEle.attr('src', window.URL.createObjectURL(eve.target.files[ 0 ]));
        }
        else {
            showAndHide(prewWrapper, 'd-none', 'd-block');
        }

    }


    imageInput.change((e) => {
        previewImage(showImage, imgPrevWrapper, e);
    })

    imgPrevCancel.click((e) => {
        showAndHide(imgPrevWrapper, 'd-none', 'd-block');
        //restvalue
        imageInput.val('');
    })


})