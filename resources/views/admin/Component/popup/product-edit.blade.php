<div class="modal fade" id="product-edit-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="$('#image-upload').val('')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position:relative">
                <div id="updateFormRootWrapper"></div>
                <form action="/product/update/store" method="POST" class="signup" enctype='multipart/form-data' id="update-product-form">

                    <input type="text" name="pid" id="pid" class="form-control rawinput" hidden>

                    <div class="form-body row ml-0 mr-0 p-3">

                      
                        <div class="col-12">
                            <label for="name" class="text-danger">Name</label>
                            <input type="text" name="name" id="name" class="form-control rawinput mb-2" autocomplete="off">
                        </div>


                        <div class="col-md-6 ">
                            <label for="price" class="text-danger">Price</label>
                            <input type="text" name="price" id="price" class="form-control rawinput mb-2" autocomplete="off">
                        </div>
                        <div class="col-md-6 ">
                            <label for="stock" class="text-danger">Stock</label>
                            <input type="text" name="stock" id="stock" class="form-control rawinput mb-2" autocomplete="off">
                        </div>
                        <div class="col-md-6 ">
                            <label for="weight" class="text-danger">Weight</label>
                            <input type="text" name="weight" id="unit_weight" class="form-control rawinput mb-2" autocomplete="off">
                        </div>
                        <div class="col-md-6  mb-2">
                            <label for="weight" class="text-danger">Unit</label>
                            
                            <select class="form-control rawinput" name="unit" id="unit" class="form-control rawinput" style="text-align-last:center;">
                                <option value="Kg">Kg</option>
                                <option value="g">g</option>
                                <option value="mg">mg</option>
                                <option value="pcs">Pcs</option>
                                <option value="l">L</option>
                                <option value="ml">ml</option>
                            </select>
                        </div>


                    

                        <div class="col-12  mb-2">
                            <label for="description" class="text-danger">Description</label>
                            <textarea name="description" id="description" class="form-control rawinput h-100" rows="3"></textarea>
                        </div>

                        
                        <div class="col-6 w-100 pt-3" style="margin-top:28px; margin-bottom: 15px;">
                            <div class="img-upload-wrapper w-100 mt-2 position-relative">
                                <span class="img-preview-close RT-shadow" id="img-preview-cancel">
                                    <i class="fas fa-times-circle p-0 m-0"></i>
                                </span>
                                <label class="file-input-btn btn mt-3 w-100" for="image-upload">   
                                    <img src="/assets/Backend/img/placeholder.jpg" id="image" class="w-100" style="height:200px;" />
                                </label>
                                <div class="content-details fadeIn-bottom">
                                    <label for="image-upload">
                                        <i class="fas fa-upload content-text"></i> 
                                    </label>
                                </div>
                            </div>
                            <input type="file" class="d-none" value="/assets/Backend/img/placeholder.jpg" class="image-upload" id="image-upload" name="image" accept="image/*" />
                        </div>


                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="$('#image-upload').val('')">Close</button>
                <button class="btn btn-primary" onclick="document.getElementById('update-product-form').submit();">Update</button>
            </div>
        </div>
    </div>
</div>