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
                        <a href="<?php echo route('generate_bill');?>">{{ trans('label_word.generate_bill') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.create_farmer_bill') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.create_farmer_bill') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!--Start farmer stock section-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet">
                        <div class="portlet-title" style="background-color: white; border: 1px solid #eee; width:99%">
                            <div class="caption" style="margin-left: 1%;">
                                <i class="fa fa-arrow-up font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.create_farmer_bill') }}</span>
                            </div>


                        </div>
                        <div class="portlet-body">
                            <div class="invoice">
                                <div class="col-md-2 col-xs-2 col-sm-2"
                                     style="background-color: white; border: 1px solid #eee;">
                                    <div class="col-md-10 col-xs-10 col-sm-10">

                                        <div class="form-group margin-top-10" id="div_seller_name">
                                            <label for="single-seller"
                                                   class="control-label text-bold">{{ trans('label_word.farmer_name') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_name"
                                                   class="control-label ">{{$data['stock_in_data'][0]->f_name}}</label>
                                            <input type="hidden" name="seller_id" id="seller_id"
                                                   value="{{$data['stock_in_data'][0]->id}}">
                                            <input type="hidden" name="spi_invoice_no" id="spi_invoice_no">

                                        </div>

                                        <div class="form-group" id="div_seller_mobile">
                                            <label for="single-mobile"
                                                   class="control-label text-bold">{{ trans('label_word.mobile_no') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_mobile"
                                                   class="control-label">{{$data['stock_in_data'][0]->mobile}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_city">
                                            <label for="single-city"
                                                   class="control-label text-bold">{{ trans('label_word.city') }}
                                                &nbsp;:</label>
                                            <br>
                                            <label id="seller_city"
                                                   class="control-label">{{$data['stock_in_data'][0]->city}}</label>
                                        </div>
                                        <div class="form-group" id="div_seller_state">
                                            <label for="single-state"
                                                   class="control-label text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                            <br>
                                            <label id="seller_state"
                                                   class="control-label">{{$data['stock_in_data'][0]->state}}</label>
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
                                                        <th class='text-center'> {{ trans('label_word.buyer_name') }}</th>
                                                        <th class='text-center'> {{ trans('label_word.good_type_sidebar') }}</th>
                                                        <th class='text-center'> {{ trans('label_word.hsn_no') }}</th>
                                                        <th class='text-center'
                                                            style="width: 10%;"> {{ trans('label_word.weight') }}</th>
                                                        <th class='text-center'
                                                            style="width: 10%;">{{ trans('label_word.price') }}
                                                            <?php if(!empty($data['site_setting_data'])){
                                                                echo $data['site_setting_data']->setting_kg_price;
                                                            }?>
                                                            (<i class="fa fa-inr" aria-hidden="true"></i>)
                                                            <input type='hidden' name="price_kg"
                                                                   id="price_kg"
                                                                   value="<?php if(!empty($data['site_setting_data'])){
                                                                       echo $data['site_setting_data']->setting_kg_price;
                                                                   }?>" style=" width: 100px;">

                                                        </th>
                                                        <th class='text-center'
                                                            style="width: 10%;"> {{ trans('label_word.bags') }}</th>
                                                        <th class='text-center'
                                                            style="width: 15%;"> {{ trans('label_word.total') }} (<i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>)
                                                        </th>

                                                        <th id="add_new_row_for_product">
                                                            <i class="fa fa-plus"></i>
                                                        </th>
                                                        <th> <input name="product" id="product" type="hidden" class="product" value="0" style=" width: 111px;"/> </th>
                                                        <th> <input name="spi_si_id" id="spi_si_id" type="hidden" class="spi_si_id" value="" style=" width: 111px;"/> </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="row_append">

                                                    <tr id="row_append_table_tr">
                                                        <td>
                                                            <select name='buyer_id' id="buyer_id0">
                                                                <option value="">Select Buyer</option>
                                                                @foreach($data['buyer_list'] as $list)
                                                                    <option value="{{$list->id}}">{{$list->buyer_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name='goods_id 0' id="goods_id0" onchange="gethsnno()">
                                                                <option value="">Select Goods</option>
                                                                @foreach($data['goods_type_list'] as $list)
                                                                    <option value="{{$list->gt_id}}">{{$list->gt_type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type='text' id="hsn_no0"
                                                                   name='hsn_no' value="" style=" width: 100px;" disabled>
                                                        </td>

                                                        <td>
                                                            <input name='qty' id="qty0" type='text'
                                                                   value="" style=" width: 90px;">
                                                        </td>

                                                        <td>
                                                            <input type='text' name="price"
                                                                   id="price0"
                                                                   value="" style=" width: 100px;" onfocusout="myFunction()">

                                                        </td>

                                                        <td>

                                                            <input name='bags' id="bags0" type='text'
                                                                   value="" style=" width: 90px;">
                                                        </td>

                                                        <td class='text-right'>
                                                            <input type='text' name="pr_total"
                                                                   id="pr_total0"
                                                                   value="0" style=" width: 111px;">
                                                        </td>


                                                    </tr>

                                                    </tbody>

                                                    <tbody id="add_row_tr_td">

                                                    </tbody>

                                                    <tbody>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold">{{ trans('label_word.total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right" id="all_total"><i class="fa fa-inr"
                                                                                                 aria-hidden="true"></i>&nbsp;<label
                                                                    for="all_total"></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right" id="market">
                                                            <span style="vertical-align: middle;">{{ trans('label_word.wages') }}
                                                                :</span>
                                                            <input type="text" style="width: 40%;"
                                                                   name="market_fee" id="market_fee"
                                                                   value="">&nbsp;

                                                        </td>
                                                        <td class="text-right"><i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp;
                                                            <label
                                                                    id="market_fee_val"
                                                                    for="market_fee_val"></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"></td>
                                                        <td class="text-right">
                                                            <span class="text-bold" style="vertical-align: middle;">{{ trans('label_word.grand_total') }}
                                                                :</span>
                                                        </td>
                                                        <td class="text-right text-bold" style="font-size: 18px;">
                                                            <i
                                                                    class="fa fa-inr"
                                                                    aria-hidden="true"></i>&nbsp; <label id="grandTotal"
                                                                   for="grandTotal"></label>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                    <tbody>
                                                    <p class="help-block" id="error_display_msg"></p>
                                                    <p class="help-block" id="error_display_msgs"></p>
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-11">
                                        <button type="button" id="btn_submit"
                                                class="btn green text-uppercase pull-right">{{ trans('label_word.save') }}
                                        </button>
                                    </div>
                                </div>
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
<input type="hidden" id="buyer_list" value="<?php  echo json_encode($data['buyer_list'])?>">
<input type="hidden" id="goods_type_list" value="<?php  echo json_encode($data['goods_type_list'])?>">
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->
<style type="text/css">
    div.radio span.checked {
        background-position: -74px -281px;
    }
</style>
<script type="text/javascript">

    $("#market_fee").keyup(function(){
        var market_fee= $("#market_fee").val();
        if(market_fee != ''){
            $("#market_fee_val").html(parseFloat(market_fee).toFixed(2));

        }else{
            market_fee='';
            $("#market_fee_val").html(market_fee);
        }
        var all_total=$("label[for='all_total']").html();
        if(market_fee==''){
            var grandTotal=all_total;

            if(grandTotal !=''){
                $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
            }else{
                grandTotal='';
                $("#grandTotal").html(grandTotal);
            }

        }else{
            //var total_with_market_fees=(all_total * market_fee)/100;

            var grandTotal= +all_total + +market_fee;
            if(grandTotal !=''){
                $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
            }else{
                grandTotal='';
                $("#grandTotal").html(grandTotal);
            }
           // $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
        }

    });

    function gethsnno(){

        var loop=0;
        var loop=$("#product").val();
        var goods_id=$("#goods_id"+loop).val();


        $.ajax({
            url: '<?php echo route('get_hsn_no_by_goods_id');?>',
            method: 'POST',
            data: {
                'goods_id':goods_id,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                console.log($obj);
                $("#hsn_no"+loop).val($obj);
            }
        });


    }

    function myFunction() {
        var loop=0;
        var loop=$("#product").val();

        var qty=$("#qty"+loop).val();
        var bags=$("#bags"+loop).val();
        var price=$("#price"+loop).val();

        var all_total=$("label[for='all_total']").html();
        var grandTotal=$("label[for='grandTotal']").html();
        var kg = $("#price_kg").val().replace('/Kg', '');

        if (kg != 1) {
            var kg_price = (price * 1) / kg;

        }else{
            var kg_price = (price * 1);
        }


        var total = qty * kg_price;
        $("#pr_total"+loop).val(parseFloat(total).toFixed(2));

        all_total_calculation();
    }


    function all_total_calculation(){

        var cal_all=0;

        var count=$("#product").val();

        for(var i=0; i<=count; i++){
//           console.log($("#pr_total" + count));
            var pr_total=$("#pr_total" + i).val();
            cal_all =  cal_all + +pr_total;
        }
     //   alert(cal_all);
        $("#all_total").val('');

        $("label[for='all_total']").html(cal_all.toFixed(2));
        $("#market_fee").keyup();
    }


    var product_data=[];

    $("#add_new_row_for_product").on("click",function () {
        //$('#btn_submit').attr('disabled', 'false');
        $('#add_new_row_for_product').hide();

        var product=0;
        var all_total=0;
        var product=$("#product").val();

        var data='';
        var buyer_id=$("#buyer_id"+product).val();
        var goods_id=$("#goods_id"+product).val();
        var hsn_no=$("#hsn_no"+product).val();
        var qty=$("#qty"+product).val();
        var bags=$("#bags"+product).val();
        var price=$("#price"+product).val();
        var pr_total=$("#pr_total"+product).val();


        var all_total=$("label[for='all_total']").html();
        var grandTotal=$("label[for='grandTotal']").html();
        var market_fee=$("#market_fee").val();

        var flag = 0;
        if(buyer_id=='' || buyer_id == undefined || goods_id=='' || qty=='' || seller_id=='' || bags=='' || price==''){

            $("#error_display_msg").html('Please enter all the required Details.');
            $("#error_display_msg").css("color","red");
            $('#add_new_row_for_product').show();
            return false;
        }else{
            var counter = parseInt(product);
            counter++;

            $("#product").val('');

            $("#product").val(counter);

            var data={
                'buyer_id':buyer_id,
                'goods_id':goods_id,
                'hsn_no':hsn_no,
                'qty':qty,
                'bags':bags,
                'price':price
            }



            $.ajax({
                url: '<?php echo route('generate_in_view_list');?>',
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);

                    var options = "";
                    $length = $obj.buyer_list.length ;
                    var i;
                    var options = '<option value="">Select buyer</option>';
                    for (i = 0; i < $length; i++) {
                        options += "<option value="+ $obj.buyer_list[i].id +">"+ $obj.buyer_list[i].buyer_name +"</option>";
                    }


                    var option = '<option value="">Select Goods</option>';
                    $lengths = $obj.goods_type_list.length ;
                    var j;
                    for (j = 0; j < $lengths; j++) {
                        option += " <option value="+ $obj.goods_type_list[j].gt_id +">"+ $obj.goods_type_list[j].gt_type +"</option>";
                    }

                    newRowContent= '<tr id="row_append_table_tr'+(counter)+'"><td> <select name="buyer_id"  id="buyer_id'+(counter)+'">'+ options +'</select> </td> <td> <select name="goods_id" onchange="gethsnno()" id="goods_id'+(counter)+'">'+ option +'</select> </td> <td><input type="text" id="hsn_no'+(counter)+'" name="hsn_no" value="" style=" width: 100px;" disabled/> </td> <td> <input name="qty"  id="qty'+(counter)+'" type="text" value="" style=" width: 90px;"/> </td>  <td> <input type="text" name="price" id="price'+(counter)+'"value="" onfocusout="myFunction()" style=" width: 100px;"> </td><td> <input name="bags" class="buyer_id" id="bags'+(counter)+'" type="text" value="" style=" width: 90px;" /> </td> <td class="text-right"> <input type="text" class="buyer_id" name="pr_total"id="pr_total'+(counter)+'" value="" style=" width: 111px;"> </td>  </tr> ';

                    $("#newRowContent").append(newRowContent);

                }
            });
        }

        $('#add_new_row_for_product').show();
    });
    var data_submit=[];

    $("#btn_submit").on('click',function () {
        //$('#btn_submit').attr('disabled', 'true');

        var product=$("#product").val();
        var market_fee=$("#market_fee").val();
        var all_total=$("label[for='all_total']").html();
        var grandTotal=$("label[for='grandTotal']").html();

        var amount = $("label[for='all_total']").text();
        var market_fee = $("#market_fee").val();
        var market_fee_val = $("label[for='market_fee_val']").text();
        var seller_id = $("#seller_id").val();
        var company_id = $("#company_id").val();
        var flag = 0;
        for(var i=0; i <= product; i++) {


            var pr_total = $("#pr_total" + i).val();
            var spi_invoice_no = $("#spi_invoice_no").val();
            var buyer_id = $("#buyer_id" + i).val();
            var goods_id = $("#goods_id" + i).val();
            var hsn_no = $("#hsn_no" + i).val();
            var qty = $("#qty" + i).val();
            var bags = $("#bags" + i).val();
            var price = $("#price" + i).val();
            var biz_id = $("#company_id").val();
            var seller_id = $("#seller_id").val();
            var total = $("#pr_total" + i).val();
            var bzcp_bzc_id = $('#bzcp_bzc_id_' + i).val();
            var spi_id = $("#spi_id_" + i).val();
            var bpi_id = $('#bpi_id_' + i).val();

            if (buyer_id == '' || goods_id == '' || qty == '' || seller_id == '' || bags == '' || price == '') {

                $("#error_display_msg").html('Please enter all the required Details.');
                $("#error_display_msg").css("color", "red");
                flag++;

            }
        }

        if (flag == 0) {
            $.ajax({

                url: '<?php echo route('add_stock_in_data');?>',
                method: 'POST',
                data: {
                    'seller_id': seller_id,
                    'company_id': company_id,
                    'bpi_id': bpi_id,
                    'amount': amount,
                    'market_fee': market_fee,
                    'market_fee_val': market_fee_val,
                    'total': grandTotal,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
//                       $("#spi_si_id").val($obj['spi_si_id']);
                        localStorage.setItem('spi_si_id_local',$obj['spi_si_id']);

                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            })
        }


        for(var i=0; i <= product; i++) {
            var spi_si_id_local = localStorage.getItem('spi_si_id_local');
            var pr_total = $("#pr_total" + i).val();
            var spi_invoice_no = $("#spi_invoice_no").val();
            var buyer_id = $("#buyer_id" + i).val();
            var goods_id = $("#goods_id" + i).val();
            var hsn_no = $("#hsn_no" + i).val();
            var qty = $("#qty" + i).val();
            var bags = $("#bags" + i).val();
            var price = $("#price" + i).val();
            var biz_id = $("#company_id").val();
            var seller_id = $("#seller_id").val();
            var total = $("#pr_total" + i).val();
            var bzcp_bzc_id = $('#bzcp_bzc_id_' + i).val();
            var spi_id = $("#spi_id_" + i).val();
            var bpi_id = $('#bpi_id_' + i).val();


            var data = {
                'buyer_id': buyer_id,
                'goods_id': goods_id,
                'hsn_no': hsn_no,
                'qty': qty,
                'bags': bags,
                'price': price

            }
            if (flag != 0) {
                return false;
            }else if (flag == 0) {

                $.ajax({
                    url: '<?php echo route('insert_seller_product_invoice');?>',
                    method: 'POST',
                    data: {
                        'bpi_id': bpi_id,
                        'bzcp_bzc_id': bzcp_bzc_id,
                        'spi_biz_id': biz_id,
                        'spi_seller_id': seller_id,
                        'spi_buyer_id': buyer_id,
                        'spi_gt_id': goods_id,
                        'spi_weight': qty,
                        'spi_bid_price': price,
                        'spi_invoice_no': spi_invoice_no,
                        'spi_si_id': spi_si_id_local,
                        'spi_total': total,
                        'spi_no_of_bags': bags,
                        'spi_id': spi_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);

                        if ($obj['SUCCESS'] == 'TRUE') {
//                            localStorage.setItem('spi_id_local',$obj['spi_id']);
                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                    }
                });

                data_submit.push(data);
            }
        }
       // localStorage.clear();
       // var spi_si_id_local = localStorage.getItem('spi_si_id_local');

  //      var url="server/nayatax/seller_bills_list_pending/" ;
         var url = "seller_bills_list_pending/";
         window.location.pathname = url;
    });

</script>
