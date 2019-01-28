@include('layouts.header')
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
                        <a href="<?php echo route('stock_in_list');?>">{{ trans('label_word.stock_in_title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.create_farmer_bill') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.create_farmer_bill') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!--Start farmer stock section-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet">
                        <div class="portlet-title" style="background-color: white; border: 1px solid #eee; width: 93%">
                            <div class="caption" style="margin-left: 1%;">
                                <i class="fa fa-arrow-up font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.create_farmer_bill') }}</span>
                            </div>


                        </div>
                        <div class="portlet-body">
                            <div class="invoice">
                                <div class="col-md-2 col-xs-2 col-sm-2"
                                     style="background-color: white; margin-right: 15px; border: 1px solid #eee;">
                                    <div class="col-md-15 col-xs-15 col-sm-15">

                                        <div class="form-group margin-top-10" id="div_seller_name">
                                            <label for="single-seller"
                                                   class="control-label text-bold">{{ trans('label_word.farmer_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_name"
                                                   class="control-label ">{{$data['farmer_consignment_data']->farmer_name}}</label>
                                            <input type="hidden" name="seller_id" id="seller_id"
                                                   value="{{$data['farmer_consignment_data']->bzcp_seller_id}}">
                                            <input type="hidden" name="spi_si_id" id="spi_si_id">
                                            <input type="hidden" name="spi_invoice_no" id="spi_invoice_no">

                                        </div>
                                        <div class="form-group" id="div_seller_company">
                                            <label for="single-comapny"
                                                   class="control-label text-bold">{{ trans('label_word.company_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_company"
                                                   class="control-label">{{$data['farmer_consignment_data']->biz_name}}</label>
                                            <input type="hidden" name="company_id" id="company_id"
                                                   value="{{$data['farmer_consignment_data']->bzcp_biz_id}}">
                                            <input type="hidden" name="company_comisiion" id="company_comisiion"
                                                   value="{{$data['farmer_consignment_data']->biz_comission}}">

                                        </div>
                                        <div class="form-group" id="div_seller_mobile">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.mobile_no') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_mobile"
                                                   class="control-label">{{$data['farmer_consignment_data']->mobile}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_city">
                                            <label for="single-city"
                                                   class="control-label text-bold">{{ trans('label_word.city') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_city"
                                                   class="control-label">{{$data['farmer_consignment_data']->city}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_state">
                                            <label for="single-state"
                                                   class="control-label text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                            <br>
                                            <label id="seller_state"
                                                   class="control-label">{{$data['farmer_consignment_data']->state}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_goods">
                                            <label for="single-state" class="control-label text-bold">Goods&nbsp;Type&nbsp;:</label>
                                            <br>
                                            <label id="seller_goods"
                                                   class="control-label">{{$data['farmer_consignment_data']->gt_type}}</label>
                                            <input type="hidden" name="goods_id" id="goods_id"
                                                   value="{{$data['farmer_consignment_data']->bzcp_gt_id}}">
                                            <input type="hidden" name="bzcp_bzc_id" id="bzcp_bzc_id"
                                                   value="{{$data['farmer_consignment_data']->bzcp_bzc_id}}">
                                        </div>
                                        <div class="form-group margin-top-10" id="div_buyer">
                                            <label for="single-buyer"
                                                   class="control-label text-bold">{{ trans('label_word.buyer_mob') }}</label>

                                            <div class="input-group col-md-12">
                                                <div class="input-group-content" id="div_buyer_test">
                                                    <input type="hidden" id="user_id" name="user_id">
                                                    <input type="text" class="form-control" name="buyer_test"
                                                           id="buyer_test"
                                                           placeholder="{{ trans('label_word.enter_buyer_mob') }}">
                                                    <label for="buyer_test1" class="control-label"></label>

                                                    <p class="help-block" id="msg_buyer"></p>
                                                    <span id="suggesstion-box"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="cancel" class="btn default text-uppercase">
                                                {{ trans('label_word.cancel') }}
                                            </button>
                                            <button type="button" id="save_compnay"
                                                    class="btn green text-uppercase pull-right">{{ trans('label_word.submit') }}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-15 col-xs-15 col-sm-15">
                                            <div class="well" style="background-color: white; border: 1px solid #eee;">
                                                <table class="table table-hover" style="margin: 0;">
                                                    <thead>
                                                    <tr>
                                                        <th> {{ trans('label_word.id') }}</th>
                                                        <th> {{ trans('label_word.buyer_name') }}</th>
                                                        <th> {{ trans('label_word.good_type_sidebar') }}</th>
                                                        <th> {{ trans('label_word.hsn_no') }}</th>
                                                        <th class="hidden-xs"
                                                            style="width: 10%;"> {{ trans('label_word.weight') }}</th>
                                                        <th class="hidden-xs"
                                                            style="width: 15%;">{{ trans('label_word.price') }}
                                                            &nbsp;(<span
                                                                    id="kg_price">{{$data['farmer_consignment_data']->setting_kg_price}}</span>)&nbsp;(<i
                                                                    class="fa fa-inr" aria-hidden="true"></i>)
                                                        </th>
                                                        <th class="hidden-xs"
                                                            style="width: 20%;"> {{ trans('label_word.sold_qty') }}</th>
                                                        <th class="text-right"
                                                            style="width: 20%;"> {{ trans('label_word.total') }} (<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>)
                                                        </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="row_append">

                                                    </tbody>
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold">{{ trans('label_word.total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="all_total"><i class="fa fa-inr"
                                                                                                 aria-hidden="true"></i>&nbsp;<label
                                                                    for="all_total"></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
                                                        <td class="text-right" id="market">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.wages') }}
                                                                :</span>
                                                            <input type="text" style="width: 30%;"
                                                                   onkeyup="BSP.only('digit','market_fee')"
                                                                   name="market_fee" id="market_fee"
                                                                   value="">&nbsp;<label class="control-label"></label>
                                                        </td>
                                                        <td class="text-right">

                                                            &nbsp;<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true" style="margin-left: 10%"></i>&nbsp;<label
                                                                    id="market_fee_val"
                                                                    for="market_fee_val"></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6"></td>
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
                                    <div class="row">
                                        <div>
                                            <button type="button" id="btn_submit"
                                                    class="btn green text-uppercase pull-right">{{ trans('label_word.save') }}
                                            </button>
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
        var company_id = $("#company_id").val();
        $('#buyer_test').autocomplete({

            source: function (request, response) {
                $.ajax({
                    url: '<?php echo route('fetch_user_auto_complete_for_stock'); ?>',
                    dataType: "json",
                    method: 'POST',
                    data: {
                        company_id: company_id,
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
                // console.log(ui);
                $("#user_id").val(ui.item.id);
                $("#buyer_test").val(ui.item.name);
                $("#buyer_test1").text(ui.item.name);
                $("#buyer_test").attr('readonly', 'readonly');
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
        localStorage.clear();
        var spi_si_id_local = localStorage.getItem('spi_si_id');
        var spi_invoice_no_local = localStorage.getItem('spi_invoice_no');

        if (spi_si_id_local != null && spi_invoice_no_local != null) {
            $("#spi_si_id").val(spi_si_id_local);
            $("#spi_invoice_no").val(spi_invoice_no_local);
            // $("#error_msg").text("Invalid Credential.");
        }
        var counter = 0;
        $("#cancel").click(function () {
            var spi_id = $("#spi_id" + counter).val();
            $("#buyer_test1").empty();
            $("#buyer_test").val('');
            $("#user_id").val('');
            $("#tr_" + counter).remove();
            counter--;
            $.ajax({
                url: '<?php echo route('delete_seller_product');?>',
                method: 'POST',
                data: {
                    'spi_id': spi_id,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#spi_id" + counter).val('');
                    }
                }
            });
            trCall();
            $('#save_compnay').removeClass('hidden');
            $('#save_compnay').removeAttr('disabled');
            $('#buyer_test').removeAttr('readonly');
        });


        $("#save_compnay").click(function () {

            $('#save_compnay').attr('disabled', 'disabled');
            var buyer_name = $("#buyer_test").val();
            var user_id = $("#user_id").val();
            var farmer_id = $("#seller_id").val();
            var spi_si_id = $("#spi_si_id").val();
            var bzcp_bzc_id = $("#bzcp_bzc_id").val();
            var goods_id = $("#goods_id").val();
            $flag = 0;

            if (buyer_name == '' || buyer_name == undefined) {
                $flag++;
                $("#div_buyer_test").addClass('has-error');
                $("#msg_buyer").html('Buyer is required.');
                $('#save_compnay').removeAttr('disabled');
            } else if (user_id == '' && buyer_name != '') {
                $flag++;
                $("#div_buyer_test").addClass('has-error');
                $("#msg_buyer").html('Buyer is not exist.');
                $('#save_compnay').removeAttr('disabled');
            } else {
                $("#div_buyer_test").removeClass('has-error');
                $("#msg_buyer").html('');
            }
            if ($flag == 0) {
                $.ajax({
                    url: '<?php echo route('get_farmer_stock_for_buyer');?>',
                    method: 'POST',
                    data: {
                        'spi_si_id': spi_si_id,
                        'farmer_id': farmer_id,
                        'gt_id': goods_id,
                        'bzcp_bzc_id': bzcp_bzc_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            counter++;
                            var newRow = $("<tr id='tr_" + counter + "'>");
                            var cols = "";

                            cols += "<td> " + counter + "<input type='hidden' id='spi_id" + counter + "' name='spi_id" + counter + "' ><input type='hidden' id='spi_invoice_no " + counter + "' name='spi_invoice_no" + counter + "' > </td>";
                            cols += "<td>" + buyer_name;
                            cols += "<input type='hidden' id='buyer_name_" + counter + "' name='buyer_name" + counter + "' value='" + user_id + "' >";
                            cols += "</td>";
                            cols += "<td>" + $obj['Data'][0]['gt_type'];
                            cols += "<input type='hidden' id='gt_name " + counter + "' name='gt_name" + counter + "' value='" + goods_id + "' >";
                            cols += "</td>";
                            if ($obj['Data'][0]['gt_hsn_no'] != '') {
                                cols += "<td>" + $obj['Data'][0]['gt_hsn_no'];
                            } else {
                                cols += "<td>-";
                            }

                            cols += "</td>";
                            cols += " <td class='hidden-xs' id='total_weight_" + counter + "'>" + $obj['Data'][0]['bzcp_weight'] + "</td>";

                            cols += "<td class='pull-right' ondblclick='document.getElementById(&#39price_" + counter + "&#39).disabled=false;'>";
                            if ($obj['Data'][0]['bzcp_price'] > 0) {
                                cols += " <input name='price" + counter + "' onchange='priceInfo(this.value," + $obj['Data'][0]['bzcp_id'] + ");' onkeyup='BSP.only(&#39digit&#39,&#39qty_" + counter + "&#39)' onkeyup='BSP.only(&#39digit&#39,&#39price_" + counter + "&#39)' id= 'price_" + counter + "' value='" + $obj['Data'][0]['bzcp_price'] + "'   type='text' style='width: 100%;height: 30px;' disabled>";
                            } else {
                                cols += " <input name='price" + counter + "' onchange='priceInfo(this.value," + $obj['Data'][0]['bzcp_id'] + ");' onkeyup='BSP.only(&#39digit&#39,&#39qty_" + counter + "&#39)' onkeyup='BSP.only(&#39digit&#39,&#39price_" + counter + "&#39)' id= 'price_" + counter + "' value='" + $obj['Data'][0]['bzcp_price'] + "'   type='text' style='width: 100%;height: 30px;'>";
                            }
                            cols += "</td>";

                            cols += "<td class='hidden-xs'>";
                            cols += " <input name='qty" + counter + "' id='qty_" + counter + "' type='text' style='width: 60%;height: 30px;'>";
                            cols += "</td>";

                            cols += "<td class='text-right'> <i class='fa fa-inr' aria-hidden='true'></i> &nbsp;<label id='total" + counter + "' for='total" + counter + "'></label>";
                            cols += "</td>";
                            newRow.append(cols);
                            $("table #row_append").append(newRow);
                            //$("#buyer_test").val('');
                            //$("#user_id").val('');
                            $('#save_compnay').attr('disabled', 'disabled');
                            $('#save_compnay').addClass('hidden');

                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                    }
                });


            }
        });
    });
    function priceInfo(price, id) {
        var r = $("#kg_price").text();

        var kg = r.replace("/Kg", "");
        if (kg == 20) {
            var kg_price = price / kg;
        } else {
            var kg_price = price;
        }
        $.ajax({
            url: '<?php echo route('price_added');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                'price': kg_price,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    //toastr.success($obj['MESSAGE']);
                    //$("#price_").attr('readonly');
                    $("#price_" + id).attr('disabled', 'disabled');
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    ;

    function weightInfo(weight, id) {
        var weight = $("#weight").text();

        $.ajax({
            url: '<?php echo route('weight_added');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                'weight': weight,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    $("#weight_" + id).attr('disabled', 'disabled');
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    ;

    $("table #row_append").on("change", 'input', function (event) {

        var id = $(this).closest('tr').attr('id').replace("tr_", "");
        var current_input_id = event.target.id;
        if (current_input_id.indexOf('qty_') > -1) {
            total($(this).closest("tr"), id);
            trCall();
        }
    });
    function total(row, id) {
        $('#btn_submit').removeAttr('disabled');
        var qty = row.find('#qty_' + id).val();
        var total_weight = row.find('#total_weight_' + id).text();
        var price = row.find('#price_' + id).val();
        var r = $("#kg_price").text();
        var kg = r.replace("/Kg", "");
        if (kg == 20) {
            var kg_price = price / kg;
        } else {
            var kg_price = price;
        }

        if (parseInt(qty) > parseInt(total_weight)) {
            toastr.error(qty + " Qty not available.Please enter lesser then Total Qty.");
            $('#btn_submit').attr('disabled', 'disabled');
        } else {
            var kg_p = kg.replace("/Kg", "");
            var total_price = qty * kg_price;
            $("table #row_append").find('label[for^="total' + id + '"]').html((total_price).toFixed(2));
            $('#btn_submit').removeAttr('disabled');
            //$('#save_compnay').removeAttr('disabled');
            return saveProduct(id);
        }
        GrantTotal();
        // kg.replace("/Kg()", "");

    }
    function AllTotal() {

        var allTotal = 0;

        $("table #row_append").find('label[for^="total"]').each(function () {
            allTotal += +$(this).text();

        });
        $("label[for='all_total']").html(allTotal);

    }
    function trCall() {
        AllTotal();
        GrantTotal();
    }
    $("#market").on("change", 'input', function (event) {
        GrantTotal();

    });
    function GrantTotal() {
        var id = [];

        $("table #row_append").find('input[name^="qty"]').each(function () {
            id.push($(this).attr('id').replace("qty_", ""));
        });

        /* $.each( id, function( i, val ) {
         var qty = $( "#qty_" + val ).val();
         var price = $( "#price_" + val ).val();
         var r = $("#kg_price").text();
         var kg = r.replace("/Kg", "");

         var qty = $( "#qty_" + id ).val();
         var price = $( "#price_"+ id ).val();
         if(kg == 20){
         var kg_price = price/kg;
         }else{
         var kg_price = price;
         }
         var total_price = qty * kg_price;
         var total = total_price.toFixed(2);
         $("#total"+val).text(total);
         //all_total += total_price;
         });*/
        var allTotal = 0;

        $("table #row_append").find('label[for^="total"]').each(function () {
            allTotal += +$(this).text();

        });
        $("label[for='all_total']").html(allTotal);
        var wages = $("#market_fee").val();
        var market_fee_val = wages * 1;
        var grantTotal = allTotal + market_fee_val;
        $('#grandTotal').text(grantTotal);
        $('#market_fee_val').text(market_fee_val);
        $('#grandTotal').text(grantTotal);
        $("#print").removeClass('hidden');
    }


    function saveProduct(id) {

        var spi_si_id = $("#spi_si_id").val();
        var spi_id_local = 'spi_id_local_' + id;
        /* spi_id_local = localStorage.getItem('spi_id'+id);
         if(spi_id_local != null && spi_id_local != null) {
         $("#spi_id" + id).val(spi_id_local);
         }*/
        var biz_id = $("#company_id").val();
        var seller_id = $("#seller_id").val();
        var spi_invoice_no = $("#spi_invoice_no").val();
        var r = $("#kg_price").text();
        var kg = r.replace("/Kg", "");

        var qty = $("#qty_" + id).val();
        var price = $("#price_" + id).val();
        if (kg == 20) {
            var kg_price = price / kg;
        } else {
            var kg_price = price;
        }
        var total_price = qty * kg_price;
        var total = total_price.toFixed(2);
        var spi_id = $("#spi_id" + id).val();
        var buyer_id = $('#buyer_name_' + id).val();
        var bzcp_bzc_id = $("#bzcp_bzc_id").val();
        var gt_id = $("#goods_id").val();
        var weight = $('#qty_' + id).val();

        $.ajax({
            url: '<?php echo route('insert_seller_product_invoice');?>',
            method: 'POST',
            data: {
                'bzcp_bzc_id': bzcp_bzc_id,
                'spi_biz_id': biz_id,
                'spi_seller_id': seller_id,
                'spi_buyer_id': buyer_id,
                'spi_gt_id': gt_id,
                'spi_weight': weight,
                'spi_bid_price': kg_price,
                'spi_invoice_no': spi_invoice_no,
                'spi_si_id': spi_si_id,
                'spi_total': total,
                'spi_id': spi_id,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);

                if ($obj['SUCCESS'] == 'TRUE') {
                    $('input[name^="spi_id"]').val(($obj['spi_id']));
                    // localStorage.setItem("spi_id"+id,$obj['spi_id']);
                    $("spi_id" + id).val($obj['spi_id']);
                    if (spi_si_id == '') {
                        $("#spi_si_id").val($obj['spi_si_id']);
                        $("#spi_invoice_no").val($obj['spi_invoice_no']);
                        localStorage.setItem("spi_si_id", $obj['spi_si_id']);
                        localStorage.setItem("spi_invoice_no", $obj['spi_invoice_no']);
                    }
                    //$('#save_compnay').removeAttr('disabled');
                    $('#buyer_test').removeAttr('readonly');
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
        // GrantTotal();
    }
    $("#btn_submit").click(function () {

        var seller_id = $("#seller_id").val();
        var company_id = $("#company_id").val();
        var spi_id = $('input[name^="spi_id"]').val();
        var spi_si_id = $("#spi_si_id").val();

        var amount = $("label[for='all_total']").text();
        var market_fee = $("#market_fee").val();
        var market_fee_val = $("label[for='market_fee_val']").text();
        var total = $("label[for='grandTotal']").text();


        var payment_type = '';
        if ($("input[name=payment_type]:checked").val() != '') {
            payment_type = $("input[name=payment_type]:checked").val()
        }
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
        var scroll_element = '';
        var flag = 0;
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

                url: '<?php echo route('add_stock_in_data');?>',
                method: 'POST',
                data: {
                    'seller_id': seller_id,
                    'company_id': company_id,
                    'spi_si_id': spi_si_id,
                    'amount': amount,
                    'market_fee': market_fee,
                    'market_fee_val': market_fee_val,
                    'total': total,
                    'bank_name': bank_name,
                    'cheque_no': transction_id,
                    'ac_no': ac_no,
                    'ifsc_code': ifsc_code,
                    'payment_type': payment_type,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        window.location = '<?php echo route('stock_in_list');?>';
                        localStorage.removeItem('spi_si_id_local');
                        localStorage.removeItem('spi_invoice_no_local');
                        localStorage.clear();
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
