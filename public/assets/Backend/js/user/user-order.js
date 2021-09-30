import {Class,DateExtract,NumberExtract} from '../model/Dom.js';


$(document).ready((e) => {

    let accordionWrapper=$('#accordion');

    const listItemRoot=(child,data,nestedChild)=>{
        return`
        <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
            ${child(data,nestedChild)}
        </div>
        
        `
    }
    const listItem=(data,nestedChild)=>{
        let final="";
        const date=new DateExtract();
        
        for (let i = 0; i < data.length; i++) {
            let color=false;
            if(data[i].status=="pending"){
                color="#7fbfc4";
            }
            else if(data[i].status=="process"){
                color="#f49025";
            }
            else if(data[i].status=="couriered"){
                color="#619ffc";
            }
            else if(data[i].status=="cancelled"){
                color="#f2451c";
            }
            else if(data[i].status=="complete"){
                color="#43bf57";
            }

            let loopItem=
            `
                <div class="panel-heading RT-shadow" role="tab" id="headingTwo">
                    <a class="collapse-controle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse${data[i].OrderId}" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="user-collapse-panel-list">
                            <div class="user-collapse-panel-item">
                                <span>#${data[i].OrderId}</span>
                                <span>${date.humanReadbleDate(data[i].date,'h:m')}</span>
                                <span>Rs ${NumberExtract.numberWithComma(data[i].total)}</span>
                                <span class="badge text-white pl-2 pr-2 rounded-0 d-flex align-items-center text-capitalize" style="font-size:14px;background-color:${color?color:'#000'}">${data[i].status}</span>
                            </div>
                        </div>
                    </a>
                </div>

                ${nestedChild(data[i].OrderId,data[i].OrderData,data[i].total)}

            `

            final=final+" "+loopItem;

           
        }
        
        return final;
    }
    const nestedChild=(id,data,total)=>{
        let final="";

        let  loopItem=
        `
        <div id="collapse${id}" class="panel-collapse collapse pb-1" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <div class="invoice-card position-relative pl-3 pr-3">
                    
                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <td >PRODUCT</td>
                                    <td class="text-center">UNIT</td>
                                    <td >PRICE</td>
                                </tr>
                            </thead>
                            <tbody id="product-item-list-wrapper">
                                
                                ${nestedChildItem(data)}
                                <tr class="calc-row">
                                    <td colspan="2">Total</td>
                                    <td>Rs ${total}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        `


        final=final+" "+loopItem;

        return final;
        
        
    }

    const nestedChildItem=(data)=>{
        let final=""

        data.map((v)=>{
            //console.log(v.name);
            final=final+" "+
            `
            <tr class="row-data">
                <td class="text-capitalize">${v.name}</td>
                <td id="unit">${v.qty} x ${v.price}</td>
                <td>Rs ${v.qty*v.price}</td>
            </tr>
            
            `;
        })
        
        
        
        return final;
    }



    /*
    <div class="invoice-title">
        <div id="main-title" class="mt-0">
            <span style="color:#000;" class="font-weight-bold">Delivery address :</span>
        </div>

        <div class='address-details-box'>
            <span id="add-name">Mohamed sakeen</span>
            <span id="add-street">241/c new road kalmunai</span>
            <span id="add-city">kalmunai</span>
            <span>
                <span id="add-zip">32300</span>
                <span id="add-province">Ampara</span>
            </span>
            <span id="add-contact">0757630782</span>
        </div>
    </div>
    */


    Class.addEvent('user-order-btn','click',(e)=>{
        let token=$(e.target).attr('token');
        let url="/api/user/order";
        let status="web";
        let data=[];
        axios.get(url, {headers: {'status': status,'access_token':token}}).then((res)=>{
            if(res.data.status){
                data=res.data.data.result;
                //RESET DOM
                accordionWrapper.html("");
                accordionWrapper.append(listItemRoot(listItem,data,nestedChild));
            }
           
        })
        
    })


})