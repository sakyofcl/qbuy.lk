$(document).ready((e)=>{
    let offerSearchBtn=$('#search-box-for-offer');
    let resultWrapper=$('#search-result-wrapper');
    let searchIcon=$('#searchIcon');
    let searchLoader=$('#searchLoader');
    let offerProductName=$('#offer-product-name');
    let offerProductPrice=$('#offer-product-price')
    let offerProductId=$('#offer-product-id');
    
    
    let searchItem=(id,name,price)=>{
        return`
            <div class="d-flex justify-content-between search-item-for-offer" pid=${id} price=${price} name="${name}">
                <span pid=${id} price=${price} name="${name}"> #${id}</span> 
                <span pid=${id} price=${price} name="${name}">${name}</span>
                <span class="text-capitalize" pid=${id} price=${price} name="${name}">Rs ${price}</span>
            </div>
        
        `
    }



    offerSearchBtn.keyup((e)=>{

        if(e.target.value){

            //start load
            searchLoader.removeClass('d-none');
            //hide search icone
            searchIcon.addClass('d-none');

            const searchString=e.target.value;
            axios.get('/api/search?q='+searchString,{
                headers:{
                    feild:"name,price,pid"
                }
        
            }).then((res)=>{
                resultWrapper.addClass('d-flex')
                resultWrapper.removeClass('d-none')
                
                //stop load
                searchLoader.addClass('d-none');
                //show search icone
                searchIcon.removeClass('d-none');
                
                resultWrapper.html("");
                res.data.data.map((v,i)=>{
                    resultWrapper.append(searchItem(v.pid,v.name,v.price)) 
                })

                //set event to item
                let searchItemWrapper=$('.search-item-for-offer');
                searchItemWrapper.click((e)=>{
                    const targetEle=$(e.target);
                    const pid=targetEle.attr('pid');
                    const price=targetEle.attr('price');
                    const name =targetEle.attr('name');

                    //display current price and product name
                    offerProductPrice.val(price)
                    offerProductName.val(name)
                    offerProductId.val(pid)

                    //hide resuld wrapper and clear data
                    resultWrapper.addClass('d-none')
                    resultWrapper.removeClass('d-flex')
                    resultWrapper.html("");
                })
                
                
            })
        }
        else{
            resultWrapper.html("");
            resultWrapper.addClass('d-none')
            resultWrapper.removeClass('d-flex')
        }
        
        
    })

    




})