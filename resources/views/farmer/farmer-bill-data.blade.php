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
                        <a href="<?php echo route('seller_bills_list_pending');?>">{{ trans('label_word.seller_bill_sidebar_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.seller_bill_sidebar') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.seller_bill_sidebar') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!--Start farmer stock section-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet">
                        <div class="portlet-title" style="background-color: white; border: 1px solid #eee; width:99%">
                            <div class="caption" style="margin-left: 1%;">
                                <i class="fa fa-arrow-up font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.seller_bill_sidebar') }}</span>
                            </div>

                        </div>

                        <div class="portlet-body">
                            <div class="invoice">
                                <div class="col-md-2 col-xs-2 col-sm-2"
                                     style="background-color: white; border: 1px solid #eee;">
                                    <div class="col-md-10 col-xs-10 col-sm-10">

                                        <div class="form-group margin-top-10" id="div_seller_name">
                                            <label for="single-seller"
                                                   class="control-label text-bold">{{ trans('label_word.seller_bill_sidebar') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_name"
                                                   class="control-label ">{{$faramer_details[0]->f_name}}</label>
                                            <input type="hidden" name="seller_id" id="seller_id"
                                                   value="{{$faramer_details[0]->id}}">
                                            <input type="hidden" name="spi_invoice_no" id="spi_invoice_no">
                                            <input type="hidden" name="si_id" id="si_id" value="{{$data[0]->si_id}}">
                                            <input type="hidden" name="date" id="date" value="{{$data[0]->seller_date}}">
                                        </div>

                                        <div class="form-group" id="div_seller_mobile">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.mobile_no') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_mobile"
                                                   class="control-label">{{$faramer_details[0]->mobile}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_city">
                                            <label for="single-city"
                                                   class="control-label text-bold">{{ trans('label_word.city') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_city"
                                                   class="control-label">{{$faramer_details[0]->city}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_state">
                                            <label for="single-state"
                                                   class="control-label text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                            <br>
                                            <label id="seller_state"
                                                   class="control-label">{{$faramer_details[0]->state}}</label>
                                        </div>
                                        <!--<div class="form-group" id="div_seller_goods">
                                            <label for="single-state" class="control-label">Goods&nbsp;Type&nbsp;:</label>
                                            <label id="seller_goods" class="control-label">$data['consignment_data']->gt_type}}</label>
                                            <input type="hidden" name="goods_id" id="goods_id" value="$data['consignment_data']->bzcp_gt_id}}">
                                        </div>-->
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <div class="well" style="background-color: white; border: 1px solid #eee;">
                                                <table class="table table-hover" style="margin: 0;">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 20%;"> {{ trans('label_word.buyer_name') }}</th>
                                                        <th style="width: 20%;"> {{ trans('label_word.good_type_sidebar') }}</th>
                                                        <th style="width: 15%;"> {{ trans('label_word.hsn_no') }}</th>
                                                        <th class='text-center' style="width: 10%;"> {{ trans('label_word.weight') }}</th>
                                                        <th class='text-center' >{{ trans('label_word.price') }}</th>
                                                        <th class='text-center' style="width: 10%;"> {{ trans('label_word.bags') }}</th>
                                                        <th  class='text-right' style="width: 15%;"> {{ trans('label_word.total') }} (<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>)
                                                        </th>


                                                    </tr>
                                                    </thead>
                                                    @foreach($data as  $farmer_bill_data)
                                                        <tbody id="row_append">

                                                        <tr id="row_append_table_tr">
                                                            <td>
                                                                {{$farmer_bill_data->f_name}} {{$farmer_bill_data->l_name}}
                                                            <td>
                                                                {{$farmer_bill_data->gt_type}}

                                                            </td>
                                                            <td>
                                                                {{$farmer_bill_data->gt_hsn_no}}
                                                            </td>

                                                            <td class='text-center'>
                                                                {{$farmer_bill_data->spi_weight}}
                                                            </td>

                                                            <td class='text-center'>
                                                                {{$farmer_bill_data->spi_rate}}

                                                            </td >
                                                            <td class='text-center' style="width: 5%;">
                                                                {{$farmer_bill_data->spi_no_of_bags}}
                                                            </td>

                                                            <td class='text-right' style="width: 15%;">
                                                                {{$farmer_bill_data->spi_total}}
                                                            </td>


                                                        </tr>

                                                        </tbody>

                                                    @endforeach

                                                    <tbody>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold">{{ trans('label_word.total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="all_total"><i class="fa fa-inr"
                                                                                                 aria-hidden="true"></i>&nbsp;<label
                                                                    for="all_total"></label>{{$data[0]->si_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right" id="market">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.wages') }}
                                                                :</span>


                                                        </td>
                                                        <td class="text-right">
                                                            <label
                                                                    id="market_fee_val"
                                                                    for="market_fee_val"></label><i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;{{$data[0]->si_wages}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right" id="market">
                                                            <span style="vertical-align: middle;margin-left: -96px;">{{ trans('label_word.other_charge') }}
                                                                :</span>


                                                        </td>
                                                        <td class="text-right">
                                                            <label
                                                                    id="market_fee_val"
                                                                    for="market_fee_val"></label><i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;{{$data[0]->si_other_charge}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold" style="vertical-align: middle;margin-left: -17px;">{{ trans('label_word.grand_total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right text-bold" style="font-size: 18px;">
                                                            <label id="grandTotal"
                                                                   for="grandTotal"></label><i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;{{$data[0]->si_total}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold" style="vertical-align: middle;margin-left: -96px;">{{ trans('label_word.grand_total_round') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right text-bold" style="font-size: 18px;">
                                                            <label id="grandTotal"
                                                                   for="grandTotal"></label><i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;<?php echo round($data[0]->si_total);?>.00
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <tbody>
                                                    <p class="help-block" id="error_display_msg"></p>
                                                    <p class="help-block" id="error_display_msgs"></p>
                                                    </tbody>

                                                </table>

                                                <?php
                                                $next_date=date('Y-m-d');
                                                if( $data[0]->seller_date != $next_date){
                                                ?>
                                                <div id="print" class="row">
                                                    <div class="col-md-15">
                                                        <div class="form-body">

                                                            <div class="form-group">
                                                                <label class="col-md-2">{{ trans('label_word.payment_type') }}</label>

                                                                <div class="radio-list col-md-9" i>
                                                                    <?php if(isset($data[0]->si_payment_type) && !empty($data[0]->si_payment_type) && $data[0]->si_payment_type=='Cash'){?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span >
                                                                                <input type="radio" name="payment_type"
                                                                                       id="cash"
                                                                                       value="Cash"
                                                                                       checked="checked" >
                                                                            </span>
                                                                        {{ trans('label_word.cash') }}
                                                                    </label>
                                                                    <?php }else{
                                                                    ?>
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
                                                                    <?php
                                                                    } ?>
                                                                    <?php if(isset($data[0]->si_payment_type) && !empty($data[0]->si_payment_type) && $data[0]->si_payment_type=='Cheque'){?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="cheque"
                                                                                       value="Cheque" checked="checked" >
                                                                                  <input type="hidden" id="payment" name="payment" value="1">
                                                                            </span>
                                                                        {{ trans('label_word.cheque') }}
                                                                    </label>
                                                                    <?php }else{
                                                                    ?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="cheque"
                                                                                       value="Cheque">
                                                                            </span>
                                                                        {{ trans('label_word.cheque') }}
                                                                    </label>
                                                                    <?php
                                                                    } ?>
                                                                    <?php if(isset($data[0]->si_payment_type) && !empty($data[0]->si_payment_type) && $data[0]->si_payment_type=='RTGS'){?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="rtgs" value="RTGS" checked="checked">
                                                                            </span>
                                                                        <input type="hidden" id="payment" name="payment" value="1">
                                                                        {{ trans('label_word.rtgs') }}
                                                                    </label>
                                                                    <?php }else{
                                                                    ?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="rtgs" value="RTGS">
                                                                            </span>
                                                                        {{ trans('label_word.rtgs') }}
                                                                    </label>
                                                                    <?php
                                                                    } ?>

                                                                    <?php if(isset($data[0]->si_payment_type) && !empty($data[0]->si_payment_type) && $data[0]->si_payment_type=='NEFT'){?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="neft" value="NEFT" checked="checked">
                                                                            </span>
                                                                        <input type="hidden" id="payment" name="payment" value="1">
                                                                        {{ trans('label_word.neft') }}
                                                                    </label>
                                                                    <?php }else{
                                                                    ?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="neft" value="NEFT">
                                                                            </span>
                                                                        {{ trans('label_word.neft') }}
                                                                    </label>
                                                                    <?php
                                                                    } ?>
                                                                    <?php if(isset($data[0]->si_payment_type) && !empty($data[0]->si_payment_type) && $data[0]->si_payment_type=='DD'){?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="dd" value="DD" checked="checked">
                                                                            </span>
                                                                        <input type="hidden" id="payment" name="payment" value="1">
                                                                        {{ trans('label_word.dd') }}
                                                                    </label>
                                                                    <?php }else{
                                                                    ?>
                                                                    <label class="radio-inline"
                                                                           style="padding-left: 0px;">
                                                                            <span>
                                                                                <input type="radio" name="payment_type"
                                                                                       id="dd" value="DD">
                                                                            </span>
                                                                        {{ trans('label_word.dd') }}
                                                                    </label>
                                                                    <?php
                                                                    } ?>
                                                                    <p class="help-block" id="error_payment_msg"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12 hidden" id="bank_details">
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-5 col-xs-5"
                                                                         id="div_bank">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-building-o"></i>
                                                                            <?php if(isset($data[0]->si_bank_name) && !empty($data[0]->si_bank_name)){?>
                                                                            <input type="text" class="form-control"
                                                                                   id="bank_name" name="bank_name"
                                                                                   placeholder="{{ trans('label_word.bank_name') }}" value="{{$data[0]->si_bank_name}}">
                                                                            <?php }else{
                                                                            ?>
                                                                            <input type="text" class="form-control"
                                                                                   id="bank_name" name="bank_name"
                                                                                   placeholder="{{ trans('label_word.bank_name') }}">
                                                                            <?php
                                                                            } ?>
                                                                            <p class="help-block" id="msg_bank"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 col-xs-5"
                                                                         id="div_ifsc">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <?php if(isset($data[0]->si_ifs_code) && !empty($data[0]->si_ifs_code)){?>
                                                                            <input type="text" class="form-control"
                                                                                   id="ifsc_code" name="ifsc_code"
                                                                                   placeholder="{{ trans('label_word.ifsc_code') }}" value="{{$data[0]->si_ifs_code}}">
                                                                            <?php }else{
                                                                            ?>
                                                                            <input type="text" class="form-control"
                                                                                   id="ifsc_code" name="ifsc_code"
                                                                                   placeholder="{{ trans('label_word.ifsc_code') }}">
                                                                            <?php
                                                                            } ?>
                                                                            <p class="help-block" id="msg_ifsc"></p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5 col-sm-5 col-xs-5 hidden"
                                                                         id="div_ac_no">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <?php if(isset($data[0]->si_ac_no) && !empty($data[0]->si_ac_no)){?>
                                                                            <input type="text" class="form-control"
                                                                                   id="ac_no" name="ac_no"
                                                                                   placeholder="{{ trans('label_word.ac_no') }}" value="{{$data[0]->si_ac_no}}">
                                                                            <?php }else{
                                                                            ?>
                                                                            <input type="text" class="form-control"
                                                                                   id="ac_no" name="ac_no"
                                                                                   placeholder="{{ trans('label_word.ac_no') }}">
                                                                            <?php
                                                                            } ?>
                                                                            <p class="help-block" id="msg_ac"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 col-xs-5 hidden"
                                                                         id="div_cheque_no">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <?php if(isset($data[0]->si_cheque_no) && !empty($data[0]->si_cheque_no)){?>
                                                                            <input type="text" class="form-control"
                                                                                   id="cheque_no" name="cheque_no"
                                                                                   placeholder="{{ trans('label_word.cheque_no') }}" value="{{$data[0]->si_cheque_no}}">
                                                                            <?php }else{
                                                                            ?>
                                                                            <input type="text" class="form-control"
                                                                                   id="cheque_no" name="cheque_no"
                                                                                   placeholder="{{ trans('label_word.cheque_no') }}">
                                                                            <?php
                                                                            } ?>
                                                                            <p class="help-block" id="msg_cheque"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 col-xs-5 hidden"
                                                                         id="div_transction_no">
                                                                        <div class="input-icon margin-top-10">
                                                                            <i class="fa fa-font"></i>
                                                                            <?php if(isset($data[0]->si_cheque_no) && !empty($data[0]->si_cheque_no)){?>
                                                                            <input type="text" class="form-control"
                                                                                   id="transction_no"
                                                                                   name="transction_no"
                                                                                   placeholder="{{ trans('label_word.transaction_no') }}" value="{{$data[0]->si_cheque_no}}">
                                                                            <?php }else{
                                                                            ?>
                                                                            <input type="text" class="form-control"
                                                                                   id="transction_no"
                                                                                   name="transction_no"
                                                                                   placeholder="{{ trans('label_word.transaction_no') }}">
                                                                            <?php
                                                                            } ?>
                                                                            <p class="help-block"
                                                                               id="msg_transction"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php }?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $next_date=date('Y-m-d');
                if($data[0]->seller_date != $next_date){
                ?>
                <div class="row">
                    <div class="col-xs-11">
                        <button type="button" id="btn_submit"
                                class="btn green text-uppercase pull-right">{{ trans('label_word.save') }}
                        </button>
                    </div>
                </div>
                <?php }?>
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

//    $(document).ready(function() {
//        var payment_type = $("input[name=payment_type]:checked").val();
//        if (payment_type != '') {
//
//            if(payment_type == 'Cash'){
//                jQuery("#dd").attr('disabled',true);
//                jQuery("#neft").attr('disabled',true);
//                jQuery("#rtgs").attr('disabled',true);
//                jQuery("#cheque").attr('disabled',true);
//            }else if(payment_type == 'Cheque'){
//                jQuery("#dd").attr('disabled',true);
//                jQuery("#neft").attr('disabled',true);
//                jQuery("#rtgs").attr('disabled',true);
//                jQuery("#cash").attr('disabled',true);
//            }else if(payment_type == 'DD'){
//                jQuery("#neft").attr('disabled',true);
//                jQuery("#rtgs").attr('disabled',true);
//                jQuery("#cash").attr('disabled',true);
//                jQuery("#cheque").attr('disabled',true);
//            }else if(payment_type == 'NEFT'){
//                jQuery("#dd").attr('disabled',true);
//                jQuery("#rtgs").attr('disabled',true);
//                jQuery("#cash").attr('disabled',true);
//                jQuery("#cheque").attr('disabled',true);
//            }else if(payment_type == 'RTGS'){
//                jQuery("#dd").attr('disabled',true);
//                jQuery("#neft").attr('disabled',true);
//                jQuery("#cash").attr('disabled',true);
//                jQuery("#cheque").attr('disabled',true);
//            }
//
//        }
//
//    });
//
//    window.onload = function() {
//
//        var payment_type = $("input[name=payment_type]:checked").val();
//        if (payment_type != '') {
//
//            if(payment_type == 'Cash'){
//                $("#dd").hide();
//                $("#cheque").hide();
//                $("#neft").hide();
//                $("#rtgs").hide();
//
//            }else if(payment_type == 'Cheque'){
//                $("#dd").hide();
//                $("#neft").hide();
//                $("#rtgs").hide();
//                $("#cash").hide();
//                document.getElementById('cash').style.display = 'none';
//            }else if(payment_type == 'DD'){
//                $("#cheque").hide();
//                $("#neft").hide();
//                $("#rtgs").hide();
//                $("#cash").hide();
//            }else if(payment_type == 'NEFT'){
//                $("#dd").hide();
//                $("#cheque").hide();
//                $("#rtgs").hide();
//                $("#cash").hide();
//            }else if(payment_type == 'RTGS'){
//                $("#dd").hide();
//                $("#cheque").hide();
//                $("#neft").hide();
//                $("#cash").hide();
//            }
//            $("input[name=payment_type]").change();
//        }
//    };

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

    $("#btn_submit").on('click',function () {
        var  payment_type = $("input[name=payment_type]:checked").val();
        var si_id= $("#si_id").val();
        var seller_id= $("#seller_id").val();



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
        var date=$("#date").val();
        var payment = $("#payment").val();
        var flag=0;
        if (payment == '' || payment == undefined) {
            payment=0;
        }else{
            payment=1;
        }
        if (payment_type == '' || payment_type == undefined) {

            $("#error_display_msgs").html('Please select any payment type');
            $("#error_display_msgs").css("color","red");
            flag++;
        }
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
                $("#msg_ifsc").html("Please enter your IFSC Code. It's a required Field.");
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
        if(flag !=0){
            return false;
        }
        if(flag==0){
            $('#btn_submit').attr('disabled', 'disabled');
            $.ajax({

                url: '<?php echo route('add_stock_in_data');?>',
                method: 'POST',
                data: {
                    'bank_name': bank_name,
                    'cheque_no': transction_id,
                    'ac_no': ac_no,
                    'ifsc_code': ifsc_code,
                    'payment_type': payment_type,
                    'si_id':si_id,
//                    'payment':payment,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        //var url="seller_bills_list_pending";
                        var url="farmer_bill/" +seller_id + "/"+ date;;
                        //var url="server/nayatax/farmer_bill/" +seller_id;
                        window.location.pathname = url;
                        localStorage.removeItem('spi_si_id_local');
                        localStorage.removeItem('spi_invoice_no_local');
                        localStorage.clear();
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            })
        }
    });

</script>
