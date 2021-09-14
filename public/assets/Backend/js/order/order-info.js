
$(document).ready(()=>{
    
    
    function productListDom(name,qty,tot){
        return`
        <tr class="row-data">
            <td class="text-capitalize">${name}</td>
            <td id="unit">${qty}</td>
            <td>Rs ${numberWithCommas(tot)}</td>
        </tr>
        
        `
    }
    function productListTotal(total){
        return`
        <tr class="calc-row">
            <td colspan="2">Total</td>
            <td>Rs ${ numberWithCommas(total)}</td>
        </tr>
        `
    }
    let orderCheckBtn=$('.order-view-btn');
    let productItemWrapper=$('#product-item-list-wrapper');
    let acceptOrderBtn=$('#accept-order-btn');
    let cancelOrderBtn=$('#reject-order-btn');
  
    let url="/api/order/view/info?oid=";
     
    function editHandleClick(e){
        const addId={
            name:'add-name',
            street:'add-street',
            city:'add-city',
            zip:'add-zip',
            province:'add-province',
            contact:'add-contact'
        }
        //rest address dom
        const ele=['add-name','add-street','add-city','add-zip','add-province','add-contact'];
        ele.map((e)=>{
            setValueToInnerHtml(e, " ");
        })

        //reset the order id
        setValueToInnerHtml('order-id-ele',"");

        //reset order item
        setValueToInnerHtml('product-item-list-wrapper',"");
        
        //reset accept btn
        acceptOrderBtn.attr('href','#');
        const oid=$(e.target).attr('oid');

        axios.get(url+oid).then((res)=>{
            if(res.data.status){

                //set data order id and date
                
                if(res.data.order){
                    const orderId=res.data.order.oid;
                    const orderDate=res.data.order.date;
                    date = new Date(orderDate)
                    const datevalues = {
                        year:date.getFullYear(),
                        month:date.getMonth()+1,
                        day:date.getDate(),
                        houre:date.getHours(),
                        minit:date.getMinutes()
                    };
                    
                    
                    const dateFinal=datevalues.day+"/"+datevalues.month+"/"+datevalues.year+"  "+datevalues.houre+":"+datevalues.minit;
                    setValueToInnerHtml('order-id-ele',"#"+orderId)
                    setValueToInnerHtml('date',dateFinal)

                    //accept order
                    acceptOrderBtn.attr('href','/order/status/change?status=process&oid='+orderId);
                    //cancell order
                    cancelOrderBtn.attr('href','/order/status/change?status=cancelled&oid='+orderId);
                }
                else{
                    setValueToInnerHtml('order-id-ele',"#xxxx")
                }
                

                //set data to address
                const address=res.data.address;
                if(address){
                    setValueToInnerHtml(addId.name, address.name+",");
                    setValueToInnerHtml(addId.street, address.street+",");
                    setValueToInnerHtml(addId.city, address.city+",");
                    setValueToInnerHtml(addId.zip, address.zip+" | ");
                    setValueToInnerHtml(addId.province, address.province+",");
                    setValueToInnerHtml(addId.contact, address.contact+".");
                }
                //end
                
                //display order product
                if(res.data.product){
                    //reset order item
                    setValueToInnerHtml('product-item-list-wrapper',"");
                    const orderProduct=res.data.product;
                    let fullTotal=0;
                    orderProduct.map((v)=>{
                        let ele=productListDom(v.name,v.qty,v.price*v.qty)
                        productItemWrapper.append(ele);

                        fullTotal+=v.price*v.qty;
                    })

                    productItemWrapper.append(productListTotal(fullTotal));

                }
                console.log(res.data.product);
            }
            else{
                console.log("no ok");
            }
            
        }) 
  
    }
    
    for (let i = 0; i < orderCheckBtn.length; i++) {
        orderCheckBtn[i].addEventListener('click',editHandleClick)
    }
    function setValueToInnerHtml(ele,v){
        const e=document.getElementById(ele);
        e.innerText=v;
    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    function dateFormat(v){
        const d=new Date(v);
        return d.toLocaleTimeString.replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
    }

    
})