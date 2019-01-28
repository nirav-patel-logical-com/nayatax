<!--Start Include header here-->
@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container" id="page_id">
    @include('layouts.sidebar')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index-2.html">{{ trans('label_word.home') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="<?php echo route('goods');?>">{{ trans('label_word.goods_type_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span><?php if($data['page_title'] === 'Add Goods Type'){ ?>{{ trans('label_word.goods_type_add') }}<?php } else { ?>{{ trans('label_word.goods_type_edit') }} <?php } ?></span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"><?php if($data['page_title'] === 'Add Goods Type'){ ?>{{ trans('label_word.goods_type_add') }}<?php } else { ?>{{ trans('label_word.goods_type_edit') }} <?php } ?></h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN Add Goods Type-->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cubes font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase"><?php if($data['page_title'] === 'Add Goods Type'){ ?>{{ trans('label_word.goods_type_add') }}<?php } else { ?>{{ trans('label_word.goods_type_edit') }} <?php } ?></span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <input type="hidden" name="gt_id"
                                       value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                           echo $data['goods_details'][0]->gt_id;
                                       } ?>" id="gt_id">

                                <div class="form-body">
                                    <div class="form-group" id="div_company">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <select id="company" class="form-control select2" autofocus>
                                                        <option>{{ trans('label_word.company_select') }}</option>
                                                        @foreach($data['company_list'] as $item)
                                                            <option value="{{$item->id}}"
                                                            <?php if (isset($data['goods_details']) && !empty($data['goods_details']) && $item->id === $data['goods_details'][0]->gt_biz_id) {
                                                                echo 'selected';
                                                            }?>
                                                                    >{{$item->biz_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <p class="help-block" id="msg_company"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_gt_type">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-cube"></i>
                                                    <input type="text" name="gt_type" id="gt_type"
                                                           value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                                               echo $data['goods_details'][0]->gt_type;
                                                           } ?>" class="form-control"
                                                           placeholder="{{ trans('label_word.good_type_sidebar') }}">

                                                    <p class="help-block" id="msg_gt_type"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_gt_hsn">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-briefcase"></i>
                                                    <input type="text" name="gt_hsn_no" id="gt_hsn_no" onkeyup="BSP.only('digit','gt_hsn_no')"
                                                           value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                                               echo $data['goods_details'][0]->gt_hsn_no;
                                                           } ?>" class="form-control"
                                                           placeholder="{{ trans('label_word.hsn_no') }}">

                                                    <p class="help-block" id="msg_gt_hsn"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="status_of_tax"
                                           value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_is_tax_apply)) {
                                               echo $data['goods_details'][0]->gt_is_tax_apply;
                                           } ?>">


                                    @if((Route::is('add_goods_type')))
                                        <div class="row">
                                            <div class="margin-top-12">
                                                <div class="col-md-4">
                                                    <label>{{ trans('label_word.gst_item_include') }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="radio-list">
                                                        <div class="col-md-6">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tex" id="yes" value="True"
                                                                <?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_is_tax_apply) && $data['goods_details'][0]->gt_is_tax_apply === 'True') {
                                                                    echo "Checked";
                                                                } ?>> {{ trans('label_word.yes') }} </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tex" id="no" value="False"
                                                                <?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_is_tax_apply)) {
                                                                    if ($data['goods_details'][0]->gt_is_tax_apply == 'False') {
                                                                        echo "Checked";
                                                                    }
                                                                } else {
                                                                    echo "Checked";
                                                                } ?>
                                                                        > {{ trans('label_word.no') }} </label>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                     <div class="row hidden" id="div_cgst">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.c_tax') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="cgst_tax"
                                                       onkeyup="BSP.only('int_flot','cgst_tax')" id="cgst_tax"
                                                       value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                        echo $data['goods_details'][0]->gt_cgst_tax;
                                    } ?>" class="form-control"
                                                       placeholder="{{ trans('label_word.c_tax') }}">

                                                <p class="help-block" id="msg_gt_type"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="div_sgst">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.s_tax') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="sgst_tax"
                                                       onkeyup="BSP.only('int_flot','sgst_tax')" id="sgst_tax"
                                                       value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                        echo $data['goods_details'][0]->gt_sgst_tax;
                                    } ?>" class="form-control"
                                                       placeholder="{{ trans('label_word.s_tax') }}">

                                                <p class="help-block" id="msg_sgst"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="div_igst">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.i_tax') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="igst_tax"
                                                       onkeyup="BSP.only('int_flot','igst_tax')" id="igst_tax"
                                                       value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                        echo $data['goods_details'][0]->gt_igst_tax;
                                    } ?>" class="form-control"
                                                       placeholder="{{ trans('label_word.i_tax') }}">

                                                <p class="help-block" id="msg_igst"></p>
                                            </div>
                                        </div>
                                    </div>
                                        @else
                                        <div class="row">
                                            <div class="margin-top-12">
                                                <div class="col-md-4">
                                                    <label>{{ trans('label_word.gst_item_include') }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="radio-list">
                                                        <div class="col-md-6">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tex" id="yes" value="True" disabled
                                                                <?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_is_tax_apply) && $data['goods_details'][0]->gt_is_tax_apply === 'True') {
                                                                    echo "Checked";
                                                                } ?>> {{ trans('label_word.yes') }} </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="tex" id="no" value="False" disabled
                                                                <?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_is_tax_apply)) {
                                                                    if ($data['goods_details'][0]->gt_is_tax_apply == 'False') {
                                                                        echo "Checked";
                                                                    }
                                                                } else {
                                                                    echo "Checked";
                                                                } ?>
                                                                        > {{ trans('label_word.no') }} </label>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row hidden" id="div_cgst">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-4">
                                                    <label>{{ trans('label_word.c_tax') }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="cgst_tax"
                                                           onkeyup="BSP.only('int_flot','cgst_tax')" id="cgst_tax"
                                                           value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                                               echo $data['goods_details'][0]->gt_cgst_tax;
                                                           } ?>" class="form-control"
                                                           placeholder="{{ trans('label_word.c_tax') }}" disabled>

                                                    <p class="help-block" id="msg_gt_type"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row hidden" id="div_sgst">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-4">
                                                    <label>{{ trans('label_word.s_tax') }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="sgst_tax"
                                                           onkeyup="BSP.only('int_flot','sgst_tax')" id="sgst_tax"
                                                           value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                                               echo $data['goods_details'][0]->gt_sgst_tax;
                                                           } ?>" class="form-control"
                                                           placeholder="{{ trans('label_word.s_tax') }}" disabled>

                                                    <p class="help-block" id="msg_sgst"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row hidden" id="div_igst">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-4">
                                                    <label>{{ trans('label_word.i_tax') }}</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="igst_tax"
                                                           onkeyup="BSP.only('int_flot','igst_tax')" id="igst_tax"
                                                           value="<?php if (isset($data['goods_details']) && !empty($data['goods_details'])) {
                                                               echo $data['goods_details'][0]->gt_igst_tax;
                                                           } ?>" class="form-control"
                                                           placeholder="{{ trans('label_word.i_tax') }}" disabled>

                                                    <p class="help-block" id="msg_igst"></p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                    <div class="row">
                                        <div class="margin-top-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.status') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="radio-list">
                                                    <div class="col-md-6">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="active" value="Active"
                                                            <?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_status) && $data['goods_details'][0]->gt_status === 'Active') {
                                                                echo "Checked";
                                                            } ?>> {{ trans('label_word.active') }} </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="inactive"
                                                                   value="Inactive"
                                                            <?php if (isset($data['goods_details']) && !empty($data['goods_details'][0]->gt_status)) {
                                                                if ($data['goods_details'][0]->gt_status === 'Inactive') {
                                                                    echo "Checked";
                                                                }
                                                            } else {
                                                                echo "Checked";
                                                            } ?>> {{ trans('label_word.inactive') }} </label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="btn green"
                                            id="btn_submit">{{ trans('label_word.submit') }}</button>
                                    <a href="<?php echo route('goods'); ?>"
                                       class="btn default">{{ trans('label_word.cancel') }}</a>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END Add Goods Type-->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    </div>
    <!-- END CONTENT -->
    <!-- BEGIN FOOTER -->
    @include('layouts.footer')

    <!-- END FOOTER -->
    <script type="text/javascript">
        $('#page_id').keypress(function (e) {
            var key = e.which;
            if (key == 13)  // the enter key code
            {
                $("#btn_submit").click();

            }
        });
        $("input[name=gt_type]").focusout(function () {

            var gt_type = $("#gt_type").val();
            var scroll_element = '';
            var gt_id = $("#gt_id").val();
            var company = $("#company").find("option:selected").attr("value");
            var flag = 0;
            if (gt_type == '') {
                $("#div_gt_type").addClass('has-error');
                $("#msg_gt_type").html("Please enter your Goods Type. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_gt_type';
                }
            }
            if (flag == 0) {
                $.ajax({
                    url: '<?php echo route('check_unique_goods_type');?>',
                    method: 'POST',
                    data: {
                        'gt_type': gt_type,
                        'gt_id': gt_id,
                        'company': company,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            $("#div_gt_type").removeClass('has-error');
                            $("#msg_gt_type").html("");
                            $("#btn_submit").removeAttr('disabled');
                        } else {
                            $("#div_gt_type").addClass('has-error');
                            $("#msg_gt_type").html($obj['MESSAGE']);

                            if (scroll_element == '') {
                                scroll_element = 'div_gt_type';
                            }
                            $("#btn_submit").attr('disabled', 'disabled');
                        }
                    }
                });
            }
        });
        $("document").ready(function () {
            var status_tax = $("#status_of_tax").val();
            if (status_tax == 'True') {
                $("#div_cgst").removeClass('hidden');
                $("#div_sgst").removeClass('hidden');
                $("#div_igst").removeClass('hidden');
            }
            else if (status_tax == 'False') {
                $("#div_cgst").addClass('hidden');
                $("#div_sgst").addClass('hidden');
                $("#div_igst").addClass('hidden');
            }
            $('input[type=radio][name=tex]').change(function () {
                if (this.value == 'True') {
                    $("#div_cgst").removeClass('hidden');
                    $("#div_sgst").removeClass('hidden');
                    $("#div_igst").removeClass('hidden');
                }
                else if (this.value == 'False') {
                    $("#div_cgst").addClass('hidden');
                    $("#div_sgst").addClass('hidden');
                    $("#div_igst").addClass('hidden');
                }
            });
            $("#btn_submit").on("click", function (e) {

                var gt_type = $("#gt_type").val();
                var gt_hsn_no = $("#gt_hsn_no").val();
                var sgst_tax = $("#sgst_tax").val();
                var cgst_tax = $("#cgst_tax").val();
                var igst_tax = $("#igst_tax").val();
                var gt_id = $("#gt_id").val();
                var status = $("input[name=status]:checked").val();
                var tax = $("input[name=tex]:checked").val();

                var company = $("#company").find("option:selected").attr("value");
                var flag = 0;
                var scroll_element = '';

                var onlyAlpfaSpace_regx = BSP.regx('only_alpha_space');
                var onlyAlpfa_regx = BSP.regx('only_alpha');


                /* if (gt_hsn_no == '') {
                 $("#div_gt_hsn").addClass('has-error');
                 $("#msg_gt_hsn").html("Please fill Goods Type HSN NO. It's a required Field.");
                 flag++;
                 if (scroll_element == '') {
                 scroll_element = 'div_gt_hsn';
                 }
                 }else{
                 $("#div_gt_hsn").removeClass('has-error');
                 $("#msg_gt_hsn").html("");
                 }*/

                if (gt_type == '') {
                    $("#div_gt_type").addClass('has-error');
                    $("#msg_gt_type").html("Please enter your Goods Type. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_gt_type';
                    }
                } else {

                    var goods = $.ajax({
                        url: '<?php echo route('check_unique_goods_type');?>',
                        method: 'POST',
                        async: false,
                        data: {
                            'gt_type': gt_type,
                            'gt_id': gt_id,
                            'company': company,
                            '_token': '<?php echo csrf_token();?>'
                        },
                        success: function (result) {
                            $obj = JSON.parse(result);
                            if ($obj['SUCCESS'] == 'TRUE') {
                                $("#div_gt_type").removeClass('has-error');
                                $("#msg_gt_type").html("");
                            } else {
                                $("#div_gt_type").addClass('has-error');
                                $("#msg_gt_type").html($obj['MESSAGE']);
                                flag++;
                                if (scroll_element == '') {
                                    scroll_element = 'div_gt_type';
                                }
                            }
                        }
                    });
                }
                if (gt_type != '') {
                    goods.done(function (msg) {
                        $obj = JSON.parse(msg);
                        if ($obj['SUCCESS'] == 'FALSE') {
                            $("#div_gt_type").addClass('has-error');
                            $("#msg_gt_type").html($obj['MESSAGE']);
                            if (scroll_element == '') {
                                scroll_element = 'div_gt_type';
                            }
                            $('#btn_submit').attr('disabled', 'disabled');


                        } else {
                            $("#div_gt_type").removeClass('has-error');
                            $("#msg_gt_type").html("");
                            $("#btn_submit").removeAttr('disabled');
                        }
                    });
                }

                if (company == '' || company == undefined) {
                    $("#div_company").addClass('has-error');
                    $("#msg_company").html("Please select your Company Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_company';
                    }
                } else {
                    $("#div_company").removeClass('has-error');
                    $("#msg_company").html("");
                }

                if (flag == 0) {
                    $('#btn_submit').attr('disabled', 'disabled');
                    $.ajax({
                        url: '<?php echo route('goods_details_add');?>',
                        method: 'POST',
                        data: {
                            'gt_type': gt_type,
                            'gt_id': gt_id,
                            'gt_hsn_no': gt_hsn_no,
                            'status': status,
                            'sgst_tax': sgst_tax,
                            'igst_tax': igst_tax,
                            'cgst_tax': cgst_tax,
                            'company': company,
                            'tax': tax,
                            '_token': '<?php echo csrf_token();?>'
                        },
                        success: function (result) {
                            $obj = JSON.parse(result);
                            //console.log($obj);
                            if ($obj['SUCCESS'] == 'TRUE') {
                                toastr.success($obj['MESSAGE']);
                                window.location = '<?php echo route("goods");?>';

                            } else {
                                toastr.error($obj['MESSAGE']);
                            }
                        }
                    });
                } else if (scroll_element != '') {
                    BSP.scroll_upto_div(scroll_element);
                }
            });

        });
    </script>
