<div class="modal fade" id="offer-edit-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position:relative">


                <div class=" ml-3 mr-3 ">
                    <small  class="form-text text-primary font-weight-bold text-uppercase">update offer..!</small>
                </div>
                <div class="divider ml-3 mr-3 mt-2 mb-3" style="height:2px; background-color:#dddddd;"></div>
                
                
                <form action="/offer/update/store" method="POST" class="signup" id="update-product-form">

                    <input type="text" name="offer" id="offer_id"  class="form-control rawinput" hidden>

                    <div class="form-body row ml-0 mr-0 p-3">

                        <div class="col-md-6 pr-1 pl-1 mb-3">
                            <small  class="form-text text-muted font-weight-bold text-uppercase">Offer price</small>
                            <div class="input-group m-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rs</span>
                                </div>
                                <input type="text" class="form-control" id="offer_price" name='price' autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-6 pr-1 pl-1 mb-3">
                            <small  class="form-text text-muted font-weight-bold text-uppercase">extends date</small>
                            <div class='input-group'>
                                <div class='input-group'>
                                    <input type="date" value="<?php echo date('Y-m-d'); ?>" id="offer-date" name="end"  class="form-control w-100">
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="d-flex w-100 justify-content-end pr-3 pb-2">
                        <button class="btn btn-primary" onclick="document.getElementById('update-product-form').submit();">Update</button>
                    </div>

                    
                </form>

                <div class=" ml-3 mr-3 ">
                    <small  class="form-text text-danger font-weight-bold text-uppercase">delete offer..!</small>
                </div>
                <div class="divider ml-3 mr-3 mt-2 mb-3" style="height:2px; background-color:#dddddd;"></div>


                <div class="col-md-12  pr-3  pl-3 mb-3 mt-3">

                    <small  class="form-text text-muted mb-1 ">~ Ender offer ID to delete this offer.</small>

                    <form action="/offer/delete" method="GET" id="delete-offer-form">
                        <div class="input-group">
                            <input type="text"  id="offer-id-display" class="form-control" disabled readonly>
                            <input type="text" name="offer_id" placeholder="Offer id" class="form-control">
                        </div>
                    </form>

                    <div class="d-flex w-100 justify-content-end mt-3">
                        <button class="btn btn-danger mt-3" onclick="document.getElementById('delete-offer-form').submit();">Delete</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>