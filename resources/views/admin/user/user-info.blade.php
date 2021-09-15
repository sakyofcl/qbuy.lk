<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Info | Qbuy.lk</title>
    <!----------------------------[ Css Library ]---------------------------->
    @include('/admin/Component/Link/css')
    <link rel="stylesheet" href="/assets/Backend/css/user-info.css">
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
                        ['name' => 'home', 'link' => '/'],
                        ['name' => 'user', 'link' => '/user']
                    ];
                    echo breadcrumb('info', $path);
                    ?>
                    <!-- end breadcrumb -->



                   

                        <div class="container p-0">
                            <h1 class="h3 mb-3">Settings</h1>
                            <div class="row">
                                <div class="col-md-5 col-xl-4">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Profile Settings</h5>
                                        </div>

                                        <div class="list-group list-group-flush" role="tablist">
                                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                                            Account
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                                            Password
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Privacy and safety
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Email notifications
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Web notifications
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Widgets
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Your data
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Delete account
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 col-xl-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                                            <div class="card">
                                               <div class="container bootstrap snippets bootdey">
                                                    <div class="panel-body inf-content">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="d-flex flex-column align-items-center text-center">
                                                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="rounded-circle p-1 bg-primary" width="110">
                                                                            
                                                                            <div class="d-flex justify-content-center text-dark">
                                                                                <span>Mohamed sakeen</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
				                                            </div>   
                                                            <div class="col-md-8">
                                                               
                                                                <div class="table-responsive">
                                                                <table class="table table-user-information">
                                                                    <tbody>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Signature</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                #1022    
                                                                            </td>
                                                                        </tr>
                                                                        <tr>    
                                                                            <td>
                                                                                <span>Name</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                <span>Mohamed sakeen</span>     
                                                                            </td>
                                                                        </tr>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Phone</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                0757630782 
                                                                            </td>
                                                                        </tr>

                                                                        <tr>        
                                                                            <td>
                                                                                <span>Email</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                sakyofcl@gmail.com
                                                                            </td>
                                                                        </tr>


                                                                        <tr>        
                                                                            <td>
                                                                                <span>Gender</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                Male
                                                                            </td>
                                                                        </tr>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Join</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                <span>2012/02/15</span> 
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

                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-actions float-right">
                                                        <div class="dropdown show">
                                                            <a href="#" data-toggle="dropdown" data-display="static">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                                                    <circle cx="12" cy="12" r="1"></circle>
                                                                    <circle cx="19" cy="12" r="1"></circle>
                                                                    <circle cx="5" cy="12" r="1"></circle>
                                                                </svg>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="card-title mb-0">Private info</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputFirstName">First name</label>
                                                                <input type="text" class="form-control" id="inputFirstName" placeholder="First name">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputLastName">Last name</label>
                                                                <input type="text" class="form-control" id="inputLastName" placeholder="Last name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail4">Email</label>
                                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress">Address</label>
                                                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress2">Address 2</label>
                                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputCity">City</label>
                                                                <input type="text" class="form-control" id="inputCity">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="inputState">State</label>
                                                                <select id="inputState" class="form-control">
                                                                    <option selected="">Choose...</option>
                                                                    <option>...</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputZip">Zip</label>
                                                                <input type="text" class="form-control" id="inputZip">
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="password" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Password</h5>

                                                    <form>
                                                        <div class="form-group">
                                                            <label for="inputPasswordCurrent">Current password</label>
                                                            <input type="password" class="form-control" id="inputPasswordCurrent">
                                                            <small><a href="#">Forgot your password?</a></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPasswordNew">New password</label>
                                                            <input type="password" class="form-control" id="inputPasswordNew">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPasswordNew2">Verify password</label>
                                                            <input type="password" class="form-control" id="inputPasswordNew2">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </form>

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