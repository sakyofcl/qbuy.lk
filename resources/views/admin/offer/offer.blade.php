<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Offer | Qbuy.lk</title>
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
                        ['name' => 'home', 'link' => '/dashboard']
                    ];
                    echo breadcrumb('offers', $path);
                    ?>
                    <!-- end breadcrumb -->

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
                            <div class="col-md-6 p-0">
                                <div class="card RT-shadow RT-radius border-0 mb-3 RT-list-products">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                            <i class="fas fa-cogs pr-2"></i>Add offer
                                        </h6>

                                    </div>
                                    <div class="card-body">

                                        <div class="filter-wrapper mb-3">
                                            <form action="/offer/place" method="POST" class="row m-0 d-flex justify-content-between">

                                                <div class="col-md-12 pr-1 pl-1 mb-3 position-relative">
                                                    <small  class="form-text text-muted font-weight-bold text-uppercase">find</small>
                                                    <div class="input-group m-0 ">
                                                        <input type="text" class="form-control" placeholder="search..!" id="search-box-for-offer" autocomplete="off">
                                                        <div class="input-group-append">
                                                            <div class="bg-danger pl-2 pr-2 text-white d-flex justify-content-center align-items-center" style="border-top-right-radius: 0.35rem;border-bottom-right-radius: 0.35rem;">
                                                                <i class="fas fa-search " id="searchIcon"></i> 
                                                                <div class="load-search d-none" id="searchLoader"></div> 
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="d-none  flex-column flex-nowrap  w-100 p-2 RT-shadow position-absolute bg-white" id="search-result-wrapper" style="top:32;left:0;z-index:50;">
                                                    </div>

                                                </div>
                                               
                                               <input type="text" id="offer-product-id" name="pid" class="form-control" value="" readonly hidden>
                                               <input type="text" id="offer-product-name" class="form-control" value=""  readonly hidden >

                                                <div class="col-md-6 pr-1 pl-1 mb-3">
                                                    <small  class="form-text text-muted font-weight-bold text-uppercase">Current price</small>
                                                    <div class="input-group m-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rs</span>
                                                        </div>
                                                        <input type="text" id="offer-product-price" class="form-control" value="0"  disabled>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-6 pr-1 pl-1 mb-3">
                                                    <small  class="form-text text-muted font-weight-bold text-uppercase">Offer price</small>
                                                    <div class="input-group m-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rs</span>
                                                        </div>
                                                        <input type="text" class="form-control" name='price'>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 pr-1 pl-1 mb-3">
                                                    <small  class="form-text text-muted font-weight-bold text-uppercase">start</small>
                                                    <div class='input-group'>
                                                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="start" class="form-control w-100">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-1 pl-1 mb-3">
                                                    <small  class="form-text text-muted font-weight-bold text-uppercase">end</small>
                                                    <div class='input-group'>
                                                        <div class='input-group'>
                                                            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="end"  class="form-control w-100">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--
                                                <div class="col-md-12 pr-1 pl-1 mb-3">
                                                    <small  class="form-text text-muted font-weight-bold text-uppercase">select type</small>
                                                    <div class="input-group m-0">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text text-capitalize">type</span>
                                                        </div>
                                                        <select class="form-control" name="tag">
                                                            
                                                            <option value="general" selected>General</option>
                                                            <option value="active">Active</option>
                                                            <option value="deactive">Deactive</option>
                                                            <option value="restricted">Restricted</option>
                                                        </select>
                                                    </div>
                                                    <div  class="text-center w-100 text-uppercase text-dark mt-1 mb-1"><span>or</span></div>
                                                    
                                                    <input type="text" placeholder="new tag" class="form-control" name="newTag">
                                                </div>
                                                -->

                                                <div class="col-md-12 pr-1 pl-1 mb-3">
                                                   <button type="submit" class="btn btn-danger RT-shadow w-100 pt-2 pb-2"><i class="fas fa-tags"></i> Place Offer</button>
                                                </div>



                    
                                            </form>
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
                                            <i class="fas fa-cogs pr-2"></i>Manage Offers
                                        </h6>

                                    </div>
                                    <div class="card-body">

                                
                                        <div class="filter-wrapper mb-3">
                                            <form class="row m-0 d-flex flex-nowrap">
                                                <div class="col-4 col-md-2 p-0 mr-2">
                                                    <select class="custom-select rounded-0 bg-gray" name="status">
                                                        <option value="all">All</option>
                                                        <option value="active">Active</option>
                                                        <option value="deactive">Deactive</option>
                                                        <option value="restricted">Restricted</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-4 col-md-1 p-0">
                                                    <input class="btn btn-danger rounded-0" type="submit" value="SHOW" />
                                                </div>
                                            </form>
                                        </div>


                                        <div class="w-100">

                                            <div class="table-responsive">
                                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                                    <thead class="bg-gray">
                                                        <tr class="product-table-head-tr text-uppercase">
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Start</th>
                                                            <th>End</th>
                                                            <th>status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @foreach ($offer as $offerItem )
                                                            <tr class="product-list-tr">
                                                                <td>
                                                                    <div>{{$offerItem->offer_id}}</div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                     {{$offerItem->name}}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    
                                                                    
                                                                    <div>
                                                                        Rs {{number_format($offerItem->offer_price,2)}} 
                                                                        <span class="text-muted ml-1 mr-1" style="font-size:12px;">
                                                                            <del>{{$offerItem->price}}</del>
                                                                        </span> 
                                                                    </div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <div>

                                                                            {{$offerItem->start}}
                                                                    
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                            {{$offerItem->end}}
                                                                            
                                                                    
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        @if ($offerItem->status=="active")
                                                                            <span class="badge badge-success p-2 text-capitalize rounded-0" style="font-size:13px;">active</span>
                                                                        @elseif($offerItem->status=="expired")
                                                                            <span class="badge badge-danger p-2 text-capitalize rounded-0" style="font-size:13px;">expired</span>
                                                                        @elseif($offerItem->status=="schedule")
                                                                            <span class="badge badge-primary p-2 text-capitalize rounded-0" style="font-size:13px;">schedule</span>
                                                                        @endif
                                                                        
                                                                    </div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <div>
                                                                        <button class="btn btn-danger text-white border-0 RT-shadow offer-edit-btn" offer={{$offerItem->offer_id}} price={{$offerItem->offer_price}} end={{$offerItem->end}} start={{$offerItem->start}}  data-toggle="modal" data-target="#offer-edit-model">
                                                                            <i class="fas fa-eye font-weight-bold offer-edit-btn" offer={{$offerItem->offer_id}} price={{$offerItem->offer_price}} end={{$offerItem->end}} start={{$offerItem->start}}></i>
                                                                            
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
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
            @include('/admin/Component/popup/offer-edit')
            

        </div>
    </div>

    <!----------------------------[ End Wrapper ]---------------------------->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/admin/Component/Link/js')
    <script src="/assets/Backend/js/offer/offer.js"></script>
    <script src="/assets/Backend/js/offer/offer-edit.js" type="module"></script>

</body>





</html>