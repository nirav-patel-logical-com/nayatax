<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<!-- CSS Reset -->
<style type="text/css">

    /* What it does: Remove spaces around the email design added by some email clients. */
    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
    html,
    body {
        margin: 0 auto !important;
        padding: 0px !important;
        height: 100% !important;
        width: 100% !important;
    }

    /* What it does: Stops email clients resizing small text. */
    * {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    a:focus {
        outline: 0;
    }

    /* What it does: Centers email on Android 4.4 */
    div[style*="margin: 16px 0"] {
        margin: 0 !important;
    }

    /* What it does: Stops Outlook from adding extra spacing to tables. */
    table,
    td {
        mso-table-lspace: 0pt !important;
        mso-table-rspace: 0pt !important;
    }

    /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
    table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
    }

    table table table {
        table-layout: auto;
    }

    /* What it does: Uses a better rendering method when resizing images in IE. */
    img {
        -ms-interpolation-mode: bicubic;
    }

    /* What it does: A work-around for iOS meddling in triggered links. */
    .mobile-link--footer a,
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: underline !important;
    }

</style>

<!-- Progressive Enhancements -->
<style>

    /* What it does: Hover styles for buttons */
    .button-td,
    .button-a {
        transition: all 100ms ease-in;
    }

    .button-td:hover,
    .button-a:hover {
        background: #d4aa58 !important;
        border-color: #d4aa58 !important;
    }

    /* Media Queries */
    @media screen and (max-width: 480px) {

        /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
        .fluid,
        .fluid-centered {
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* And center justify these ones. */
        .fluid-centered {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* What it does: Forces table cells into full-width rows. */
        .stack-column,
        .stack-column-center {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            direction: ltr !important;
        }

        /* And center justify these ones. */
        .stack-column-center {
            text-align: center !important;
        }

        /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
        .center-on-narrow {
            text-align: center !important;
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            float: none !important;
        }

        table.center-on-narrow {
            display: inline-block !important;
        }

    }
    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid #eee !important;
    }
</style>
<head>
    @include('layouts.head')
</head>
<!-- END HEAD -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
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

            <div class="row">
                <div class="col-md-12 col-lg-12">
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

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <h3 class="page-title"></h3>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="actions pull-right SCREEN_VIEW_CONTAINER" style="margin-top:20px;">
                        <div class="btn-group btn-group-devided">
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
            </div>


            <!-- Table Start-->
            <div class="row" style="margin-top: 20px;">
                <div class="col-sm-12">

                    <center style="width: 100%; background: #FFFFFF; padding:5px !important;">

                        <!-- Visually Hidden Preheader Text : BEGIN -->
                        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
                            (Optional) This text will appear in the inbox preview, but not the email body.
                        </div>
                        <!-- Visually Hidden Preheader Text : END -->

                        <!--
                            Set the email width. Defined in two places:
                            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 680px.
                            2. MSO tags for Desktop Windows Outlook enforce a 680px width.
                            Note: The Fluid and Responsive templates have a different width (600px). The hybrid grid is more "fragile", and I've found that 680px is a good width. Change with caution.
                        -->
                        <div style="max-width: 100%; margin: auto;">
                            <!--[if mso]>
                            <table cellspacing="0" cellpadding="0" border="0" width="680" align="center">
                                <tr>
                                    <td>
                            <![endif]-->

                            <!-- Email Header : BEGIN -->
                            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                                   style="max-width: 100%;">
                                <tr>
                                    <td colspan="1">
                                    <td style="width:70%;padding:10px 0px; text-align: center; font-family: 'Open Sans', sans-serif; font-size: 17px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                        <span style="color:#000;"><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_biz_market_name)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_biz_market_name}}<?php }?></span><br><span
                                                style="color:#000;">Upvidhi No. 36 (2) (Puravni-8)</span>
                                    </td>
                                    <td style="text-align:right; background-color: #fff;">
                                        <a href="#" target="_blank">
                                            <img src="{{asset('assets/img/nayataxlogo.png')}}" width="150" alt="alt_text" border="0">
                                        </a>

                                    </td>

                                </tr>
                            </table>
                            <!-- Email Header : END -->
                            <br>


                            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                                   style="max-width:100%;">

                                <!-- Hero Image, Flush : BEGIN -->
                                <tr>
                                    <td bgcolor="#ffffff">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>

                                                <td style=" text-align: left; font-family: 'Open Sans', sans-serif; font-size: 13px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000; font-size:13px;">From,</span><br>
                                                    <span style="color:#000; font-size:13px;"><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_biz_name)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_biz_name}}<?php } else { echo "--"; } ?></span><br>
                                                    <span style="color:#000; font-size:13px;">GSTIN No:&nbsp; <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_gstin_no)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_gstin_no}}<?php } else { echo "--"; } ?></span><br>
                                                    <span style="color:#000; font-size:13px;">PAN NO :&nbsp;<?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_pan_no)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_pan_no}}<?php } else { echo "--"; } ?></span><br>
                                                    <span style="color:#000; font-size:13px;">(M):&nbsp;<?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_mobile)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_mobile}}<?php } else { echo "--"; } ?></span><br>
                                                    <span style="color:#000; font-size:13px;">(Office Tel):&nbsp;<?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_biz_tel_no)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_biz_tel_no}}<?php } else { echo "--"; } ?></span><br>
                                                    <span style="color:#000; font-size:13px;">(Office M):&nbsp;<?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data'][0]->company_biz_mobile)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_biz_mobile}}<?php } else { echo "--"; } ?></span><br>

                                                </td>

                                                <td style=" text-align: left;vertical-align:top;width:42%; font-family: 'Open Sans', sans-serif; font-size: 13px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000;float:left;">To,</span><br>
                                                    <span style="color:#000;float:left;">Buyer Name:&nbsp;{{$invoice_data['buyer_invoice_data'][0]->f_name.' '.$invoice_data['buyer_invoice_data'][0]->m_name.' '.$invoice_data['buyer_invoice_data'][0]->l_name}}</span><br>
                                                    <span style="color:#000;float:left;">Address:&nbsp;{{$invoice_data['buyer_invoice_data'][0]->city}}
                                                        <?php if(isset($invoice_data['buyer_invoice_data'][0]->district) && !empty($invoice_data['buyer_invoice_data'][0]->district)) {?>
                                                        ,{{$invoice_data['buyer_invoice_data'][0]->district}},{{$invoice_data['buyer_invoice_data'][0]->state}}
                                                     <?php }?>
                                                        </span><br>
                                                </td>

                                                <td style="vertical-align:top;width:15%;padding: 10px 0px; text-align: right; font-family: 'Open Sans', sans-serif; font-size: 24px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000;"><strong>INVOICE</strong></span><br><span
                                                            style="color:#000;"></span><br>
                                                    <span style="color:#000; font-size:13px;">Invoice No:{{$invoice_data['buyer_invoice_data'][0]->si_invoice_no}}</span><br><span
                                                            style="color:#000;"></span>
                                                   <!-- <span style="color:#000; font-size:13px;"> {{$invoice_data['buyer_invoice_data'][0]->si_invoice_no}}&nbsp;</span><br><span
                                                            style="color:#000;"></span>-->
                                                    <span style="color:#000; font-size:13px;">Date: <?php echo date("d-m-Y", strtotime($invoice_data['buyer_invoice_data'][0]->spi_add_date));?></span><br>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Hero Image, Flush : END -->
                            </table>
                            <br>


                            <table class="table  table-responsive table-bordered" style="margin:0;width:100%; background:#fff; padding:20px 10px; font-family: 'Open Sans', sans-serif;" cellspacing="7" cellpadding="7">
                                <thead class="text-uppercase nt_inv_cat_hdr" style="color: #333; background:#e67e22; color:#fff;">

                                <tr>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:10%;">
                                        SR. NO
                                    </th>
                                    <?php  if( $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "False") {
                                       ?> <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:19%;">
                                        GOODS TYPE
                                    </th><?php
                                    }else{?>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:13%;">
                                        GOODS TYPE
                                    </th>
                                    <?php
                                    }?>

                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:13%;">
                                        HSN NO
                                    </th>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:18%;">
                                        QTY (Kg.)
                                    </th>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:18%;">
                                        PRICE PER&nbsp;<?php if (!empty($invoice_data['site_setting_data']->setting_kg_price)) {
                                            echo $invoice_data['site_setting_data']->setting_kg_price;
                                        }?>
                                    </th>
                                    <?php if(($invoice_data['buyer_invoice_data'][0]->state == 'Gujarat' || empty($invoice_data['buyer_invoice_data'][0]->state)) && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True") { ?>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:20%;">CGST</th>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:20%;">SGST</th>
                                    <?php }elseif($invoice_data['buyer_invoice_data'][0]->state != 'Gujarat' && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True"){ ?>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:20%;">IGST</th>
                                    <?php } ?>

                                    <?php  if( $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "False") {
                                    ?> <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:23%;">
                                        Amount
                                    </th><?php
                                    }else{?>
                                    <th style="text-align:center;font-size:12px;font-family: 'Open Sans', sans-serif;width:20%;">
                                        Amount
                                    </th>
                                    <?php
                                    }?>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                </tr>

                                <?php $n = 0; ?>
                                @foreach($invoice_data['buyer_invoice_data'] as $item)
                                    <?php $n++; ?>
                                    <tr class="bg-f5f5f5">
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            {{$n}}
                                        </td>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            {{$item->gt_type}}
                                        </td>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            {{$item->gt_hsn_no}}
                                        </td>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            {{$item->spi_weight}}
                                        </td>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            {{$item->spi_rate}}
                                        </td>
                                        <?php if(($invoice_data['buyer_invoice_data'][0]->state == 'Gujarat' || empty($invoice_data['buyer_invoice_data'][0]->state))&& $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True") { ?>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            ({{$item->bpi_cgst}}%)&nbsp;{{$item->bpi_cgst_price}}
                                        </td>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            ({{$item->bpi_sgst}}%)&nbsp;{{$item->bpi_sgst_price}}
                                        </td>
                                        <?php }elseif($invoice_data['buyer_invoice_data'][0]->state != 'Gujarat' && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True"){ ?>
                                        <td style="text-align:center;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        ({{$item->bpi_igst}}%)&nbsp;{{$item->bpi_igst_price}}
                                        </td>
                                        <?php } ?>

                                        <td style="text-align:right;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                            {{$item->spi_total}}
                                        </td>
                                    </tr>
                                @endforeach


                                <tr class="bg-f5f5f5">
                                    <?php if($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "False"){
                                       ?>
                                        <td colspan="4" style="border: none !important;"></td>
                                        <?php
                                    } else if(($invoice_data['buyer_invoice_data'][0]->state == 'Gujarat'|| empty($invoice_data['buyer_invoice_data'][0]->state)) && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True") { ?>
                                    <td colspan="6" style="border: none !important;"></td>
                                        <?php }else if(($invoice_data['buyer_invoice_data'][0]->state != 'Gujarat')&& ($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True")){?>
                                        <td colspan="5" style="border: none !important;"></td>
                                        <?php
                                        }else{?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php

                                    }?>
                                    <td class="text-right" style="text-align:center;color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        Subtotal&nbsp;
                                    </td>
                                    <td class="text-right" style="text-align:right; color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        <i class="fa fa-rupee"></i>&nbsp;{{$invoice_data['buyer_invoices_data']->total}}
                                    </td>
                                </tr>
                                <tr class="bg-f5f5f5">
                                    <?php if($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "False"){
                                    ?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php
                                    } else if(($invoice_data['buyer_invoice_data'][0]->state == 'Gujarat'|| empty($invoice_data['buyer_invoice_data'][0]->state)) && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True") { ?>
                                    <td colspan="6" style="border: none !important;"></td>
                                    <?php }else if(($invoice_data['buyer_invoice_data'][0]->state != 'Gujarat')&& ($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True")){?>
                                    <td colspan="5" style="border: none !important;"></td>
                                    <?php
                                    }else{?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php

                                    }?>
                                    <td class="text-right" style="text-align:center;color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        Market Fees&nbsp;:&nbsp;({{$invoice_data['buyer_invoices_data']->market_fees}}&nbsp;%)
                                    </td>
                                    <td class="text-right" style="text-align:right; color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        <i class="fa fa-rupee"></i>&nbsp;{{$invoice_data['buyer_invoices_data']->grandtotal1}}
                                    </td>

                                </tr>
                                
                                <tr class="bg-f5f5f5">
                                    <?php if($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "False"){
                                    ?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php
                                    } else if(($invoice_data['buyer_invoice_data'][0]->state == 'Gujarat'|| empty($invoice_data['buyer_invoice_data'][0]->state)) && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True") { ?>
                                    <td colspan="6" style="border: none !important;"></td>
                                    <?php }else if(($invoice_data['buyer_invoice_data'][0]->state != 'Gujarat')&& ($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True")){?>
                                    <td colspan="5" style="border: none !important;"></td>
                                    <?php
                                    }else{?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php

                                    }?>
                                    <td class="text-right" style="text-align:center;color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        Total&nbsp;Amount
                                    </td>
                                    <td class="text-right" style="text-align:right; color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        <i class="fa fa-rupee"></i>&nbsp;{{$invoice_data['buyer_invoices_data']->grandtotals}}
                                    </td>
                                </tr>

                                <tr class="bg-f5f5f5">
                                    <?php if($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "False"){
                                    ?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php
                                    } else if(($invoice_data['buyer_invoice_data'][0]->state == 'Gujarat'|| empty($invoice_data['buyer_invoice_data'][0]->state)) && $invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True") { ?>
                                    <td colspan="6" style="border: none !important;"></td>
                                    <?php }else if(($invoice_data['buyer_invoice_data'][0]->state != 'Gujarat')&& ($invoice_data['buyer_invoice_data'][0]->gt_is_tax_apply == "True")){?>
                                    <td colspan="5" style="border: none !important;"></td>
                                    <?php
                                    }else{?>
                                    <td colspan="4" style="border: none !important;"></td>
                                    <?php

                                    }?>
                                    <td class="text-right" style="text-align:center;color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        <strong>Round Of Total&nbsp;Amount</strong></td>
                                    <td class="text-right" style="text-align:right; color:#000;font-family: 'Open Sans', sans-serif;font-size:13px;">
                                        <strong><i class="fa fa-rupee"></i>&nbsp;<?php echo round($invoice_data['buyer_invoices_data']->grandtotals);?> .00</strong></td>
                                </tr>

                                <tr class="bg-f5f5f5">
                                    <td colspan="8" style="font-size:13px;">Invoice Amount Chargeable (in words):
                                        <strong>INR {{$invoice_data['buyer_invoices_data']->grand_total_word}} Only</strong>
                                    </td>
                                </tr>


                                </tbody>

                            </table>
                            <br> <br>
                            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                                   style="max-width: 100%;">

                                <!-- Hero Image, Flush : BEGIN -->
                                <tr>
                                    <td bgcolor="#ffffff" style="padding:0px 10px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style=" text-align: left; font-family: 'Open Sans', sans-serif; font-size: 12px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000;">
														<p style="color:#000;margin:0px !important;font-size:12px;">FOR, <?php if(isset($invoice_data['buyer_invoice_data'][0]) && !empty($invoice_data['buyer_invoice_data'][0]->company_biz_name)) { ?>{{$invoice_data['buyer_invoice_data'][0]->company_biz_name}}<?php } else { echo "--"; } ?></p>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Hero Image, Flush : END -->
                            </table>


                            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                                   style="max-width:100%;">

                                <!-- Hero Image, Flush : BEGIN -->
                                <tr>
                                    <td bgcolor="#ffffff" style="padding:35px 10px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>

                                                <td style=" text-align: left; font-family: 'Open Sans', sans-serif; font-size: 13px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000;">Authorise Signatory</span><br>
                                                </td>

                                                <!--<td style=" text-align: right; font-family: 'Open Sans', sans-serif; font-size: 13px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000;">Farmer's Signature</span>
                                                </td>-->

                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Hero Image, Flush : END -->
                            </table>


                            <!--[if mso]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </div>
                    </center>


                </div>

            </div>
            <!-- Table Ends-->

            <!--End In and out section-->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')
@include('layouts.footer-js')
<!-- END FOOTER -->
<style type="text/css">
    div.radio span.checked {
        background-position: -74px -281px;
    }
</style>
<style type="text/css" media="print">

    .SCREEN_VIEW_CONTAINER{
        display: none;
    }
    .other_print_layout{
        background-color:#FFF;
    }
</style>
<!-- CSS for the things we DO NOT want to print (web view) -->
<style type="text/css" media="screen">

    /* #PRINT_VIEW{
         display: none;
     }*/
    .other_web_layout{
        background-color:#E0E0E0;
    }
    @media print {
        a[href]:after {
            content: none !important;
        }
    }
</style>
<script>
    function myFunction() {
        window.print();
    }
</script>
<!-- END FOOTER -->
</body>
</html>




