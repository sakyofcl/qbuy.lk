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
                    @include('/admin/Component/message/alert-box')

                    <!-- breadcrumb -->
                    <?php
                    $path = [
                        ['name' => 'home', 'link' => '/']
                    ];
                    echo breadcrumb('Category', $path);
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

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
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
                                            <li class="bg-gray d-flex row flex-nowrap m-0 mb-2  RT-shadow">
                                                <div class="col-9 d-flex p-0">
                                                    <a data-toggle="collapse" href="#list-{{$item->cid}}" aria-expanded="false" class=" btn btn-primary rounded-0 d-flex justify-content-center align-items-center">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <form method="POST" action="/category/main/edit" class="d-none align-items-center w-100 pl-1 pr-1" id="cat-edit-{{$item->cid}}" enctype="multipart/form-data">
                                                        <input type="text" name="catname" class="form-control border" value="{{$item->name}}">

                                                        
                                                        <label class="file-input-btn btn btn-primary RT-shadow m-0 ml-1 mr-1"  for="catImageEdit-{{$item->cid}}">
                                                            <i class="fas fa-upload"></i> 
                                                            
                                                        </label>
                                                        
                                                        <input type="file" class="image-upload" name="image" id="catImageEdit-{{$item->cid}}" accept="image/*"  hidden>
                                                        
                                                        <input type="text" name="catid" value="{{$item->cid}}" hidden/>
                                                    </form>

                                                   <span class="d-flex align-items-center pl-2 font-weight-bold text-capitalize text-dark" id="display-{{$item->cid}}">
                                                        {{$item->name}} ({{$item->tottal}})
                                                    </span>

                                                </div>
                                                <div class="col-3 d-flex justify-content-end align-items-center p-1">

                                                    <div id="cat-container-{{$item->cid}}" class="d-block">
                                                        <button class="btn btn-success RT-shadow rounded-0 mr-2 cat-edit-btn" targetContainer="cat-edit-container-{{$item->cid}}"  container="cat-container-{{$item->cid}}" catid="{{$item->cid}}" target="cat-edit-{{$item->cid}}" display="display-{{$item->cid}}">
                                                            <i class="fas fa-pencil-alt text-white cat-edit-btn" targetContainer="cat-edit-container-{{$item->cid}}" container="cat-container-{{$item->cid}}" catid="{{$item->cid}}" target="cat-edit-{{$item->cid}}" display="display-{{$item->cid}}"></i>
                                                        </button>
                                                        <button class="btn btn-danger RT-shadow rounded-0 delete-category-btn" targetName={{$item->name}} targetId={{$item->cid}} endpoint="/category/main/delete" data-toggle="modal" data-target="#delete-category-model" >
                                                            <i class="far fa-trash-alt text-white delete-category-btn" targetName={{$item->name}} targetId={{$item->cid}} endpoint="/category/main/delete"></i>
                                                        </button>
                                                    </div>   
                                                    <div id="cat-edit-container-{{$item->cid}}" class="d-none">
                                                        <button class="btn btn-success RT-shadow rounded-0 mr-2 category-save" type="submit" form="cat-edit-{{$item->cid}}">
                                                            <i class="fas fa-check text-white category-save"></i>
                                                        </button>
                                                        <button class="btn btn-danger RT-shadow rounded-0 cancel-cat-btn"  display="display-{{$item->cid}}" container="cat-edit-container-{{$item->cid}}" targetContainer="cat-container-{{$item->cid}}" target="cat-edit-{{$item->cid}}">
                                                            <i class="fas fa-times text-white delete-category-btn" display="display-{{$item->cid}}" container="cat-edit-container-{{$item->cid}}" targetContainer="cat-container-{{$item->cid}}" target="cat-edit-{{$item->cid}}"></i>
                                                        </button>
                                                    </div>  
                                                   
                                                   
                                                </div>
                                            </li>
                                            <ul class="list-unstyled pl-5 collapse" id="list-{{$item->cid}}">
                                                @foreach($sub as $subitem)
                                                @if($subitem->cid==$item->cid)
                                                <li class="bg-gray d-flex row flex-nowrap m-0 mb-2 p-2 RT-shadow">
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
                                        <form action="/category/main/store" method="POST" class=" d-flex row flex-nowrap m-0 w-100" enctype='multipart/form-data'>
                                            <div class="col-6 d-flex p-0 pr-3">
                                                <input type="text" placeholder="Ender category" name="catname" id="catname" class="form-control bg-gray w-100">
                                            </div>
                                            <div class="col-4 d-flex p-0 pr-3">

                                                <label class="file-input-btn btn btn-primary RT-shadow m-0 w-100"  for="catImage"><i class="fas fa-upload"></i> image</label>
                                                <input type="file" class="d-none" class="image-upload" name="image" id="catImage" accept="image/*" />
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

                       
                    </div>

                </div>
                <!-- End Page Content -->

            </div>
            <!----------------------------[ End Main Content ]---------------------------->

            <!----------------------------[ Footer ]---------------------------->
            @include('/admin/Component/Footer/footer')
            @include('/admin/Component/popup/delete-category')
            
        </div>
    </div>

    <!----------------------------[ End Wrapper ]---------------------------->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/admin/Component/Link/js')
    <script src="/assets/Backend/js/category/category.js" type="module"></script>
    <script src="/assets/Backend/js/category/category-dynamic.js" type="module"></script>

</body>





</html>