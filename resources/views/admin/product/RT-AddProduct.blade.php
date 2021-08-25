<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RT-AddProducts | Qbuy.lk</title>
    <!----------------------------[ Css Library ]---------------------------->
    @include('/Admin/Component/Link/css')
</head>



<body id="RT-Dashboard">

    <!----------------------------[ Wrapper ]---------------------------->

    <div id="wrapper" class="bg-gray">

        <!----------------------------[ Sidebar ]---------------------------->
        @include('/Admin/Component/Sidebar/RT-Sidebar')
        <!----------------------------[ End Sidebar ]------------------------>

        <div id="content-wrapper" class="d-flex flex-column bg-gray">

            <!----------------------------[ Main Content ]---------------------------->
            <div id="content">

                <!----------------------------[ Header ]---------------------------->
                @include('/Admin/Component/Header/header')
                <!----------------------------[ End Header ]------------------------>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @include('/Admin/Component/breadcrumb')

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/'],
                        ['name' => 'product', 'link' => '/RT-product']
                    ];
                    echo breadcrumb('AddProduct', $path);
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
                                            <form action="/store-product" method="POST" enctype='multipart/form-data'>

                                                <div class="form-body row ml-0 mr-0 p-3">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <label for="name" class="text-danger ">Product Name*</label>
                                                        <input type="text" name="name" id="name" class="form-control bg-gray">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="name" class="text-danger">Category*</label>
                                                        <select class="form-control bg-gray" name="catname" id="catname">
                                                            <option value="c">Mango</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="name" class="text-danger">Tags*</label>
                                                        <select class="form-control bg-gray" name="tags" id="tags">
                                                            <option value="exclusive">Exclusive</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="stock" class="text-danger">Stock*</label>
                                                        <input type="number" name="stock" id="stock" class="form-control bg-gray">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="brand" class="text-danger">Unit*</label>
                                                        <select class="form-control bg-gray" name="unit" id="unit">
                                                            <option value="kg" selected>Kg</option>
                                                            <option value="g">g</option>
                                                            <option value="pcs">Pcs</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 w-100">
                                                        <label for="unitWeight" class="text-danger">Unit Weight*</label>
                                                        <input type="number" name="unitWeight" id="unitWeight" class="form-control bg-gray">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="price" class="text-danger">Product Price*</label>
                                                        <input type="number" name="price" id="price" class="form-control bg-gray">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="description" class="text-danger">Short Description*</label>
                                                        <textarea name="description" id="description" class="form-control bg-gray h-100" rows="3"></textarea>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <label for="image" class="text-danger mt-4">Product Image*</label>
                                                        <input type="file" name="image" id="image" class="form-control-file rawinput">
                                                    </div>

                                                </div>

                                                <div class="form-footer">
                                                    <button type="submit" class="btn btn-danger h-100 ml-4" id="addbtn">
                                                        <i class="fas fa-plus mr-1"></i>
                                                        <span>Add New<span>
                                                    </button>
                                                </div>
                                            </form>
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
            @include('/Admin/Component/Footer/footer')

        </div>
    </div>

    <!----------------------------[ End Wrapper ]---------------------------->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/Admin/Component/Link/js')

</body>

</html>