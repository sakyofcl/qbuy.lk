<!-- Modal -->
<div class="modal fade" id="user-status-change-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body modal-confirm">
          <div class="modal-content">
              <div class="modal-header flex-column">	
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                

                <div class="w-100 p-1 mb-2 bg-light text-left border">
                    <span class="font-weight-bold text-dark ml-2">USER STATUS<span>
                </div>
                <ul class="w-100 p-1 mb-2 bg-light text-left border d-flex flex-column flex-nowrap list-unstyled">
                    <li>
                        <span class="badge badge-success p-2 RT-shadow rounded-0">ACTIVE</span>
                        <ul class="pt-3 pr-3 pb-3 d-flex flex-column flex-nowrap ">
                            <span>What if?</span>
                            <li>Able to place order. </li>
                            <li>Make add to cart. </li>
                            <li>Create ship address. </li>
                            <li>Custamize profile. </li>
                            <li>It will be default status. etc.. </li>
                        </ul>
                    </li>

                    <li>
                        <span class="badge badge-warning p-2 RT-shadow rounded-0">RESTRICTED</span>
                        <ul class="pt-3 pr-3 pb-3 d-flex flex-column flex-nowrap">
                            <span>What if?</span>
                            <li>Can't place order.</li>
                            <li>Can't Make add to cart.</li>
                            <li>Can't Create ship address more. </li>
                        </ul>
                    </li>

                    <li>
                        <span class="badge badge-danger p-2 RT-shadow rounded-0">DEACTIVE</span>
                        <ul class="pt-3 pr-3 pb-3 d-flex flex-column flex-nowrap">
                            <span>What if?</span>
                            <li>They are can't login.</li>
                            <li>Their data Not delete.</li>
                        </ul>
                    </li>
                    
                </ul>


                <form action="#" method="POST">
                  <div class="input-group mb-3 ">
                    <input type="text" class="form-control RT-shadow rounded-0" placeholder="Ender user id">
                    
                  </div>
                </form>
              </div>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
              </div>
          </div>
      </div>
      
    </div>
  </div>
</div>