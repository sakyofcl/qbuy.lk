import {Class} from '../model/Dom.js';
$(document).ready(()=>{
    
    let editElement=$('.product-edit-btn');
    let url="/api/product/info?pid=";
    let unitSelect=$("#unit")[0];
    let unitList=['Kg','g','mg','pcs','l','ml'];
    let placeHolderImage="/assets/Backend/img/placeholder.jpg";
    let imageUpload=$('#image-upload');
    let displayImage=$('#show-img');
    let imgPrevCancel = $('#img-preview-cancel');
     
    function editHandleClick(e){
        const pid=$(e.target).attr('pid');
        
       
        axios.get(url+pid).then((res) => {
            let data=[];
            
            if(res.data.status){
                
                data=res.data.data
                
                setDefaultValueToForm(data,['name','description','price','unit_weight','pid','stock'],'text');
                setDefaultValueToForm(data,['image'],'image');
                setDefaultValueToForm(data,['unit'],'select');
            }
            
            
        })
    }

    //product delete 
    Class.addEvent('product-delete-btn','click',(e)=>{
        const targetId=$(e.target).attr('targetId');
        const targetName=$(e.target).attr('targetName');
        const endPoint=$(e.target).attr('endpoint');
        const actionForm=$('#delete-product-form');
        const diplayId=$('#delete-product-id-display');
        const displayName=$('#delete-product-name-display');

        //set id 
        diplayId.text(targetId);
        displayName.text(targetName);
        
        actionForm.attr('action',endPoint);
        console.log(endPoint);
        
    })
    

    imageUpload.change((e)=>{
        if (e.target.files.length >= 1) {
            console.log('have file');
            displayImage.attr('src',window.URL.createObjectURL(e.target.files[ 0 ]));
        }
        else {
            displayImage.attr('src',placeHolderImage);
            
        }
    })

    imgPrevCancel.click((e) => {
        displayImage.attr('src',placeHolderImage);
        imageUpload.val('');
    })


    for (let i = 0; i < editElement.length; i++) {
        editElement[i].addEventListener('click',editHandleClick)
    }
    
    
    function setDefaultValueToForm(data,ele,type){
        if(type=="text"){
            ele.map((v)=>{
                const element=$("#"+v)[0];
                element.value=data[v];
            })
        }
        else if(type=='image'){
            ele.map((v)=>{
                const element=$("#"+v);
                console.log(element);
                element.attr('src',data[v]);
            })
        }
        else if(type=="select"){
            ele.map((v)=>{
                const options=$("#"+v)[0].options;
                for (let index = 0; index < options.length; index++) {
                    if(options[index].value==data[v]){
                        options[index].setAttribute("selected",true);
                    }
                }
            }) 
        }
        else if('editer'){
            ele.map((v)=>{
                tinymce.get(v).setContent(data['editerdesc']);
            }) 
        }
        
        
    }
})