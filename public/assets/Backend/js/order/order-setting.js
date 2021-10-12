import {Class} from '../model/Dom.js';
$(document).ready(()=>{
    console.log('work');


    Class.addEvent('order-setting-btn','click',(e)=>{
        let oid=$(e.target).attr('oid');
        let stage=$(e.target).attr('stage');
        let paid=$(e.target).attr('paid');
        
        $('#order-id').val(oid);
        
        setDefaultToSelect('#order-status',stage);
        setDefaultToSelect('#order-paid',paid);
    })
})

function setDefaultToSelect(ele,item){
    const options=$(ele)[0].options;
    for (let index = 0; index < options.length; index++) {
        if(options[index].value==item){
            options[index].setAttribute("selected",true);
        }
    }
}