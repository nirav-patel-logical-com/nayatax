@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
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
                        <span>{{ trans('label_word.site_setting_sidebar') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.site_setting_sidebar') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.site_setting_sidebar') }}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>-->

                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!--gst detail start -nikita -->
                            <div class="card">
                                <div class="card-head card-head-sm style-gold">

                                    <div class="tools">

                                    </div>
                                </div>


                                <div class="card-body">
                                    <?php
                                    if (isset($select_site_settings) && !empty($select_site_settings)) {
                                        $setting_id = $select_site_settings[0]->setting_id;
                                        $setting_SGST = $select_site_settings[0]->setting_SGST;
                                        $setting_CGST = $select_site_settings[0]->setting_CGST;
                                        $setting_IGST = $select_site_settings[0]->setting_IGST;
                                        $market_fees = $select_site_settings[0]->market_fees;
                                        $gstin_no = $select_site_settings[0]->gstin_no;
                                        $hsn_no = $select_site_settings[0]->hsn_no;
                                        $pan_no = $select_site_settings[0]->pan_no;
                                        $aadhar_no = $select_site_settings[0]->aadhar_no;
                                        $biz_comission = $select_site_settings[0]->biz_comission;
                                        $setting_price = $select_site_settings[0]->setting_kg_price;
                                        $settings_wages = $select_site_settings[0]->settings_wages;
                                    } else {
                                        $setting_id = '';
                                        $setting_SGST = '';
                                        $setting_CGST = '';
                                        $setting_IGST = '';
                                        $gstin_no = '';
                                        $hsn_no = '';
                                        $pan_no = '';
                                        $market_fees='';
                                        $aadhar_no = '';
                                        $biz_comission = '';
                                        $setting_price = '';
                                        $settings_wages='';
                                    }

                                    ?>
                                    <form class="form" name="gst_detail_add_form" id="gst_detail_add_form" method="post"
                                          action="<?php echo route('setting_gst_post');?>"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                                        <input type="hidden" name="setting_id" id="setting_id" value="{{$setting_id}}">


                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                             <!--   <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold">{{ trans('label_word.cgst') }}&nbsp;*&nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group" data-original-title="Please enter CGST"
                                                             title="" data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content" id="div_setting_cgst">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_cgst" id="setting_cgst"
                                                                           value="{{$setting_CGST}}"
                                                                           onkeyup="BSP.only('digit','setting_cgst')">

                                                                    <p class="help-block" id="msg_setting_cgst"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold">{{ trans('label_word.igst') }}&nbsp;*&nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group" data-original-title="Please enter IGST"
                                                             title="" data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content" id="div_setting_igst">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_igst" id="setting_igst"
                                                                           value="{{$setting_IGST}}"
                                                                           onkeyup="BSP.only('digit','setting_igst')">

                                                                    <p class="help-block" id="msg_setting_igst"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold">{{ trans('label_word.hsn_no') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group"
                                                             data-original-title="Please enter HSN No. / SAC Code"
                                                             title="" data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content"
                                                                     id="div_setting_hsn_sac">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_hsn_sac" id="setting_hsn_sac"
                                                                           value="{{$hsn_no}}">

                                                                    <p class="help-block" id="msg_setting_hsn_sac"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold"  style="margin-top: 12px;">{{ trans('label_word.wages') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group"
                                                             data-original-title="Please enter wages" title=""
                                                             data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content"
                                                                     id="div_setting_wages">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_wages" id="setting_wages"
                                                                           value="{{$settings_wages}}">

                                                                    <p class="help-block" id="msg_setting_wages"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                                        <label class="text-bold" style="margin-top: 12px;">{{ trans('label_word.select_weight_type') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="margin-top:12px !important;">
                                                        <?php $ichecked = '';$achecked = '';
                                                        if ($setting_price === '1Kg') {
                                                            $achecked = "checked";
                                                        } elseif ($setting_price === '20Kg') {
                                                            $ichecked = "checked";
                                                        }?>
                                                        <div class="radio-list">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="setting_kg_price" id="1kg"
                                                                       value="1Kg" value="Active" {{$achecked}}>
                                                                1{{ trans('label_word.kg') }}
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="setting_kg_price" id="20kg"
                                                                       value="20Kg" {{$ichecked}}>
                                                                20{{ trans('label_word.kg') }} </label>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold"  style="margin-top:12px !important;">{{ trans('label_word.market_fee') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group"
                                                             data-original-title="Please enter market fees for buyer" title=""
                                                             data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content"
                                                                     id="div_market_fees">
                                                                    <input type="text" class="form-control"
                                                                           name="market_fees" id="market_fees"
                                                                           value="{{$market_fees}}">

                                                                    <p class="help-block" id="msg_market_fees"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             <!--   <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold">{{ trans('label_word.sgst') }}&nbsp;*&nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group" data-original-title="Please enter SGST"
                                                             title="" data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content" id="div_setting_sgst">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_sgst" id="setting_sgst"
                                                                           value="{{$setting_SGST}}"
                                                                           onkeyup="BSP.only('digit','setting_sgst')">

                                                                    <p class="help-block" id="msg_setting_sgst"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold">{{ trans('label_word.gst_tin') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group"
                                                             data-original-title="Please enter GSTIN NO" title=""
                                                             data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content" id="div_setting_gstin">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_gstin" id="setting_gstin"
                                                                           value="{{$gstin_no}}">

                                                                    <p class="help-block" id="msg_setting_gstin"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold">{{ trans('label_word.pan_no') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group" data-original-title="Pan No" title=""
                                                             data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content" id="div_setting_pan">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_pan" id="setting_pan"
                                                                           value="{{$pan_no}}">

                                                                    <p class="help-block" id="msg_setting_pan"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                -->

                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <label class="text-bold"  style="margin-top:12px !important;">{{ trans('label_word.commission_per') }}
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-group"
                                                             data-original-title="Please enter Commission" title=""
                                                             data-placement="bottom" data-toggle="tooltip">
                                                            <div class="input-group ">
                                                                <div class="input-group-content"
                                                                     id="div_setting_commission">
                                                                    <input type="text" class="form-control"
                                                                           name="setting_commission"
                                                                           id="setting_commission"
                                                                           value="{{$biz_comission}}">

                                                                    <p class="help-block"
                                                                       id="msg_setting_commission"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-actionbar">
                                    <?php if(isset($role_permission_arr['site-settings']) && $role_permission_arr['site-settings'] != 'None' && $role_permission_arr['site-settings'] != 'Read'){ ?>
                                    <div class="card-actionbar-row">
                                        <button type="button" id="gst_detail_add_cancel"
                                                class="btn default text-uppercase">
                                            {{ trans('label_word.cancel') }}
                                        </button>
                                        <button type="button" id="gst_detail_add_save"
                                                class="btn green text-uppercase pull-right">{{ trans('label_word.submit') }}
                                        </button>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <!--gst detail end -nikita -->
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


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->
<script type="text/javascript">

    $("#gst_detail_add_save").click(function () {
        $setting_sgst = $("#setting_sgst").val();
        $setting_cgst = $("#setting_cgst").val();
        $setting_igst = $("#setting_igst").val();
        $setting_gstin = $("#setting_gstin").val();
        $setting_hsn_sac = $("#setting_hsn_sac").val();
        $setting_commission = $("#setting_commission").val();
        $setting_aadhar = $("#setting_aadhar").val();
        $setting_pan = $("#setting_pan").val();
        $market_fees = $("#market_fees").val();
        $flag = 0;
        $scroll_element = '';
        $gst_no_regx = BSP.regx('gst_no');

        $only_digit_regx = BSP.regx('only_digit');

//        if ($setting_sgst == '') {
//            $("#div_setting_sgst").addClass('has-error');
//            $("#msg_setting_sgst").html("Please enter the rate of SGST. It's a required Field.");
//            $flag++;
//        } else if (!$only_digit_regx.test($setting_sgst)) {
//            $("#div_setting_sgst").addClass('has-error');
//            $("#msg_setting_sgst").html("Please enter valid SGST.");
//            $flag++;
//        } else {
//            $("#div_setting_sgst").removeClass('has-error');
//            $("#msg_setting_sgst").html("");
//        }
//
//        if ($setting_cgst == '') {
//            $("#div_setting_cgst").addClass('has-error');
//            $("#msg_setting_cgst").html("Please enter the rate of CGST. It's a required Field.");
//            $flag++;
//        } else if (!$only_digit_regx.test($setting_cgst)) {
//            $("#div_setting_cgst").addClass('has-error');
//            $("#msg_setting_cgst").html("Please enter valid CGST.");
//            $flag++;
//        } else {
//            $("#div_setting_cgst").removeClass('has-error');
//            $("#msg_setting_cgst").html("");
//        }
//
//        if ($setting_igst == '') {
//            $("#div_setting_igst").addClass('has-error');
//            $("#msg_setting_igst").html("Please enter the rate of IGST. It's a required Field.");
//            $flag++;
//        } else if (!$only_digit_regx.test($setting_igst)) {
//            $("#div_setting_igst").addClass('has-error');
//            $("#msg_setting_igst").html("Please enter the valid IGST.");
//            $flag++;
//        } else {
//            $("#div_setting_igst").removeClass('has-error');
//            $("#msg_setting_igst").html("");
//        }


        if ($flag == 0) {
            $(this).attr('disabled', 'disabled');
            $("#gst_detail_add_form").submit();
        } else if ($scroll_element != '') {
            BSP.scroll_upto_div($scroll_element);
        }
    });

    $("#gst_detail_add_cancel").click(function () {
        BSP.redirect_back();
    });

</script>
