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
    <div class="page-content-wrapper" id="role_id">
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
                        <a href="<?php echo route('role_list');?>">{{ trans('label_word.role_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.role_add') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> {{ trans('label_word.role_add') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-shield font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.role_add') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form" id="role_add" method="post"
                                  action="<?php echo route('role_create_post');?>" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="rl_title_exist" id="rl_title_exist">

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="text-bold">{{ trans('label_word.role_sidebar') }}&nbsp;*</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="form-group"
                                             data-original-title="{{ trans('label_word.role_placeholder') }}" title=""
                                             data-placement="bottom" data-toggle="tooltip">
                                            <div class="input-group col-md-9">
                                                <div class="input-group-content" id="div_rl_title">
                                                    <input type="text" class="form-control" name="rl_title"
                                                           id="rl_title" autofocus>
                                                    <input type="hidden" class="form-control" name="rl_title_exist"
                                                           id="rl_title_exist">

                                                    <p class="help-block pull-right" id="msg_rl_title"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right" id="page_id">
                                    <button type="button" class="btn green"
                                            id="role_add_save">{{ trans('label_word.submit') }}</button>
                                    <button type="button" id="role_add_cancel"
                                            class="btn default">{{ trans('label_word.cancel') }}</button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END CREATE ADMIN-->
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


    $("#role_add").submit(function (e) {
        var rl_title = $("#rl_title").val();


        var flag = 0;
        $scroll_element = '';

        var onlyAlpfa_regx = BSP.regx('only_alpha_space');
        if (rl_title == '') {
            $("#div_rl_title").attr('class', 'input-group-content has-error');
            $("#msg_rl_title").html("Please enter the role");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_rl_title';
            }
            return false;
        } else if (!onlyAlpfa_regx.test(rl_title)) {
            $("#div_rl_title").attr('class', 'input-group-content form-group has-error');
            $("#msg_rl_title").html("Invalid Role");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_rl_title';
            }
            return false;
        }

        if (flag == 0) {

            $("#role_add_save").attr('disabled', 'disabled');
            $("#fa_rl_title").attr('style', 'display:none');
            $("#loader_rl_title").attr('style', 'display:block');
            $.ajax({
                method: 'POST',
                data: {'r_type': rl_title, '_token': '{{csrf_token()}}'},
                url: '<?php echo route('is_unique_role');?>',
                success: function (data) {
                    if (data == 0) {
                        $("#rl_title_exist").val('E');
                        $("#div_rl_title").attr('class', 'input-group-content has-error');
                        $("#msg_rl_title").html("Role is exist");
                        return false;
                    } else {
                        $("#rl_title_exist").val('');
                        $("#div_rl_title").attr('class', 'input-group-content');
                        $("#msg_rl_title").html("");
                    }
                    $("#role_add_save").removeAttr('disabled');
                    $("#fa_rl_title").attr('style', 'display:block');
                    $("#loader_rl_title").attr('style', 'display:none');
                }
            });
        } else if ($scroll_element != '') {
            BSP.scroll_upto_div($scroll_element);
        } else {
            return false;
        }
    });
    $("#rl_title").focusout(function (e) {
        $rl_title = $("#rl_title").val();
        $id = '';
        if ($rl_title) {
            $("#fa_rl_title").attr('style', 'display:none');
            $("#loader_rl_title").attr('style', 'display:block');

            $.ajax({
                method: 'POST',
                data: {'r_type': $rl_title, '_token': '{{csrf_token()}}'},
                url: '<?php echo route('is_unique_role');?>',
                success: function (data) {
                    if (data == 0) {
                        $("#rl_title_exist").val('E');
                        $("#div_rl_title").attr('class', 'input-group-content has-error');
                        $("#msg_rl_title").html("Role is exist");
                        $("#role_add_save").attr('disabled', 'disabled');
                        return false;
                    } else {
                        $("#rl_title_exist").val('');
                        $("#div_rl_title").attr('class', 'input-group-content');
                        $("#msg_rl_title").html("");
                        $("#role_add_save").removeAttr('disabled');
                        $("#fa_rl_title").attr('style', 'display:block');
                        $("#loader_rl_title").attr('style', 'display:none');

                    }

                }
            });
            return e.keyCode = 9;
        }
    });
    $("#rl_title").keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            //$("#role_add_save").trigger('click');
            return false;
        }
    });
    $("#role_id").keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $("#role_add_save").trigger('click');
            // $("#role_add_save").click();

        }
    });
    $("#role_add_save").click(function () {
        var rl_title = $("#rl_title").val();
        var rl_title_exist = $("#rl_title_exist").val();

        var flag = 0;
        $scroll_element = '';

        var onlyAlpfa_regx = BSP.regx('only_alpha_space');

        if (rl_title == '') {
            $("#div_rl_title").attr('class', 'input-group-content has-error');
            $("#msg_rl_title").html("Please enter the role");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_rl_title';
            }
        } else if (!onlyAlpfa_regx.test(rl_title)) {
            $("#div_rl_title").attr('class', 'input-group-content form-group has-error');
            $("#msg_rl_title").html("Invalid Role");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_rl_title';
            }
        } else if (rl_title_exist == 'E') {
            $("#div_rl_title").attr('class', 'input-group-content has-error');
            $("#msg_rl_title").html("Role is exist");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_email';
            }
            return false;
        } else {
            var role = $.ajax({
                method: 'POST',
                async: false,
                data: {'r_type': $rl_title, '_token': '{{csrf_token()}}'},
                url: '<?php echo route('is_unique_role');?>',
                success: function (data) {
                    if (data == 0) {
                        flag++;
                    } else {
                        $("#rl_title_exist").val('');
                        $("#div_rl_title").attr('class', 'input-group-content');
                        $("#msg_rl_title").html("Invalid Role");
                        $("#role_add_save").removeAttr('disabled');
                        $("#fa_rl_title").attr('style', 'display:block');
                        $("#loader_rl_title").attr('style', 'display:none');
                        return false;
                    }

                }
            });
        }
        if (role != '') {
            role.done(function (msg) {
                if (msg == 0) {
                    ("#div_rl_title").attr('class', 'input-group-content has-error');
                    $("#msg_rl_title").html("Invalid Role");
                    $("#role_add_save").attr('disabled', 'disabled');
                } else {
                    $("#admin_submit").removeAttr('disabled');
                    $("#msg_rl_title").html("Invalid Role");
                }
            });
        }
        if (flag != 0) {
            return false;
        }

        if (flag == 0) {
            $(this).attr('disabled', 'disabled');
            $("#role_add").submit();
        } else if ($scroll_element != '') {
            BSP.scroll_upto_div($scroll_element);
        }
    });

    $("#role_add_cancel").click(function () {
        BSP.redirect_to('{{ route('role_list') }}');
    });
</script>
