<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    @include('layouts.head')
</head>
<!-- END HEAD -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
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
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo route('dashboard');?>">{{ trans('label_word.home') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{ trans('label_word.change_password') }}</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> {{ trans('label_word.change_password') }}</h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN {{ trans('label_word.change_password') }}-->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa icon-user font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.change_password') }}</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form">
                            <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                            <div class="form-body">
                                <div class="form-group" id="div_old_password">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group margin-top-10">
                                                                <span class="input-group-addon">
                                                                   <i class="fa fa-key"></i>
                                                                </span>
                                                <input type="password"
                                                       class="form-control jb_res_mobi_form_control jb-form-control-eye"
                                                       name="old_password" id="old_password" placeholder="{{ trans('label_word.old_password') }}">
                                                        <span class="input-group-addon jb-input-group-addon-eye">
                                                            <i class="fa fa-eye-slash" id="show_old_password"
                                                               style="cursor: pointer;"></i>
                                                            <i class="fa fa-eye" id="hide_old_password"
                                                               style="display:none;cursor: pointer;"></i>
                                                        </span>

                                            </div>
                                            <span class="help-block pull-right" id="msg_old_password"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div_new_password">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group margin-top-10">
                                                                <span class="input-group-addon">
                                                                   <i class="fa fa-key"></i>
                                                                </span>
                                                <input type="password"
                                                       class="form-control jb_res_mobi_form_control jb-form-control-eye"
                                                       name="old_password" id="new_password" placeholder="{{ trans('label_word.new_password') }}">
                                                        <span class="input-group-addon jb-input-group-addon-eye">
                                                            <i class="fa fa-eye-slash" id="show_old_password"
                                                               style="cursor: pointer;"></i>
                                                            <i class="fa fa-eye" id="hide_old_password"
                                                               style="display:none;cursor: pointer;"></i>
                                                        </span>

                                            </div>
                                            <span class="help-block pull-right" id="msg_new_password"></span>

                                        </div>
                                    </div>
                                </div>
                              <!--  <div class="form-group" id="div_new_password">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group margin-top-10">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-key"></i>
                                                        </span>
                                                <input type="password"
                                                       class="form-control jb_res_mobi_form_control jb-form-control-eye"
                                                       name="new_password" id="new_password" placeholder="{{ trans('label_word.new_password') }}">
                                                        <span class="input-group-addon jb-input-group-addon-eye">
                                                            <i class="fa fa-eye-slash" id="show_new_password"
                                                               style="cursor: pointer;"></i>
                                                            <i class="fa fa-eye" id="hide_new_password"
                                                               style="display:none;cursor: pointer;"></i>
                                                        </span>

                                            </div>
                                            <span class="help-block pull-right" id="msg_new_password"></span>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="text-right">
                                <button type="button" id="admin_submit" class="btn green">{{ trans('label_word.save') }}</button>
                                <a href="<?php echo route('dashboard');?>" class="btn default">{{ trans('label_word.cancel') }}</a>
                             </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END {{ trans('label_word.change_password') }}-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
    <!-- BEGIN FOOTER -->

    @include('layouts.footer')
    @include('layouts.footer-js')
    <!-- END FOOTER -->
    <script type="text/javascript">
        $("#show_old_password").click(function () {
            document.getElementById('old_password').type = 'text';
            $(this).hide();
            $("#hide_old_password").show();
        });
        $("#hide_old_password").click(function () {
            document.getElementById('old_password').type = 'password';
            $(this).hide();
            $("#show_old_password").show();
        });

        $("#show_new_password").click(function () {
            document.getElementById('new_password').type = 'text';
            $(this).hide();
            $("#hide_new_password").show();
        });
        $("#hide_new_password").click(function () {
            document.getElementById('new_password').type = 'password';
            $(this).hide();
            $("#show_new_password").show();
        });
        $("input[name=old_password]").change(function () {

            var old_password = $("#old_password").val();
            var scroll_element = '';
            var user_id = $("#user_id").val();
            $("#admin_submit").removeAttr('disabled');
            $.ajax({

                url: '<?php echo route("check_user_password");?>',
                method: 'POST',
                data: {
                    'old_password': old_password,
                    'user_id': user_id,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_old_password").removeClass('has-error');
                        $("#msg_old_password").html("");
                        $("#admin_submit").removeAttr('disabled');
                    } else {
                        $("#div_old_password").addClass('has-error');
                        $("#msg_old_password").html('Incorrect Old Password');
                       if (scroll_element == '') {
                            scroll_element = 'div_old_password';
                        }
                        $("#admin_submit").attr('disabled','disabled');
                    }

                }
            });

        });
        $("#admin_submit").on("click", function () {
            var flag = 0;
            var scroll_element = '';
            var old_password = $("#old_password").val();
            var new_password = $("#new_password").val();
            var user_id = $("#user_id").val();
            var pattern_capital = new RegExp('[A-Z]');
            var pattern_number = new RegExp('[0-9]');

            if (old_password == '') {
                $("#div_old_password").addClass('has-error');
                $("#msg_old_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
            } else if (old_password != '' && old_password.length < 8) {
                $("#div_old_password").addClass('has-error');
                //$("#msg_old_password").html("Password should contain minimum 8 characters");
                $("#msg_old_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_old_password';
                }
            } else if (old_password != '' && !old_password.match(pattern_capital)) {
                $("#div_old_password").addClass('has-error');
                //$("#msg_old_password").html("Password should contain at least 1 capital letter");
                $("#msg_old_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_old_password';
                }
            } else if (old_password != '' && !old_password.match(pattern_number)) {
                $("#div_old_password").addClass('has-error');
                //$("#msg_old_password").html("Password should contain at least 1 numeric");
                $("#msg_old_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_old_password';
                }
            } else {

                $("#div_password").removeClass('has-error');
                $("#msg_old_password").html("");
            }

            if (new_password == '') {
                $("#div_new_password").addClass('has-error');
                $("#msg_new_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
            } else if (new_password != '' && new_password.length < 8) {
                $("#div_new_password").addClass('has-error');
                //$("#msg_new_password").html("Password should contain minimum 8 characters");
                $("#msg_new_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_new_password';
                }
            } else if (new_password != '' && !new_password.match(pattern_capital)) {
                $("#div_new_password").addClass('has-error');
                //$("#msg_new_password").html("Password should contain at least 1 capital letter");
                $("#msg_new_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_new_password';
                }
            } else if (new_password != '' && !new_password.match(pattern_number)) {
                $("#div_new_password").addClass('has-error');
                //$("#msg_new_password").html("Password should contain at least 1 numeric");
                $("#msg_new_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_new_password';
                }
            } else {
                $("#div_new_password").removeClass('has-error');
                $("#msg_new_password").html("");
            }


            if (flag == 0) {

                $.ajax({
                    url: '<?php echo route("change_password");?>',
                    method: 'POST',
                    data: {
                        'old_password': old_password,
                        'new_password': new_password,
                        'user_id': user_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            toastr.success($obj['MESSAGE']);
                            window.location = '<?php echo route('dashboard');?>';

                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                    }
                });
            } else if (scroll_element != '') {
                BSP.scroll_upto_div(scroll_element);
            }
        });

    </script>
</body>
</html>