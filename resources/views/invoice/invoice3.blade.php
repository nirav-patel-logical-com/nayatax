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
                        <a href="<?php echo route('buyer_bills_list');?>">{{ trans('label_word.buyer_invoice_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{$invoice_data['page_title']}}</span>
                    </li>
                    <br>
                    <h3 class="page-title">Invoice</h3>
                </ul>
                <div class="actions pull-right margin-top-40">
                    <div class="btn-group btn-group-devided">
                        <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                            <i class="fa fa-plus"></i>
                        </button>-->
                        <button id="sample_editable_1_new" onclick="myFunction()" class="btn sbold green add"> Print
                            <i class="fa fa-print"></i>
                        </button>
                        <a id="sample_editable_1_new" class="btn sbold green add"
                           href="{{$invoice_data['buyer_invoice_download']}}" download target="_blank"> Download
                            Invoice
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!--Start In and out section-->
            <!--Start invoice header main section-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="panel">
                        <!--Start Invoice Logo Header-->
                        <div class="page-bar bg-dark-blue">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="text-right invoice-logo-header">
                                        <img src="../assets/layouts/layout/img/naya_tax_invoice_logo.svg" width="150" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Invoice Logo Header-->
                        <!--Start invoice table structure-->
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <!--Start Header Section-->
                                <div class="bg-light-grey in_clnt_hd_sec">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4"><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_subject_name)) { echo "Subject to ";?>{{$invoice_data['buyer_invoice_data']->biz_subject_name}}<?php }?></h4>
                                                <h4 class="nt_h4">GST IN : <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->gstin_no)) { ?>{{$invoice_data['buyer_invoice_data']->gstin_no}}<?php } else { echo "--"; } ?></h4>
                                                <h4 class="nt_h4">PAN NO : <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->pan_no)) { ?>{{$invoice_data['buyer_invoice_data']->pan_no}}<?php } else { echo "--"; } ?></h4>
                                            </td>
                                            <td align="center" style="vertical-align: top;">
                                                <h4 class="nt_h4"><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_market_name)) { ?>{{$invoice_data['buyer_invoice_data']->biz_market_name}}<?php }?></h4>
                                                <h4 class="nt_h4">Upvidhi No.  36 (2) (Puravni-8)</h4>
                                            </td>
                                            <td align="right">
                                                <h4 class="nt_h4"><span>Tel: <a><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_tel_no)) { ?>{{$invoice_data['buyer_invoice_data']->biz_tel_no}}<?php } else { echo "--"; } ?></a></span><br></h4>
                                                <h4 class="nt_h4"><span>(R.) <a> {{$invoice_data['buyer_invoice_data']->mobile}}</a></span></h4>
                                                <h4 class="nt_h4"><span>(M.) <a> <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_tel_no)) { ?>{{$invoice_data['buyer_invoice_data']->biz_mobile}}<?php } else { echo "--"; } ?></a></span></h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <div class="nt_invoice_left_logo">
                                                    <img src="{{$invoice_data['buyer_invoice_data']->image}}" width="70" alt="" />
                                                </div>
                                            </td>
                                            <td align="center">
                                                <h3 class="nt_h3"><strong>{{$invoice_data['buyer_invoice_data']->biz_name}}<?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_nick_name)) { ?><br>({{$invoice_data['buyer_invoice_data']->biz_nick_name}})<?php } ?></strong></h3>
                                                <h4 class="nt_h4"><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_nick_name)) { ?>{{$invoice_data['buyer_invoice_data']->biz_type}}<?php } ?></h4>
                                                <h4 class="nt_h4">
                                                    {{$invoice_data['buyer_invoice_data']->address1}},
                                                    <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->address2)) { ?>
                                                    {{$invoice_data['buyer_invoice_data']->address2}}<?php } ?>
                                                    {{$invoice_data['buyer_invoice_data']->city}}, {{$invoice_data['buyer_invoice_data']->district}},{{$invoice_data['buyer_invoice_data']->state}}.
                                                </h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <div class="nt_vouchar_sec text-uppercase text-center">
                                                    <span>Paymant Voucher</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Bill No. {{$invoice_data['buyer_invoice_data']->bi_invoice_no}}</h4>
                                            </td>
                                            <td align="right">
                                                <h4 class="nt_h4">Date <?php echo date("d-m-Y", strtotime($invoice_data['buyer_invoice_data']->bi_add_date));?></h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <hr style="margin: 5px 0;">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!--End Header Section-->
                                <div class="nt_invoice_far_sec">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Buyer's Name : {{$invoice_data['buyer_invoice_data']->buyer_name}}</h4>
                                            </td>
                                            <td>
                                                <h4 class="nt_h4 text-right">GST IN : <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->buyer_gstin_no)) { ?>{{$invoice_data['buyer_invoice_data']->buyer_gstin_no}}<?php } else { echo "--"; } ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Village : {{$invoice_data['buyer_invoice_data']->buyer_city}}</h4>
                                            </td>
                                            <td>
                                                <h4 class="nt_h4 text-right">State : {{$invoice_data['buyer_invoice_data']->buyer_state}}</h4>
                                            </td>
                                            <?php
                                            if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->buyer_gstin_no)) {
                                                $str = $invoice_data['buyer_invoice_data']->buyer_gstin_no;
                                                $code = str_split("$str",2);
                                                $code = $code[0];
                                            } else { $code='---'; }
                                            ?>
                                            <td>
                                                <h4 class="nt_h4 text-right">Code No. : <?php echo $code; ?></h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <hr style="margin: 10px 0;">
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Farmer's name : {{$invoice_data['buyer_invoice_data']->farmer_name}}</h4>
                                            </td>
                                            <td></td>
                                            <td>
                                                <h4 class="nt_h4 text-right">GST IN : <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->seller_gstin_no)) { ?>{{$invoice_data['buyer_invoice_data']->seller_gstin_no}}<?php } else { echo "--"; } ?></h4>
                                            </td>
                                        </tr>
                                    </table>


                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <hr style="margin: 10px 0;">
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-hover" style="margin: 0;">
                                        <thead class="text-uppercase nt_inv_cat_hdr">
                                        <tr>
                                            <th>SR.&nbsp;NO.</th>
                                            <th>Goods&nbsp;Type</th>
                                            <th>HSN&nbsp;No.</th>
                                            <th>Qty</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">CGST</th>
                                            <th class="text-right">SGST</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $n = 0; ?>
                                        @foreach($invoice_data['buyer_product_invoice_data'] as $item)
                                            <?php $n++; ?>
                                        <tr>
                                            <td>{{$n}}</td>
                                            <td>{{$item->gt_type}}</td>
                                            <td>{{$item->gt_hsn_no}}</td>
                                            <td>{{$item->bpi_weight}}</td>
                                            <td class="text-right">{{$item->bpi_amount}}</td>
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                            <td class="text-right">CGST:({{$item->bpi_cgst}}%)&nbsp;{{$item->bpi_cgst_price}}</td>
                                            <td class="text-right">SGST:({{$item->bpi_sgst}}%)&nbsp;{{$item->bpi_sgst_price}}</td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                            <td class="text-right">IGST:({{$item->bpi_igst}}%)&nbsp;{{$item->bpi_igst_price}}</td>
                                            <?php } ?>
                                            <td class="text-right">{{$item->bpi_total}}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="bg-f5f5f5">
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                                <td colspan="6"></td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                                <td colspan="5"></td>
                                            <?php } ?>
                                            <td class="text-right"><strong class="text-x">Subtotal</strong></td>
                                            <td class="text-right"><strong class="text-x">{{$invoice_data['buyer_invoice_data']->bi_amount}}</strong></td>
                                        </tr>
                                        <tr class="bg-f5f5f5">
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                                <td colspan="6"></td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                                <td colspan="5"></td>
                                            <?php } ?>
                                            <td class="text-right">Commission&nbsp;:&nbsp;({{$invoice_data['buyer_invoice_data']->bi_comission}}&nbsp;%)</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bi_commission_price}}</td>
                                        </tr>
                                        <tr class="bg-f5f5f5">
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                                <td colspan="6"></td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                                <td colspan="5"></td>
                                            <?php } ?>
                                            <td class="text-right">Market Fee&nbsp;:&nbsp;({{$invoice_data['buyer_invoice_data']->bi_market_fee}}&nbsp;%)</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bi_market_fee_per}}</td>
                                        </tr>
                                        <tr class="bg-f5f5f5">
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                                <td colspan="6"></td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                                <td colspan="5"></td>
                                            <?php } ?>
                                            <td class="text-right"><strong class="text-x">Total&nbsp;Amount</strong></td>
                                            <td class="text-right"><strong class="text-x">{{$invoice_data['buyer_invoice_data']->bi_total}}</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <hr style="margin: 5px 0;">
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Amount Chargeable (in words)</h4>
                                                <h4 class="nt_h4"><strong>{{$invoice_data['buyer_invoice_data']->grand_total_word}}</strong></h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <hr style="margin: 5px 0 20px 0;">
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" class="table-bordered">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4 text-center">Tax Paybal Under Revarse Charge</h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" class="table table-bordered nt_tax_table">
                                        <tr>
                                            <td rowspan="2" class="text-center">HSN CODE</td>
                                            <td rowspan="2" class="text-center">TAXABLE<br>VALUE</td>
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                            <td colspan="2" class="text-center">CENTRAL TAX</td>
                                            <td colspan="2" class="text-center">STATE TAX</td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                            <td colspan="2" class="text-center">INTER STATE TAX</td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                                <td class="text-center">Rate</td>
                                                <td class="text-center">Amount</td>
                                                <td class="text-center">Rate</td>
                                                <td class="text-center">Amount</td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                                <td class="text-center">Rate</td>
                                                <td class="text-center">Amount</td>
                                            <?php } ?>

                                        </tr>
                                        <tr>
                                            <td>{{$invoice_data['buyer_invoice_data']->hsn_no}}</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bi_amount}}</td>
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bpi_cgst}}</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bpi_cgst_price}}</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bpi_sgst}}</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bpi_sgst_price}}</td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bpi_igst}}</td>
                                            <td class="text-right">{{$invoice_data['buyer_invoice_data']->bpi_igst_price}}</td>
                                            <?php } ?>

                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>TOTAL</strong></td>
                                            <td class="text-right"><strong>{{$invoice_data['buyer_invoice_data']->bi_total}}</strong></td>
                                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                                            <td class="text-right"></td>
                                            <td class="text-right"><strong>{{$invoice_data['buyer_invoice_data']->bpi_cgst_price}}</strong></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"><strong>{{$invoice_data['buyer_invoice_data']->bpi_sgst_price}}</strong></td>
                                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                                            <td class="text-right"></td>
                                            <td class="text-right"><strong>{{$invoice_data['buyer_invoice_data']->bpi_igst_price}}</strong></td>
                                            <?php } ?>

                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Amount Chargeable (in words) : <strong>{{$invoice_data['buyer_invoice_data']->grand_total_word}}</strong></h4>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" class="nt_signatur_sec">
                                        <tr>
                                            <td>
                                                <h4 class="nt_h4">Buyer's Signature </h4>
                                            </td>
                                            <td align="right" style="vertical-align: top;">
                                                <h4 class="nt_h4">{{$invoice_data['buyer_invoice_data']->biz_name}}</h4>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--End invoice table structure-->
                    </div>
                </div>
            </div>
            <!--End invoice header main section-->
            <!--End In and out section-->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('footer')
<!-- END FOOTER -->
<style type="text/css">
    div.radio span.checked {
        background-position: -74px -281px;
    }
</style>
<script>
    function myFunction() {
        window.print();
    }
</script>

