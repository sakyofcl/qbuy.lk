import {Class,DateExtract,NumberExtract} from '../model/Dom.js';

$(document).ready((e) => {

    
    const createUserBtn=$('#create-user-btn');
    const nameEle=document.getElementById('user-name-val');
    const nummberEle=document.getElementById('user-phone-val');
    
    createUserBtn.click((e)=>{
        const url="/api/auth/client/register";
        var bodyFormData = new FormData();
        bodyFormData.append('name',nameEle.value)
        bodyFormData.append('password',$('#user-password').val())
        bodyFormData.append('phone',nummberEle.value)
        bodyFormData.append('verify_key',$('#user-verify_key').val())
       

        axios({method: "post",url:url,data: bodyFormData}).then((res)=>{
           
            location.reload();
        })

    })



})

