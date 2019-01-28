<head>
    @include('layouts.head')
</head>

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
    .card{
        box-shadow: 0 1px 3px 0 #FFF;
    }
    td{
        line-height: 1.4 !important;
        padding:8px;
    }
    th{
        line-height: 1.4 !important;
        padding:8px;
    }
</style>
<div class="col-md-12">
    <div class="card card-printable">
    <div class="card-body" id="invoice_content">

        <div class="row">
            <div class="col-xs-12">
                <table class="table">
                    <tr>
                        <td align="left">
                            <img src="{{asset('assets/img/nayataxlogo.png')}}" width="200">
                        </td>
                        <td align="right">
                            <h1 class="text-light text-default-light">Invoice</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table">
                    <tr>
                        <td valign="top" align="left">
                            <h4 class="text-light">Prepared by</h4>
                            <address>
                                <b>{{$invoice_data['buyer_invoice_data']->biz_name}}</b>
                            </address>

                            <address>
                                {{$invoice_data['buyer_invoice_data']->address1}},<br>
                                <?php if(isset($invoice_data['buyer_invoice_data']->address2) && !empty($invoice_data['buyer_invoice_data']->address2))
                                {echo $invoice_data['buyer_invoice_data']->address2 .',<br>' ; }?>
                                {{$invoice_data['buyer_invoice_data']->city}},{{$invoice_data['buyer_invoice_data']->state}}<br>
                                {{$invoice_data['buyer_invoice_data']->mobile}}
                            </address>
                            <?php if(!empty($invoice_data['buyer_invoice_data']->gstin_no)){ ?>
                            <br>
                            GSTTIN No&nbsp;: &nbsp;{{$invoice_data['buyer_invoice_data']->gstin_no}}
                            <?php } ?>
                        </td>
                        <td valign="top" align="center">
                            <h4 class="text-light">Prepared for</h4>
                            <address>
                                <b>{{$invoice_data['buyer_invoice_data']->buyer_name}}</b>
                            </address>
                            <address>
                                {{$invoice_data['buyer_invoice_data']->buyer_address1}},<br>
                                <?php if(isset($invoice_data['buyer_invoice_data']->buyer_address2) && !empty($invoice_data['buyer_invoice_data']->buyer_address2))
                                {echo $invoice_data['buyer_invoice_data']->buyer_address2 .',<br>' ; }?>
                                {{$invoice_data['buyer_invoice_data']->buyer_city}},{{$invoice_data['buyer_invoice_data']->buyer_state}}<br>
                                {{$invoice_data['buyer_invoice_data']->buyer_mobile}}
                            </address><br>
                            <?php if(!empty($invoice_data['buyer_invoice_data']->buyer_gstin_no)){ ?>
                            <br>
                            GSTTIN No&nbsp;: &nbsp;{{$invoice_data['buyer_invoice_data']->buyer_gstin_no}}
                            <?php } ?>

                        </td>
                        <td valign="top" align="right">
                            <table>
                                <tr>
                                    <td align="left">INVOICE NO&nbsp;:&nbsp;</td>
                                    <td align="right">
                                        {{$invoice_data['buyer_invoice_data']->bi_invoice_no}}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">DATE :</td>
                                    <td align="right">
                                        <?php echo date("d-m-Y",strtotime($invoice_data['buyer_invoice_data']->bi_add_date));?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <br/>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead style="color: #828282;">
                    <tr>
                        <th style="width:80px;border-bottom: 2px solid #eee;" class="text-left">SR. NO.</th>
                        <th style="border-bottom: 2px solid #eee;" class="text-left">Farmer Name</th>
                        <th style="border-bottom: 2px solid #eee;" class="text-left">Goods Type</th>
                        <th class="text-right" style="border-bottom: 2px solid #eee;">Qty</th>
                        <th class="text-right" style="border-bottom: 2px solid #eee;">Price</th>
                        <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                        <th class="text-right" style="border-bottom: 2px solid #eee;" colspan="2">CGST</th>
                        <th class="text-right" style="border-bottom: 2px solid #eee;" colspan="2">SGST</th>
                        <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                        <th class="text-right" style="border-bottom: 2px solid #eee;" colspan="2">IGST</th>
                        <?php } ?>
                        <th style="width:90px;border-bottom: 2px solid #eee;" class="text-right">TOTAL</th>
                    </tr>

                    <!-- <tr>
                         <th colspan="4"><hr></th>
                     </tr>-->
                    </thead>
                    <tbody>
                    <?php $n=0; ?>
                    @foreach($invoice_data['buyer_product_invice_data'] as $item)
                        <?php $n++; ?>
                        <tr>
                            <td style="vertical-align: top;">{{$n}}</td>
                            <td style="vertical-align: top;">{{$item->farmer_name}}</td>
                            <td style="vertical-align: top;">{{$item->gt_type}}</td>
                            <td class="text-right" style="vertical-align: top;">{{$item->bpi_weight}}</td>
                            <td class="text-right" style="vertical-align: top;">{{$item->bpi_amount}}</td>
                            <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                            <td class="text-right" colspan="2" style="vertical-align: top;">
                                CGST&nbsp;:&nbsp;({{$item->bpi_cgst}}&nbsp;%)&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$item->bpi_cgst_price}}
                            </td>

                            <td class="text-right" colspan="2" style="vertical-align: top;">
                                SGST&nbsp;:&nbsp;({{$item->bpi_sgst}}&nbsp;%)&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$item->bpi_sgst_price}}
                            </td>


                            <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>

                            <td class="text-right" colspan="2" style="vertical-align: top;">
                                IGST&nbsp;:&nbsp;({{$item->bpi_igst}}&nbsp;%)&nbsp;&nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$item->bpi_igst_price}}
                            </td>

                            <?php } ?>
                            <td class="text-right" style="vertical-align: top;">&nbsp;<i class="fa fa-inr"
                                                                                         aria-hidden="true"></i>&nbsp;{{$item->bpi_total}}</td>
                        </tr>

                    @endforeach



                    <tr style="font-size: 12px;">

                        <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                        <td style="border: medium none;" colspan="8"></td>
                        <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                        <td style="border: medium none;" colspan="7"></td>
                        <?php } ?>
                        <th style="border: medium none;padding: 3px;" class="text-right">Subtotal</th>
                        <td style="border: medium none;padding: 3px;" class="text-right">
                            &nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$invoice_data['buyer_invoice_data']->bi_amount}}
                        </td>
                    </tr>
                    <tr>
                        <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                        <td style="border: medium none;" colspan="8"></td>
                        <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                        <td style="border: medium none;" colspan="7"></td>
                        <?php } ?>
                        <td style="border: medium none;padding: 3px;" class="text-right">
                            Commission&nbsp;:&nbsp;({{$invoice_data['buyer_invoice_data']->bi_comission}}&nbsp;%)
                        </td>

                        <td  class="text-right" style="border: medium none;padding: 3px;">
                            &nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$invoice_data['buyer_invoice_data']->bi_commission_price}}
                        </td>
                    </tr>

                    <tr>
                        <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                        <td style="border: medium none;" colspan="8"></td>
                        <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                        <td style="border: medium none;" colspan="7"></td>
                        <?php } ?>
                        <td style="border: medium none;padding: 3px;" class="text-right">
                            Market&nbsp;Fee&nbsp;:&nbsp;({{$invoice_data['buyer_invoice_data']->bi_market_fee_per}})&nbsp;%
                        </td>

                        <td  class="text-right" style="border: medium none;padding: 3px;">
                            &nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$invoice_data['buyer_invoice_data']->bi_market_fee}}
                        </td>
                    </tr>


                    <tr style="font-size: 12px;">
                        <?php if($invoice_data['buyer_invoice_data']->buyer_state === 'Gujarat') { ?>
                        <td style="border: medium none;" colspan="8"></td>
                        <?php }elseif($invoice_data['buyer_invoice_data']->buyer_state != 'Gujarat'){ ?>
                        <td style="border: medium none;" colspan="7"></td>
                        <?php } ?>


                        <th style="border: medium none;padding: 3px;" class="text-right">
                            Total Amount
                        </th>
                        <th style="border: medium none;padding: 3px;" class="text-right">
                            &nbsp;<i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$invoice_data['buyer_invoice_data']->bi_total}}
                        </th>
                    </tr>
                    <!--End new layout-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>