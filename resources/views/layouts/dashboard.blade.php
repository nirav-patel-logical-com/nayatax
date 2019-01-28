<style>
        .orange {
            background-color: orange;
        }
        .visual>i {
            color: #FFF;
            opacity: .1;
            filter: alpha(opacity=10);
        }
        .details .number {
            color: #FFF;
        }
        .desc {
            color: #FFF;
            opacity: 1;
            filter: alpha(opacity=100);
        }
    </style>

<!--Start Include header here-->
@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
   @include('layouts.sidebar')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BAR -->

        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> {{ trans('label_word.dashbord_sidebar') }}</h3>


        <div class="row">
            <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin']!='None'){ ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="<?php echo route('admin'); ?>">
                    <div class="visual">
                        <i class="fa icon-user"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$user_details['admin_count']}}">0</span>
                        </div>
                        <div class="desc"> {{ trans('label_word.admin_sidebar') }} </div>
                    </div>
                </a>
            </div>
                <?php } ?>
                <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin']!='None'){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 orange" href="<?php echo route('agent_list'); ?>">
                        <div class="visual">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$user_details['agent_count']}}">0</span>
                            </div>
                            <div class="desc"> {{ trans('label_word.agent_sidebar') }} </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            <?php if(isset($role_permission_arr['farmers']) && $role_permission_arr['farmers']!='None'){ ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo route('seller_list'); ?>">
                    <div class="visual">
                        <i class="fa fa-arrow-up"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$user_details['seller_count']}}">0</span></div>
                        <div class="desc"> {{ trans('label_word.farmer_sidebar') }} </div>
                    </div>
                </a>
            </div>
                <?php } ?>
                <?php if(isset($role_permission_arr['buyer']) && $role_permission_arr['buyer']!='None'){ ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo route('buyer'); ?>">
                    <div class="visual">
                        <i class="fa fa-arrow-down"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$user_details['buyer_count']}}">0</span>
                        </div>
                        <div class="desc"> {{ trans('label_word.buyer_sidebar') }} </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

@include('layouts.footer')

