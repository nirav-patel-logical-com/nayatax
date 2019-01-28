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
                                     style="background-color: white; border: 1px solid #eee;">
                                    <div class="col-md-12 col-xs-12 col-sm-12">

                                        <div class="form-group  margin-top-10" id="div_buyer_name">
                                            <label for="single-buyer"
                                                   class="control-label text-bold">{{ trans('label_word.buyer_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="buyer_name"
                                                   class="control-label">{{$data['stock_out_data']->buyer_name}}</label>
                                            <input type="hidden" name="buyer_id" id="buyer_id"
                                                   value="{{$data['stock_out_data']->spi_buyer_id}}">
                                            <input type="hidden" name="spi_id" id="spi_id"
                                                   value="{{$data['stock_out_data']->spi_id}}">
                                            <input type="hidden" name="bpi_bi_id" id="bpi_bi_id">
                                            <input type="hidden" name="bpi_invoice_no" id="bpi_invoice_no">


                                        </div>
                                        <div class="form-group" id="div_buyer_company">
                                            <label for="single-comapny"
                                                   class="control-label text-bold">{{ trans('label_word.company_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <input type="hidden" name="company_id" id="company_id"
                                                   value="{{$data['stock_out_data']->spi_biz_id}}">
                                            <input type="hidden" name="company_commission" id="company_commission"
                                                   value="{{$data['stock_out_data']->biz_comission}}">
                                            <label id="buyer_company"
                                                   class="control-label">{{$data['stock_out_data']->biz_name}}</label>
                                        </div>
                                        <div class="form-group" id="div_buyer_mobile">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.mobile_no') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="buyer_mobile"
                                                   class="control-label">{{$data['stock_out_data']->mobile}}</label>
                                        </div>
                                        <div class="form-group" id="div_buyer_city">
                                            <label for="single-city"
                                                   class="control-label text-bold">{{ trans('label_word.city') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="buyer_city"
                                                   class="control-label">{{$data['stock_out_data']->city}}</label>
                                        </div>
                                        <div class="form-group" id="div_buyer_state">
                                            <label for="single-state"
                                                   class="control-label text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                            <br>
                                            <label id="buyer_state"
                                                   class="control-label">{{$data['stock_out_data']->state}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9" style="margin-left: 10px;">
                                    <div class="row">
                                        <div class="col-md-15 col-xs-15 col-sm-15" style="width: 111%;">
                                            <div class="well" style="background-color: white; border: 1px solid #eee;">
                                                <table class="table table-hover" style="margin: 0;">
                                                    <thead>
                                                    <tr>
                                                        <th width="1px">{{ trans('label_word.id') }}</th>
                                                        <th width="80px">{{ trans('label_word.farmer_name') }}</th>
                                                        <th width="70px">{{ trans('label_word.good_type_sidebar') }}</th>
                                                        <th width="60px">{{ trans('label_word.hsn_no') }}</th>
                                                        <th width="60px"
                                                            class="hidden-xs">{{ trans('label_word.sold_qty') }}</th>
                                                        <th width="60px"
                                                            class="text-right">{{ trans('label_word.sold_price') }}</th>
                                                        <th width="30px"
                                                            class="text-right">{{ trans('label_word.price') }} &nbsp;<i
                                                                    class="fa fa-inr" aria-hidden="true"></i></th>

                                                        <?php if($data['stock_out_data']->state == 'Gujarat'){ ?>
                                                        <th width="20px"
                                                            class="text-right ">{{ trans('label_word.cgst') }}</th>
                                                        <th width="20px"
                                                            class="text-right ">{{ trans('label_word.sgst') }}</th>
                                                        <?php }elseif($data['stock_out_data']->state != 'Gujarat'){?>
                                                        <th width="20px"
                                                            class="text-right ">{{ trans('label_word.igst') }}</th>
                                                        <?php } ?>
                                                        <th width="50px"
                                                            class="text-right">{{ trans('label_word.total') }}(<i
                                                                    class="fa fa-inr" aria-hidden="true"></i>)
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="row_append">
                                                    <tr>
                                                        <td width="10px">1</td>
                                                        <td width="50px">{{$data['stock_out_data']->seller_name}}
                                                            <input type="hidden" name="seller_id" id="seller_id"
                                                                   value="{{$data['stock_out_data']->si_saller_id}}">
                                                            <input type="hidden" name="bpi_id" id="bpi_id">
                                                            <input type="hidden" name="bzcp_bzc_id" id="bzcp_bzc_id"
                                                                   value="{{$data['stock_out_data']->spi_bzc_id}}">
                                                        </td>
                                                        <td width="20px">{{$data['stock_out_data']->gt_type}}
                                                            <input type="hidden" name="gt_id" id="gt_id"
                                                                   value="{{$data['stock_out_data']->spi_gt_id}}"></td>
                                                        <td width="20px">{{$data['stock_out_data']->gt_hsn_no}}</td>
                                                        <td width="20px" class="hidden-xs"
                                                            id="qty">{{$data['stock_out_data']->spi_weight}}</td>
                                                        <td width="50px" class="text-right"
                                                            id="price">{{$data['stock_out_data']->spi_rate}}</td>
                                                        <td width="30px" class="text-right" id="total_price"></td>

                                                        <?php if($data['stock_out_data']->state == 'Gujarat'){ ?>
                                                        <td width="20px" class="text-right ">(<span
                                                                    id="td_cgst">{{$data['stock_out_data']->gt_cgst_tax}}</span>&nbsp;%)&nbsp;&nbsp;<span
                                                                    id="cgst_val"></span>
                                                        </td>
                                                        <td width="20px" class="text-right ">(<span
                                                                    id="td_sgst">{{$data['stock_out_data']->gt_sgst_tax}}</span>&nbsp;%)&nbsp;&nbsp;<span
                                                                    id="sgst_val"></span>
                                                        </td>
                                                        <?php }elseif($data['stock_out_data']->state != 'Gujarat'){?>
                                                        <td width="20px" class="text-right ">(<span
                                                                    id="td_igst">{{$data['stock_out_data']->gt_igst_tax}}</span>&nbsp;%)&nbsp;&nbsp;<span
                                                                    id="igst_val"></span>
                                                        </td>
                                                        <?php } ?>

                                                        <td width="50px" class="text-right"><i class="fa fa-inr"
                                                                                               aria-hidden="true"></i>&nbsp;<span
                                                                    id="td_total"></span>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                    <tbody>
                                                    <tr>
                                                        <?php if($data['stock_out_data']->state === 'Gujarat'){ ?>
                                                        <td colspan="8" class=""></td>
                                                        <?php }elseif($data['stock_out_data']->state != 'Gujarat'){?>
                                                        <td colspan="9" class="hidden"></td>
                                                        <?php } ?>

                                                        <td class="text-right">
                                                            <span class="text-bold">{{ trans('label_word.total_amount') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="all_total"><i class="fa fa-inr"
                                                                                                 aria-hidden="true"></i>&nbsp;<label
                                                                    for="all_total"></label></td>
                                                    </tr>
                                                    <tr>
                                                        <?php if($data['stock_out_data']->state === 'Gujarat'){ ?>
                                                        <td colspan="8" class=""></td>
                                                        <?php }elseif($data['stock_out_data']->state != 'Gujarat'){?>
                                                        <td colspan="9" class="hidden"></td>
                                                        <?php } ?>
                                                        <td class="text-right">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.commission') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <label id="commission_per"
                                                                   for="commission_per"
                                                                   class="pull-left">{{$data['stock_out_data']->biz_comission}}</label>&nbsp;<label
                                                                    class="control-label pull-left">(%)</label>&nbsp;<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;<label id="commission"
                                                                                                        for="commission"></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <?php if($data['stock_out_data']->state === 'Gujarat'){ ?>
                                                        <td colspan="8" class=""></td>
                                                        <?php }elseif($data['stock_out_data']->state != 'Gujarat'){?>
                                                        <td colspan="9" class="hidden"></td>
                                                        <?php } ?>
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
                                                        <?php if($data['stock_out_data']->state === 'Gujarat'){ ?>
                                                        <td colspan="8" class=""></td>
                                                        <?php }elseif($data['stock_out_data']->state != 'Gujarat'){?>
                                                        <td colspan="9" class="hidden"></td>
                                                        <?php } ?>
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
<script>

    $(document).ready(function () {
        total();
    });
    $("#market").on("change", 'input', function (event) {
        GrantTotal();
    });
    function GrantTotal() {

        var grandTotal = $('#grandTotal').text();
        var commission = $("#company_commission").val();
        var all_total = $('#all_total').text();
        var market_fee = $("#market_fee").val();
        var market_fee_val = (all_total * market_fee) / 100;
        grandTotal = (+grandTotal + +market_fee_val);
        $('#grandTotal').text(grandTotal.toFixed(2));
        $('#market_fee_val').text(market_fee_val.toFixed(2));

    }

    function total() {
        var qty = $("#qty").text();
        var price = $("#price").text();
        var total = qty * price;
        $('#total_price').text(total.toFixed(2));
        var cgst_per = $("#td_cgst").text();
        var sgst_per = $("#td_sgst").text();
        var igst_per = $("#td_igst").text();
        var cgst = ((total * cgst_per) / 100);
        var sgst = ((total * sgst_per) / 100);
        var igst = ((total * igst_per) / 100);
        $('#cgst_val').text(cgst.toFixed(2));
        $('#sgst_val').text(sgst.toFixed(2));
        $('#igst_val').text(igst.toFixed(2));
        var total_price = total + cgst + sgst + igst;
        $('#td_total').text(total_price.toFixed(2));
        $('#all_total').text(total_price.toFixed(2));
        var commission = $("#company_commission").val();
        var commission_val = ((total_price * commission) / 100);
        var market_fee = $("#market_fee").val();
        var market_fee_val = (total_price * market_fee) / 100;
        var grantTotal = (total_price + (commission_val) + market_fee_val);
        $('#commission_per').text(commission);
        $('#commission').text(commission_val.toFixed(2));
        $('#grandTotal').text(grantTotal.toFixed(2));
        $('#market_fee_val').text(market_fee_val.toFixed(2));
    }

    $("#btn_submit").click(function () {
        var buyer_id = $("#buyer_id").val();
        var spi_id = $("#spi_id").val();
        var company_id = $("#company_id").val();
        var bpi_bi_id = $("#bpi_bi_id").val();
        var biz_id = $("#company_id").val();
        var bpi_bi_id = $("#bpi_bi_id").val();
        var buyer_id = $("#buyer_id").val();
        var bzcp_bzc_id = $("#bzcp_bzc_id").val();
        var bpi_id = $("#bpi_id").val();
        var seller_id = $("#seller_id").val();
        var gt_id = $("#gt_id").val();
        var bpi_invoice_no = $("#bpi_invoice_no").val();
        var qty = $("#qty").text();
        var price = $("#price").text();
        var total = qty * price;
        var cgst_per = $("#td_cgst").text();
        var sgst_per = $("#td_sgst").text();
        var igst_per = $("#td_igst").text();
        var cgst = ((total * cgst_per) / 100);
        var sgst = ((total * sgst_per) / 100);
        var igst = ((total * igst_per) / 100);
        var total_price = total + cgst + sgst + igst;

        var commission = $("#company_commission").val();
        var amount = $('#all_total').text();
        var commission_val = (((amount * commission) / 100).toFixed(2));
        var market_fee = $("#market_fee").val();
        var grand_total = $("label[for='grandTotal']").text();
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
            $.ajax({
                url: '<?php echo route('insert_product_invoice');?>',
                method: 'POST',
                async: false,
                data: {
                    'bpi_id': bpi_id,
                    'spi_id': spi_id,
                    'bpi_bi_id': bpi_bi_id,
                    'bpi_biz_id': biz_id,
                    'bpi_buyer_id': buyer_id,
                    'bpi_saller_id': seller_id,
                    'bpi_gt_id': gt_id,
                    'bpi_bzc_id': bzcp_bzc_id,
                    'bpi_weight': qty,
                    'bpi_bid_price': price,
                    'bpi_cgst': cgst_per,
                    'bpi_sgst': sgst_per,
                    'bpi_igst': igst_per,
                    'bpi_cgst_price': cgst,
                    'bpi_sgst_price': sgst,
                    'bpi_igst_price': igst,
                    'bpi_amount': total,
                    'bpi_total': total_price,
                    'bpi_invoice_no': bpi_invoice_no,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#bpi_id").val($obj['bpi_id']);
                        bpi_id = $obj['bpi_id'];
                        bpi_bi_id = $obj['bpi_bi_id'];
                        if (bpi_bi_id == '') {
                            $("#bpi_bi_id").val($obj['bpi_bi_id']);
                            $("#bpi_invoice_no").val($obj['bpi_invoice_no']);
                        }
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });
            $('#btn_submit').attr('disabled', 'disabled');
            $.ajax({
                url: '<?php echo route('add_stock_out_data');?>',
                method: 'POST',
                data: {
                    'buyer_id': buyer_id,
                    'spi_id': spi_id,
                    'company_id': company_id,
                    'bpi_bi_id': bpi_bi_id,
                    'farmer_id': seller_id,
                    'gt_id': gt_id,
                    'bpi_id': bpi_id,
                    'bzcp_bzc_id': bzcp_bzc_id,
                    'amount': total_price,
                    'commission': commission,
                    'commission_val': commission_val,
                    'market_fee': market_fee,
                    'bi_market_fee_per': market_fee_val,
                    'total': grand_total,
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
                        var bi_id = $obj['bpi_bi_id']
                        window.location = "<?php echo route('buyer_bills_list');?>";
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
</script>

