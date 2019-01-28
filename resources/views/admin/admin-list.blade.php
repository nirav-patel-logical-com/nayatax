
<!--Start Include header here-->
@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
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
                        <span>{{ trans('label_word.admin_list') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.admin_list') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->

            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-user font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.admin_list') }}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>-->
                                    <?php if(isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None' && $role_permission_arr['admin'] != 'Read'){ ?>
                                    <button id="sample_editable_1_new" class="btn sbold green" href="#create_admin"
                                            data-toggle="modal"> {{ trans('label_word.add_new') }}
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-bordered" id="posts">
                                <thead>
                                <tr>
                                    <th> {{ trans('label_word.id') }} </th>
                                    <th> {{ trans('label_word.name') }} </th>
                                    <th> {{ trans('label_word.email') }} </th>
                                    <th> {{ trans('label_word.mobile_no')}} </th>
                                    <th> {{ trans('label_word.status') }} </th>
                                    <th> {{ trans('label_word.action') }} </th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END CREATE ADMIN-->
            <!--Start Add new admin popup-->
            <div class="modal fade bs-modal-sm" id="create_admin" tabindex="-1" role="create_admin" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{ trans('label_word.create_admin') }}</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" id="frm_admin">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12" id="div_fname">
                                            <div class="form-group">
                                                <div class="input-icon">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="f_name" name="f_name"
                                                           placeholder="{{ trans('label_word.first_name') }}" autofocus>

                                                    <p class="help-block" id="msg_fname"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" id="div_mname">
                                            <div class="form-group">
                                                <div class="input-icon ">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="m_name" name="m_name"
                                                           placeholder="{{ trans('label_word.middle_name') }}">

                                                    <p class="help-block" id="msg_mname"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12" id="div_lname">
                                            <div class="form-group">
                                                <div class="input-icon">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="l_name" name="l_name"
                                                           placeholder="{{ trans('label_word.last_name') }}">

                                                    <p class="help-block" id="msg_lname"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" id="div_nname">
                                            <div class="form-group">
                                                <div class="input-icon ">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="nick_name"
                                                           name="nick_name"
                                                           placeholder="{{ trans('label_word.nick_name') }}">

                                                    <p class="help-block" id="msg_nname"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_email">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon ">
                                                    <i class="fa fa-envelope"></i>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                           placeholder="{{ trans('label_word.email') }}">

                                                    <p class="help-block" id="msg_email"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_mobile">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon ">
                                                    <i class="fa fa-mobile"></i>
                                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                                           placeholder="{{ trans('label_word.mobile_no') }}">

                                                    <p class="help-block" id="msg_mobile"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_password">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon ">
                                                    <i class="fa fa-key"></i>
                                                    <input type="password" class="form-control" id="password"
                                                           name="password"
                                                           placeholder="{{ trans('label_word.password') }}">

                                                    <p class="help-block" id="msg_password"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-md-radios">
                                                <label class="col-md-3 control-label"
                                                       for="form_control_1">{{ trans('label_word.status') }}</label>

                                                <div class="col-md-9">
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="active" value="Active"
                                                                   value="Active"> {{ trans('label_word.active') }}
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="inactive"
                                                                   value="Inactive"
                                                                   checked> {{ trans('label_word.inactive') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="admin_submit"
                                    class="btn green">{{ trans('label_word.save') }}</button>
                            <button type="button" id="admin_cancel" class="btn dark btn-outline"
                                    data-dismiss="modal">{{ trans('label_word.cancel') }}</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--End Add new admin popup-->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->
<script type="text/javascript">
    /*$('#create_admin').keypress(function (e) {
     var key = e.which;
     if(key == 13)  // the enter key code
     {
     $("#admin_submit").click();

     }
     });*/
    $('#create_admin').on("click",'hidden.bs.modal', function (e) {
        $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

    });

    $("input[name=email]").change(function () {

        var email = $("#email").val();
        var email_regx = BSP.regx('email');
        var scroll_element = '';
        var flag = 0;
        if ((email != '') && !email_regx.test(email)) {
            $("#div_email").addClass('has-error');
            $("#msg_email").html("Email is invalid");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_email';
            }
        }
        if (flag == 0 && email != '') {
            $("#admin_submit").removeAttr('disabled');
            $.ajax({

                url: '<?php echo route("check_unique_email");?>',
                method: 'POST',
                data: {
                    'email': email,
                    'user_id': 0,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_email").removeClass('has-error');
                        $("#msg_email").html("");
                        $("#admin_submit").removeAttr('disabled');
                    } else {
                        $("#div_email").addClass('has-error');
                        $("#msg_email").html($obj['MESSAGE']);

                        if (scroll_element == '') {
                            scroll_element = 'div_email';
                        }
                        $("#admin_submit").attr('disabled', 'disabled');
                    }

                }
            });
        }

    });
    $("input[name=mobile]").change(function () {

        var mobile = $("#mobile").val();
        var mobile_no_regx = BSP.regx('mobile');
        var scroll_element = '';
        var flag = 0;
        if (mobile == '') {
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Please enter your Mobile Number. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mobile';
            }
        } else if ((mobile != '') && !mobile_no_regx.test(mobile)) {
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Mobile is invalid");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mobile';
            }
        }
        if (flag == 0) {
            $("#admin_submit").removeAttr('disabled');
            $.ajax({

                url: '<?php echo route("check_unique_mobile");?>',
                method: 'POST',
                data: {
                    'mobile': mobile,
                    'user_id': 0,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_mobile").removeClass('has-error');
                        $("#msg_mobile").html("");
                        $("#admin_submit").removeAttr('disabled');
                    } else {
                        $("#div_mobile").addClass('has-error');
                        $("#msg_mobile").html($obj['MESSAGE']);
                        if (scroll_element == '') {
                            scroll_element = 'div_mobile';
                        }
                        $("#admin_submit").attr('disabled', 'disabled');
                    }

                }
            });
        }

    });
    $('#create_admin').on('hidden.bs.modal', function (e) {
        $("#f_name").val('');
        $("#m_name").val('');
        $("#l_name").val('');
        $("#nick_name").val('');
        $("#email").val('');
        $("#password").val('');
        $("#mobile").val('');
        $("#div_fname").removeClass('has-error');
        $("#msg_fname").html("");
        $("#div_mname").removeClass('has-error');
        $("#msg_mname").html("");
        $("#div_lname").removeClass('has-error');
        $("#msg_lname").html("");
        $("#div_email").removeClass('has-error');
        $("#msg_email").html("");
        $("#div_password").removeClass('has-error');
        $("#msg_password").html("");
        $("#div_mobile").removeClass('has-error');
        $("#msg_mobile").html("");
        $("#admin_submit").removeAttr('disabled');
    });
    $("#admin_cancel").on("click", function (e) {

        $("#f_name").val('');
        $("#m_name").val('');
        $("#l_name").val('');
        $("#nick_name").val('');
        $("#email").val('');
        $("#password").val('');
        $("#mobile").val('');
        $("#div_fname").removeClass('has-error');
        $("#msg_fname").html("");
        $("#div_mname").removeClass('has-error');
        $("#msg_mname").html("");
        $("#div_lname").removeClass('has-error');
        $("#msg_lname").html("");
        $("#div_email").removeClass('has-error');
        $("#msg_email").html("");
        $("#div_password").removeClass('has-error');
        $("#msg_password").html("");
        $("#div_mobile").removeClass('has-error');
        $("#msg_mobile").html("");
        $("#admin_submit").removeAttr('disabled');
    });
    $("#frm_admin").submit(function () {
        $(".admin_submit").click();
    });


    $("#admin_submit").on("click", function (e) {

        var f_name = $("#f_name").val();
        var m_name = $("#m_name").val();
        var l_name = $("#l_name").val();
        var nick_name = $("#nick_name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var status = $("input[name=status]:checked").val();
        var mobile = $("#mobile").val();

        var flag = 0;
        var scroll_element = '';
        var onlyAlpfaSpace_regx = BSP.regx('only_alpha_space');
        var onlyAlpfa_regx = BSP.regx('only_alpha');
        var mobile_no_regx = BSP.regx('mobile');
        var email_regx = BSP.regx('email');
        var pattern_capital = new RegExp('[A-Z]');
        var pattern_number = new RegExp('[0-9]');
        var regexp = new RegExp('[0-9 ]+');

        if (f_name == '') {
            $("#div_fname").addClass('has-error');
            $("#msg_fname").html("Please enter your First Name. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_fname';
            }
        } else if ((f_name != '') && f_name.match(regexp)) {
            $("#div_fname").addClass('has-error');
            $("#msg_fname").html("Numeric Number and Space not allowed.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_fname';
            }
        } else {
            $("#div_fname").removeClass('has-error');
            $("#msg_fname").html("");
        }

        if (m_name == '') {
            $("#div_mname").addClass('has-error');
            $("#msg_mname").html("Please enter your Middle Name. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mname';
            }
        } else if ((m_name != '') && m_name.match(regexp)) {
            $("#div_mname").addClass('has-error');
            $("#msg_mname").html("Numeric Number and Space not allowed.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mname';
            }
        } else {
            $("#div_mname").removeClass('has-error');
            $("#msg_mname").html("");
        }

        if ((nick_name != '') && nick_name.match(regexp)) {
            $("#div_nname").addClass('has-error');
            $("#msg_nname").html("Numeric Number and Space not allowed.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_nname';
            }
        } else {
            $("#div_nname").removeClass('has-error');
            $("#msg_nname").html("");
        }
        if (l_name == '') {
            $("#div_lname").addClass('has-error');
            $("#msg_lname").html("Please enter your Last Name. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_lname';
            }
        } else if ((l_name != '') && l_name.match(regexp)) {
            $("#div_lname").addClass('has-error');
            $("#msg_lname").html("Numeric Number and Space not allowed.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_lname';
            }
        } else {
            $("#div_lname").removeClass('has-error');
            $("#msg_lname").html("");
        }

        if ((email != '') && !email_regx.test(email)) {
            $("#div_email").addClass('has-error');
            $("#msg_email").html("Email is invalid");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_email';
            }
        } else {
            if (email != '') {
                var test = $.ajax({
                    url: '<?php echo route("check_unique_email");?>',
                    method: 'POST',
                    async: false,
                    data: {
                        'email': email,
                        'user_id': 0,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            $("#div_email").removeClass('has-error');
                            $("#msg_email").html("");
                            $("#admin_submit").removeAttr('disabled');
                        } else {
                            flag++;
                        }
                    }
                });
            }
        }
        if (email != '') {
            test.done(function (msg) {
                $obj = JSON.parse(msg);
                if ($obj['SUCCESS'] == 'FALSE') {
                    $("#div_email").addClass('has-error');
                    $("#msg_email").html("Email is existed");
                    if (scroll_element == '') {
                        scroll_element = 'div_email';
                    }
                    $('#admin_submit').attr('disabled', 'disabled');


                } else {
                    $("#admin_submit").removeAttr('disabled');
                }
            });
        }


        if (mobile == '') {
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Please enter your Mobile Number. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mobile';
            }
        } else if ((mobile != '') && !mobile_no_regx.test(mobile)) {
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Mobile is invalid");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mobile';
            }
        } else {
            $("#div_mobile").removeClass('has-error');
            $("#msg_mobile").html("");
        }
        if (password == '') {
            $("#div_password").addClass('has-error');
            $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
            flag++;
        } else if (password != '' && password.length < 8) {
            $("#div_password").addClass('has-error');
            //$("#msg_password").html("Password should contain minimum 8 characters");
            $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_password';
            }
        } else if (password != '' && !password.match(pattern_capital)) {
            $("#div_password").addClass('has-error');
            //$("#msg_password").html("Password should contain at least 1 capital letter");
            $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_password';
            }
        } else if (password != '' && !password.match(pattern_number)) {
            $("#div_password").addClass('has-error');
            //$("#msg_password").html("Password should contain at least 1 numeric");
            $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_password';
            }
        } else {
            var mobile_test = $.ajax({
                url: '<?php echo route("check_unique_mobile");?>',
                method: 'POST',
                async: false,
                data: {
                    'mobile': mobile,
                    'user_id': 0,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_mobile").removeClass('has-error');
                        $("#msg_mobile").html("");
                        $("#admin_submit").removeAttr('disabled');
                    } else {
                        flag++;
                    }

                }
            });
        }

        mobile_test.done(function (msg) {
            $obj = JSON.parse(msg);
            if ($obj['SUCCESS'] == 'FALSE') {
                $("#div_mobile").addClass('has-error');
                $("#msg_mobile").html("Mobile is existed");
                if (scroll_element == '') {
                    scroll_element = 'div_mobile';
                }
                $('#admin_submit').attr('disabled', 'disabled');
            } else {
                $("#admin_submit").removeAttr('disabled');
            }
        });
        if (flag != 0) {
            return false;
        }
        if (flag == 0) {
            $('#admin_submit').attr('disabled', 'disabled');
            $.ajax({
                url: '<?php echo route('admin_details_save'); ?>',
                method: 'POST',
                data: {
                    'f_name': f_name,
                    'm_name': m_name,
                    'l_name': l_name,
                    'nick_name': nick_name,
                    'email': email,
                    'password': password,
                    'mobile': mobile,
                    'role_id': '1',
                    'role_name': 'Admin',
                    'status': status,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    //console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        window.location = 'admin';

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
<script type="text/javascript">
    function status_change(id, status) {
        $.ajax({
            url: 'api/change_user_status',
            method: 'POST',
            data: {
                'id': id,
                'status': status,
                'module': 'user',
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                //console.log($obj);
                if ($obj['SUCCESS'] == 'TRUE') {
                    toastr.success($obj['MESSAGE']);
                    setTimeout(function () {
                        BSP.redirect_to(window.location.href);
                    }, 1000);
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
</script>
<!--to get data for datatabels-->
<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo route('admin_list_post'); ?>",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "email"},
                {"data": "mobile"},
                {"data": "status"},
                {"data": "action"}
            ]

        });
    });
</script>
