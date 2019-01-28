<?php
$activate_deshboard = '';
$admin = '';
$agent = '';
$farmer = '';
$buyer = '';
$goods = '';
$seller_bill = '';
$buyer_bill = '';
$bill_collection = '';
$buyer_bill_collection = '';
$report = '';
$site_setting = '';
$ledger = '';
$stock_out = '';
$stock_in = '';
$role = '';
$module = '';
$permission = '';
$sale_report = '';
$farmer_report = '';
$stock_out_pending = '';
$stock_in_pending = '';

if ((Route::is('dashboard'))) {
    $activate_deshboard = 'active';
}
if ((Route::is('admin'))) {
    $admin = 'active';
}
if ((Route::is('admin_view'))) {
    $admin = 'active';
}
if ((Route::is('admin_edit'))) {
    $admin = 'active';
}
if ((Route::is('farmer'))) {
    $farmer = 'active';
}
if ((Route::is('farmer_edit'))) {
    $farmer = 'active';
}

if ((Route::is('seller_list'))) {
    $farmer = 'active';
}
if ((Route::is('seller_view'))) {
    $farmer = 'active';
}
if ((Route::is('agent'))) {
    $agent = 'active';
}
if ((Route::is('agent_edit'))) {
    $agent = 'active';
}
if ((Route::is('agent_list'))) {
    $agent = 'active';
}if ((Route::is('agent_view'))) {
    $agent = 'active';
}
if ((Route::is('buyer'))) {
    $buyer = 'active';
}
if ((Route::is('buyer_add'))) {
    $buyer = 'active';
}
if ((Route::is('buyer_edit'))) {
    $buyer = 'active';
}
if ((Route::is('buyer_view'))) {
    $buyer = 'active';
}
if ((Route::is('seller_bills_list'))) {
    $seller_bill = 'active';
}if ((Route::is('buyer_bills_list'))) {
    $buyer_bill = 'active';
}
if ((Route::is('goods'))) {
    $goods = 'active';
}
if ((Route::is('add_goods_type'))) {
    $goods = 'active';
}
if ((Route::is('edit_goods_type'))) {
    $goods = 'active';
}if ((Route::is('goods_type_view'))) {
    $goods = 'active';
}
if ((Route::is('stock_out_invoice'))) {
    $buyer_bill = 'active';
}
if ((Route::is('stock_out_list'))) {
    $stock_out = 'active';
}
if ((Route::is('stock_out'))) {
    $stock_out = 'active';
}
if ((Route::is('stock_in_invoice'))) {
    $seller_bill = 'active';
}
if ((Route::is('stock_in'))) {
    $stock_in = 'active';
}
if ((Route::is('stock_in_list'))) {
    $stock_in = 'active';
}
if ((Route::is('ledger'))) {
    $ledger = 'active';
}
if ((Route::is('bill_collection_add'))) {
    $seller_bill = 'active';
}
if ((Route::is('buyer_bill_collection_add'))) {
    $buyer_bill = 'active';
}
if ((Route::is('role_create'))) {
    $role = 'active';
}
if ((Route::is('role_list'))) {
    $role = 'active';
}
if ((Route::is('module_create'))) {
    $module = 'active';
}
if ((Route::is('module_list'))) {
    $module = 'active';
}
if ((Route::is('set_role_module_permission'))) {
    $permission = 'active';
}
if ((Route::is('setting_reference_credit'))) {
    $site_setting = 'active';
}
if ((Route::is('sales_report'))) {
    $sale_report = 'active';
}
if ((Route::is('farmer_report'))) {
    $farmer_report = 'active';
}
if ((Route::is('buyer_stock_out_bill_create'))) {
    $stock_out_pending = 'active';
}
if ((Route::is('stock_out_view'))) {
    $stock_out_pending = 'active';
}
if ((Route::is('farmer_stock_in_bill_create'))) {
    $stock_in_pending = 'active';
}
?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200"><!--style="padding-top: 20px"-->
            <li class="nav-item start <?php echo $activate_deshboard;?>">
                <a href="<?php echo route('dashboard'); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ trans('label_word.dashbord_sidebar') }}</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None'){ ?>
            <li class="nav-item <?php echo $admin;?>">
                <a href="<?php echo route('admin'); ?>" class="nav-link nav-toggle">
                    <i class="fa icon-user"></i>
                    <span class="title">{{ trans('label_word.admin_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None'){ ?>
            <li class="nav-item <?php echo $role;?>">
                <a href="<?php echo route('role_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-shield"></i>
                    <span class="title">{{ trans('label_word.role_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None'){ ?>
            <li class="nav-item <?php echo $module;?>">
                <a href="<?php echo route('module_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-gear"></i>
                    <span class="title">{{ trans('label_word.module_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None'){ ?>
            <li class="nav-item <?php echo $permission;?>">
                <a href="<?php echo route('set_role_module_permission'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-anchor"></i>
                    <span class="title">{{ trans('label_word.permission_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['agent']) && $role_permission_arr['agent'] != 'None'){ ?>
            <li class="nav-item <?php echo $agent;?>">
                <a href="<?php echo route('agent_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">{{ trans('label_word.agent_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['farmers']) && $role_permission_arr['farmers'] != 'None'){ ?>
            <li class="nav-item <?php echo $farmer;?>">
                <a href="<?php echo route('seller_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-arrow-up"></i>
                    <span class="title">{{ trans('label_word.farmer_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['buyer']) && $role_permission_arr['buyer'] != 'None'){ ?>
            <li class="nav-item <?php echo $buyer;?>">
                <a href="<?php echo route('buyer'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-arrow-down"></i>
                    <span class="title">{{ trans('label_word.buyer_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['goods-type']) && $role_permission_arr['goods-type'] != 'None'){ ?>
            <li class="nav-item <?php echo $goods;?>">
                <a href="<?php echo route('goods'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-cubes"></i>
                    <span class="title">{{ trans('label_word.good_type_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['ledger-note']) && $role_permission_arr['ledger-note'] != 'None'){ ?>
            <li class="nav-item hidden <?php echo $ledger;?>">
                <a href="<?php echo route('stock_out_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-sticky-note-o"></i>
                    <span class="title">{{ trans('label_word.ledger_note_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['stock-in']) && $role_permission_arr['stock-in'] != 'None'){ ?>
            <li class="nav-item hidden <?php echo $stock_in;?>">
                <a href="<?php echo route('generate_bill'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-sticky-note-o"></i>
                    <span class="title">{{ trans('label_word.generate_bill') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['stock-in']) && $role_permission_arr['stock-in'] != 'None'){ ?>
            <!--    <li class="nav-item <?php echo $stock_in;?>">
                <a href="<?php  echo route('stock_in_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-arrow-up"></i>
                    <span class="title">{{ trans('label_word.stock_in_title') }}</span>
                </a>
            </li>-->
            <?php } ?>
            <?php if(isset($role_permission_arr['stock-out']) && $role_permission_arr['stock-out'] != 'None'){ ?>
        <!--    <li class="nav-item <?php echo $stock_out;?>">
                <a href="<?php echo route('stock_out_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-arrow-down"></i>
                    <span class="title">{{ trans('label_word.stock_out_title') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['stock-in']) && $role_permission_arr['stock-in'] != 'None'){ ?>
            <li class="nav-item <?php echo $stock_in_pending;?>">
                <a href="<?php echo route('farmer_stock_in_bill_create'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-list-alt"></i>
                    <span class="title">{{ trans('label_word.farmer_pending_bill') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['stock-out']) && $role_permission_arr['stock-out'] != 'None'){ ?>
            <li class="nav-item <?php echo $stock_out_pending;?>">
                <a href="<?php echo route('buyer_stock_out_bill_create'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-list-alt"></i>
                    <span class="title">{{ trans('label_word.buyer_pending_bill') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['buyer-bill']) && $role_permission_arr['buyer-bill'] != 'None'){ ?>
            <li class="nav-item <?php echo $buyer_bill;?>">
                <a href="<?php  echo route('buyer_bills_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-file-text-o"></i>
                    <span class="title">{{ trans('label_word.buyer_bill_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['seller-bill']) && $role_permission_arr['seller-bill'] != 'None'){ ?>
            <li class="nav-item <?php echo $seller_bill;?>">
                <a href="<?php echo route('seller_bills_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-file-text-o"></i>
                    <span class="title">{{ trans('label_word.seller_bill_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>

            <?php if(isset($role_permission_arr['sales-report']) && $role_permission_arr['sales-report'] != 'None'){ ?>
            <li class="nav-item <?php echo $sale_report;?>">
                <a href="<?php echo route('sales_report');?>" class="nav-link nav-toggle">
                    <i class="fa fa-file-text"></i>
                    <span class="title">{{ trans('label_word.sales_report') }}</span>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($role_permission_arr['farmer-report']) && $role_permission_arr['farmer-report'] != 'None'){ ?>
            <li class="nav-item <?php echo $farmer_report;?>">
                <a href="<?php echo route('farmer_report');?>" class="nav-link nav-toggle">
                    <i class="fa fa-file-text"></i>
                    <span class="title">{{ trans('label_word.farmer_report') }}</span>
                </a>
            </li>-->
            <?php } ?>
            <?php if(isset($role_permission_arr['site-settings']) && $role_permission_arr['site-settings'] != 'None'){ ?>
            <li class="nav-item <?php echo $site_setting;?>">
                <a href="<?php echo route('setting_reference_credit');?>" class="nav-link nav-toggle">
                    <i class="fa fa-cogs"></i>
                    <span class="title">{{ trans('label_word.site_setting_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="http://bsptechno.com/" class="title" style="margin-top: 40px;" title="BSP Technologies." target="_blank">Copyright © 2017 Nayatax</a>
            </li>
        </ul>

        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->