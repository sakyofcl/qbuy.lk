import {Class,DateExtract,NumberExtract} from '../model/Dom.js';

const ele=['user-name','user-email','user-gender','user-id','user-phone','user-join'];
const inputEle=['input-name','input-email','input-gender','input-phone'];

function addressEle(name,street,city,zip,province,contact){
    return `
    <div class="owl-item active" style="width: 172px;margin-right: 10px;">
        <div class="ship-address-item w-100">
            <div class="ship-address-item-content"> ${name}</div>
            <div class="ship-address-item-content">${street}</div>
            <div class="ship-address-item-content">${city}</div>
            <div class="ship-address-item-content">${zip} ${province}</div>
            <div class="ship-address-item-content">${contact}</div>
        </div>
    </div>
    `
}


$(document).ready((e) => {

    
    const profileEditBtn=$('#admin-edit-user-btn');
    const profileSaveBtn=$('#admin-save-user-btn');
    const profileEditClsoe=$('#admin-close-user-btn');


    profileEditBtn.click((e)=>{

        const newEle=['user-name','user-email','user-gender','user-phone'];
        inputEle.map((inpEle)=>{
            $("#"+inpEle).attr("hidden",false);
        })
        newEle.map((eleVal)=>{
            $("#"+eleVal).addClass('d-none');
        })


        //show close and save btn
        profileEditBtn.addClass('d-none');
        profileSaveBtn.removeClass('d-none');
        profileEditClsoe.removeClass('d-none');
    })

    profileEditClsoe.click((e)=>{


        const newEle=['user-name','user-email','user-gender','user-phone'];
        inputEle.map((inpEle)=>{
            $("#"+inpEle).attr("hidden",true);
        })
        newEle.map((eleVal)=>{
            $("#"+eleVal).removeClass('d-none');
        })


        //hide close and save btn
        profileEditBtn.removeClass('d-none');
        profileSaveBtn.addClass('d-none');
        profileEditClsoe.addClass('d-none');
    })

    Class.addEvent('user-info-btn','click',(e)=>{
        const token=$(e.target).attr('token');
        callUserProfile(e,token);
    })


})

function callUserProfile(e,token){
    let tokenString=token;
    let url='/api/user/profile';
    let data={};
    

    //reset dom
    ele.map((v)=>{
        setValueToInnerHtml(v,'');
    })

    //reset address
   
    

    axios.get(url, {headers: {'access_token':tokenString}}).then((res)=>{
        console.log(res.data.data);
        if(res.data.status){

            //set value 
            data=res.data.data;
            setValueToInnerHtml('user-name',data.name)
            setValueToInnerHtml('user-email',data.email)
            setValueToInnerHtml('user-gender',data.gender)
            setValueToInnerHtml('user-id',"#"+data.uid)
            setValueToInnerHtml('user-phone',data.contact)
            setValueToInnerHtml('user-join','10/2/2021')

            
            //input box defailt value
            $('#input-name').val(data.name)
            $('#input-email').val(data.email)
            $('#input-gender').val(data.gender)
            $('#input-phone').val(data.contact)
            $('#input-signature').val(data.uid)

            //change password
            $('#change-password-signature').val(data.uid)
            $('#delete-password-signature').val(data.uid)


            /*
            const options= $('input-gender').options;
            for (let index = 0; index < options.length; index++) {
                if(options[index].value==data[v]){
                    options[index].setAttribute("selected",true);
                }
                else{
                    options[index].setAttribute("disabled",true);
                }

            }

            */

        }
        else{
            data={}
        }
    })

    axios.get('api/ship/address',{headers: {'access_token':tokenString}}).then((res)=>{
        let address=[]
        let addressWrapper=$('#ship-address-carousel');
        $($('.owl-stage')[0]).html('');
        if(res.data.status){
            
            address=res.data.data;

            address.map((v)=>{
                $($('.owl-stage')[0]).append(addressEle(v.name,v.street,v.city,v.zip,v.province,v.contact));
            })

        }
    })

    
  
    
   
}


function setValueToInnerHtml(ele,v){
    const e=document.getElementById(ele);
    e.innerText=v;
}


var nxtico = "<i class='fas fa-chevron-right'></i>";
var prvico = "<i class='fas fa-chevron-left'></i>";

$('#ship-address-carousel').owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    dots: false,
    navText: [prvico, nxtico],
    responsive: {
        0:{
            items:2
        },
        400: {
            items: 3
        }
    }
})
