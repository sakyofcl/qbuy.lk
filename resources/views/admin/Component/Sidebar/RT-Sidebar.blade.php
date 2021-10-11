@include('/admin/Component/Sidebar/Component/SB-Dropdown')
@include('/admin/Component/Sidebar/Component/SB-Userdetail')




<ul class="navbar-nav bg-gradient-primary RT-shadow sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- company info -->
    <?php
    echo company('Qbuy', '/assets/Backend/img/logo/favicon.png', '#');
    ?>

    <hr class="sidebar-divider my-0">

    <!-- dropdown links -->

    <!--Dashboard -->
    <?php
    echo dropdown('D-0', 'Dashboard', '/', 'fas fa-fw fa-tachometer-alt');
    ?>
    <!-- End Dashboard -->
    <hr class="sidebar-divider">

    <!-- Store -->
    <?php
    echo dropdownHeader('shop');
    echo dropdown('D-0', 'Category', '/category-tab', 'fas fa-align-left');
    echo dropdown('D-0', 'Product', '/product/all', 'fas fa-store-alt');
    echo dropdown('D-0', 'Offer', '/offer', 'fas fa-tags');
    ?>
    <!-- End Category -->
    <hr class="sidebar-divider">

    <!-- Order -->
    <?php
    echo dropdownHeader('Sales');
    echo dropdown('D-0', 'Order', '/order', 'fas fa-shopping-bag');
    ?>
    <!-- End Category -->
    <hr class="sidebar-divider">

    <!-- Order -->
    <?php
    echo dropdownHeader('customer');
    echo dropdown('D-0', 'User', '/user', 'fas fa-users');
    ?>

    <!-- Sidebar Toggler-->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>