<!-- Modal -->
<div class="modal fade" id="product-delete-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body modal-confirm">
          <div class="modal-content">
              <div class="modal-header flex-column">
                  <div class="icon-box">
                    <span><i class="fas fa-trash"></i></span>
                  </div>						
                  <h4 class="modal-title w-100">Are you sure?</h4>	
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <p>Do you really want to delete these records? This process cannot be undone.</p>

                <div class="w-100 d-flex justify-content-center pb-2">
                    <span class="font-weight-bold text-dark ml-2">ID :<span>
                    <span class="font-weight-bold" style="color:#000;" id="delete-product-id-display">#<span>
                </div>
                <div class="w-100 d-flex flex-column  pb-2">
                    <span class="font-weight-bold text-uppercase" style="color:#000;" id="delete-product-name-display">#<span>
                </div>


                <form action="#" method="GET" id="delete-product-form">
                  <div class="input-group mb-3 ">
                    <input type="text" class="form-control RT-shadow rounded-0" name="pid" placeholder="Ender id">
                  </div>
                </form>
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="delete-product-form">Delete</button>
              </div>
          </div>
      </div>
      
    </div>
  </div>
</div>