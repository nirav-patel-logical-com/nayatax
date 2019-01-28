
<?php $add_path='';
if(Request::segment(2) != ''){
    $add_path = '../';
}?>

<link href="https://nayatax.com/assets/bsp-layouts/css/bsp-style.css" rel="stylesheet" type="text/css" />
<style>
    .text-bold{
        font-weight: bold !important;
    }
    .td_padding{
        padding: 5px;
    }
    body{
        background-color: #FFF !important;
    }

    /*Start Custom css*/

    .page-container-bg-solid .page-bar, .page-content-white .page-bar{
        background-color: #f1f2f7;
    }
    .page-sidebar .page-sidebar-menu > li.active > a > .selected, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a > .selected{
        border-right: 12px solid #f1f2f7;
    }

    .page-header.navbar .top-menu .navbar-nav > li.dropdown .dropdown-toggle:hover, .page-header.navbar .top-menu .navbar-nav > li.dropdown.open .dropdown-toggle{
        background-color: #f1f2f7;
    }
    .page-header.navbar .top-menu .navbar-nav > li.dropdown-language > .dropdown-toggle > .langname, .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > .username, .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > i{
        color: #364150;
    }
    .page-sidebar .page-sidebar-menu > li.active.open > a, .page-sidebar .page-sidebar-menu > li.active > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a{
        background: #e67e22;
    }

    .page-sidebar .page-sidebar-menu > li.active.open > a:hover, .page-sidebar .page-sidebar-menu > li.active > a:hover, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a:hover, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a:hover{
        background: #d37422;
    }

    .nt_h5 {
        font-size: 10px !important;
        font-weight:normal !important;
        margin-top: 2px !important;
        margin-bottom: 2px !important;
    }
    .nt_h4 {
        font-size: 12px;
        font-weight:normal !important;
        margin-top: 2px !important;
        margin-bottom: 2px !important;
    }
    .nt_h4_2 {
        font-size: 12px;
        font-weight:normal !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
    .nt_h3{
        font-size: 15px;
        font-weight:normal !important;
        margin-top: 10px !important;
        margin-bottom: 10px !important;
    }
    .bg-f5f5f5{
        background-color: #f5f5f5;
    }
    .text-x{
        font-size: 12px;
    }
    .nt_vouchar_sec{
        margin: 15px 0;
    }

    .nt_vouchar_sec span{
        alignment: center;
        border: 1px solid #3a3a3a;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: underline;
    }
    .table thead tr th{
        font-size: 12px;
        font-weight: 500;
        line-height: 1.4 !important;
        padding:2px;
    }
    .table td, .table th{
        font-size: 12px;
        line-height: 1.4 !important;
        padding:2px;
    }
    .nt_th_center thead tr th{
        text-align: center;
        line-height: 1.4 !important;
        padding:2px;
    }
    .nt_tax_table>tbody>tr>td, .nt_tax_table>tbody>tr>th, .nt_tax_table>tfoot>tr>td, .nt_tax_table>tfoot>tr>th, .nt_tax_table>thead>tr>td, .nt_tax_table>thead>tr>th{
        padding: 3px !important;
        font-size: 11px !important;
    }

    .invoice-logo-header img{
        margin-top: 30px;
    }

    .in_clnt_hd_sec{
        padding: 0px 15px;
    }
    .nt_invoice_left_logo{
        position: absolute;
        margin-top: -30px;
    }
    .nt_invoice_far_sec{
        padding: 0px 15px;
    }
    .nt_inv_cat_hdr{
        background-color: #e67e22;
        color: white;
    }
    .nt_signatur_sec{
        margin-top: 10px;
        margin-bottom: 20px;
    }
    table.table-bordered{
        border: 1px solid #e7ecf1;
    }

    /* table.table-bordered, .table-bordered tr td{
         border-right: 1px solid #e7ecf1;
         border-bottom: 1px solid #e7ecf1;
     }
     .table-bordered tr:last-child {
         border-right: none;
         border-bottom: none;
     }*/
    .td_border_bottom{
        border-bottom: 1px solid #e7ecf1;
    }
    .td_border_right{
        border-right: 1px solid #e7ecf1;
    }


    /*End Custom css*/
</style>
<!-- BEGIN CONTENT -->

<!-- END PAGE BAR -->
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!--Start In and out section-->
<!--Start invoice header main section-->
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="panel">

            <!--Start invoice table structure-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <!--Start Header Section-->
                    <div class="in_clnt_hd_sec">
                        <table width="100%">
                            <tr>
                                <td width="30%" lang="gu">
                                    <h4 class="nt_h4"><?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->biz_subject_name)) { echo "Subject to ";?>{{$invoice_data['seller_invoice_data']->biz_subject_name}}<?php }?></h4>
                                    <h4 class="nt_h4">GST IN : <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->gstin_no)) { ?>{{$invoice_data['seller_invoice_data']->gstin_no}}<?php } else { echo "--"; } ?></h4>
                                    <h4 class="nt_h4">PAN NO : <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->pan_no)) { ?>{{$invoice_data['seller_invoice_data']->pan_no}}<?php } else { echo "--"; } ?></h4>
                                </td>
                                <td align="center" style="vertical-align: top;" lang="gu">
                                    <h4 class="nt_h4"><?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->biz_market_name)) { ?>{{$invoice_data['seller_invoice_data']->biz_market_name}}<?php }?></h4>
                                    <h4 class="nt_h4">Upvidhi No.  36 (2) (Puravni-8)</h4>
                                </td>
                                <td align="right" lang="gu">
                                    <h4 class="nt_h4"><span>Tel: <a><?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->biz_tel_no)) { ?>{{$invoice_data['seller_invoice_data']->biz_tel_no}}<?php } else { echo "--"; } ?></a></span><br></h4>
                                    <h4 class="nt_h4"><span>(R.) <a> {{$invoice_data['seller_invoice_data']->mobile}}</a></span></h4>
                                    <h4 class="nt_h4"><span>(M.) <a> <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->biz_tel_no)) { ?>{{$invoice_data['seller_invoice_data']->biz_mobile}}<?php } else { echo "--"; } ?></a></span></h4>
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td width="5%">
                                    <div>
                                        <img src="{{$invoice_data['seller_invoice_data']->image}}" width="70" alt="" />
                                    </div>
                                </td>
                                <td align="center" lang="gu">
                                    <h3 class="nt_h3"><strong>{{$invoice_data['seller_invoice_data']->biz_name}}<?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->biz_nick_name)) { ?><br>({{$invoice_data['seller_invoice_data']->biz_nick_name}})<?php } ?></strong></h3>
                                    <h4 class="nt_h4"><?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->biz_nick_name)) { ?>{{$invoice_data['seller_invoice_data']->biz_type}}<?php } ?></h4>
                                    <h4 class="nt_h4">
                                        {{$invoice_data['seller_invoice_data']->address1}},
                                        <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->address2)) { ?>
                                        {{$invoice_data['seller_invoice_data']->address2}}<?php } ?>
                                        {{$invoice_data['seller_invoice_data']->city}}, {{$invoice_data['seller_invoice_data']->district}},{{$invoice_data['seller_invoice_data']->state}}.
                                    </h4>
                                </td>

                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td></td>
                                <td width="56%">
                                    <span style="border: 1px solid #3a3a3a;padding: 4px 10px; font-size: 13px;font-weight: 600;text-decoration: underline;">PAYMENT VOUCHER</span>
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <h4 class="nt_h4">Bill No. {{$invoice_data['seller_invoice_data']->si_invoice_no}}</h4>
                                </td>
                                <td align="right">
                                    <h4 class="nt_h4">Date <?php echo date("d-m-Y", strtotime($invoice_data['seller_invoice_data']->si_add_date));?></h4>
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
                                <td lang="gu">
                                    <h4 class="nt_h4">Farmer's Name : {{$invoice_data['seller_invoice_data']->seller_name}}</h4>
                                </td>
                                <td align="center">
                                </td>
                                <td align="right">
                                    <h4 class="nt_h4">GST IN : <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->seller_gstin_no)) { ?>{{$invoice_data['seller_invoice_data']->seller_gstin_no}}<?php } else { echo "--"; } ?></h4>
                                </td>
                            </tr>
                            <tr>
                                <td lang="gu">
                                    <h4 class="nt_h4">Village : {{$invoice_data['seller_invoice_data']->seller_city}}</h4>
                                </td>
                                <td align="center" lang="gu">
                                    <h4 class="nt_h4">State : {{$invoice_data['seller_invoice_data']->seller_state}}</h4>
                                </td>
                                <?php
                                if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->seller_gstin_no)) {
                                    $str = $invoice_data['seller_invoice_data']->seller_gstin_no;
                                    $code = str_split("$str",2);
                                    $code = $code[0];
                                } else { $code='---'; }
                                ?>
                                <td align="right">
                                    <h4 class="nt_h4">Code No. : <?php echo $code; ?></h4>
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
                                <td lang="gu">

                                </td>
                                <td align="right">
                                    <h4 class="nt_h4 text-right">GST IN : <?php if(isset($invoice_data['seller_product_invoice_data']) && !empty($invoice_data['seller_product_invoice_data']->buyer_gstin_no)) { ?>{{$invoice_data['seller_product_invoice_data']->buyer_gstin_no}}<?php } else { echo "--"; } ?></h4>
                                </td>
                            </tr>
                        </table>


                        <table width="100%">
                            <tr>
                                <td>
                                    <hr style="margin-top: 10px;margin-bottom: 2px;">
                                </td>
                            </tr>
                        </table>
                        <table class="table table-hover" style="margin: 0;" width="100%">
                            <thead class="text-uppercase nt_inv_cat_hdr">
                            <tr>
                                <th align="left">SR.&nbsp;NO.</th>
                                <th align="left">Buyer's Name</th>
                                <th align="left">Goods&nbsp;Type</th>
                                <th align="left">HSN&nbsp;No.</th>
                                <th align="right">Qty</th>
                                <th align="right" class="text-right">Price</th>
                                <th align="right" class="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($invoice_data['seller_product_invoice_data'] as $seller_product_invoice_data)

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td lang="gu"> {{$seller_product_invoice_data->buyer_name}}</td>
                                    <td lang="gu"> {{$seller_product_invoice_data->gt_type}}</td>
                                    <td>{{$seller_product_invoice_data->gt_hsn_no}}</td>
                                    <td class="text-right" align="right">{{$seller_product_invoice_data->spi_weight}}</td>
                                    <td class="text-right" align="right">
                                        {{$seller_product_invoice_data->spi_rate}}
                                    </td>
                                    <td class="text-right" align="right">&nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$seller_product_invoice_data->spi_total}}
                                    </td>
                                    <?php $i=$i+1;?>
                                </tr>
                            @endforeach

                            <tr class="bg-f5f5f5">
                                <td colspan="4"></td>
                                <td align="right" class="text-right"><strong class="text-x">Subtotal</strong></td>
                                <td align="right" class="text-right"><strong class="text-x">{{$invoice_data['seller_invoice_data']->si_amount}}</strong></td>
                            </tr>
                            <tr class="bg-f5f5f5">
                                <td colspan="4"></td>
                                <td align="right" class="text-right">Wages&nbsp;:</td>
                                <td align="right" class="text-right">{{$invoice_data['seller_invoice_data']->si_wages}}</td>
                            </tr>
                            <tr class="bg-f5f5f5">
                                <td colspan="4"></td>
                                <td align="right" class="text-right"><strong class="text-x">Total&nbsp;Amount</strong></td>
                                <td align="right" class="text-right"><strong class="text-x">{{$invoice_data['seller_invoice_data']->si_total}}</strong></td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <hr style="margin: -5px 0 20px 0;">
                                </td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <h4 class="nt_h4">Amount Chargeable (in words)</h4>
                                    <h4 class="nt_h4"><strong>INR {{$invoice_data['seller_invoice_data']->grand_total_word}}</strong></h4>
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
                                <td align="center">
                                    <h4 class="nt_h4_2 text-center">Tax Paybal Under Revarse Charge</h4>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" class="table table-bordered nt_tax_table">
                            <tr>
                                <td align="center" class="td_border_bottom td_border_right text-center"><h4 class="nt_h5 text-center">HSN CODE</h4></td>
                                <td align="center"  class="td_border_bottom text-center"><h4 class="nt_h5 text-center">TAXABLE<br>VALUE</h4></td>
                            </tr>

                            <tr>
                                <td class="td_border_bottom td_border_right"><h4 class="nt_h5">{{$invoice_data['seller_invoice_data']->hsn_no}}</h4></td>
                                <td align="right" class="td_border_bottom  text-right"><h4 class="nt_h5">{{$invoice_data['seller_invoice_data']->si_amount}}</h4></td>
                            </tr>
                            <tr>
                                <td align="right" class="td_border_right text-right"><h4 class="nt_h5"><strong>TOTAL</strong></h4></td>
                                <td align="right" class="text-right"><h4 class="nt_h5"><strong>{{$invoice_data['seller_invoice_data']->si_total}}</strong></h4></td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>
                                    <h4 class="nt_h4_2">Amount Chargeable (in words) : <strong>INR {{$invoice_data['seller_invoice_data']->grand_total_word}}</strong></h4>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" class="nt_signatur_sec">
                            <tr>
                                <td>
                                    <h4 class="nt_h4_2">Farmer's Signature </h4>
                                </td>
                                <td align="right" style="vertical-align: top;" lang="gu">
                                    <h4 class="nt_h4_2">{{$invoice_data['seller_invoice_data']->seller_name}}</h4>
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


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
