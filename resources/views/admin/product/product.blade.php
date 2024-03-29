<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products | Qbuy.lk</title>
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
                    @include('/admin/Component/message/alert-box')

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/dashboard']
                    ];
                    echo breadcrumb('products', $path);
                    ?>
                    <!-- end breadcrumb -->

                    <?php
                        if(session::has('message')){
                            $status=0;
                            $msg=session::get('message');

                            if(session::has('status')){
                                $status=session::get('status');
                            }
                            echo alertBox($msg,$status);
                        }
                    ?>

                    

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary RT-shadow RT-radius h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success RT-shadow RT-radius h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info RT-shadow RT-radius h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning RT-shadow RT-radius h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container mt-4 p-0">
                        <div class="row m-0">
                            <div class="col-md-12 p-0">
                                <div class="card RT-shadow RT-radius border-0 mb-3 RT-list-products">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                            <i class="fas fa-cogs pr-2"></i>Manage Products
                                        </h6>

                                       

                                        <form class="input-group w-50" action="/search/product" method="get">
                                            <input type="text" name="q" class="form-control" placeholder="search product..!">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="submit"><i class="fas fa-search " id="searchIcon"></i></button>
                                            </div>
                                        </form>

                                        <a href="/product/create" class="btn btn-danger font-weight-bold RT-shadow">
                                            Add Products
                                        </a>
                                    </div>
                                    <div class="card-body">
                                       


                                    <!--
                                        <div class="filter-wrapper mb-3">
                                            <form class="row m-0 d-flex flex-nowrap" method="GET" action="/product">
                                                <div class="col-4 col-md-2 p-0 mr-2">
                                                    <select class="custom-select rounded-0 bg-gray" name="maincat">
                                                        <option value="0">All</option>
                                                        @foreach($main as $item)
                                                        <option value="{{$item->cid}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-4 col-md-2 p-0 mr-2">
                                                    <select class="custom-select rounded-0 bg-gray">
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 col-md-1 p-0">
                                                    <input class="btn btn-danger rounded-0" type="submit" value="SHOW" />
                                                </div>
                                            </form>
                                        </div>
                                    -->
                                        <div class="owl-carousel product-category-slider" id="product-category-slider">

                                            @if($current=="all")
                                                <a href="/product/all" class=" d-block item product-category-slider-item rounded-pill active-category-slider">
                                                    all 
                                                </a>
                                            @else
                                                <a href="/product/all" class=" d-block item product-category-slider-item rounded-pill">
                                                    all
                                                </a>
                                            @endif

                                            @foreach($main as $item)

                                                @if($current==$item->name)
                                                    <a href="/product/{{$item->name}}" class=" d-block item product-category-slider-item rounded-pill active-category-slider">
                                                        {{$item->name}}
                                                    </a>
                                                @else
                                                    <a href="/product/{{$item->name}}" class="d-block item product-category-slider-item rounded-pill">
                                                        {{$item->name}} 
                                                    </a>
                                                @endif

                                            @endforeach

                                        </div>

                                        


                                        <div class="w-100">

                                            <div class="table-responsive">
                                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                                    <thead class="bg-gray">
                                                        <tr class="product-table-head-tr">
                                                            <th>ID</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Weight</th>
                                                            <th>Stock</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach($product as $item)
                                                        <tr class="product-list-tr">
                                                            <td>
                                                                <div>{{"#".$item->pid}}</div>
                                                            </td>
                                                            <td>
                                                                <div class="cat-img h-100 RT-radius">
                                                                    <img class="border border-dark" src="/products/{{$item->image}}" style="width:50px;height:50px;">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>{{$item->name}}</div>
                                                            </td>
                                                            <td>
                                                                <div>{{"Rs ".number_format($item->price,2,".", ",")}}</div>
                                                            </td>
                                                            <td>
                                                                <div class=" text-lowercase">{{$item->unit_weight." ".$item->unit }}</div>
                                                            </td>
                                                            <td>

                                                                <div class="form-group form-check text-center">
                                                                    @foreach($stock_status as $item_stock_status)
                                                                    @if($item_stock_status->pid==$item->pid)
                                                                    @if($item_stock_status->status=="1")
                                                                    <input type="checkbox" class="form-check-input bg-danger" id="edit-stock" onclick="location.href='/product/stock/update/staus?pid={{$item->pid}}&v=0'" checked>
                                                                    @elseif($item_stock_status->status=="0")
                                                                    <input type="checkbox" class="form-check-input" id="edit-stock" onclick="location.href='/product/stock/update/staus?pid={{$item->pid}}&v=1'">
                                                                    @endif
                                                                    @break
                                                                    @endif
                                                                    @endforeach
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="w-100 d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-primary mr-2 RT-shadow RT-radius product-edit-btn"  pid={{ $item->pid }} data-toggle="modal" data-target="#product-edit-model">
                                                                        <i class="far fa-edit product-edit-btn" pid={{ $item->pid }}></i>
                                                                    </button>
                                                                    <button class="btn btn-danger RT-shadow RT-radius product-delete-btn" targetName="{{$item->name}}" targetId={{ $item->pid }} endpoint="/product/delete" data-toggle="modal" data-target="#product-delete-model">
                                                                        <i class="far fa-trash-alt product-delete-btn" targetName="{{$item->name}}" targetId={{ $item->pid }} endpoint="/product/delete"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="pagination-area d-flex justify-content-center align-items-center">
                                               
                                                {{ $product->links() }}
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
            @include('/admin/Component/popup/product-edit')
            @include('/admin/Component/popup/product-delete')

        </div>
    </div>

    <!----------------------------[ End Wrapper ]---------------------------->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/admin/Component/Link/js')
    <script src="/assets/Backend/js/product/product-edit.js" type="module"></script>

</body>





</html>