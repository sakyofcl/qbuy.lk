<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Products | Qbuy.lk</title>
    <!----------------------------[ Css Library ]---------------------------->
    @include('/admin/Component/Link/css')
</head>



<body id="RT-Dashboard">

    <!----------------------------[ Wrapper ]---------------------------->

    <div id="wrapper" class="bg-gray">

        <!----------------------------[ Sidebar ]---------------------------->
        @include('/admin/Component/Sidebar/RT-Sidebar')
        <!----------------------------[ End Sidebar ]------------------------>

        <div id="content-wrapper" class="d-flex flex-column bg-gray">

            <!----------------------------[ Main Content ]---------------------------->
            <div id="content">

                <!----------------------------[ Header ]---------------------------->
                @include('/admin/Component/Header/header')
                <!----------------------------[ End Header ]------------------------>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @include('/admin/Component/breadcrumb')
                    @include('/admin/Component/message/alert')

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/'], ['name' => 'Product', 'link' => '/product']
                    ];
                    echo breadcrumb('Add product', $path);
                    echo alertMsg('alert-success', 'product added completed..!');
                    ?>
                    <!-- end breadcrumb -->

                    <div class="container mt-4 p-0">
                        <div class="row m-0">
                            <div class="col-md-12 p-0">
                                <div class="card RT-shadow RT-radius border-0 mb-3 product-add">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                            <i class="fas fa-gifts pr-2"></i>Add Products
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="w-100">


                                            <div class="form-body row ml-0 mr-0 p-3">

                                                <div class="col-md-6">
                                                    <label for="name" class="text-danger ">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control bg-gray">
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="name" class="text-danger">Category</label>
                                                    <select class="form-control bg-gray" name="cid" id="cid">
                                                        @foreach($main as $maincat)
                                                        <option value="{{$maincat->cid}}">{{$maincat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="name" class="text-danger">Sub Category</label>
                                                    <select class="form-control bg-gray" name="sub_id" id="sub_id">
                                                        <option value="0" selected>Select</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="price" class="text-danger">Product Price</label>
                                                    <input type="number" name="price" id="price" class="form-control bg-gray">
                                                </div>


                                                <div class="col-md-2">
                                                    <label for="stock" class="text-danger">Stock</label>
                                                    <input type="number" name="stock" id="stock" class="form-control bg-gray">
                                                </div>

                                                <div class="col-md-2 w-100">
                                                    <label for="unitWeight" class="text-danger">Unit Weight</label>
                                                    <input type="number" name="unitWeight" id="unitWeight" class="form-control bg-gray">
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="brand" class="text-danger">Unit</label>
                                                    <select class="form-control bg-gray" name="unit" id="unit">
                                                        <option value="kg" selected>Kg</option>
                                                        <option value="g">g</option>
                                                        <option value="pcs">Pcs</option>
                                                    </select>
                                                </div>





                                                <div class="col-md-12">
                                                    <label for="description" class="text-danger">Description</label>
                                                    <textarea name="description" id="description" class="form-control bg-gray h-100" rows="3"></textarea>
                                                </div>

                                                <div class="col-md-12 mt-5">
                                                    <div class="img-upload-wrapper">
                                                        <div class="pt-1 pb-1">
                                                            <div class="image-preview borderw-100 row m-0 d-none " id="img-preview">
                                                                <div class="col-md-4 p-1 border border-dark RT-shadow position-relative">
                                                                    <span class="img-preview-close RT-shadow" id="img-preview-cancel"><i class="fas fa-times-circle p-0 m-0"></i></span>
                                                                    <img src="#" id="show-img" class="w-100" style="height:288px;" />
                                                                </div>
                                                            </div>
                                                            <label class="file-input-btn btn btn-primary RT-shadow mt-3" for="image"><i class="fas fa-upload"></i> image</label>
                                                            <input type="file" class="d-none" class="image-upload" id="image" name="image" accept="image/*" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-footer d-flex">
                                                <button type="submit" class="btn btn-danger h-100 ml-4 RT-shadow" id="add-new">
                                                    Add New
                                                </button>
                                                <button type="submit" class="btn btn-success h-100 ml-4 RT-shadow" id="save-btn">
                                                    Save
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- End Page Content -->

            </div>
            <!----------------------------[ End Main Content ]---------------------------->

            <!----------------------------[ Footer ]---------------------------->
            @include('/admin/Component/Footer/footer')

        </div>
    </div>

    <!----------------------------[ End Wrapper ]---------------------------->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/admin/Component/Link/js')
    <script src="/assets/Backend/js/product/product.js"></script>
    <script src="/assets/Backend/js/product/api.js"></script>
</body>





</html>