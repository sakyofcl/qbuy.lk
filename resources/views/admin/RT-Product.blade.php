<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RT-Products | Qbuy.lk</title>
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

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/']
                    ];
                    echo breadcrumb('product', $path);
                    ?>
                    <!-- end breadcrumb -->

                    <div class="container mt-4 p-0">
                        <div class="row m-0">
                            <div class="col-md-12 p-0">
                                <div class="card RT-shadow RT-radius border-0 mb-3 RT-list-products">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                            <i class="fas fa-cogs pr-2"></i>Manage Products
                                        </h6>
                                        <a href="/RT-add-products" class="btn btn-danger font-weight-bold">
                                            Add Products
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <span class="badge badge-primary rounded p-2 text-capitalize border mb-3">
                                            <i class="fas fa-list-ul pr-1"></i>List products
                                        </span>

                                        <div class="w-100">

                                            <div class="table-responsive">
                                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                                    <thead class="bg-gray">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Qty</th>
                                                            <th>Category</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach ($products as $items)
                                                        <tr>
                                                            <td>{{$i}}</td>
                                                            <td>
                                                                <div class="cat-img h-100 RT-radius">
                                                                    <img src="{{$items['images'][0]}}" class="h-100" style="width:50px;">
                                                                </div>
                                                            </td>
                                                            <td>{{$items['name']}}</td>
                                                            <td>{{$items['price']}}</td>
                                                            <td>{{$items['stock']}}</td>
                                                            <td>{{$items['Category']}}</td>
                                                            <td>
                                                                <div class="w-100 d-flex justify-content-end">
                                                                    <button type="button" class="btn btn-primary mr-2">
                                                                        <i class="far fa-edit"></i>
                                                                    </button>
                                                                    <a href="/delete-products/{{$items->id()}}" class="btn btn-danger">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        @endforeach

                                                    </tbody>
                                                </table>
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

</body>

</html>