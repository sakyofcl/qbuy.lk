<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders | Qbuy.lk</title>
    <!----------------------------[ Css Library ]---------------------------->
    @include('/admin/Component/Link/css')
    <style>
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: 0;
        }

        .mailbox-widget .custom-tab .nav-item .nav-link {
            border: 0;
            color: #fff;
            border-bottom: 3px solid transparent;
        }

        .mailbox-widget .custom-tab .nav-item .nav-link.active {
            background: #e8e8e8;
            border-radius: 0;
            color: #fff;
            border-bottom: 3px solid #007bff;
        }

        .no-wrap td,
        .no-wrap th {
            white-space: nowrap;
        }

        .table td,
        .table th {
            padding: .9375rem .4rem;
            vertical-align: top;
            border-top: 1px solid rgba(120, 130, 140, .13);
        }

        .font-light {
            font-weight: 300;
        }

        .wrapper {
            margin: 0 auto;
        }

        .search_bar {
            height: 48px;
            border: 3px solid rgba(131, 149, 179, 0.3);
            display: flex;
            padding-left: 24px;
            padding-right: 4px;
            justify-content: space-between;
            box-shadow: 0 12px 20px 0 rgba(131, 149, 179, 0);
            transition: 0.2s ease box-shadow, 0.2s ease border;
            align-items: center;
        }



        .search_bar.focus {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom: none;
            box-shadow: none;
        }

        .search_input {
            height: 42px;
            padding: 0;
            padding-left: 8px;
            border: 0;
            width: calc(100% - 96px);
            font-size: 16px;
            line-height: 30px;
            letter-spacing: 0.5px;
            font-weight: 300;
            background-color: #fff;
            font-family: inherit;
        }

        .search_input:focus {
            outline: none;
            outline-offset: none;
        }

        .search_input .search_input:hover~.search_bar {
            box-shadow: 1px 1px 1px #0000;
        }

        .search_icone {
            width: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 34px;
            border-radius: 12px;
            border: none;
            background-color: #fff;
            transition: 0.4s background-color;
            cursor: pointer;
        }

        .search_icone:hover {
            background-color: #e8f0fe;
        }

        .search_icone .ico {
            width: 100%;
            color: black;
            font-size: 20px;
        }

        @media screen and (max-width: 768px) {
            .wrapper {
                padding: 0 20px;
            }
        }
    </style>
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
                    echo breadcrumb('Order', $path);
                    ?>
                    <!-- end breadcrumb -->




                    <div class="container mt-4 p-0">
                        <div class="row m-0">
                            <div class="col-md-12 p-0">
                                <div class="card RT-shadow RT-radius border-0 mb-3 RT-list-products">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                                            <i class="fas fa-cogs pr-2"></i>Orders
                                        </h6>

                                    </div>
                                    <div class="card-body">

                                        <div class="order-tap-pane-controller mb-2">
                                            
                                            <a class="nav-link btn {{$tab=="new" ? "active" : ""}}" href="/order?tab=new">
                                                New
                                            </a>
                                            <a class="nav-link btn {{$tab=="process" ? "active" : ""}}" href="/order?tab=process">
                                                Process
                                            </a>
                                            <a class="nav-link btn {{$tab=="complete" ? "active" : ""}}" href="/order?tab=complete">
                                                Complete
                                            </a>
                                            <a class="nav-link btn {{$tab=="cancelled" ? "active" : ""}}" href="/order?tab=cancelled">
                                                Cancelled
                                            </a>

                                        </div>



                                        <div class="tab-content">
                                            @if($tab=="new")
                                                @include('/admin/order/new-order') 
                                            @elseif($tab=="process")
                                                @include('/admin/order/process-order') 
                                            @elseif($tab=="complete")
                                                @include('/admin/order/complete-order')
                                            @elseif($tab=="cancelled") 
                                                @include('/admin/order/cancelled-order')
                                            @endif

                                            <div class="pagination-area d-flex justify-content-center align-items-center">
                                                {{ $orders->links() }}
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
    <!-- PRODUCT INFO MODEL -->
    @include('/admin/Component/popup/order-info')

    <!----------------------------[ Javascript Library ]---------------------------->
    @include('/admin/Component/Link/js')
    <script src="/assets/Backend/js/category/category.js"></script>
    <script src="/assets/Backend/js/order/order-info.js"></script>

</body>





</html>