

<!-- ORDER INFO -->
<div class="modal fade" id="order-info-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <span class="badge badge-danger RT-shadow p-2 rounded-0 text-uppercase">Order details</span>
        

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body product-info-body p-1">
          <div class="invoice-card position-relative" id="invoice-div">
              <div class="invoice-title">
                  <div id="main-title" class="mt-0">
                      <h4 style="color:#000;">INVOICE</h4>

                      <span>
                        <span  style="color:#000;" class="font-weight-bold">ORDER ID : </span>
                        <span style="color:#000;" id="order-id-ele"></span>
                      </span>
                      
                  </div>
                  <span id="date" class="mt-0" style="color:#000;"></span>
              </div>

              

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
                      
                      </tbody>
                  </table>
              </div>

                <div class="invoice-title">
                  <div id="main-title" class="mt-0">
                      <span style="color:#000;" class="font-weight-bold">Delivery address :</span>
                  </div>
                  <!-- Javascript append data-->
                  <div class='address-details-box'>
                    <span id="add-name"></span>
                    <span id="add-street"></span>
                    <span id="add-city"></span>
                    <span>
                      <span id="add-zip"></span>
                      <span id="add-province"></span>
                    </span>
                    <span id="add-contact"></span>
                  </div>
                  
                </div>

              <!--
              <div class="invoice-footer">
                  <button class="btn btn-secondary" id="later">LATER</button>
                  <button class="btn btn-primary">PAY NOW</button>
              </div>
              -->
          </div>

          
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-light border RT-shadow" id="invoice-print-btn"> <i class="fas fa-file-invoice mr-1"></i>Invoice</a>

        <div class='w-75 d-flex justify-content-end'>
          <button type="button" class="btn btn-secondary RT-shadow ml-2" data-dismiss="modal">Close</button>
          <a href="#"  class="btn btn-danger RT-shadow ml-2" id="reject-order-btn">Reject</button>
          <a href="#" class="btn btn-success RT-shadow ml-2" id="accept-order-btn">Accept</a>
        </div>
        
      </div>
    </div>
  </div>
</div>