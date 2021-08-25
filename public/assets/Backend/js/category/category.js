$(document).ready((e) => {
    let addMainCategory = $('#add-main-category');
    let addCatBtn = $('#add-cat-btn');
    let catAddCancelBtn = $('#cat-add-cancel-btn');


    addCatBtn.click((e) => {
        addMainCategory.addClass('d-flex');
        addMainCategory.removeClass('d-none');
        addCatBtn.addClass('d-none');
    })

    catAddCancelBtn.click((e) => {
        addMainCategory.addClass('d-none');
        addMainCategory.removeClass('d-flex');
        addCatBtn.removeClass('d-none');
    })

})