<div class="modal fade" id="user-add-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position:relative">

              

                <div class="change-password-container RT-shadow RT-radius">
                    <div class="w-100 p-1">
                        <span class="font-weight-bold text-capitalize" style="color:#000;">Add new user</span>
                    </div>
                    <div class="ship-address-wrapper">
                        
                            <input type="text" name='verify_key' value="<?php echo rand(); ?>" class="form-control" id="user-verify_key" hidden>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name</span>
                                </div>
                                <input type="text"  class="form-control" id="user-name-val">
                                
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Phone</span>
                                </div>
                                <input type="text"  class="form-control" id="user-phone-val">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Password</span>
                                </div>
                                <input type="password" name="password" class="form-control" id="user-password">
                                
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Password must be 8 to 18 characters.</small>

                           
                        
                    </div>
                </div>

            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark mr-2" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"  id='create-user-btn'>CREATE</button>
            </div>
        </div>
    </div>
</div>