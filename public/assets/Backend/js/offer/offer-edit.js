import {Class} from '../model/Dom.js';

$(document).ready((e) => {
    Class.addEvent('offer-edit-btn','click',(e)=>{
        const targetId=$(e.target).attr('offer');
        const startDate=$(e.target).attr('start');
        const endDate=$(e.target).attr('end');
        const price=$(e.target).attr('price');
    

        const priceEle=$('#offer_price');
        const offerDateEle=$('#offer-date');
        const offerIdEle=$('#offer-id-display');
        const offerEle=$('#offer_id');

        priceEle.val(price);
        offerDateEle.attr('min',startDate)
        offerDateEle.val(endDate)
        offerIdEle.val(targetId)
        offerEle.val(targetId);
        
        
    })
})