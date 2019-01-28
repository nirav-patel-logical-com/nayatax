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
                                    <div class="col-md-10 col-xs-10 col-sm-10">

                                        <div class="form-group margin-top-10" id="div_seller_name">
                                            <label for="single-seller"
                                                   class="control-label text-bold">{{ trans('label_word.farmer_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_name"
                                                   class="control-label ">{{$data['stock_in_data']->farmer_name}}</label>
                                            <input type="hidden" name="seller_id" id="seller_id"
                                                   value="{{$data['stock_in_data']->bpi_saller_id}}">
                                            <input type="hidden" name="spi_si_id" id="spi_si_id">
                                            <input type="hidden" name="spi_invoice_no" id="spi_invoice_no">

                                        </div>
                                        <div class="form-group" id="div_seller_company">
                                            <label for="single-comapny"
                                                   class="control-label text-bold">{{ trans('label_word.company_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_company"
                                                   class="control-label">{{$data['stock_in_data']->biz_name}}</label>
                                            <input type="hidden" name="company_id" id="company_id"
                                                   value="{{$data['stock_in_data']->bpi_biz_id}}">
                                            <input type="hidden" name="company_comisiion" id="company_comisiion"
                                                   value="{{$data['stock_in_data']->biz_comission}}">

                                        </div>
                                        <div class="form-group" id="div_seller_mobile">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.mobile_no') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_mobile"
                                                   class="control-label">{{$data['stock_in_data']->mobile}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_city">
                                            <label for="single-city"
                                                   class="control-label text-bold">{{ trans('label_word.city') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_city"
                                                   class="control-label">{{$data['stock_in_data']->city}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_state">
                                            <label for="single-state"
                                                   class="control-label text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                            <br>
                                            <label id="seller_state"
                                                   class="control-label">{{$data['stock_in_data']->state}}</label>
                                        </div>
                                        <!--<div class="form-group" id="div_seller_goods">
                                            <label for="single-state" class="control-label">Goods&nbsp;Type&nbsp;:</label>
                                            <label id="seller_goods" class="control-label">$data['consignment_data']->gt_type}}</label>
                                            <input type="hidden" name="goods_id" id="goods_id" value="$data['consignment_data']->bzcp_gt_id}}">
                                        </div>-->
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
                                                            style="width: 15%;"> {{ trans('label_word.weight') }}</th>
                                                        <th class="text-right"
                                                            style="width: 20%;">{{ trans('label_word.price') }}
                                                            &nbsp;1/Kg(<i class="fa fa-inr" aria-hidden="true"></i>)
                                                        </th>
                                                        <th class="text-right"
                                                            style="width: 20%;"> {{ trans('label_word.total') }} (<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>)
                                                        </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="row_append">


                                                   
                                                   
                                                    <tr>
                                                        <td> 1
                                                            <input type='hidden' id="bpi_id_{{$data['stock_in_data']->bpi_id}}"
                                                                   name='bpi_id' value="{{$data['stock_in_data']->bpi_id}}">
                                                            <input type='hidden' id='spi_id_{{$data['stock_in_data']->bpi_id}}'
                                                                   name='spi_id'>
                                                        </td>
                                                        <td>
                                                            {{$data['stock_in_data']->buyer_name}}
                                                            <input type='hidden' id="buyer_id_{{$data['stock_in_data']->bpi_id}}"
                                                                   name='buyer_id' value="{{$data['stock_in_data']->bi_buyer_id}}">
                                                        </td>
                                                        <td>
                                                            {{$data['stock_in_data']->gt_type}}
                                                            <input type='hidden' id="goods_id_{{$data['stock_in_data']->bpi_id}}"
                                                                   name='goods_id' value="{{$data['stock_in_data']->bpi_gt_id}}">
                                                        </td>

                                                        <td>
                                                            <input type='hidden' id="bzcp_bzc_id_{{$data['stock_in_data']->bpi_id}}"
                                                                   name='bzcp_bzc_id' value="{{$data['stock_in_data']->bpi_bzc_id}}">
                                                            {{$data['stock_in_data']->gt_hsn_no}}
                                                        </td>

                                                        <td class='hidden-xs'>
                                                            {{$data['stock_in_data']->bpi_weight}}
                                                            <input name='qty' id="qty_{{$data['stock_in_data']->bpi_id}}" type='hidden'
                                                                   value="{{$data['stock_in_data']->bpi_weight}}">
                                                        </td>

                                                        <td class='text-right hidden-xs'
                                                            id="price_kg_{{$data['stock_in_data']->bpi_id}}">
                                                            <i class='fa fa-inr' aria-hidden='true'></i>
                                                            &nbsp;{{$data['stock_in_data']->bpi_bid_price}}
                                                            <input type='hidden' name="price"
                                                                   id="price_{{$data['stock_in_data']->bpi_id}}"
                                                                   value="{{$data['stock_in_data']->bpi_bid_price}}">
                                                            <?php /*if(isset($data['stock_in_data']->setting_kg_price) && !empty($data['stock_in_data']->setting_kg_price)){
                                                                echo $data['stock_in_data']->setting_kg_price;
                                                            }else{
                                                                echo "1/Kg";
                                                            } */?>
                                                        </td>
                                                        <td class='text-right'><i class='fa fa-inr'
                                                                                  aria-hidden='true'></i> &nbsp;<label
                                                                    id="pr_total_{{$data['stock_in_data']->bpi_id}}"></label>
                                                        </td>

                                                    </tr>
                                                   </tbody>
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold">{{ trans('label_word.total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="all_total"><i class="fa fa-inr"
                                                                                                 aria-hidden="true"></i>&nbsp;<label
                                                                    for="all_total"></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right" id="market">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.wages') }}
                                                                :</span>
                                                            <input type="text" style="width: 20%;"
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
                                                        <td colspan="5"></td>
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
                                    <div class="col-xs-11">
                                        <button type="button" id="btn_submit"
                                                class="btn green text-uppercase pull-right">{{ trans('label_word.save') }}
                                        </button>
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
    function saveProduct(id) {

        var spi_si_id = $("#spi_si_id").val();
        var spi_id_local = 'spi_id_local_' + id;
        spi_id_local = localStorage.getItem('spi_id_' + id);
        if (spi_id_local != null && spi_id_local != null) {
            $("#spi_id_" + id).val(spi_id_local);
        }
        var biz_id = $("#company_id").val();
        var seller_id = $("#seller_id").val();
        var spi_invoice_no = $("#spi_invoice_no").val();

        var kg = $('#price_kg_' + id).text().replace('/Kg', '');
        var qty = $("#qty_" + id).val();
        var price = $("#price_" + id).val();
        if (kg != 1) {
            var kg_price = (price * 1) / kg;
        }
        var kg_price = (price * 1);
        var total_price = qty * kg_price;
        var total = total_price.toFixed(2);
        var spi_id = $("#spi_id_" + id).val();
        var bpi_id = $('#bpi_id_' + id).val();
        var buyer_id = $('#buyer_id_' + id).val();
        var bzcp_bzc_id = $('#bzcp_bzc_id_' + id).val();
        var gt_id = $('#goods_id_' + id).val();
        var weight = $('#qty_' + id).val();

        $.ajax({
            url: '<?php echo route('insert_seller_product_invoice');?>',
            method: 'POST',
            data: {
                'bpi_id': bpi_id,
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
                    localStorage.setItem("spi_id_" + id, $obj['spi_id']);
                    //$('input[name^="bpi_id"]').val(($obj['bpi_id']));
                    if (spi_si_id == '') {
                        $("#spi_si_id").val($obj['spi_si_id']);
                        $("#spi_invoice_no").val($obj['spi_invoice_no']);
                    }
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });


        GrantTotal();
    }
    function GrantTotal() {
        var id = [];

        $("table #row_append").find('input[name^="qty"]').each(function () {
            id.push($(this).attr('id').replace("qty_", ""));
        });
        var all_total = 0;
        $.each(id, function (i, val) {
            var kg = $('#price_kg_' + val).text().replace('/Kg', '');
            var qty = $("#qty_" + val).val();
            var price = $("#price_" + val).val();
            if (kg != 1) {
                var kg_price = (price * 1) / kg;
            }
            var kg_price = (price * 1);
            var total_price = qty * kg_price;
            var total = total_price.toFixed(2);
            $("#pr_total_" + val).text(total);
            all_total += total_price;


        });
        $("label[for='all_total']").html(all_total.toFixed(2));
        var wages = $("#market_fee").val();
        var market_fee_val = wages * 1;
        var grantTotal = all_total + market_fee_val;
        $('#grandTotal').text(grantTotal.toFixed(2));
        $('#market_fee_val').text(market_fee_val.toFixed(2));
        $('#grandTotal').text(grantTotal.toFixed(2));
        $("#print").removeClass('hidden');
    }
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
    $("document").ready(function () {
        //localStorage.clear();
        var spi_si_id_local = localStorage.getItem('spi_si_id');
        var spi_invoice_no_local = localStorage.getItem('spi_invoice_no');

        if (spi_si_id_local != null && spi_invoice_no_local != null) {
            $("#spi_si_id").val(spi_si_id_local);
            $("#spi_invoice_no").val(spi_invoice_no_local);
            // $("#error_msg").text("Invalid Credential.");
        }
        var spi_si_id = $("#spi_si_id").val();
        if (spi_si_id == undefined || spi_si_id == '') {
            var biz_id = $("#company_id").val();
            var seller_id = $("#seller_id").val();

            $.ajax({
                url: '<?php echo route('insert_seller_invoice');?>',
                method: 'POST',
                data: {
                    'biz_id': biz_id,
                    'seller_id': seller_id,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);

                    if ($obj['SUCCESS'] == 'TRUE') {
                        //$('input[name^="bpi_id"]').val(($obj['bpi_id']));
                        //if (spi_si_id == '') {
                        $("#spi_si_id").val($obj['spi_si_id']);
                        $("#spi_invoice_no").val($obj['spi_invoice_no']);
                        //}

                        localStorage.setItem("spi_si_id", $obj['spi_si_id']);
                        localStorage.setItem("spi_invoice_no", $obj['spi_invoice_no']);
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });
        }

        var id = [];

        $("table #row_append").find('input[name^="qty"]').each(function () {
            id.push($(this).attr('id').replace("qty_", ""));
        });

        var all_total = 0;
        $.each(id, function (i, val) {
            var kg = $('#price_kg_' + val).text().replace('/Kg', '');
            var qty = $("#qty_" + val).val();
            var price = $("#price_" + val).val();
            if (kg != 1) {
                var kg_price = (price * 1) / kg;
            }
            var kg_price = (price * 1);
            var total_price = qty * kg_price;
            var total = total_price.toFixed(2);
            $("#pr_total_" + val).text(total);
            all_total += total_price;


        });
        $("label[for='all_total']").html(all_total.toFixed(2));
        var wages = $("#market_fee").val();
        var market_fee_val = wages * 1;
        var grantTotal = all_total + market_fee_val;
        $('#grandTotal').text(grantTotal.toFixed(2));
        // saveProduct(id);
        var counter = 0;

        $("#market").on("change", 'input', function (event) {
            GrantTotal();

        });


        $("#btn_submit").click(function () {

            var id = [];

            $("table #row_append").find('input[name^="qty"]').each(function () {
                id.push($(this).attr('id').replace("qty_", ""));
            });
            var all_total = 0;
            $.each(id, function (i, val) {
                var kg = $('#price_kg_' + val).text().replace('/Kg', '');
                var qty = $("#qty_" + val).val();
                var price = $("#price_" + val).val();
                if (kg != 1) {
                    var kg_price = (price * 1) / kg;
                }
                var kg_price = (price * 1);
                var total_price = qty * kg_price;
                var total = total_price.toFixed(2);
                $("#pr_total_" + val).text(total);
                all_total += total_price;

                return saveProduct(val);
            });
            var seller_id = $("#seller_id").val();
            var company_id = $("#company_id").val();
            var spi_id = $('input[name^="spi_id"]').val();
            var spi_si_id = $("#spi_si_id").val();
//return false;
            var bpi_id = [];
            $("table #row_append").find('input[name^="bpi_id"]').each(function () {
                bpi_id.push($(this).val());

            });

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
                        'bpi_id': bpi_id,
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
                            window.location = '<?php echo route('farmer_stock_in_bill_create');?>';
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
    });

</script>
