

<?php $add_path='';
if(Request::segment(2) != ''){
    $add_path = '../';
}?>

<link href="https://nayatax.com/assets/bsp-layouts/css/bsp-style.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<style>
    body{
        font-family: 'Open Sans', sans-serif;
    }
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
        font-size: 17px;
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
        background-color: #ffffff;
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

    .td_border_bottom{
        border-bottom: 1px solid #e7ecf1;
    }
    .td_border_right{
        border-right: 1px solid #e7ecf1;
    }
    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid #eee !important;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px;
        line-height: 1.42857;
        vertical-align: top;
        border-top: 1px solid #e7ecf1;
    }
    .table-responsive {
        overflow-x: auto;
        min-height: .01%;
    }
    .img-responsive, .img-thumbnail, .table, label {
        max-width: 100%;
    }
    table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
    }
    .table tbody tr td{
        border: 1px solid #e1e1e1 !important;
    }


    /*End Custom css*/
</style>

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

                                <td colspan="1"></td>
                                <td align="center" style="width:60%;padding:10px 0px; text-align: center; font-family: 'Open Sans', sans-serif; font-size: 20px; mso-height-rule: exactly; line-height: 20px; color: #555555;" lang="gu">
                                    <h4 class="nt_h4"><?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_biz_market_name)) { ?>{{$invoice_data['seller_invoice_data']->company_biz_market_name}}<?php }?></h4>
                                    <h4 class="nt_h4">Upvidhi No.  36 (2) (Puravni-8)</h4>
                                </td>

                                <td style="width:20%; text-align:center;">
                                    <div>
                                        <img src="{{asset('assets/img/nayataxlogo.png')}}"style="height: 50px;" width="100" alt="" />
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <!--Address Start-->
                        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                               style="max-width:100%;">

                            <!-- Hero Image, Flush : BEGIN -->
                            <tr>
                                <td bgcolor="#ffffff">
                                    <br>
                                    <br>
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>

                                            <td style=" text-align: left;vertical-align:top;width:40%; font-family: 'Open Sans', sans-serif;  mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                <span style="color:#000; font-size:11px;">From,</span><br>
                                                <span style="color:#000; font-size:11px;" lang="gu">Company Name:&nbsp;<?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_biz_name)) { ?>{{$invoice_data['seller_invoice_data']->company_biz_name}}<?php } else { echo "--"; } ?></span><br>
                                                 <span style="color:#000; font-size:11px;" lang="gu">Address:&nbsp;{{$invoice_data['seller_invoice_data']->company_address1}}
                                                     <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_address2)) { ?>
                                                     , {{$invoice_data['seller_invoice_data']->company_city}}<?php } ?>
                                                     {{$invoice_data['seller_invoice_data']->company_taluko}}, {{$invoice_data['seller_invoice_data']->company_district}},{{$invoice_data['seller_invoice_data']->company_state}}.</span><br>

                                                <span style="color:#000; font-size:11px;">GST TIN No:&nbsp;<?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_gstin_no)) { ?>{{$invoice_data['seller_invoice_data']->company_gstin_no}}<?php } else { echo "--"; } ?></span><br>
                                                <span style="color:#000; font-size:11px;">PAN NO :&nbsp;<?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_pan_no)) { ?>{{$invoice_data['seller_invoice_data']->company_pan_no}}<?php } else { echo "--"; } ?></span><br>
                                                <span style="color:#000; font-size:11px;">(Office Tel):&nbsp;<?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_biz_tel_no)) { ?>{{$invoice_data['seller_invoice_data']->company_biz_tel_no}}<?php } else { echo "--"; } ?></span><br>
                                                <span style="color:#000; font-size:11px;">(Office M):&nbsp;<?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_biz_mobile)) { ?>{{$invoice_data['seller_invoice_data']->company_biz_mobile}}<?php } else { echo "--"; } ?></span><br>

                                            </td>

                                            <td style="vertical-align:top;width:40%; font-family: 'Open Sans', sans-serif; font-size: 11px; mso-height-rule: exactly; line-height: 20px; color: #555555;    padding-left: 0px;">
                                                <span style="color:#000;float:left;">To,</span><br>
                                                <span style="color:#000;float:left;" lang="gu">Farmer Name:&nbsp;{{$invoice_data['seller_invoice_data']->seller_name}}</span><br>
                                                <span style="color:#000;float:left;" lang="gu">Address:&nbsp;{{$invoice_data['seller_invoice_data']->seller_city}},{{$invoice_data['seller_invoice_data']->seller_state}}</span><br>
                                            </td>

                                            <td style="vertical-align:top;width:20%;padding: 10px 0px; text-align: center; font-family: 'Open Sans', sans-serif; font-size: 24px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                <span style="color:#000;"><strong>INVOICE</strong></span><br><span
                                                        style="color:#000;"></span><br>
                                                <span style="color:#000; font-size:11px;">Invoice No&nbsp;{{$invoice_data['seller_invoice_data']->si_invoice_no}}</span><br><span
                                                        style="color:#000;"></span>
                                                <!--   <span style="color:#000; font-size:11px;">&nbsp; {{$invoice_data['seller_invoice_data']->si_invoice_no}}</span><br><span
                                                        style="color:#000;"></span>-->
                                                <span style="color:#000; font-size:11px;">Date:&nbsp;<?php echo date("d-m-Y", strtotime($invoice_data['seller_invoice_data']->si_add_date));?></span><br>
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Hero Image, Flush : END -->
                        </table>
                        <!-- Address Ends-->


                        <br>
                        <br>

                        <!-- Payment Bill-->
                        <table class="table table-hover table-bordered" style="width:100%;">
                            <thead class="text-uppercase nt_inv_cat_hdr">
                            <tr>
                                <th align="center">SR.&nbsp;NO.</th>
                                <th align="center"> BUYER'S NAME</th>
                                <th align="center">GOOD&nbsp;TYPE</th>
                                <th align="center">HSN&nbsp;NO</th>
                                <th align="center">Bags</th>
                                <th align="center">QTY(KG.)</th>
                                <th align="center" class="text-right">PRICE PER <?php if (!empty($invoice_data['site_setting_data']->setting_kg_price)) {
                                        echo $invoice_data['site_setting_data']->setting_kg_price;
                                    }?></th>
                                <th align="center" class="text-right">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($invoice_data['seller_product_invoice_data'] as $seller_product_invoice_data)

                                <tr>
                                    <td style="text-align:center;"><?php echo $i; ?></td>
                                    <td style="text-align:center;" lang="gu"> {{$seller_product_invoice_data->buyer_name}}</td>
                                    <td style="text-align:center;" lang="gu"> {{$seller_product_invoice_data->gt_type}}</td>
                                    <td style="text-align:center;">{{$seller_product_invoice_data->gt_hsn_no}}</td>
                                    <td style="text-align:center;">{{$seller_product_invoice_data->spi_no_of_bags}}</td>
                                    <td class="text-center" align="center">{{$seller_product_invoice_data->spi_weight}}</td>
                                    <td class="text-center" align="center">
                                        {{$seller_product_invoice_data->spi_rate}}
                                    </td>
                                    <td class="text-center" align="right">&nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$seller_product_invoice_data->spi_total}}
                                    </td>
                                    <?php $i=$i+1;?>
                                </tr>
                            @endforeach

                            <tr class="bg-f5f5f5">
                                <td colspan="6" style="border: 1px solid #ffffff !important;"></td>
                                <td align="center" class="text-center"><strong class="text-x">Subtotal</strong></td>
                                <td align="right" class="text-center"><strong class="text-x">₹&nbsp;{{$invoice_data['seller_invoice_data']->si_amount}}</strong></td>
                            </tr>
                            <tr class="bg-f5f5f5">
                                <td colspan="6" style="border: 1px solid #ffffff !important;"></td>
                                <td align="center" class="text-center">Wages&nbsp;:</td>
                                <td align="right" class="text-center">₹&nbsp;{{$invoice_data['seller_invoice_data']->si_wages}}</td>
                            </tr>
                            <tr class="bg-f5f5f5">
                                <td colspan="6" style="border: 1px solid #ffffff !important;"></td>
                                <td align="center" class="text-center"> Other Charges&nbsp;:</td>
                                <td align="right" class="text-center">₹&nbsp;{{$invoice_data['seller_invoice_data']->si_other_charge}}</td>
                            </tr>
                            <tr class="bg-f5f5f5">
                                <td colspan="6" style="border: 1px solid #ffffff !important;"></td>
                                <td align="center" class="text-center"><strong class="text-x">Total&nbsp;Amount</strong></td>
                                <td align="right" class="text-center"><strong class="text-x">₹&nbsp;{{$invoice_data['seller_invoice_data']->si_total}}</strong></td>
                            </tr>
                            <tr class="bg-f5f5f5">
                                <td colspan="6" style="border: 1px solid #ffffff !important;"></td>
                                <td align="center" class="text-center"><strong class="text-x">Round Of Total&nbsp;Amount</strong></td>
                                <td align="right" class="text-center"><strong class="text-x">₹&nbsp;<?php echo round($invoice_data['seller_invoice_data']->si_total);?>.00</strong></td>
                            </tr>
                            <tr class="bg-f5f5f5" style="border: 1px solid #ffffff !important;">
                                <td colspan="8" style="font-size:11px;font-family: 'Open Sans', sans-serif;">Invoice Amount Chargeable (in words):&nbsp;
                                    <strong>INR {{$invoice_data['seller_invoice_data']->grand_total_word}} Only</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- Payment Bill-->

                        <br>
                        <!-- HSN NO-->
                        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                               style="max-width: 100%;">

                            <!-- Hero Image, Flush : BEGIN -->
                            <tr>
                                <td bgcolor="#ffffff" style="padding:0px 10px;">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td style=" text-align: left; font-family: 'Open Sans', sans-serif; font-size: 12px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                                    <span style="color:#000;" lang="gu">
														<p style="color:#000;margin:0px !important;font-size:12px;">FOR, <?php if(isset($invoice_data['seller_invoice_data']) && !empty($invoice_data['seller_invoice_data']->company_biz_name)) { ?>{{$invoice_data['seller_invoice_data']->company_biz_name}}<?php } else { echo "--"; } ?></p>
                                                    </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Hero Image, Flush : END -->
                        </table>

                        <!-- Authorized Signatory Start-->
                        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                               style="max-width:100%;">

                            <!-- Hero Image, Flush : BEGIN -->
                            <tr>
                                <td bgcolor="#ffffff" style="padding:40px 10px;">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>

                                            <td style=" text-align: left; font-family: 'Open Sans', sans-serif; font-size: 11px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
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
                        <!-- Authorized Signatory Start-->

                    </div>
                </div>
                <!--End invoice table structure-->
            </div>
        </div>
    </div>
</div>
<!--End invoice header main section-->


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

