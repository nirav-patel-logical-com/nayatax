<?php $add_path='';
if(Request::segment(2) != ''){
    $add_path = '../';
}
if(Request::segment(3) != ''){
    $add_path = '../../';
}
if(Request::segment(4) != ''){
    $add_path = '../../../';
}
if(Request::segment(5) != ''){
    $add_path = '../../../../';
}
if(isset($_SESSION['lang_local']) && !empty($_SESSION['lang_local'])){
    if($_SESSION['lang_local'] === 'guj'){
        App::setLocale('guj');
    }else{
        App::setLocale('en');
    }
}else{
    App::setLocale('en');
}


?>
@include('layouts.head')
<!-- BEGIN HEADER -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo route('dashboard');?>">
                <img src="{{$add_path}}assets/img/logo2.png" alt="logo" class="logo-default" style="margin: 2px 30px 0;" /> </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!--<img alt="" class="img-circle" src="{{$add_path}}assets/layouts/layout/img/avatar3_small.jpg" />-->
                        <span class="username username-hide-on-mobile" > {{$_SESSION['login_user']->f_name}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo route('user_view',['id'=>$_SESSION['login_user']->id]) ?>">
                                <i class="icon-user"></i> {{ trans('label_word.view_profile') }} </a>
                        </li>
                        <li>
                            <a href="<?php echo route('change_admin_password',['id'=>$_SESSION['login_user']->id]); ?>">
                                <i class="icon-key"></i> {{ trans('label_word.change_password') }}</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?php echo route('logout');?>">
                                <i class="icon-lock"></i> {{ trans('label_word.log_out') }} </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>

        </div>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile"> {{ trans('label_word.lang') }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li class=" <?php
                        if ($_SESSION['lang_local'] == 'en')
                        {
                            echo 'active';
                        }
                        ?>">
                            <a href="" onclick="myfunction('EN');">
                                {{ trans('label_word.en') }} </a>
                        </li>
                        <li class="<?php
                        if ($_SESSION['lang_local'] == 'guj')
                        {
                            echo 'active';
                        }
                        ?>">
                            <a href="" onclick="myfunction('GUJ');">
                                {{ trans('label_word.guj') }} </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>

        </div>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!--<img alt="" class="img-circle" src="{{$add_path}}assets/layouts/layout/img/avatar3_small.jpg" />-->
                        <span class="username username-hide-on-mobile" > {{$_SESSION['login_user']->biz_name}} </span>

                    </a>

                </li>
            </ul>
            </span>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<script>
    function myfunction(lang){
        $.ajax({
            method:'POST',
           data:{'lang':lang,'_token':'{{csrf_token()}}'},
            url:'<?php echo route('change_lang');?>',
            success:function(result){
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] != 'TRUE') {
                    toastr.error($obj['MESSAGE']);
                }

            }
        });
    }
</script>
</body>