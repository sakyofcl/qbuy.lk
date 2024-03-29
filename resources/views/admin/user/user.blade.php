<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users | Qbuy.lk</title>
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
                        ['name' => 'home', 'link' => '/']
                    ];
                    echo breadcrumb('user', $path);
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
                                            <i class="fas fa-cogs pr-2"></i>Users
                                        </h6>

                                        <form class="input-group w-50" action="/search/user" method="get">
                                            <input type="text" name="q" class="form-control" placeholder="search user..!">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="submit"><i class="fas fa-search " id="searchIcon"></i></button>
                                            </div>
                                        </form>


                                        <button  class="btn btn-danger font-weight-bold RT-shadow"  data-toggle="modal" data-target="#user-add-model">
                                            Add User
                                        </button>

                                    </div>
                                    <div class="card-body">

                                        <div class="filter-wrapper mb-3">
                                            <form class="row m-0 d-flex flex-nowrap" method="GET" action="#">
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
                                                        <tr class="product-table-head-tr">
                                                            <th>ID</th>
                                                            <th>Profile</th>
                                                            <th>Phone</th>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                            <th>Level</th>
                                                            <th>Points</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    @foreach ($users as $userItem)
                                                        <tr class="product-list-tr">
                                                                <td>
                                                                    <div>#{{$userItem->uid}}</div>
                                                                </td>
                                                                <td>
                                                                    <div class="w-100 d-flex justify-content-center">
                                                                        <div style="width:40px;height:40px;" class="RT-shadow rounded-circle bg-light">
                                                                            <img src="/profile/{{$userItem->image}}" style="width:40px;height:40px;" class="rounded-circle">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>{{$userItem->phone}}</div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <div>
                                                                        <span>{{$userItem->name}}</span>
                                                                    
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                       <span>
                                                                            @if ($userItem->status=="active")
                                                                                <span class="badge badge-success  p-2 rounded-0" style="font-size:15px;">Active</span>
                                                                            @elseif($userItem->status=="restricted")
                                                                                <span class="badge badge-warning p-2 rounded-0" style="font-size:15px;">Restricted</span>
                                                                            @elseif($userItem->status=="deactive")
                                                                                <span class="badge badge-danger p-2 rounded-0" style="font-size:15px;">Deactive</span>
                                                                            @else
                                                                                <span class="badge badge-light p-2 rounded-0" style="font-size:15px;">?</span>
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        
                                                                        <span class="badge bg-white  p-2 rounded-0 text-dark text-uppercase" style="font-size:15px; letter-spacing:2px;">

                                                                            @if ($userItem->level=="silver")
                                                                                <i class="fas fa-crown" style="color:#e5e4e2;"></i>
                                                                                <span >Silver</span>
                                                                            @elseif($userItem->level=="gold")
                                                                                <i class="fas fa-crown" style="color:#FFD700;"></i>
                                                                                <span>Gold</span>
                                                                            @elseif($userItem->level=="platinum")
                                                                                <i class="fas fa-crown" style="color:#9e9e9e;"></i>
                                                                                <span>Platinum</span>
                                                                            @elseif($userItem->level=="diamond")
                                                                                <i class="fas fa-crown" style="color:#7b00e8;"></i>
                                                                                <span>Diamond</span>
                                                                            @else
                                                                                <i class="fas fa-crown" style="color:#000;"></i>
                                                                                <span>?</span>
                                                                            @endif
                                                                            
                                                                        </span>
                                                                        
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <span style="font-size:13px;color:#000;">
                                                                            <span id="user-point">{{$userItem->point}}</span>
                                                                            <i class="fas fa-coins text-warning"></i>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                

                                                                
                                                                <td>
                                                                    <div>
                                                                        <button class="btn btn-primary text-white border-0 RT-shadow mr-2 user-order-btn" token={{$userItem->access_token}} data-toggle="modal" data-target="#user-order-model" >
                                                                            <i class="fas fa-shopping-bag font-weight-bold" token={{$userItem->access_token}}></i>
                                                                        </button>
                                                                        <button class="btn btn-dark text-white border-0 RT-shadow user-info-btn" token={{$userItem->access_token}} level="{{$userItem->level}}" status="{{$userItem->status}}" img="/profile/{{$userItem->image}}" data-toggle="modal" data-target="#user-info-model">
                                                                            <i class="fas fa-user font-weight-bold" token={{$userItem->access_token}} level="{{$userItem->level}}" status="{{$userItem->status}}" img="/profile/{{$userItem->image}}"></i>
                                                                        </button>
                                                                        
                                                                    </div>
                                                                </td>
                                                                
                                                        </tr>
                                                    @endforeach
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="pagination-area d-flex justify-content-center align-items-center">
                                                {{ $users->links() }}
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
            @include('/admin/Component/popup/user-delete')
            @include('/admin/Component/popup/user-status')
            @include('/admin/Component/popup/user-order')
            @include('/admin/Component/popup/user-info')   
            @include('/admin/Component/popup/user-add')     

        </div>
    </div>

    <!----------------------------[ End Wrapper ]---------------------------->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/admin/Component/Link/js')
    <script src="/assets/Backend/js/user/user-order.js" type="module"></script>
    <script src="/assets/Backend/js/user/user-info.js" type="module"></script>
    <script src="/assets/Backend/js/user/create-user.js" type="module"></script>
</body>





</html>