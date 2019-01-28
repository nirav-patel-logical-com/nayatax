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
                        <a href="<?php echo route('module_list');?>">{{ trans('label_word.module_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.module_add') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> {{ trans('label_word.module_add') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gear font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.module_add') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form class="form" id="module_add" method="post"
                                  action="<?php echo route('module_create_post');?>" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="mod_title_exist" id="mod_title_exist">

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="text-bold">{{ trans('label_word.module_group') }} *</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="form-group" id="div_mod_group"
                                             data-original-title="{{ trans('label_word.module_group_placeholder') }}"
                                             title="" data-placement="bottom" data-toggle="tooltip">
                                            <select class="form-control" name="mod_group" id="mod_group">
                                                <option value="General">{{ trans('label_word.general') }}</option>
                                            </select>

                                            <p class="help-block pull-right" id="msg_mod_group"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <label class="text-bold">{{ trans('label_word.module_name') }}&nbsp;*</label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="form-group"
                                             data-original-title="{{ trans('label_word.module_placeholder') }}" title=""
                                             data-placement="bottom" data-toggle="tooltip">
                                            <div class="input-group col-md-12">
                                                <div class="input-group-content" id="div_mod_title">
                                                    <input type="text" class="form-control" name="mod_title"
                                                           id="mod_title">
                                                    <input type="hidden" class="form-control" name="mod_title_exist"
                                                           id="mod_title_exist">

                                                    <p class="help-block pull-right" id="msg_mod_title"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right" id="page_id">
                                    <button type="button" class="btn green"
                                            id="module_add_save">{{ trans('label_word.submit') }}</button>
                                    <button type="button" id="module_add_cancel"
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



<script type="text/javascript">

    $("#module_add_cancel").click(function () {
        BSP.redirect_to('{{ route('module_list') }}');
    });


    $("#mod_title").keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            // return e.keyCode = 9;
            return false;
        }
    });
    $("#page_id").keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $("#module_add_save").click();

        }
    });
    $("#mod_title").focusout(function () {
        $mod_title = $("#mod_title").val();
        $id = '';

        if ($mod_title) {
            $("#fa_mod_title").attr('style', 'display:none');
            $("#loader_mod_title").attr('style', 'display:block');

            $.ajax({
                method: 'POST',
                data: {'mod_title': $mod_title, '_token': '{{csrf_token()}}'},
                url: '{{route('is_unique_module')}}',
                success: function (data) {
                    if (data == 0) {
                        $("#mod_title_exist").val('E');
                        $("#div_mod_title").attr('class', 'input-group-content has-error');
                        $("#msg_mod_title").html("Module is exist");
                        $("#module_add_save").attr('disabled', 'disabled');
                        return false;
                    } else {
                        $("#mod_title_exist").val('');
                        $("#div_mod_title").attr('class', 'input-group-content');
                        $("#msg_mod_title").html("");
                        $("#module_add_save").removeAttr('disabled');
                    }

                    $("#fa_mod_title").attr('style', 'display:block');
                    $("#loader_mod_title").attr('style', 'display:none');
                }
            });
        }
    });


    $("#module_add_save").click(function () {
        var mod_title = $("#mod_title").val();
        var mod_title_exist = $("#mod_title_exist").val();

        var flag = 0;
        $scroll_element = '';

        var onlyAlpfa_regx = BSP.regx('only_alpha_number_space_hifun');

        if (mod_title == '') {
            $("#div_mod_title").attr('class', 'input-group-content has-error');
            $("#msg_mod_title").html("Please enter the Module Name");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_mod_title';
            }
        } else if (!onlyAlpfa_regx.test(mod_title)) {
            $("#div_mod_title").attr('class', 'input-group-content form-group has-error');
            $("#msg_mod_title").html("Invalid Module");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_rl_title';
            }
        } else if (mod_title_exist == 'E') {
            $("#div_mod_title").attr('class', 'input-group-content has-error');
            $("#msg_mod_title").html("Module is exist");
            flag++;
            if ($scroll_element == '') {
                $scroll_element = 'div_mod_title';
            }
        } else {
            var module = $.ajax({
                method: 'POST',
                async: false,
                data: {'mod_title': $mod_title, '_token': '{{csrf_token()}}'},
                url: '{{route('is_unique_module')}}',
                success: function (data) {
                    if (data == 0) {
                        flag++;
                    } else {
                        $("#mod_title_exist").val('');
                        $("#div_mod_title").attr('class', 'input-group-content');
                        $("#msg_mod_title").html("");
                        $("#module_add_save").removeAttr('disabled');
                    }

                    $("#fa_mod_title").attr('style', 'display:block');
                    $("#loader_mod_title").attr('style', 'display:none');
                }
            });
        }
        if (module != '') {
            module.done(function (msg) {
                if (msg == 0) {
                    $("#div_mod_title").attr('class', 'input-group-content has-error');
                    $("#msg_mod_title").html("Module is exist");
                    $("#module_add_save").attr('disabled', 'disabled');
                } else {
                    $("#admin_submit").removeAttr('disabled');
                }
            });
        }
        if (flag != 0) {
            return false;
        }


        if (flag == 0) {
            $(this).attr('disabled', 'disabled');
            $("#module_add").submit();
        } else if ($scroll_element != '') {
            BSP.scroll_upto_div($scroll_element);
        }
    });
</script>
