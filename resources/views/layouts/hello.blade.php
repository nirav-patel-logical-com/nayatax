<table class="table" width="100%">
        <tr>
                <td valign="top" width="44%" style="font-size: 25px;"  align="left">
                        <h4 class="text-light">Prepared by</h4>
                </td>
                <td valign="top" width="40%" style="font-size: 25px;" class="left">
                        <h4 class="text-light">Prepared for</h4>
                </td>
                <td valign="top" width="60%" style="font-size: 25px;" class="right">

                        INVOICE NO&nbsp;:&nbsp;
                        {{$invoice_data['seller_invoice_data']->bi_invoice_no}}
                </td>
        </tr>
        <tr>
                <td valign="top" width="44%"  align="left" style="font-size: 25px;" lang="gu">
                        {{$invoice_data['seller_invoice_data']->biz_name}}
                </td>
                <td valign="top" width="40%" class="left" style="font-size: 25px;" lang="gu">
                        {{$invoice_data['seller_invoice_data']->seller_name}}
                </td>
                <td  valign="top" width="60%" style="font-size: 25px;" class="right">
                        DATE :&nbsp;:&nbsp;<?php echo date("d-m-Y",strtotime($invoice_data['seller_invoice_data']->bi_add_date));?>

                </td>

        </tr>
        <tr>
                <td valign="top" width="44%"  align="left" style="font-size: 25px;" lang="gu">
                        {{$invoice_data['seller_invoice_data']->address1}},<br>
                        <?php if(isset($invoice_data['seller_invoice_data']->address2) && !empty($invoice_data['seller_invoice_data']->address2))
                        {echo $invoice_data['seller_invoice_data']->address2 .',<br>' ; }?>
                        {{$invoice_data['seller_invoice_data']->city}},{{$invoice_data['seller_invoice_data']->state}}<br>
                        {{$invoice_data['seller_invoice_data']->mobile}}
                </td>
                <td valign="top" width="40%" class="left" style="font-size: 25px;" lang="gu">
                        {{$invoice_data['seller_invoice_data']->seller_address1}},<br>
                        <?php if(isset($invoice_data['seller_invoice_data']->seller_address2) && !empty($invoice_data['seller_invoice_data']->seller_address2))
                        {echo $invoice_data['seller_invoice_data']->seller_address2 .',<br>' ; }?>
                        {{$invoice_data['seller_invoice_data']->seller_city}},{{$invoice_data['seller_invoice_data']->seller_state}}<br>
                        {{$invoice_data['seller_invoice_data']->seller_mobile}}
                </td>
        </tr>
        <tr>
                <td valign="top" width="44%"  align="left" style="font-size: 25px;" lang="gu">
                        <?php if(!empty($invoice_data['seller_invoice_data']->gstin_no)){ ?>
                        GSTTIN No&nbsp;: &nbsp;{{$invoice_data['seller_invoice_data']->gstin_no}}
                        <?php } ?>
                </td>
                <td valign="top" width="40%" class="left" style="font-size: 25px;" lang="gu">
                        <?php if(!empty($invoice_data['seller_invoice_data']->seller_gstin_no)){ ?>
                        GSTTIN No&nbsp;: &nbsp;{{$invoice_data['seller_invoice_data']->seller_gstin_no}}
                        <?php } ?>
                </td>
        </tr>
</table>