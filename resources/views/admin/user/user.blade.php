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

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/']
                    ];
                    echo breadcrumb('user', $path);
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
                            <div class="col-md-12 p-0">
                                <div class="card RT-shadow RT-radius border-0 mb-3 RT-list-products">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                            <i class="fas fa-cogs pr-2"></i>Users
                                        </h6>

                                    </div>
                                    <div class="card-body">

                                        <span class="badge badge-primary rounded p-2 text-capitalize border mb-3">
                                            <i class="fas fa-list-ul pr-1"></i>List Users
                                        </span>



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
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>


                                                        <tr class="product-list-tr">
                                                                <td>
                                                                    <div>#15</div>
                                                                </td>
                                                                <td>
                                                                    <div class="w-100 d-flex justify-content-center">
                                                                        <div style="width:40px;height:40px;" class="RT-shadow rounded-circle bg-light">
                                                                        <img src="https://bootdey.com/img/Content/avatar/avatar4.png" style="width:40px;height:40px;" class="rounded-circle">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>0757630782</div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <div>
                                                                        <span>Mohamed sakeen</span>
                                                                    
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                       <span><span class="badge badge-success RT-shadow p-2 rounded-0" style="font-size:15px;">Active</span></span>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                       <span> <i class="fas fa-crown " style="color:#FFD700;"></i></span>
                                                                    </div>
                                                                </td>
                                                                

                                                                
                                                                <td>
                                                                    <div>
                                                                        <a href="/user/info" class="btn btn-primary text-white border-0 RT-shadow mr-2" >
                                                                            <i class="fas fa-user font-weight-bold"></i>
                                                                        </a>
                                                                        <button class="btn btn-danger text-white border-0 RT-shadow" data-toggle="modal" data-target="#user-delete-confirm-model">
                                                                            <i class="fas fa-trash font-weight-bold"></i>
                                                                        </button>
                                                                        
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
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
            @include('/admin/Component/popup/user-delete')
            @include('/admin/Component/popup/user-status')
            

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