<style>

       .ui-autocomplete {
            background: white;
            border-radius: 0px;
            font-size: 14px;
            font-family: "Open Sans", sans-serif;
        }

        .ui-autocomplete:hover {
            background: white;
        }

    </style>


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
                        <a href="<?php echo route('stock_out_list');?>">{{ trans('label_word.stock_out_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.stock_out_add_title') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.stock_out_add_title') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!--Start farmer stock section-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet">
                        <div class="portlet-title" style="background-color: white; border: 1px solid #eee;">
                            <div class="caption" style="margin-left: 2%;">
                                <i class="fa fa-arrow-down font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.stock_out_add_title') }}</span>
                            </div>

                        </div>
                        <div class="portlet-body margin-right-10">
                            <div class="invoice">
                                <div class="col-md-2 col-xs-2 col-sm-2"
                                     style="background-color: white; margin-right: 6px; border: 1px solid #eee;  width: 20%">
                                    <div class="col-md-12 col-xs-12 col-sm-12">

                                        <div class="form-group margin-top-10" id="div_buyer">
                                            <label for="single-buyer"
                                                   class="control-label text-bold">{{ trans('label_word.buyer_mob') }}</label>

                                            <div class="input-group col-md-12">
                                                <div class="input-group-content" id="div_buyer_test">
                                                    <input type="text" class="form-control" name="buyer_test"
                                                           id="buyer_test"
                                                           placeholder="{{ trans('label_word.enter_buyer_mob') }}">
                                                    <!--<label for="buyer_test" class="control-label"></label>-->
                                                    <p class="help-block" id="msg_buyer"></p>
                                                    <span id="suggesstion-box"></span>
                                                </div>
                                            </div>
                                            <p class="help-block" id="msg_buyer"></p>
                                        </div>
                                        <div class="form-group hidden margin-top-10" id="div_buyer_name">
                                            <label for="single-buyer"
                                                   class="control-label text-bold">{{ trans('label_word.buyer_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="buyer_name" class="control-label"></label>
                                            <input type="hidden" name="buyer_id" id="buyer_id">
                                            <input type="hidden" name="bpi_bi_id" id="bpi_bi_id">
                                            <input type="hidden" name="bpi_invoice_no" id="bpi_invoice_no">


                                        </div>
                                        <div class="form-group hidden" id="div_buyer_company">
                                            <label for="single-comapny"
                                                   class="control-label text-bold">{{ trans('label_word.company_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <input type="hidden" name="company_id" id="company_id">
                                            <input type="hidden" name="company_commission" id="company_commission">
                                            <label id="buyer_company" class="control-label"></label>
                                        </div>
                                        <div class="form-group hidden" id="div_buyer_mobile">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.mobile_no') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="buyer_mobile" class="control-label"></label>
                                        </div>
                                        <div class="form-group hidden" id="div_buyer_city">
                                            <label for="single-city"
                                                   class="control-label text-bold">{{ trans('label_word.city') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="buyer_city" class="control-label"></label>
                                        </div>
                                        <div class="form-group hidden" id="div_buyer_state">
                                            <label for="single-state"
                                                   class="control-label text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                            <br>
                                            <label id="buyer_state" class="control-label"></label>
                                        </div>

                                        <div class="form-group" id="div_farmer">
                                            <label for="single-farmer"
                                                   class="control-label text-bold">{{ trans('label_word.farmer_mob') }}</label>

                                            <div class="input-group select2-bootstrap-prepend">
                                                <select id="single-farmer" class="form-control select2">
                                                    <option>{{ trans('label_word.select_farmer') }}</option>

                                                </select>

                                                <p class="help-block" id="msg_farmer"></p>
                                            </div>
                                        </div>
                                        <div class="form-group hidden" id="div_selected_farmer">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.farmer_name') }}
                                                &nbsp;:</label>
                                            <br>
                                         </div>

                                        <div class="form-group" id="div_goods">
                                            <label for="single-goods_type"
                                                   class="control-label text-bold">{{ trans('label_word.good_type_sidebar') }}</label>

                                            <div class="input-group select2-bootstrap-prepend">
                                                <select id="single-goods_type" class="form-control select2">
                                                    <option>{{ trans('label_word.goods_select') }}</option>
                                                </select>

                                                <p class="help-block" id="msg_goods"></p>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <button type="button" id="cancel" class="btn default text-uppercase">
                                                {{ trans('label_word.cancel') }}
                                            </button>
                                            <button type="button" id="save_compnay"
                                                    class="btn green text-uppercase pull-right margin-bottom-10">{{ trans('label_word.submit') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-15 col-xs-15 col-sm-15" style="width: 107%">
                                            <div class="well" style="background-color: white; border: 1px solid #eee;">
                                                <table class="table table-hover" style="margin: 0;">
                                                    <thead>
                                                    <tr>
                                                        <th width="10px">{{ trans('label_word.id') }}</th>
                                                        <th width="50px">{{ trans('label_word.farmer_name') }}</th>
                                                        <th width="20px">{{ trans('label_word.good_type_sidebar') }}</th>
                                                        <th width="20px"
                                                            class="hidden-xs">{{ trans('label_word.total_qty') }}</th>
                                                        <th width="20px"
                                                            class="hidden-xs">{{ trans('label_word.sold_price') }}&nbsp;/<label
                                                                    for="kg_price" id="kg_price"></label></th>
                                                        <th width="20px"
                                                            class="hidden-xs">{{ trans('label_word.sold_qty') }}</th>
                                                        <th width="30px"
                                                            class="text-right">{{ trans('label_word.price') }}</th>
                                                        <th width="20px" class="text-right hidden"
                                                            id="th_cgst">{{ trans('label_word.cgst') }}</th>
                                                        <th width="20px" class="text-right hidden"
                                                            id="th_sgst">{{ trans('label_word.sgst') }}</th>
                                                        <th width="20px" class="text-right hidden"
                                                            id="th_ighst">{{ trans('label_word.igst') }}</th>
                                                        <th width="50px" class="text-right"
                                                            id="th_total">{{ trans('label_word.total') }}(<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>)
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="row_append">


                                                    </tbody>
                                                    <tbody>
                                                    <tr>
                                                        <td colspan=6" id="td_6_tot" class=""></td>
                                                        <td colspan=8" id="td_8_tot" class="hidden"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold">{{ trans('label_word.total_amount') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="all_total"><i class="fa fa-inr"
                                                                                                 aria-hidden="true"></i>&nbsp;<label
                                                                    for="all_total"></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=6" id="td_6_com" class=""></td>
                                                        <td colspan=8" id="td_8_com" class="hidden"></td>
                                                        <td class="text-right">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.commission') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <label id="commission_per"
                                                                   for="commission_per" class="pull-left"></label>&nbsp;<label
                                                                    class="control-label pull-left">(%)</label>&nbsp;<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;<label id="commission"
                                                                                                        for="commission"></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan=6" id="td_6_fee" class=""></td>
                                                        <td colspan=8" id="td_8_fee" class="hidden"></td>
                                                        <td class="text-right">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.market_fee') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="market">
                                                            <input type="text" name="market_fee"
                                                                   onkeyup="BSP.only('digit','market_fee')"
                                                                   class="pull-left" id="market_fee"
                                                                   style='width: 25%;'>&nbsp;<label
                                                                    class="control-label pull-left">&nbsp;(%)</label>
                                                            <i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;<label
                                                                    id="market_fee_val"
                                                                    for="market_fee_val"></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" id="td_6_grand" class=""></td>
                                                        <td colspan="8" id="td_8_grand" class="hidden"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold" style="vertical-align: middle;">{{ trans('label_word.grand_total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right text-bold" style="font-size: 23px;"><i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;<label id="grandTotal"
                                                                                                        for="grandTotal"></label>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div id="print" class="row">
                                                    <div class="col-md-15">
                                                        <div class="form-body">

                                                            <div class="form-group">
                                                                <label class="col-md-2">{{ trans('label_word.payment_type') }}</label>

                                                                <div class="radio-list col-md-9">
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="cash"
                                                                                       value="Cash"
                                                                                        >
                                                                            </span>
                                                                        {{ trans('label_word.cash') }}
                                                                    </label>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="cheque"
                                                                                       value="Cheque">
                                                                            </span>
                                                                        {{ trans('label_word.cheque') }}
                                                                    </label>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="rtgs" value="RTGS">
                                                                            </span>
                                                                        {{ trans('label_word.rtgs') }}
                                                                    </label>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="neft" value="NEFT">
                                                                            </span>
                                                                        {{ trans('label_word.neft') }}
                                                                    </label>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="dd" value="DD">
                                                                            </span>
                                                                        {{ trans('label_word.dd') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12 hidden" id="bank_details">
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-5 col-xs-5"
                                                                         id="div_bank">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-building-o"></i>
                                                                            <input type="text" class="form-control"
                                                                                   id="bank_name" name="bank_name"
                                                                                   placeholder="{{ trans('label_word.bank_name') }}">

                                                                            <p class="help-block" id="msg_bank"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 col-xs-5"
                                                                         id="div_ifsc">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <input type="text" class="form-control"
                                                                                   id="ifsc_code" name="ifsc_code"
                                                                                   placeholder="{{ trans('label_word.ifsc_code') }}">

                                                                            <p class="help-block" id="msg_ifsc"></p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-5 col-xs-5 hidden"
                                                                         id="div_ac_no">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <input type="text" class="form-control"
                                                                                   id="ac_no" name="ac_no"
                                                                                   placeholder="{{ trans('label_word.ac_no') }}">

                                                                            <p class="help-block" id="msg_ac"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 col-xs-5 hidden"
                                                                         id="div_cheque_no">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <input type="text" class="form-control"
                                                                                   id="cheque_no" name="cheque_no"
                                                                                   placeholder="{{ trans('label_word.cheque_no') }}">

                                                                            <p class="help-block" id="msg_cheque"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 col-xs-5 hidden"
                                                                         id="div_transction_no">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <input type="text" class="form-control"
                                                                                   id="transction_no"
                                                                                   name="transction_no"
                                                                                   placeholder="{{ trans('label_word.transaction_no') }}">

                                                                            <p class="help-block"
                                                                               id="msg_transction"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" id="btn_submit"
                                                class="btn green text-uppercase pull-right">{{ trans('label_word.submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End farmer stock section-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->
<style type="text/css">
    div.radio span.checked {
        background-position: -74px -281px;
    }
</style>

<script type="text/javascript">
    $("input[name=payment_type]").change(function () {
        var payment_type = $("input[name=payment_type]:checked").val();
        if (payment_type == 'Cash') {
            $("#bank_details").addClass('hidden');
        }
        else {
            $("#bank_details").removeClass('hidden');
            if (payment_type == 'DD' || payment_type == 'Cheque') {
                $("#div_cheque_no").removeClass('hidden');
                $("#div_ac_no").addClass('hidden');
                $("#div_transction_no").addClass('hidden');
            } else {
                $("#div_ac_no").removeClass('hidden');
                $("#div_transction_no").removeClass('hidden');
                $("#div_cheque_no").addClass('hidden');
            }
        }
    });

</script>

<script type="text/javascript">

    $(function () {

        $('#buyer_test').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '<?php echo route('fetch_user_auto_complete_for_stock'); ?>',
                    dataType: "json",
                    method: 'POST',
                    data: {
                        term: request.term.split(/,\s*/).pop(),
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            multiselect: false,
            select: function (event, ui) {
                //console.log(ui);return false;
                $("#user_id").val(ui.item.id);
                $("#bd_id").val(ui.item.bd_id);
                $("#buyer_test").val(ui.item.user_name);
                $("#buyer_test").attr('readonly', 'readonly');

                $("#div_buyer").addClass('hidden');
                $("#div_buyer_name").removeClass('hidden');
                $("#div_buyer_company").removeClass('hidden');
                $("#div_buyer_mobile").removeClass('hidden');
                $("#div_buyer_city").removeClass('hidden');
                $("#div_buyer_state").removeClass('hidden');

                $("#buyer_company").text(ui.item.biz_name);
                $("#company_id").val(ui.item.biz_id);
                $("#company_commission").val(ui.item.company_data.biz_comission);
                if (ui.item.company_data.setting_kg_price == null || ui.item.company_data.setting_kg_price == '') {
                    $("#kg_price").html("1/Kg");
                } else {
                    $("#kg_price").html(ui.item.company_data.setting_kg_price);
                }

                $("#buyer_id").val(ui.item.id);
                $("#buyer_name").text(ui.item.name);
                $("#buyer_city").text(ui.item.city);
                $("#buyer_state").text(ui.item.state);
                $("#buyer_mobile").text(ui.item.mobile);
                //option += '<option>Select Goods Type</option>'
                /*for (var i = 0; i < gt_id.length; i++) {
                    option += '<option var catlogue_id="' + farmer_id[i]['bzcp_bzc_id'] + '" var gt_type = "' + gt_id[i]['gt_type'] + '" value="' + gt_id[i]['bzcp_gt_id'] + '">' + gt_id[i]['gt_type'] + '</option>';
                }
                $('#single-goods_type').append(option); */
                var farmer_id = ui.item.farmer_data;
                var farmer = '';
                //farmer += '<option>{{ trans('label_word.select_farmer') }}</option>'
                for (var i = 0; i < farmer_id.length; i++) {
                    farmer += '<option  var farmer_name = "' + farmer_id[i]['seller_name'] + '" value="' + farmer_id[i]['bzcp_seller_id'] + '">' + farmer_id[i]['seller_name'] + '</option>';
                }
                $('#single-farmer').append(farmer);
                return false;
            }

        }).autocomplete("instance")._renderItem = function (ul, item) {
            if (item.mobile == '') {
                $mobile_name_text = "<span class='text-bold'>" + item.name + "</span>";
            }
            if (item.mobile.length < 4) {
                $mobile_name_text = "<span class='text-bold'>" + item.name + "</span>";
            } else {
                $mobile_name_text = "<span class='text-bold'>" + item.name + " ( " + item.mobile + " )</span>";
            }
            return $("<li class='select2'>")
                    .append($mobile_name_text)
                    .appendTo(ul);
        };

    });

    $(document).ready(function () {
        var counter = 0;
        $("#cancel").click(function () {
            $('#save_compnay').removeAttr('disabled');
            var bpi_id = [];
            $("table #row_append").find('input[id^="bpi_id"]').each(function () {
                bpi_id.push($(this).val());

            });
            //var bpi_id = $("#bpi_id"+counter).val();
            if (bpi_id == '') {
                $("#single-goods_type").empty();
                $("#single-farmer").empty();
                var option = '';
                option += '<option>{{ trans('label_word.goods_select') }}</option>'

                $('#single-goods_type').append(option);
                $('#single-goods_type').select2({
                    placeholder: "{{ trans('label_word.goods_select') }}"
                });
                $('#div_farmer').removeClass('hidden');
                var farmer = '';
                farmer += '<option>{{ trans('label_word.select_farmer') }}</option>';
                $('#single-farmer').append(farmer);
                $('#single-farmer').select2({
                    placeholder: "{{ trans('label_word.select_farmer') }}"
                });
                $("#buyer_test").removeAttr('readonly');
                $("#div_buyer").removeClass('hidden');
                $("#div_buyer_name").addClass('hidden');
                $("#div_buyer_company").addClass('hidden');
                $("#div_buyer_mobile").addClass('hidden');
                $("#div_buyer_city").addClass('hidden');
                $("#div_buyer_state").addClass('hidden');

                $("#buyer_company").empty();
                $("#company_id").empty();
                $("#company_commission").empty();
                $("#kg_price").empty();
                $("#buyer_id").empty();
                $("#buyer_name").empty();
                $("#buyer_city").empty();
                $("#buyer_state").empty();
                $("#buyer_mobile").empty();
                $("#tr_1").remove();
                $("#div_farmer").removeClass('has-error');
                $("#msg_farmer").html('');
                $("#div_goods").removeClass('has-error');
                $("#msg_goods").html('');
                $('#div_farmer').removeClass('hidden');
                $('#div_selected_farmer').addClass('hidden');
                $('#div_selected_farmer').text('');
                counter = 0;
                $('#save_compnay').removeAttr('disabled');
            }
            else {
                $("#single-goods_type").select2('val', '');
                $("#single-farmer").select2('val', '');
                $('#single-goods_type').select2({
                    placeholder: "{{ trans('label_word.goods_select') }}"
                });
                $('#single-farmer').select2({
                    placeholder: "{{ trans('label_word.select_farmer') }}"
                });
                $("#div_goods").removeClass('has-error');
                $("#msg_goods").html('');
                /*$("#tr_"+counter).remove();
                 counter--;
                 $.ajax({
                 url: '
                <?php //echo route('delete_buyer_product');?>',
                 method: 'POST',
                 data: {
                 'bpi_id': bpi_id,
                 '_token': '
                <?php //echo csrf_token();?>'
                 },
                 success: function (result) {
                 $obj = JSON.parse(result);
                 if ($obj['SUCCESS'] == 'TRUE') {
                 $("#bpi_id"+counter).val('');
                 }
                 }
                 });*/
            }
            trCall();
            // $("#single-farmer").empty();

        });

        /*$("#single-buyer").on("change", function () {
            var selected_value = $(this).find("option:selected").attr("value");

            $.ajax({
                url: '<?php echo route('get_user_data_for_stock');?>',
                method: 'POST',
                data: {
                    'user_id': selected_value,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_buyer").addClass('hidden');
                        $("#div_buyer_name").removeClass('hidden');
                        $("#div_buyer_company").removeClass('hidden');
                        $("#div_buyer_mobile").removeClass('hidden');
                        $("#div_buyer_city").removeClass('hidden');
                        $("#div_buyer_state").removeClass('hidden');

                        $("#buyer_company").text($obj['Data']['biz_name']);
                        $("#company_id").val($obj['Data']['biz_id']);
                        $("#company_commission").val($obj['company_data']['biz_comission']);
                        if ($obj['company_data']['setting_kg_price'] != null) {
                            $("#kg_price").html($obj['company_data']['setting_kg_price'] + "(<i class='fa fa-inr' aria-hidden='true'></i>)");
                        } else {
                            $("#kg_price").html("1/Kg(<i class='fa fa-inr' aria-hidden='true'></i>)");
                        }

                        $("#buyer_id").val(selected_value);
                        $("#buyer_name").text($obj['Data']['name']);
                        $("#buyer_city").text($obj['Data']['city']);
                        $("#buyer_state").text($obj['Data']['state']);
                        $("#buyer_mobile").text($obj['Data']['mobile']);
                        var gt_id = $obj['good_data'];
                        var option = '';
                        //option += '<option>Select Goods Type</option>'
                        for (var i = 0; i < gt_id.length; i++) {
                            option += '<option var gt_type = "' + gt_id[i]['gt_type'] + '" value="' + gt_id[i]['bzcp_gt_id'] + '">' + gt_id[i]['gt_type'] + '</option>';
                        }
                        $('#single-goods_type').append(option);


                        *//* var farmer_id = $obj['farmer_data'];
                         var farmer = '';
                         for (var i=0;i<farmer_id.length;i++){
                         farmer += '<option var farmer_name = "'+ farmer_id[i]['farmer_name'] + '" value="'+ farmer_id[i]['id'] + '">' + farmer_id[i]['name'] + '</option>';
                         }
                         $('#single-farmer').append(farmer);*//*
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });
        });*/


        $("#single-farmer").on("change", function () {
            var selected_value = $(this).find("option:selected").attr("value");
            var selected_name = $(this).find("option:selected").attr("farmer_name");
            $("#single-goods_type").empty();
            var company_id = $("#company_id").val();
            if (selected_value != undefined) {

                $.ajax({
                    url: '<?php echo route('get_farmer_data_for_stock');?>',
                    method: 'POST',
                    data: {
                        'farmer_id': selected_value,
                        'company_id': company_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);

                        if ($obj['SUCCESS'] == 'TRUE') {
                            var gt_id = $obj['good_data'];
                            var option = '';
                            option += '<option>{{ trans('label_word.goods_select') }}</option>'
                            for (var i = 0; i < gt_id.length; i++) {
                                option += '<option var catlogue_id="' + gt_id[i]['bzcp_bzc_id'] + '"  var gt_type = "' + gt_id[i]['gt_type'] + '" value="' + gt_id[i]['bzcp_gt_id'] + '">' + gt_id[i]['gt_type'] + '</option>';
                            }
                            $('#single-goods_type').append(option);

                            $('#div_farmer').addClass('hidden');
                            $('#div_selected_farmer').removeClass('hidden');
                            $('#div_selected_farmer').text(selected_name);
                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                    }
                });
            }
        });


        $("#save_compnay").click(function () {

            var selected_goods_value = $("#single-goods_type").find("option:selected").attr("value");
            var selected_goods_type = $("#single-goods_type").find("option:selected").attr("gt_type");
            var selected_farmer_value = $("#single-farmer").find("option:selected").attr("value");
            var selected_farmer_name = $("#single-farmer").find("option:selected").attr("farmer_name");
            var selected_bzcp_bzc_id = $("#single-goods_type").find("option:selected").attr("catlogue_id");
            var bpi_bi_id = $("#bpi_bi_id").val();
            var buyer_id = $("#buyer_id").val();
            $flag = 0;

            if ((buyer_id == '' || buyer_id == undefined)) {
                $flag++;
                $("#div_buyer").addClass('has-error');
                $("#msg_buyer").html('Buyer is required.');
            } else {
                $("#div_buyer").removeClass('has-error');
                $("#msg_buyer").html('');
            }

            if ((selected_farmer_value == '' || selected_farmer_value == undefined)) {
                $flag++;
                $("#div_farmer").addClass('has-error');
                $("#msg_farmer").html('Farmer is required.');
            } else {
                $("#div_farmer").removeClass('has-error');
                $("#msg_farmer").html('');
            }

            if (selected_goods_value == '' || selected_goods_value == undefined) {
                $flag++;
                $("#div_goods").addClass('has-error');
                $("#msg_goods").html('Goods Type is required.');
            } else {
                $("#div_goods").removeClass('has-error');
                $("#msg_goods").html('');
            }
            if ($flag == 0) {

                $.ajax({
                    url: '<?php echo route('get_farmer_stock');?>',
                    method: 'POST',
                    data: {
                        'bpi_bi_id': bpi_bi_id,
                        'farmer_id': selected_farmer_value,
                        'gt_id': selected_goods_value,
                        'bzcp_bzc_id': selected_bzcp_bzc_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            counter++;
                            var buyer_state = $('#buyer_state').text();
                            var newRow = $("<tr id='tr_" + counter + "'>");
                            var cols = "";

                            cols += "<td> " + counter + "<input type='hidden' id='bpi_id" + counter + "' name='bpi_id" + counter + "' ><input type='hidden' id='bpi_invoice_no " + counter + "' name='bpi_invoice_no" + counter + "' > </td>";
                            cols += "<td>" + $obj['Data'][0]['seller_name'];
                            cols += "<input type='hidden' id='bzcp_bzc_id " + counter + "' name='bzcp_bzc_id" + counter + "' value='" + selected_bzcp_bzc_id + "' >";
                            cols += "<input type='hidden' id='seller_name " + counter + "' name='seller_name" + counter + "' value='" + $obj['Data'][0]['bzcp_seller_id'] + "' >";
                            cols += "</td>";
                            cols += "<td>" + $obj['Data'][0]['gt_type'];
                            cols += "<input type='hidden' id='gt_name " + counter + "' name='gt_name" + counter + "' value='" + $obj['Data'][0]['bzcp_gt_id'] + "' >";
                            cols += "</td>";
                            cols += " <td class='hidden-xs' id='total_weight_" + counter + "' style='width: 1%;'>" + $obj['Data'][0]['bzcp_weight'] + "</td>";

                            cols += "<td class='hidden-xs'>";
                            cols += " <input name='price" + counter + "' onkeyup='BSP.only(&#39digit&#39,&#39price_" + counter + "&#39)' id= 'price_" + counter + "' value='" + $obj['Data'][0]['bzcp_price'] + "'   type='text' style='width: 100%;height: 30px;'>";
                            cols += "</td>";

                            cols += "<td class='hidden-xs'>";
                            cols += " <input name='qty" + counter + "' onkeyup='BSP.only(&#39digit&#39,&#39qty_" + counter + "&#39)' id='qty_" + counter + "' type='text' style='width: 60%;height: 30px;'>";
                            cols += "</td>";
                            cols += "<td class='text-right'> <i class='fa fa-inr' aria-hidden='true'></i> &nbsp;<label id='pr_total" + counter + "' for='pr_total" + counter + "'></label>";
                            cols += "</td>";
                            if (buyer_state === 'Gujarat') {
                                $("#th_cgst").removeClass('hidden');
                                $("#th_sgst").removeClass('hidden');
                                $("#td_8_tot").removeClass('hidden');
                                $("#td_6_tot").addClass('hidden');
                                $("#td_8_com").removeClass('hidden');
                                $("#td_6_com").addClass('hidden');
                                $("#td_8_fee").removeClass('hidden');
                                $("#td_6_fee").addClass('hidden');
                                $("#td_8_grand").removeClass('hidden');
                                $("#td_6_grand").addClass('hidden');
                                cols += "<td class='text-right'>(<label id='cgst_per" + counter + "' for='cgst_per" + counter + "'>" + $obj['Data'][0]['gt_cgst_tax'] + "</label>%)";
                                cols += "<label id='cgst_total" + counter + "' for='cgst_total" + counter + "'></label>";
                                cols += "</td>";

                                cols += "<td class='text-right'>(<label id='sgst_per" + counter + "' for='sgst_per" + counter + "'>" + $obj['Data'][0]['gt_sgst_tax'] + "</label>%)";
                                cols += "<label id='sgst_total" + counter + "' for='sgst_total" + counter + "'></label>";
                                cols += "</td>";
                            } else if (buyer_state != 'Gujarat') {
                                $("#th_igst").removeClass('hidden');
                                cols += "<td class='text-right'>(<label id='igst_per" + counter + "' for='igst_per" + counter + "'>" + $obj['Data'][0]['gt_igst_tax'] + "</label>%)";
                                cols += "<label id='igst_total" + counter + "' for='igst_total" + counter + "'></label>";
                                cols += "</td>";
                            }
                            cols += "<td class='text-right'> <i class='fa fa-inr' aria-hidden='true'></i> &nbsp;<label id='total" + counter + "' for='total" + counter + "'></label>";
                            cols += "</td>";
                            newRow.append(cols);

                            /*if(buyer_state === 'Gujarat' && $obj['Data'][0]['gt_is_tax_apply'] === 'True'){
                             $("#cgst").removeClass('hidden');
                             $("#cgst_per").text($obj['Data'][0]['gt_cgst_tax']);
                             $("#sgst").removeClass('hidden');
                             $("#sgst_per").text($obj['Data'][0]['gt_sgst_tax']);
                             }else if(buyer_state != 'Gujarat' && $obj['Data'][0]['gt_is_tax_apply'] === 'True'){
                             $("#igst").removeClass('hidden');
                             $("#igst_per").text($obj['Data'][0]['gt_igst_tax']);
                             }*/
                            $("table #row_append").append(newRow);
                            $('#save_compnay').attr('disabled', 'disabled');

                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                    }
                });


            }
        });

        /* $('input[name^=qty]').change(function (event) {

         var id = $(this).closest('tr').attr('id').replace("tr_","");
         alert(id);
         //total($(this).closest("tr"),id);
         //trCall();

         });*/
        $("table #row_append").on("change", 'input', function (event) {

            var id = $(this).closest('tr').attr('id').replace("tr_", "");
            var current_input_id = event.target.id;
            if (current_input_id.indexOf('qty_') > -1) {
                total($(this).closest("tr"), id);
                trCall();
                $("#cancel").remove();
                $("#cancel").attr('disabled','disabled');
            }


        });


        function trCall() {
            AllTotal();
            GrantTotal();
        }

        $("#market").on("change", 'input', function (event) {
            GrantTotal();

        });

        function total(row, id) {
            $('#btn_submit').removeAttr('disabled');
            var qty = row.find('#qty_' + id).val();
            var total_weight = row.find('#total_weight_' + id).text();
            var price = row.find('#price_' + id).val();
            var kg = $('label[for^="kg_price"]').text();

            if (parseInt(qty) > parseInt(total_weight)) {
                toastr.error(qty + " Qty not available.Please enter lesser then Total Qty.");
                $('#btn_submit').attr('disabled', 'disabled');
            } else {
                var kg_p = kg.replace("/Kg", "");
                var kg_price = (price * 1) / kg_p;
                var total_price = qty * kg_price;
                $("table #row_append").find('label[for^="pr_total' + id + '"]').html((total_price).toFixed(2));
                pr_total(row, total_price, id);
                $('#btn_submit').removeAttr('disabled');
            }
            // kg.replace("/Kg()", "");

        }

        function pr_total(row, total_price, id) {

            var cgst_per = row.find('label[for^="cgst_per' + id + '"]').text();
            var sgst_per = row.find('label[for^="sgst_per' + id + '"]').text();
            var igst_per = row.find('label[for^="igst_per' + id + '"]').text();
            var cgst = ((total_price * cgst_per) / 100);
            var sgst = ((total_price * sgst_per) / 100);
            var igst = ((total_price * igst_per) / 100);
            var total = total_price + cgst + sgst + igst;
            $("table #row_append").find('label[for^="cgst_total' + id + '"]').html((cgst).toFixed(2));
            $("table #row_append").find('label[for^="sgst_total' + id + '"]').html((sgst).toFixed(2));
            $("table #row_append").find('label[for^="igst_total' + id + '"]').html((igst).toFixed(2));
            $("table #row_append").find('label[for^="total' + id + '"]').html((total).toFixed(2));

            var biz_id = $("#company_id").val();
            var bpi_bi_id = $("#bpi_bi_id").val();
            var buyer_id = $("#buyer_id").val();
            var bpi_id = +row.find('input[name^="bpi_id"]').val();
            var seller_id = +row.find('input[name^="seller_name"]').val();
            var gt_id = +row.find('input[name^="gt_name"]').val();
            var bzcp_bzc_id = +row.find('input[name^="bzcp_bzc_id"]').val();
            var weight = +row.find('input[name^="qty"]').val();
            var price = +row.find('input[name^="price"]').val();
            var bpi_invoice_no = $("#bpi_invoice_no").val();

            var kg = $('label[for^="kg_price"]').text();
            kg.replace("/Kg", "");
            var kg_p = kg.replace("/Kg", "");
            var kg_price = (price * 1) / kg_p;
            var amount = weight * kg_price;


            //alert(kg_p); alert(kg_price);alert(amount);return false;
            $.ajax({
                url: '<?php echo route('insert_product_invoice');?>',
                method: 'POST',
                data: {
                    'bpi_id': bpi_id,
                    'bpi_bi_id': bpi_bi_id,
                    'bpi_biz_id': biz_id,
                    'bpi_buyer_id': buyer_id,
                    'bpi_saller_id': seller_id,
                    'bpi_gt_id': gt_id,
                    'bpi_bzc_id': bzcp_bzc_id,
                    'bpi_weight': weight,
                    'bpi_bid_price': kg_price,
                    'bpi_cgst': cgst_per,
                    'bpi_sgst': sgst_per,
                    'bpi_igst': igst_per,
                    'bpi_cgst_price': cgst,
                    'bpi_sgst_price': sgst,
                    'bpi_igst_price': igst,
                    'bpi_amount': amount,
                    'bpi_total': total,
                    'bpi_invoice_no': bpi_invoice_no,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);

                    if ($obj['SUCCESS'] == 'TRUE') {
                        row.find('input[name^="bpi_id"]').val(($obj['bpi_id']));
                        if (bpi_bi_id == '') {
                            $("#bpi_bi_id").val($obj['bpi_bi_id']);
                            $("#bpi_invoice_no").val($obj['bpi_invoice_no']);

                        }

                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });
            $('#save_compnay').removeAttr("disabled");

        }

        function AllTotal() {

            var allTotal = 0;

            $("table #row_append").find('label[for^="total"]').each(function () {
                allTotal += +$(this).text();

            });
            $("label[for='all_total']").html(allTotal.toFixed(2));

        }

        function GrantTotal() {

            // var grantTotal = 0;

            var commission = $("#company_commission").val();
            var all_total = +$("label[for='all_total']").text();
            var commission_val = ((all_total * commission) / 100);
            var market_fee = $("#market_fee").val();
            var market_fee_val = (all_total * market_fee) / 100;
            var grantTotal = (all_total + (commission_val) + market_fee_val);
            $('#commission_per').text(commission);
            $('#commission').text(commission_val.toFixed(2));
            $('#grandTotal').text(grantTotal.toFixed(2));
            $('#market_fee_val').text(market_fee_val.toFixed(2));
            $("#print").removeClass('hidden');
        }

        $("#btn_submit").click(function () {
            var buyer_id = $("#buyer_id").val();
            var company_id = $("#company_id").val();
            var bpi_bi_id = $("#bpi_bi_id").val();
            var farmer_id = [];
            var gt_id = [];
            var bpi_id = [];
            var bzcp_bzc_id = [];
            var commission = $("#company_commission").val();
            var amount = $("label[for='all_total']").text();
            var commission_val = (((amount * commission) / 100).toFixed(2));
            var market_fee = $("#market_fee").val();
            var total = $("label[for='grandTotal']").text();
            var market_fee_val = $("label[for='market_fee_val']").text();
            var payment_type = $("input[name=payment_type]:checked").val();

            var bank_name = $("#bank_name").val();
            var cheque_no = $("#cheque_no").val();
            var transction_no = $("#transction_no").val();
            var ac_no = $("#ac_no").val();
            var ifsc_code = $("#ifsc_code").val();
            var transction_id = '';
            if (cheque_no != '') {
                transction_id = cheque_no;
            } else if (transction_no != '') {
                transction_id = transction_no;
            }
            var flag = 0;
            var scroll_element = '';
            $("table #row_append").find('input[id^="seller_name"]').each(function () {
                farmer_id.push($(this).val());
            });
            $("table #row_append").find('input[id^="gt_name"]').each(function () {
                gt_id.push($(this).val());

            });
            $("table #row_append").find('input[id^="bpi_id"]').each(function () {
                bpi_id.push($(this).val());

            });
            $("table #row_append").find('input[id^="bzcp_bzc_id"]').each(function () {
                bzcp_bzc_id.push($(this).val());

            });
            $("table #row_append").find('input[id^="qty"]').each(function () {

                if ($(this).val() == '' || $(this).val() == undefined) {
                    flag++;
                    $('#btn_submit').attr('disabled', 'disabled');
                    /* if (scroll_element == '') {
                     scroll_element = 'div_qty';
                     }*/
                    toastr.error("Please fill Qty.");

                }

            });
            if (payment_type != 'Cash' && payment_type != undefined) {
                if (bank_name == '') {
                    $("#div_bank").addClass('has-error');
                    $("#msg_bank").html("Please enter your bank name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_bank';
                    }
                } else {
                    $("#div_bank").removeClass('has-error');
                    $("#msg_bank").html("");
                }

                if (ifsc_code == '') {
                    $("#div_ifsc").addClass('has-error');
                    $("#msg_ifsc").html("Please fill IFSC Code. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_ifsc';
                    }
                } else {
                    $("#div_ifsc").removeClass('has-error');
                    $("#msg_ifsc").html("");
                }
                if (payment_type == 'DD' || payment_type == 'Cheque') {
                    if (cheque_no == '') {
                        $("#div_cheque_no").addClass('has-error');
                        $("#msg_cheque").html("Please enter your Cheque No. It's a required Field.");
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_cheque_no';
                        }
                    } else {
                        $("#div_cheque_no").removeClass('has-error');
                        $("#msg_cheque").html("");
                    }
                } else {
                    if (transction_no == '') {
                        $("#div_transction_no").addClass('has-error');
                        $("#msg_transction").html("Please enter your Transaction No. It's a required Field.");
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_transction_no';
                        }
                    } else {
                        $("#div_transction_no").removeClass('has-error');
                        $("#msg_transction").html("");
                    }

                    if (ac_no == '') {
                        $("#div_ac_no").addClass('has-error');
                        $("#msg_ac").html("Please enter your Account No. It's a required Field.");
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_ac_no';
                        }
                    } else {
                        $("#div_ac_no").removeClass('has-error');
                        $("#msg_ac").html("");
                    }
                }


            } else {
                $("#div_payment_type").removeClass('has-error');
                $("#msg_payment_type").html("");
            }
            if (flag == 0) {
                $('#btn_submit').attr('disabled', 'disabled');
                $.ajax({
                    url: '<?php echo route('add_stock_out_data');?>',
                    method: 'POST',
                    data: {
                        'buyer_id': buyer_id,
                        'company_id': company_id,
                        'bpi_bi_id': bpi_bi_id,
                        'farmer_id': farmer_id,
                        'gt_id': gt_id,
                        'bpi_id': bpi_id,
                        'bzcp_bzc_id': bzcp_bzc_id,
                        'amount': amount,
                        'commission': commission,
                        'commission_val': commission_val,
                        'market_fee': market_fee,
                        'bi_market_fee_per': market_fee_val,
                        'total': total,
                        'bank_name': bank_name,
                        'cheque_no': cheque_no,
                        'ac_no': ac_no,
                        'ifsc_code': ifsc_code,
                        'payment_type': payment_type,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            toastr.success($obj['MESSAGE']);
                            window.location = 'invoice/' + $obj['bpi_bi_id'];
                        } else {
                            toastr.error($obj['MESSAGE']);
                            $('#btn_submit').removeAttr('disabled');
                        }
                    }
                });
            } else if (scroll_element != '') {
                BSP.scroll_upto_div(scroll_element);
            }

        });
    });


</script>


</body>
</html>