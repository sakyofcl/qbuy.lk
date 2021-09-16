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
                    echo breadcrumb($user->name, $path);
                    ?>
                    <!-- end breadcrumb -->



                   

                        <div class="container p-0">
                            <h1 class="h3 mb-3">Settings</h1>
                            <div class="row">
                                <div class="col-md-5 col-xl-4">

                                    <div class="card shadow-none">
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
                                            Orders
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Cart
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Chat
                                            </a>
                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                            Activity
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

                                            <div class="card shadow-none">
                                               <div class="container bootstrap snippets bootdey ">
                                                    <div class="panel-body inf-content">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="card shadow-none h-100 border-0">
                                                                    <div class="card-body ">
                                                                        <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 ">
                                                                            @if ($user->status=="active")
                                                                                <img src="data:image/png;base64,{{$user->image}}" class="rounded-circle p-1 bg-success" width="100px" height="100px">
                                                                            @elseif($user->status=="restricted")
                                                                                <img src="data:image/png;base64,{{$user->image}}" class="rounded-circle p-1 bg-warning" width="100px" height="100px">
                                                                            @elseif($user->status=="deactive")
                                                                                <img src="data:image/png;base64,{{$user->image}}" class="rounded-circle p-1 bg-danger" width="100px" height="100px">
                                                                            @else
                                                                                <img src="data:image/png;base64,{{$user->image}}" class="rounded-circle p-1 bg-dark" width="100px" height="100px">
                                                                            @endif
                                                                            
                                                                            
                                                                            <div class="d-flex justify-content-center text-dark w-100  pt-1 pb-1">

                                                                                @if ($user->level=="silver")
                                                                                    <span><i class="fas fa-crown" style="color:#e5e4e2;"></i> Silver<span>
                                                                                @elseif($user->level=="gold")
                                                                                    <span><i class="fas fa-crown" style="color:#FFD700;"></i> Gold</span>
                                                                                @elseif($user->level=="platinum")
                                                                                    <span><i class="fas fa-crown" style="color:#9e9e9e;"></i> Platinum</span>
                                                                                @elseif($user->level=="diamond")
                                                                                    <span><i class="fas fa-crown" style="color:#7b00e8;"></i> Diamond</span>
                                                                                @else
                                                                                    <span><i class="fas fa-crown" style="color:#000;"></i>?</span>
                                                                                @endif
                                                                                
                                                                            </div>

                                                                            <div class="d-flex justify-content-center text-dark w-100  pt-1 pb-1">
                                                                                <button class="btn btn-primary text-white border-0 RT-shadow">
                                                                                    <i class="fas fa-user-edit"></i> Edit
                                                                                </button>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
				                                            </div>   
                                                            <div class="col-md-8">
                                                               
                                                                <div class="table-responsive">
                                                                <table class="table table-user-information ">
                                                                    <tbody>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Signature</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                #{{$user->uid}}    
                                                                            </td>
                                                                        </tr>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Name</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                {{$user->name}}    
                                                                            </td>
                                                                        </tr>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Phone</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                {{$user->phone}}
                                                                            </td>
                                                                        </tr>

                                                                        <tr>        
                                                                            <td>
                                                                                <span>Email</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                {{$user->email}}
                                                                            </td>
                                                                        </tr>


                                                                        <tr>        
                                                                            <td>
                                                                                <span>Gender</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                {{$user->gender}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>        
                                                                            <td>
                                                                                <span>Join</span>
                                                                            </td>
                                                                            <td class="text-primary">
                                                                                <span>{{$user->date}}</span> 
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