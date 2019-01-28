
<?php
$activate_deshboard = '';
$admin = '';
$agent = '';
$farmer = '';
$buyer = '';
$goods = '';
$buyer_bill = '';
$site_setting = '';
$ledger = '';
$stock_out = '';
$stock_in = '';
$role = '';
$module = '';
$permission = '';
$generate_bill='';
$sale_report = '';
$farmer_report = '';
$seller_bill='';

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
if ((Route::is('seller_bills_list'))) {
    $seller_bill = 'active';
}
if ((Route::is('stock_out_invoice'))) {
    $buyer_bill = 'active';
}
if ((Route::is('buyer_bills_list'))) {
    $buyer_bill = 'active';
}
if ((Route::is('show_buyer_data'))) {
    $buyer_bill = 'active';
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

if ((Route::is('generate_bill'))) {
    $generate_bill = 'active';
}
if((Route::is('generate_in_view'))){
    $generate_bill = 'active';
}

if((Route::is('seller_bills_list_pending'))){
    $seller_bill = 'active';
}
if((Route::is('show_farmer_data'))){
    $seller_bill = 'active';
}
if((Route::is('buyer_bills_list'))){
    $buyer_bill = 'active';
}
if((Route::is('sales_report'))){
    $sale_report = 'active';
}
if((Route::is('farmer_report'))){
    $farmer_report = 'active';
}

if((Route::is('farmer_bill_post'))){
    $seller_bill = 'active';
}
if((Route::is('farmer_bill'))){
    $seller_bill = 'active';
}

if((Route::is('buyer_bill_collection_list_post'))){
    $buyer_bill = 'active';
}
if((Route::is('sales_report_post'))){
    $sale_report = 'active';
}
if((Route::is('farmer_report_post'))){
    $farmer_report = 'active';
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



            <li class="sub-menu nav-item dcjq-parent-li" style="display: block;">
                <a href="javascript:;" class="dcjq-parent">
                    <i class="fa fa-laptop"></i>
                    <span>{{ trans('label_word.farmer_bill') }}</span>
                    <span class="dcjq-icon"></span></a>



                <ul class="page-sidebar-menu" style="display: block;">
                    <?php if(isset($role_permission_arr['stock-in']) && $role_permission_arr['stock-in'] != 'None'){ ?>
                    <li class="nav-item <?php echo $generate_bill;?>">
                        <a href="<?php echo route('generate_bill'); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">{{ trans('label_word.add') }}</span>
                        </a>
                    </li>
                    <?php } ?>
                        <?php if(isset($role_permission_arr['seller-bill']) && $role_permission_arr['seller-bill'] != 'None'){ ?>
                        <li class="nav-item <?php echo $seller_bill;?>">
                            <a href="<?php  echo route('seller_bills_list_pending'); ?>" class="nav-link nav-toggle">
                                <i class="fa fa-file-text-o"></i>
                                <span class="title">{{ trans('label_word.view') }}</span>
                            </a>
                        </li>
                        <?php } ?>
                </ul>
            </li>
            <?php if(isset($role_permission_arr['buyer-bill']) && $role_permission_arr['buyer-bill'] != 'None'){ ?>
            <li class="nav-item <?php echo $buyer_bill;?>">
                <a href="<?php  echo route('buyer_bills_list'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-file-text-o"></i>
                    <span class="title">{{ trans('label_word.buyer_bill_sidebar') }}</span>
                </a>
            </li>
            <?php } ?>
            <li class="sub-menu dcjq-parent-li" style="display: block;">
                <a href="javascript:;" class="dcjq-parent">
                    <i class="fa fa-laptop"></i>
                    <span>{{ trans('label_word.setting') }}</span>
                    <span class="dcjq-icon"></span></a>



                <ul class="page-sidebar-menu"  style="display: block;">
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
                    <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None'){ ?>
                    <li class="nav-item <?php echo $admin;?>">
                        <a href="<?php echo route('admin'); ?>" class="nav-link nav-toggle">
                            <i class="fa icon-user"></i>
                            <span class="title">{{ trans('label_word.admin_sidebar') }}</span>
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
                    <?php if(isset($role_permission_arr['site-settings']) && $role_permission_arr['site-settings'] != 'None'){ ?>
                    <li class="nav-item <?php echo $site_setting;?>">
                        <a href="<?php echo route('setting_reference_credit');?>" class="nav-link nav-toggle">
                            <i class="fa fa-cogs"></i>
                            <span class="title">{{ trans('label_word.site_setting_sidebar') }}</span>
                        </a>
                    </li>
                    <?php } ?>


                </ul>
            </li>




        </ul>

        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
