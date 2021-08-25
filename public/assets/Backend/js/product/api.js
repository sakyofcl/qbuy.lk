
$(document).ready(() => {

    let productSaveBtn = $('#save-btn');
    let addNewProductBtn = $('#add-new');
    let prevImage = $('#img-preview');
    let optnRootEle = $('#sub_id');
    let rootEleAlert = $('#alert-msg');
    let rALertMsgSpan = $('#alert-msg-span');
    let optnEle = (id, value) => {
        return (
            `
            <option value="${ id }">${ value }</option>

            `
        )
    }
    $('#cid').on('change', (e) => {
        if (e.target.name == 'cid') {
            if (e.target.value) {
                let url = "/api/category/sub?cid=";
                axios.get(url + e.target.value).then((response) => {

                    const subcat = response.data;

                    optnRootEle[ 0 ].innerHTML = "";
                    optnRootEle[ 0 ].appendChild(
                        document.createRange().createContextualFragment(
                            optnEle(0, "Select")
                        )
                    );
                    subcat.map((v) => {
                        optnRootEle[ 0 ].appendChild(
                            document.createRange().createContextualFragment(
                                optnEle(v.sub_id, v.name)
                            )
                        );
                    })

                }).catch((er) => {
                    console.log(er);
                })

            }
        }
    })

    productSaveBtn.click((eve) => {
        storeProduct(eve);
    })
    addNewProductBtn.click((eve) => {
        storeProduct(eve);
    })
    function storeProduct(eve) {
        let dataEle = [ 'name', 'cid', 'sub_id', 'price', 'stock', 'unitWeight', 'unit', 'description', 'image' ];
        let finalData = {};
        let formData = new FormData();
        dataEle.map((e) => {
            if (e == "image") {
                formData.append(e, $('#' + e)[ 0 ].files[ 0 ])
            } else {
                formData.append(e, $('#' + e).val());
            }
        })
        axios.post('/api/product/store', formData).then((res) => {

            console.log(res.data.message)
            if (res.data.status == 200) {
                if (eve.target.id == "save-btn") {
                    window.location = "/product";
                }

                let dataEle = [ 'name', 'price', 'stock', 'unitWeight', 'description' ];
                dataEle.map((v) => {
                    $('#' + v).val("");
                })
                prevImage.addClass('d-none');
                prevImage.removeClass('d-block');

                rootEleAlert.addClass('d-flex');
                rootEleAlert.removeClass('d-none');

            }


        });
    }

})