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

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/']
                    ];
                    echo breadcrumb('Category', $path);
                    ?>
                    <!-- end breadcrumb -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card RT-shadow RT-radius mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">

                                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                        <i class="fas fa-cogs pr-2"></i>Category
                                    </h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="category-list-wrapper p-2">
                                        <ul class="list-unstyled">
                                            @foreach($main as $item)
                                            <li class="bg-gray d-flex row flex-nowrap m-0 mb-2">
                                                <div class="col-10 d-flex p-0">
                                                    <a data-toggle="collapse" href="#list-{{$item->cid}}" aria-expanded="false" class=" btn btn-primary rounded-0">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <span class="d-flex align-items-center pl-2 font-weight-bold text-capitalize text-dark">{{$item->name}}</span>
                                                </div>
                                                <div class="col-2 d-flex justify-content-center align-items-center p-0">
                                                    <i class="fas fa-pencil-alt text-primary mr-2" catid="{{$item->cid}}"></i>
                                                    <a href="/category/main/delete?cid={{$item->cid}}"><i class="far fa-trash-alt text-danger" catid=""></i></a>
                                                </div>
                                            </li>
                                            <ul class="list-unstyled pl-5 collapse" id="list-{{$item->cid}}">
                                                @foreach($sub as $subitem)
                                                @if($subitem->cid==$item->cid)
                                                <li class="bg-gray d-flex row flex-nowrap m-0 mb-2 p-2">
                                                    <div class="col-10 d-flex p-0">
                                                        <span class="d-flex align-items-center pl-2 ">{{$subitem->name}}</span>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center p-0">
                                                        <i class="fas fa-pencil-alt text-primary mr-2"></i>
                                                        <i class="far fa-trash-alt text-danger"></i>
                                                    </div>
                                                </li>
                                                @endif
                                                @endforeach
                                                <form action="/category/sub/store" method="POST" class="bg-gray d-flex row flex-nowrap m-0 mb-2 p-2">
                                                    <div class="col-10 d-flex p-0">
                                                        <input type="text" placeholder="Subcategory" name="subname" class="form-control w-100" required>
                                                        <input type="number" name="cid" value="{{$item->cid}}" class="form-control w-100" hidden>
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center align-items-center p-0">
                                                        <button class="btn btn-success rounded-0" type="submit">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </ul>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-header py-3 d-flex justify-content-between align-items-center">

                                    <button class="btn btn-danger font-weight-bold RT-shadow rounded-0" id="add-cat-btn">
                                        Add Category
                                    </button>
                                    <div class="d-none w-100" id="add-main-category">
                                        <form action="/category/main/store" method="POST" class=" d-flex row flex-nowrap m-0 w-100">
                                            <div class="col-10 d-flex p-0 pr-3">
                                                <input type="text" placeholder="Ender category" name="catname" id="catname" class="form-control bg-gray w-100">
                                            </div>
                                            <div class="col-2 d-flex justify-content-center align-items-center p-0">

                                                <button class="btn btn-success rounded-0 mr-2" type="submit">
                                                    <i class="fas fa-plus"></i>
                                                </button>

                                                <button class="btn btn-danger rounded-0" type="button" id="cat-add-cancel-btn">
                                                    <i class="far fa-times-circle"></i>
                                                </button>

                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card RT-shadow RT-radius mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

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
    <script src="/assets/Backend/js/category/category.js"></script>

</body>





</html>