<div class="modal fade" id="user-info-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="max-width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position:relative">

                <div class="profile-container border RT-radius RT-shadow">
                    <div class="row p-0 m-0 h-100">
                        <div class="col-md-4 p-0 h-100">
                            <div class="profile-data">
                                <div class="profile-image RT-shadow">
                                    <img src="https://picsum.photos/200/300?random=1" class="w-100 h-100 rounded-circle" id="user-profile-image"/>
                                    <div class="user-level-box" id="user-level-ele">
                                        <i class="fas fa-crown" style="color:#7b00e8;"></i>
                                    </div>
                                </div>
                                <div class="profile-item-box d-flex justify-content-center align-items-center">
                                    <div class="profile-item-box-status" id="user-profile-status">
                                        <span class="badge badge-success rounded-0 p-1 RT-shadow" style="font-size:12px;">Active</span>
                                    </div>
                                </div>
                                <div class="profile-item-box  text-center font-weight-bold"><span style="font-size:13px;color:#000;">0 <i class="fas fa-coins text-warning"></i></span></div>
                                <div class="profile-item-action-box d-flex justify-content-center align-items-center ">
                                    
                                    <button class="btn btn-primary text-white border-0 RT-shadow w-50 mr-1" id="admin-edit-user-btn">
                                        <i class="fas fa-user-edit"></i> Edit
                                    </button>
                                    
                                    <button class="btn btn-success text-white border-0  RT-shadow w-50 mr-1 d-none" id="admin-save-user-btn" onclick="document.getElementById('user-profile-update-form').submit();">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                    
                                    <button class="btn btn-danger text-white border-0  RT-shadow w-50 d-none" id="admin-close-user-btn">
                                        <i class="fas fa-times"></i> Close
                                    </button>
                                    

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8  p-0 h-100">
                            <form class="profile-details" id="user-profile-update-form" method="POST" action="/admin/edit/user/profile">
                                <div class="profile-details-wrapper">
                                    <div class="profile-details-item-title">
                                        <span>Signature</span>
                                    </div>
                                    <div class="profile-details-item-content">
                                        <span id="user-id"></span>
                                        <input type="text" name="signature" id="input-signature" class="form-control h-100 border-0 rounded-0" hidden> 
                                    </div>
                                </div>
                                <div class="profile-details-wrapper">
                                    <div class="profile-details-item-title border-0">
                                        <span>name</span>
                                    </div>
                                    <div class="profile-details-item-content">
                                        <span id="user-name"></span>
                                        <input type="text" name="name" id="input-name" style="color:#000" class="form-control h-100 border-0 rounded-0" hidden> 
                                    </div>
                                </div>
                                <div class="profile-details-wrapper">
                                    <div class="profile-details-item-title">
                                        <span>Phone</span>
                                    </div>
                                    <div class="profile-details-item-content">
                                        <span id="user-phone"></span>
                                        <input type="text" name="phone" id="input-phone" style="color:#000" class="form-control h-100 border-0 rounded-0" hidden> 
                                    </div>
                                </div>
                                <div class="profile-details-wrapper">
                                    <div class="profile-details-item-title">
                                        <span>Email</span>
                                    </div>
                                    <div class="profile-details-item-content">
                                        <span id="user-email"></span>
                                        <input type="text" name="email" id="input-email" style="color:#000" class="form-control h-100 border-0 rounded-0" hidden>  
                                    </div>
                                </div>
                                <div class="profile-details-wrapper">
                                    <div class="profile-details-item-title">
                                        <span>Gender</span>
                                    </div>
                                    <div class="profile-details-item-content">
                                        <span id="user-gender"></span>
                                        <select name="gender" id="input-gender" class="pl-1 pr-1 border-0" hidden>
                                            <option selected value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="profile-details-wrapper">
                                    <div class="profile-details-item-title">
                                        <span>Joined date</span>
                                    </div>
                                    <div class="profile-details-item-content">
                                        <span id="user-join"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>

                <div class="ship-address-container RT-shadow RT-radius">
                    <div class="ship-address-wrapper owl-carousel w-100" id="ship-address-carousel">

                        <div class="ship-address-item w-100">
                            <div class="ship-address-item-content mb-1" style="height:15px;background:#E9E9E9;"></div>
                            <div class="ship-address-item-content mb-1" style="height:15px;background:#E9E9E9;"></div>
                            <div class="ship-address-item-content mb-1" style="height:15px;background:#E9E9E9;"></div>
                            <div class="ship-address-item-content mb-1" style="height:15px;background:#E9E9E9;"></div>
                            <div class="ship-address-item-content mb-1" style="height:15px;background:#E9E9E9;"></div>
                        </div>
                        
                    </div>
                </div>

                <div class="change-password-container RT-shadow RT-radius">
                    <div class="w-100 p-1">
                        <span class="font-weight-bold text-capitalize" style="color:#000;">Change user password</span>
                    </div>
                    <form action="/admin/change/user/password" method="POST" class="ship-address-wrapper">
                        <input type="text" name="signature" id="change-password-signature" class="form-control h-100 border-0 rounded-0" hidden> 
                        <div class="input-group">
                            <input type="text" name="password" class="form-control rounded-0" autocomplete="off">
                            <div class="input-group-append font-weight-bold">
                                <button class="btn btn-primary text-white rounded-0" type="submit">CHANGE PASSWORD</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="delete-user-container RT-shadow RT-radius">
                    
                    <div class="w-100 p-1">
                        <span class="font-weight-bold text-capitalize" style="color:#000;">Delete user Account</span>
                    </div>

                    <form action="/admin/delete/user" method="POST" class="ship-address-wrapper">
                         
                        <div class="input-group ">
                            <input type="text" aria-label="First name" value="ID XXXXX" class="form-control rounded-0" readonly disabled>
                            <input type="text" name="signature"  class="form-control rounded-0" autocomplete="off">
                            <div class="input-group-append font-weight-bold">
                                <button class="btn btn-danger text-white rounded-0" type="submit">DELETE ACCOUNT</button>
                            </div>
                        </div>

                    </form>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark mr-2" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>