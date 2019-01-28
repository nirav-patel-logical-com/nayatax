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
                        <span>{{ trans('label_word.farmer_bill_collection') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> {{ trans('label_word.farmer_bill_collection') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN Add Bill Collection-->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-user font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.farmer_bill_collection') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <input type="hidden" id="si_id" value="{{$data['seller_data']->si_id}}" name="si_id">

                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-building"></i>
                                                    <input type="text" class="form-control" id="company" name="company"
                                                           value="{{$data['seller_data']->biz_name}}"
                                                           placeholder="Company Name" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-building"></i>
                                                    <input type="text" class="form-control" id="seller" name="seller"
                                                           value="{{$data['seller_data']->seller_name}}"
                                                           placeholder="Seller Name" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-rupee"></i>
                                                    <input type="text" class="form-control" placeholder="Amount"
                                                           id="total" name="total"
                                                           value="{{$data['seller_data']->si_total}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="margin-top-10">
                                            <div class="col-md-3">
                                                <label>{{ trans('label_word.payment_type') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="radio-list">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="payment_type" id="cash"
                                                               value="Cash"> {{ trans('label_word.cash') }} </label>
                                                    <label class="radio-inline" style="margin-left: -4%">
                                                        <input type="radio" name="payment_type" id="cheque"
                                                               value="Cheque"> {{ trans('label_word.cheque') }} </label>
                                                    <label class="radio-inline" style="margin-left: -4%">
                                                        <input type="radio" name="payment_type" id="dd"
                                                               value="DD"> {{ trans('label_word.dd') }} </label>
                                                    <label class="radio-inline" style="margin-left: -4%">
                                                        <input type="radio" name="payment_type" id="neft"
                                                               value="NEFT"> {{ trans('label_word.neft') }} </label>
                                                    <label class="radio-inline" style="margin-left: -4%">
                                                        <input type="radio" name="payment_type" id="rtgs"
                                                               value="RTGS"> {{ trans('label_word.rtgs') }} </label>
                                                </div>

                                            </div>
                                            <div id="div_payment_type"><p class="help-block pull-right"
                                                                          id="msg_payment_type"></p></div>
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="div_bank">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-building-o"></i>
                                                    <input type="text" class="form-control" id="bank_name"
                                                           name="bank_name"
                                                           placeholder="{{ trans('label_word.bank_name') }}">
                                                </div>
                                                <p class="help-block" id="msg_bank"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="div_ifsc">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-font"></i>
                                                    <input type="text" class="form-control" id="ifsc_code"
                                                           name="ifsc_code"
                                                           placeholder="{{ trans('label_word.ifsc_code') }}">
                                                </div>
                                                <p class="help-block" id="msg_ifsc"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="div_ac_no">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-font"></i>
                                                    <input type="text" class="form-control" id="ac_no" name="ac_no"
                                                           placeholder="{{ trans('label_word.ac_no') }}">
                                                </div>
                                                <p class="help-block" id="msg_ac"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="div_cheque_no">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-font"></i>
                                                    <input type="text" class="form-control" id="cheque_no"
                                                           name="cheque_no"
                                                           placeholder="{{ trans('label_word.cheque_no') }}">
                                                </div>
                                                <p class="help-block" id="msg_cheque"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="div_transction_no">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-font"></i>
                                                    <input type="text" class="form-control" id="transcation_no"
                                                           name="transcation_no"
                                                           placeholder="{{ trans('label_word.transaction_no') }}">
                                                </div>
                                                <p class="help-block" id="msg_transction"></p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="text-right">
                                    <button type="button" id="btnsubmit"
                                            class="btn green">{{ trans('label_word.submit') }}</button>
                                    <a href="<?php echo route('seller_bills_list'); ?>"
                                       class="btn default">{{ trans('label_word.cancel') }}</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END Add Bill Collection-->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN FOOTER -->
    @include('layouts.footer')
    </div>
    <!-- END FOOTER -->
    <script type="text/javascript">
        $("input[name=payment_type]").change(function () {
            var payment_type = $("input[name=payment_type]:checked").val();
            if (payment_type == 'Cash') {
                $("#div_bank").addClass('hidden');
                $("#div_ifsc").addClass('hidden');
                $("#div_ac_no").addClass('hidden');
                $("#div_cheque_no").addClass('hidden');
                $("#div_transction_no").addClass('hidden');
            }
            else {
                $("#div_bank").removeClass('hidden');
                $("#div_ifsc").removeClass('hidden');
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
            $("#div_payment_type").removeClass('has-error');
            $("#msg_payment_type").html("");
        });
        $("#bank_name").focusout(function (e) {
            $("#div_bank").removeClass('has-error');
            $("#msg_bank").html("");
        });
        $("#cheque_no").focusout(function (e) {
            $("#div_cheque_no").removeClass('has-error');
            $("#msg_cheque").html("");
        });
        $("#transcation_no").focusout(function (e) {
            $("#div_transction_no").removeClass('has-error');
            $("#msg_transction").html("");
        });
        $("#ac_no").focusout(function (e) {
            $("#div_ac_no").removeClass('has-error');
            $("#msg_ac").html("");
        });
        $("#ifsc_code").focusout(function (e) {
            $("#div_ifsc").removeClass('has-error');
            $("#msg_ifsc").html("");
        });
        $("#btnsubmit").click(function () {
            var si_id = $("#si_id").val();
            var payment_type = $("input[name=payment_type]:checked").val();
            var bank_name = $("#bank_name").val();
            var cheque_no = $("#cheque_no").val();
            var transction_no = $("#transcation_no").val();
            var ac_no = $("#ac_no").val();
            var ifsc_code = $("#ifsc_code").val();
            var transction_id = '';
            if (payment_type === 'DD' || payment_type === 'Cheque') {
                transction_id = cheque_no;
            } else {
                if (payment_type != 'Cash') {
                    transction_id = transction_no;
                }
            }
            var flag = 0;
            var scroll_element = '';
            if (payment_type == undefined) {
                $("#div_payment_type").addClass('has-error');
                $("#msg_payment_type").html("Please select your payment type. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_payment_type';
                }
            } else if (payment_type != 'Cash') {
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
                    url: '<?php echo route('update_payment_type');?>',
                    method: 'POST',
                    data: {
                        'si_id': si_id,
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
                            window.location = '<?php echo route('seller_bills_list');?>'

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
