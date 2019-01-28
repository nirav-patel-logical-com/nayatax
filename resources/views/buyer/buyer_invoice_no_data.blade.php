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
                        <button  class="btn sbold green add"> Print
                            <i class="fa fa-print"></i>
                        </button>
                        <a id="sample_editable_1_new" class="btn sbold green add"
                           href="#" download target="_blank"> Download
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
                                        <img src="{{asset('assets/img/nayataxlogo.png')}}" width="150" alt="" />
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
                                            <td width="30%" lang="gu">
                                                <h4 class="nt_h4">GST IN : <?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->gstin_no)) { ?>{{$invoice_data['buyer_invoice_data'][0]->gstin_no}}<?php } else { echo "--"; } ?></h4>
                                            </td>
                                            <td align="center" style="vertical-align: top;" lang="gu">
                                                <h4 class="nt_h4"><?php if(isset($invoice_data['buyer_invoice_data']) && !empty($invoice_data['buyer_invoice_data']->biz_market_name)) { ?>{{$invoice_data['buyer_invoice_data'][0]->biz_market_name}}<?php }?></h4>
                                                <h4 class="nt_h4">Upvidhi No.  36 (2) (Puravni-8)</h4>
                                            </td>
                                            <td align="right" lang="gu">

                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <div class="nt_invoice_left_logo">

                                                </div>
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
                                                <h4 class="nt_h4">Bill No. 1</h4>
                                            </td>
                                            <td align="right">

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

                                            <td lang="gu">

                                            </td>
                                            <td align="center">
                                            </td>
                                            <td align="right">

                                            </td>

                                        <tr>
                                            <td lang="gu">

                                            </td>
                                            <td align="center" lang="gu">

                                            </td>

                                            <td align="right">

                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%">

                                            <td>
                                                <hr style="margin: 10px 0;">
                                            </td>

                                    </table>
                                    <table width="100%">

                                    </table>

                                    <table width="100%">

                                    </table>

                                    <table class="table table-hover nt_tax_table">
                                        <thead class="text-uppercase nt_inv_cat_hdr">
                                        <tr>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                                <h3 style="font-size: 15px;  text-align: center" >No Invoice Generate </h3>

                                        <tr>
                                        </tbody>
                                    </table>
                                    <table width="100%">
                                        <tr>

                                        </tr>
                                    </table>

                                    <table width="100%">
                                        <tr>

                                        </tr>
                                    </table>

                                    <table width="100%" class="nt_signatur_sec">
                                        <tr>
                                            <td>

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
@include('layouts.footer')

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

