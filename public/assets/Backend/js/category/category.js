import {Class} from '../model/Dom.js';

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


    Class.addEvent('delete-category-btn','click',(e)=>{
        const targetId=$(e.target).attr('targetId');
        const targetName=$(e.target).attr('targetName');
        const endPoint=$(e.target).attr('endpoint');
        const actionForm=$('#delete-category-form');
        const diplayId=$('#delete-category-id-display');
        const displayName=$('#delete-category-name-display');

        //set id 
        diplayId.text(targetId);
        displayName.text(targetName);
        
        actionForm.attr('action',endPoint);




        console.log(endPoint);
        
    })

})