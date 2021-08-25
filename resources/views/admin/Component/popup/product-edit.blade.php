<div class="modal fade" id="product-edit-model" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position:relative">
                <div id="updateFormRootWrapper"></div>
                <form action="/product/update/store" method="POST" class="signup" enctype='multipart/form-data' id="update-product-form">

                    <input type="text" name="pid" id="pid" class="form-control rawinput" hidden>

                    <div class="form-body row ml-0 mr-0 p-3">

                        <div class="col-md-6 form-row">
                            <select class="form-control rawinput text-uppercase" name="catid" id="catid">

                            </select>
                        </div>

                        <div class="col-md-6 form-row">
                            <select class="form-control rawinput" name="subid" id="subid">

                            </select>
                        </div>

                        <div class="col-12 form-row" style='padding-right:25px;'>
                            <label for="name" class="text-danger">Name</label>
                            <input type="text" name="name" id="name" class="form-control rawinput">
                        </div>


                        <div class="col-md-6 form-row">
                            <label for="price" class="text-danger">Price</label>
                            <input type="number" name="price" id="price" class="form-control rawinput">
                        </div>
                        <div class="col-md-4 form-row">
                            <label for="weight" class="text-danger">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control rawinput">
                        </div>
                        <div class="col-md-2 form-row">
                            <label for="weight" class="text-danger">Unit</label>
                            <select class="form-control rawinput" name="unit" id="unit" class="form-control rawinput">

                            </select>
                        </div>


                        <div class="col-md-6 form-row">
                            <label for="brand" class="text-danger">Stock</label>
                            <input type="text" name="brand" id="brand" class="form-control rawinput" placeholder="Brand" readonly>
                        </div>

                        <div class="col-md-6 form-row">
                            <label for="model" class="text-danger">Model</label>
                            <input type="text" name="model" id="model" class="form-control rawinput" placeholder="Model" readonly>
                        </div>




                        <div class="col-12 form-row">
                            <label for="description" class="text-danger">Description</label>
                            <textarea name="description" id="description" class="form-control rawinput h-100" rows="3"></textarea>
                        </div>

                        <div class="col-12 form-row" style="margin-top:28px; margin-bottom: 15px;">
                            <label for="image" class="text-danger">Image</label>
                            <input type="file" name="image" id="image" class="form-control-file rawinput">
                        </div>


                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="document.getElementById('update-product-form').submit();">Update</button>
            </div>
        </div>
    </div>
</div>