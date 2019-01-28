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
                        <span>{{ trans('label_word.set_permission') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.set_permission') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-anchor font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.set_permission') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <label class="label-font label-op">{{ trans('label_word.role_sidebar') }}</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="form-group" id="div_role_id"
                                                 data-original-title="{{ trans('label_word.role_select') }}" title=""
                                                 data-placement="bottom" data-toggle="tooltip">
                                                <select class="form-control" name="role_id" id="role_id">

                                                    <?php foreach($data['role_for_permission'] as $single_role){ ?>
                                                    <option value="<?php echo $single_role->r_id; ?>"><?php echo $single_role->r_type; ?></option>
                                                    <?php }?>
                                                </select>

                                                <p class="help-block pull-right" id="msg_role_id"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="" id="role_module_permission_table">
                                    </div>
                                </div>
                            </div>
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
    $(window).bind("pageshow", function () {
        //$("#role_id").select2();
        $("#role_id").change();
    });

    $("#role_id").change(function () {
        var role_id = $(this).val();
        var card = $("#role_module_permission_card");
        //materialadmin.AppCard.addCardLoader(card);
        $.ajax({
            type: 'post',
            data: {'_token': '<?php echo csrf_token(); ?>', 'role_id': role_id},
            url: '<?php echo route('role_permission_form'); ?>',
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    $("#role_module_permission_table").html($obj['DATA']);
                } else {
                    toastr.error($obj['MESSAGE']);
                }
                // materialadmin.AppCard.removeCardLoader(card);
            }
        });
    });

</script>
