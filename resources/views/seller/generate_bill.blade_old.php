<!--Start Include header here-->
<style>
    #errmsg {
        color: red;
    }
</style>
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
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>{{ trans('label_word.farmer_bill') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <h3 class="page-title">Farmer Bill</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">

                        <form name="farmer_add" id="bill_Add" method="post" enctype="multipart/form-data">


                            <div class="row">
                                <div class="col-sm-4">
                                    <div>

                                        <div class="form-group" id="divMonth">

                                            <div class="input-icon">
                                                <i class="glyphicon glyphicon-search"></i>
                                                <input name='mobile_no' id="mobile_no" type='text' class="form-control"
                                                       placeholder="{{ trans('label_word.search_farmer') }}" value="" autofocus
                                                       onkeyup="search_farmer();">
                                                <span class="help-block" id="msgMonth" style="float:right;"></span>
                                                <input type="hidden" id="mobile_no_selected" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Display Data Start-->
                                <div class="col-md-8">
                                    <!--<h3 style="margin:0px;">Farmer Details</h3>-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span id="farmer_name"></span><br>
                                        </div>
                                        <div class="col-md-4">
                                            <span id="farmer_mobile"></span><br>
                                        </div>
                                        <div class="col-md-4">
                                            <span id="farmer_city"></span><br>
                                            <span id="farmer_company_name"></span><br>
                                        </div>

                                    </div>
                                </div>
                                <!-- Display Data Ends-->

                            </div>

                            <div class="row"><!-- Add Information Row-->
                                <div class="col-sm-4">

                                    <div class="form-group" id="div_farmer_name" style="display: none">
                                        <label class="control-label">{{ trans('label_word.first_name') }}</label>
                                        <div class="input-icon">
                                            <input type='text' id="first_name" class="form-control" name='farmer_name'
                                                   value=""  placeholder="{{ trans('label_word.first_name') }}">
                                            <span class="help-block" id="msg_farmer_name" style="float:right;"></span>
                                            <input type="hidden" id="farmer_name_selected" value=""/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group" id="div_middle_name" style="display: none">
                                        <label class="control-label">{{ trans('label_word.middle_name') }}</label>
                                        <div class="input-icon">
                                            <input type='text' id="middle_name" class="form-control" name='middle_name'
                                                   value="" placeholder="{{ trans('label_word.middle_name') }}" >
                                            <span class="help-block" id="msg_middle_name" style="float:right;"></span>
                                        </div>
                                        <input type="hidden" id="middle_name_selected" value=""/>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group" id="div_last_name" style="display: none">
                                        <label class="control-label">{{ trans('label_word.last_name') }}</label>
                                        <div class="input-icon">
                                            <input type='text' id="last_name" class="form-control" name='last_name' value=""
                                                   placeholder="{{ trans('label_word.last_name') }}" >
                                            <span class="help-block" id="msg_last_namee" style="float:right;"></span>
                                        </div>
                                        <input type="hidden" id="last_name_selected" value=""/>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group" id="div_mobile" style="display: none">
                                        <label class="control-label">{{ trans('label_word.mobile_no') }}</label>
                                        <div class="input-icon">
                                            <input name='mobile' id="mobile" type='text' class="form-control" value="" placeholder="{{ trans('label_word.mobile_no') }}">
                                            <span class="help-block" id="msg_mobile" style="float:right;"></span>
                                            <input type="hidden" id="mobile_selected" value=""/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group" id="divcity" style="display: none">

                                        <label class="control-label">{{ trans('label_word.city') }}</label>
                                        <div class="input-icon">
                                            <input name='city' id="city" type='city' class="form-control" value="" placeholder="{{ trans('label_word.city') }}">
                                            <span class="help-block" id="msgcity" style="float:right;"></span>

                                            <input type="hidden" id="city_selected" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group" id="div_nick_name" style="display: none">
                                        <label class="control-label">{{ trans('label_word.company_select') }}</label>
                                        <select name="nick_name" id="nick_name" class="form-control select2">

                                            @foreach($data['company_list'] as $item)
                                                <option value="{{$item->id}}"
                                                <?php if (isset($seller_data['seller_data']) && !empty($seller_data['seller_data']) && $item->id == $seller_data['seller_data']->biz_id) {
                                                    echo 'selected';
                                                }?>>{{$item->biz_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block" id="msg_nick_name" style="float:right;"></span>
                                        <input type="hidden" id="nick_name_selected" value=""/>
                                    </div>
                                </div>
                                <div class="text-right" id="page_id">
                                    <input type="hidden" id="farmer_id" value=""/>

                                    <div id="add_farmer_data" style="display: none;">
                                        <button type="button" value="Save" id="farmer_data_save" name="btn_save"
                                                class="btn green"
                                                onclick="add_farmer_data()">{{ trans('label_word.submit') }}</button>
                                        <a href="<?php echo route('dashboard'); ?>"
                                           class="btn default">{{ trans('label_word.cancel') }}</a>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <!--<div class="row">
                            <div class="col-sm-3">
                                <input type="hidden" id="farmer_id" value="" />
                                <div class="form-group" id="add_farmer_data" style="display: none;">
                                    <input type="button" value="Save" id="farmer_data_save" name="btn_save" style=" background:#e67e22;border:0px; color:#fff;width: 26%;" class="btn btn-primary col-md-12" />
                                </div>
                            </div>
                        </div>-->
                    </div>

                    <div class="portlet light bordered" id="buyer_bill_Add_data" style="display: none">

                        <form name="buyer_bill_Add" id="buyer_bill_Add" method="post" style="display: none"
                              enctype="multipart/form-data">

                            <div class="row">&nbsp;</div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" style="margin-top: 10px;" id="buyer_name_hide">
                                        <div class="input-icon">

                                            <i class="glyphicon glyphicon-search"></i>

                                            <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                                   placeholder="{{ trans('label_word.search_buyer') }}" autofocus onkeyup="search_buyer();">
                                            <input type="hidden" id="buyer_name_selected" value="">
                                            <input type="hidden" id="buyer_name_select" value="">

                                            <p class="help-block" id="msg_buyer_name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <!--<h3 style="margin:0px;">Farmer Details</h3>-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span id="b_search_name"></span><br>
                                        </div>
                                        <div class="col-md-4">
                                            <span id="b_search_mobile"></span><br>
                                        </div>
                                        <div class="col-md-3">
                                            <span id="b_search_city"></span><br>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </form>

                        <div class="row" style="display:none;" id="buyer_add_data_form">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-top: 10px;" id="div_buyer_names">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_names" name="buyer_names"
                                               value=""
                                               placeholder="{{ trans('label_word.first_name') }}" autofocus>

                                        <p class="help-block" id="msg_buyer_names"></p>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="form-group" style="margin-top: 10px;" id="div_buyer_middle_name">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_middle_name"
                                               name="buyer_middle_name" value=""
                                               placeholder="{{ trans('label_word.middle_name') }}" autofocus>

                                        <p class="help-block" id="msg_buyer_middle_name"></p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group" style="margin-top: 10px;" id="div_buyer_last_name">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_last_name"
                                               name="buyer_last_name" value=""
                                               placeholder="{{ trans('label_word.last_name') }}" autofocus>

                                        <p class="help-block" id="msg_buyer_last_name"></p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group" style="margin-top: 10px;" id="div_buyer_mobile">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_mobile" name="buyer_mobile"
                                               value=""
                                               placeholder="{{ trans('label_word.mobile_no') }}" autofocus>

                                        <p class="help-block" id="msg_buyer_mobile"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">

                                <div class="form-group" style="margin-top: 10px;" id="div_buyer_city">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_city" name="buyer_city"
                                               value=""
                                               placeholder="{{ trans('label_word.city') }}" autofocus>

                                        <p class="help-block" id="msg_buyer_city"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-4" >
                                <div class="form-group" id="div_buyer_district" style="margin-top: 10px;">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_district" placeholder="{{ trans('label_word.district') }}" name="buyer_district" value=""
                                               autofocus >

                                        <p class="help-block" id="msg_buyer_district"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4" >
                                <div class="form-group" id="div_buyer_state" style="margin-top: 10px;">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="buyer_state" name="buyer_state" placeholder="{{ trans('label_word.state') }}"value=""
                                               autofocus >

                                        <p class="help-block" id="msg_buyer_state"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">
                                        <select name="company_select" id="company_select" class="form-control select2"
                                                autofocus>

                                            @foreach($data['company_list'] as $item)
                                                <option value="{{$item->id}}"
                                                <?php if (isset($seller_data['seller_data']) && !empty($seller_data['seller_data']) && $item->id == $seller_data['seller_data']->biz_id) {
                                                    echo 'selected';
                                                }?>>{{$item->biz_name}}</option>
                                            @endforeach
                                        </select>

                                        <p class="help-block" id="msg_company_select"></p>
                                    </div>
                                </div>

                            </div>

                            <div class="text-right" id="page_id">
                                <input type="hidden" id="buyer_id" value=""/>

                                <div id="add_buyer_data" style="margin-bottom: 11px;">
                                    <button type="button" value="Save" id="addmaintencebillbtn" name="btn_save"
                                            class="btn green"
                                            onclick="add_buyer_data()" style="margin-top: 10px;">{{ trans('label_word.submit') }}</button>
                                    <a href="<?php echo route('dashboard'); ?>"
                                       class="btn default" style="margin-top: 10px;">{{ trans('label_word.cancel') }}</a>
                                </div>
                            </div>

                            <!-- <div class="row">
                                 <div class="col-md-2">
                                     <div class="form-group" id="add_buyer_data">
                                         <input type="button" value="Save" id="addmaintencebillbtn" name="btn_save" style="background:#e67e22;border:0px; color:#fff;width: 38%; margin-left: 10px;margin-top: 14px;margin-bottom: 10px;" class="btn btn-primary col-md-12" onclick="add_buyer_data()"/>
                                     </div>
                                 </div>
                             </div>-->
                            <!--div id="water_reading_details">sdd</div-->
                        </div>
                        <div class="row" id="Form_add_farmer_invoice" style="display: none">

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_good_type">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">
                                        <!-- <select name='good_type' style="    width: 154px;" id="good_type" onchange="gethsnno()">
                                                        <option value="">Select Goods</option>
                                                        @foreach($data['goods_type_list'] as $list)
                                                            <option value="{{$list->gt_id}}">{{$list->gt_type}}</option>
                                                        @endforeach
                                                </select>-->
                                        <input type="text" class="form-control" id="good_type" name="good_type"
                                               placeholder="{{ trans('label_word.good_type_sidebar') }}"
                                               onkeyup="search_goods_type();">
                                        <input type="hidden" id="goods_type_selected" value="">

                                        <p class="help-block" id="msg_good_type"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_hsn_no" style="display: none">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="hsn_no" name="hsn_no"
                                               placeholder="{{ trans('label_word.hsn_no') }}">

                                        <p class="help-block" id="msg_hsn_no"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_gst_radio_button" style="display:none;">
                                <div class="form-group" style="margin-top: 17px;">
                                    <div class="input-icon">

                                        <label>{{ trans('label_word.gst_item_include') }}</label>

                                        <p class="help-block" ></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_gst_radio_button1" style="display:none;">

                                <div class="col-md-8" style="margin-top: 10px;margin-left: -81px;">
                                    <div class="radio-list">
                                        <div class="col-md-6">
                                            <label class="radio-inline">
                                                <input type="radio" name="tex" id="yes" value="True"> {{ trans('label_word.yes') }} </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="radio-inline">
                                                <input type="radio" name="tex" id="no" value="False"> {{ trans('label_word.no') }} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2 hidden"  id="div_cgst">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="cgst_tax" name="cgst_tax"
                                               placeholder="{{ trans('label_word.c_tax') }}">

                                        <p class="help-block" id="msg_cgst"></p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2 hidden" id="div_sgst">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="sgst_tax" name="sgst_tax"
                                               placeholder="{{ trans('label_word.s_tax') }}">

                                        <p class="help-block" id="msg_sgst"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2 hidden"  id="div_igst">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="igst_tax" name="igst_tax"
                                               placeholder="{{ trans('label_word.i_tax') }}">

                                        <p class="help-block" id="msg_igst"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_weight">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="weight" name="weight"
                                               placeholder="{{ trans('label_word.weight') }} (Kg.)">

                                        <p class="help-block" id="msg_weight"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_price">

                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="price" name="price"
                                               placeholder="{{ trans('label_word.price') }} Per <?php if (!empty($data['site_setting_data'])) {
                                                   echo $data['site_setting_data']->setting_kg_price;
                                               }?>">

                                        <p class="help-block" id="msg_price"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2" id="div_bags">
                                <div class="form-group" style="margin-top: 10px;">
                                    <div class="input-icon">

                                        <input type="text" class="form-control" id="bags" name="bags"
                                               placeholder="{{ trans('label_word.bags') }}">

                                        <p class="help-block" id="msg_bags"></p>

                                    </div>
                                </div>
                            </div>
                            <div class="text-right" id="page_id">
                                <input type="hidden" id="farmer_id" value=""/>

                                <div id="add_farmer_data" style="display: none;">
                                    <button type="button" value="Save" id="farmer_data_save" name="btn_save"
                                            class="btn green"
                                            onclick="add_farmer_data()">{{ trans('label_word.submit') }}</button>
                                </div>
                            </div>

                            <div class="col-md-1 col-xs-2 col-lg-2 col-sm-2">
                                <div class="form-group">
                                    <button type="button" id="add_new_row_for_product"
                                            class="btn btn-primary col-md-12"
                                            style="background:#e67e22;border:0px; color:#fff;width: 38%;margin-top: 10px;">{{ trans('label_word.save') }}</button>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="portlet light bordered" id="Form_view_farmer_invoice" style="display: none">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <table class="table table-hover" style="margin: 0;">
                                    <thead id="table_header">
                                    <tr>
                                        <th class='text-center'> SR. No</th>
                                        <th class='text-center'> {{ trans('label_word.buyer_name') }}</th>
                                        <th class='text-center'> {{ trans('label_word.good_type_sidebar') }}</th>
                                        <th class='text-center'> {{ trans('label_word.weight') }}(Kg.)</th>
                                        <th class='text-center'> {{ trans('label_word.price') }} Per
                                            <?php if (!empty($data['site_setting_data'])) {
                                                echo $data['site_setting_data']->setting_kg_price;
                                            }?>
                                            <input type='hidden' name="price_kg"
                                                   id="price_kg"
                                                   value="<?php if (!empty($data['site_setting_data'])) {
                                                       echo $data['site_setting_data']->setting_kg_price;
                                                   }?>"
                                        </th>
                                        <th class='text-right'> {{ trans('label_word.bags') }}</th>
                                        <th class='text-right'> {{ trans('label_word.total') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="add_row_tr_td">

                                    </tbody>
                                </table>

                                <table class="table table-hover" style="margin: 0;">
                                    <tbody id="total_table">
                                    <tr>
                                        <td class="text-right" id="market" style="line-height: 2.42857 !important;">
                                                                <span style="margin-left: 921px;">{{ trans('label_word.wages') }}

                                                                    :</span>
                                            <span>
                                            <input type="text"
                                                   style="width: 10%; float: right;"
                                                   name="market_fee" class="form-control" id="market_fee"
                                                   value="<?php echo $data['site_setting_data']->settings_wages;?>" disabled >&nbsp;
                                                </span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" id="market" style="line-height: 2.42857 !important;">
                                                                <span style="margin-left: 876px;">Other Charge
                                                                    :</span>
                                            <span>
                                            <input type="text" class="form-control"
                                                   style="width: 10%;  float: right;"
                                                   name="other_charge" id="other_charge"
                                                   value="">&nbsp;</span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-right" id="grand_total">
                                                                <span style="margin-left: 876px;">{{ trans('label_word.grand_total') }}
                                                                    :</span>
                                            <i
                                                    class="fa fa-inr"
                                                    aria-hidden="true"></i>&nbsp; <label id="grandTotal"
                                                                                         for="grandTotal"></label>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <span id="msg_market_fee"></span>
                                <input type="hidden" value="" id="supergrandTotal">

                            </div>
                            <div class="text-right" id="page_id">
                                <button type="button" id="product_submit"
                                        class="btn green">{{ trans('label_word.submit') }}</button>
                                <!--<button type="button" id="product_submit_pdf" class="btn green" >Save AND Print</button>-->
                                <a href="<?php echo route('dashboard'); ?>"
                                   class="btn default">{{ trans('label_word.cancel') }}</a>
                            </div>

                        </div>
                        <!--</div>-->

                    </div>

                </div>

                <div class="clearfix"></div>
                <!-- END CREATE ADMIN-->

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->

<script>
    //--------------------------------------Search farmer data---------------------------------
    var display_add_data = [];
    var selected_farmer_mobile_number;

    function search_farmer() {

        if (display_add_data.length == 0) {
            $.ajax({
                url: '<?php echo route('seller_data_serach');?>',
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    display_add_data = [];
                    var obj = JSON.parse(result);

                    var length = obj.length;

                    for (var i = 0; i < length; i++) {

                        // farmer_user_id.push(obj[i].id);
                        //  farmer_data.push({id:obj[i].id, name:obj[i].f_name + ' ' +obj[i].m_name+ ' ' +obj[i].l_name , email:obj[i].email, mobile:obj[i].mobile,company_name:obj[i].biz_name,city:obj[i].city});
                        display_add_data.push(obj[i].f_name + ' ' + obj[i].m_name + ' ' + obj[i].l_name + '-' + obj[i].mobile + '-' + obj[i].city)
                    }
                }
            });

        }


        $("#mobile_no").autocomplete({
            source: display_add_data,
            minLength: 3
        })

        $('#mobile_no').on('autocompletechange change', function () {

            $('#mobile_no_selected').val(this.value);
            var flags = 0;
            if (this.value.length > 3) {
                for (var a = 0; a < display_add_data.length; a++) {
                    if (this.value == display_add_data[a]) {
                        flags = 1;
                        break;
                    }
                }
                if (flags == 1) {
                    selected_farmer_mobile_number = this.value;

                    $("#msgMonth").html('');
                    $("#divcity").attr("style", "display:none");
                    $("#div_nick_name").attr("style", "display:none");
                    $("#div_farmer_name").attr("style", "display:none");
                    $("#div_middle_name").attr("style", "display:none");
                    $("#div_last_name").attr("style", "display:none");
                    $("#div_mobile").attr("style", "display:none");
                    $("#div_district").attr("style", "display:none");
                    $("#div_state").attr("style", "display:none");
                    $("#add_farmer_data").attr("style", "display:none");
                    search_all_farmer_data();
                } else {
                    $("#msgMonth").html("Your serach data not match with existing farmer please add new farmer");
                    $("#farmer_name").html('');
                    $("#farmer_mobile").html('');
                    $("#farmer_city").html('');
                    $('#farmer_id').val('');
                    $("#divcity").attr("style", "display:block");
                    $("#div_nick_name").attr("style", "display:block");
                    $("#div_farmer_name").attr("style", "display:block");
                    $("#div_middle_name").attr("style", "display:block");
                    $("#div_last_name").attr("style", "display:block");
                    $("#div_mobile").attr("style", "display:block");
                    $("#div_district").attr("style", "display:block");
                    $("#add_farmer_data").attr("style", "display:block");
                    $("#div_state").attr("style", "display:block");
                    $("#msgMonth").html("Your serach data not match with existing farmer please add new farmer");
                    $("#msgMonth").attr("style", "color:red");
                    //  add_farmer_data();
                }
            }

        }).change();
    }
    function search_all_farmer_data() {
        var farmer_name_selected = $('#mobile_no_selected').val();


        if (farmer_name_selected != '') {
            var all_data = farmer_name_selected.split("-");
            var mobile_no = all_data[1];
            var name = all_data[0];
            var city = all_data[2];
            $("#farmer_name").html('Name: ' + name);
            $("#farmer_mobile").html('Mobile No: ' + mobile_no);
            $("#farmer_city").html('Village / City: ' + city);
            $('#farmer_id').val(mobile_no);
            $("#Form_add_farmer_invoice").attr("style", "display:block");
            $("#Form_add_farmer_invoice").attr("style", "box-shadow:0px 0px 0px 2px rgba(0, 0, 0, .09)");
            $("#buyer_bill_Add").attr("style", "display:block");
            $("#buyer_bill_Add_data").attr("style", "display:block");
        }
    }
    //--------------------------------Add Farmer Data----------------------------------------

    function add_farmer_data() {

        var flag = 0;
        var scroll_element = '';


        var mobile_no = $('#mobile').val();
        var city = $('#city').val();
        var nick_name = $('#nick_name').val();
        var farmer_name = $('#first_name').val();
        var middle_name = $('#middle_name').val();
        var last_name = $('#last_name').val();
        var district = $('#district').val();
        var state = $('#state').val();
        var flag = 0;
        if (mobile_no == '') {
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Required Field..");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mobile';
            }

        } else if (mobile_no != '') {
            var user_id = '';
            var mobile_test = $.ajax({
                url: '<?php echo route("check_unique_mobile");?>',
                method: 'POST',
                async: false,
                data: {
                    'mobile': mobile_no,
                    'user_id': user_id,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_mobile").removeClass('has-error');
                        $("#msg_mobile").html("");
                        $("#btnSubmit").removeAttr('disabled');
                    } else {
                        $("#div_mobile").addClass('has-error');
                        $("#msg_mobile").html("Mobile Exist.");
                        flag++;
                    }

                }
            });
        } else {
            $("#div_mobile").removeClass('has-error');
            $("#msg_mobile").html("");
        }
        if (farmer_name == '') {
            $("#div_farmer_name").addClass('has-error');
            $("#msg_farmer_name").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_farmer_name';
            }

        } else {
            $("#div_farmer_name").removeClass('has-error');
            $("#msg_farmer_name").html("");
        }
        if (middle_name == '') {
            $("#div_middle_name").addClass('has-error');
            $("#msg_middle_name").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_middle_name';
            }

        } else {
            $("#div_middle_name").removeClass('has-error');
            $("#msg_middle_name").html("");
        }
        if (last_name == '') {
            $("#div_last_name").addClass('has-error');
            $("#msg_last_namee").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_last_name';
            }

        } else {
            $("#div_last_name").removeClass('has-error');
            $("#msg_last_namee").html("");
        }
        if (city == '') {
            $("#divcity").addClass('has-error');
            $("#msgcity").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'divcity';
            }

        } else {
            $("#divcity").removeClass('has-error');
            $("#msgcity").html("");
        }
        if (flag == 0) {
            $("#msg_bags").html("");
            $.ajax({
                url: '<?php echo route('farmer_data_add');?>',
                method: 'POST',
                data: {
                    'mobile_no': mobile_no,
                    'name': farmer_name,
                    'city': city,
                    'middle_name': middle_name,
                    'nick_name': nick_name,
                    'last_name': last_name,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj == '') {
                        $("#divcity").attr("style", "display:block");
                        $("#div_nick_name").attr("style", "display:block");
                        $("#div_farmer_name").attr("style", "display:block");
                        $("#div_middle_name").attr("style", "display:block");
                        $("#div_last_name").attr("style", "display:block");
                        $("#div_mobile").attr("style", "display:block");
                        $("#add_farmer_data").attr("style", "display:block");
                        $("#msgMonth").html("Your serach data not match with existing farmer please add new farmer");
                        $("#msgMonth").attr("style", "color:red");
                    }
                    else {
                        $("#farmer_name").html('Name: ' + $obj[0].f_name + ' ' + $obj[0].m_name + ' ' + $obj[0].l_name);
                        $("#farmer_mobile").html('Mobile No: ' + $obj[0].mobile);
                        $("#farmer_city").html('Village / City: ' + $obj[0].city);
                        $('#farmer_id').val($obj[0].mobile);
                        $("#divcity").attr("style", "display:none");
                        $("#div_nick_name").attr("style", "display:none");
                        $("#div_farmer_name").attr("style", "display:none");
                        $("#div_middle_name").attr("style", "display:none");
                        $("#div_last_name").attr("style", "display:none");
                        $("#div_mobile").attr("style", "display:none");
                        $("#div_district").attr("style", "display:none");
                        $("#add_farmer_data").attr("style", "display:none");
                        $("#msgMonth").html('');
                        $("#div_state").attr("style", "display:none");
                        $("#buyer_bill_Add").attr("style", "display:block");
                        $("#Form_add_farmer_invoice").attr("style", "display:block");
                        $("#Form_add_farmer_invoice").attr("style", "box-shadow:0px 0px 0px 2px rgba(0, 0, 0, .09)");
                        $("#buyer_bill_Add_data").attr("style", "display:block");
                    }

                }

            });
        } else {

            return false;
        }

    }


    //--------------------------------------Search Buyer data---------------------------------

    var buyer_display_add_data = [];
    function search_buyer() {
        $('#mobile_no').val('');
        var buyer_name = [];
        if (buyer_display_add_data.length == 0) {
            $.ajax({
                url: '<?php echo route('buyer_data_serach');?>',
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    buyer_display_add_data = [];
                    var obj = JSON.parse(result);

                    var length = obj.length;

                    for (var i = 0; i < length; i++) {

                        buyer_display_add_data.push(obj[i].f_name + ' ' + obj[i].m_name + ' ' + obj[i].l_name + '-' + obj[i].mobile + '-' + obj[i].city)

                    }
                }
            });
        }

        $("#buyer_name").autocomplete({
            source: buyer_display_add_data,
            minLength: 3
        })

        $('#buyer_name').on('autocompletechange change', function () {

            $('#buyer_name_selected').val(this.value);
            var flagss = 0;

            if (this.value.length > 3) {
                for (var a = 0; a < buyer_display_add_data.length; a++) {

                    if (this.value == buyer_display_add_data[a]) {
                        flagss = 1;
                        break;
                    }

                }

                if (flagss == 1) {
                    $("#msg_buyer_name").html('');
                    $("#buyer_add_data_form").attr("style", "display:none");
                    //$('#buyer_name_hide').show();
                    search_all_buyer_data();

                    $("#msgMonth").html("");
                } else {
                    $("#msg_buyer_name").html("Your serach data not match with existing Buyer please add new Buyer");
                    $("#msg_buyer_name").css("color", "red");
                    $("#buyer_add_data_form").attr("style", "display:block");
                    $('#b_search_mobile').html('');
                    $('#b_search_name').html('');
                    $('#b_search_city').html('');
                    // $('#buyer_name_hide').hide();
                    // add_buyer_data();
                }
            }

        }).change();


    }

    function search_all_buyer_data() {
        var buyer_name_selected = $('#buyer_name_selected').val();


        var city = $('#city').val();

        if (buyer_name_selected != '') {
            var all_data = buyer_name_selected.split("-");
            var mobile_no = all_data[1];
            var name = all_data[0];
            var city = all_data[2];
            $('#b_search_mobile').html('Mobile No.: ' + mobile_no);
            $('#b_search_name').html('Name: ' + name);
            $('#b_search_city').html('Village / City: ' + city);
            // $("#buyer_mobile").val(mobile_no);
            $("#buyer_name_select").val(name);
            //$('#buyer_name_hide').hide();
        }
    }
    function add_buyer_data() {

        var flag = 0;
        var scroll_element = '';


        var buyer_mobile = $('#buyer_mobile').val();
        var buyer_names = $('#buyer_names').val();
        var buyer_middle_name = $('#buyer_middle_name').val();
        var buyer_last_name = $('#buyer_last_name').val();
        var buyer_city = $('#buyer_city').val();
        var buyer_district = $('#buyer_district').val();
        var buyer_state = $('#buyer_state').val();
        var company_select = $('#company_select').val();
        var flag = 0;
        if (buyer_mobile == '') {
            $("#div_buyer_mobile").addClass('has-error');
            $("#msg_buyer_mobile").html("Required Field..");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_mobile';
            }

        } else if (buyer_mobile != '') {
            var user_id = '';
            var mobile_test = $.ajax({
                url: '<?php echo route("check_unique_mobile");?>',
                method: 'POST',
                async: false,
                data: {
                    'mobile': buyer_mobile,
                    'user_id': user_id,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_buyer_mobile").removeClass('has-error');
                        $("#msg_buyer_mobile").html("");
                        $("#btnSubmit").removeAttr('disabled');
                    } else {
                        $("#div_buyer_mobile").addClass('has-error');
                        $("#msg_buyer_mobile").html("Mobile Exist.");
                        flag++;
                    }

                }
            });
        } else {
            $("#div_buyer_mobile").removeClass('has-error');
            $("#msg_buyer_mobile").html("");
        }
        if (buyer_names == '') {
            $("#div_buyer_names").addClass('has-error');
            $("#msg_buyer_names").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_buyer_names';
            }

        } else {
            $("#div_buyer_names").removeClass('has-error');
            $("#msg_buyer_names").html("");
        }
        if (buyer_middle_name == '') {
            $("#div_buyer_middle_name").addClass('has-error');
            $("#msg_buyer_middle_name").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_buyer_middle_name';
            }

        } else {
            $("#div_buyer_middle_name").removeClass('has-error');
            $("#msg_buyer_middle_name").html("");
        }
        if (buyer_last_name == '') {
            $("#div_buyer_last_name").addClass('has-error');
            $("#msg_buyer_last_name").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'buyer_last_name';
            }

        } else {
            $("#div_buyer_last_name").removeClass('has-error');
            $("#msg_buyer_last_name").html("");
        }
        if (buyer_city == '') {
            $("#div_buyer_city").addClass('has-error');
            $("#msg_buyer_city").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_buyer_city';
            }

        } else {
            $("#div_buyer_city").removeClass('has-error');
            $("#msg_buyer_city").html("");
        }
        if (buyer_district == '') {
            $("#div_buyer_district").addClass('has-error');
            $("#msg_buyer_district").html("Required Field...");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_buyer_district';
            }

        } else {
            $("#div_buyer_district").removeClass('has-error');
            $("#msg_buyer_district").html("");
        }
        if (flag == 0) {
            $("#msg_bags").html("");
            $.ajax({
                url: '<?php echo route('farmer_data_add');?>',
                method: 'POST',
                data: {
                    'mobile_no': buyer_mobile,
                    'name': buyer_names,
                    'city': buyer_city,
                    'middle_name': buyer_middle_name,
                    'nick_name': company_select,
                    'last_name': buyer_last_name,
                    'buyer_district':buyer_district,
                    'buyer_state':buyer_state,
                    'type': 'buyer',
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj == '') {
                        $("#div_buyer_district").attr("style", "display:block");
                        $("#div_buyer_city").attr("style", "display:block");
                        $("#buyer_middle_name").attr("style", "display:block");
                        $("#div_buyer_last_name").attr("style", "display:block");
                        $("#div_nick_name").attr("style", "display:block");
                        $("#div_buyer_names").attr("style", "display:block");
                        $("#div_buyer_state").attr("style", "display:block");
                        $("#div_buyer_mobile").attr("style", "display:block");
                        $("#msg_buyer_name").html("Your serach data not match with existing Buyer please add new Buyer");
                        $("#msg_buyer_name").attr("style", "color:red");
                        // $('#buyer_name_hide').show();
                    }
                    else {
                        $('#b_search_mobile').html('Mobile No.: ' + $obj[0].mobile);
                        $('#b_search_name').html('Name: ' + $obj[0].f_name + ' ' + $obj[0].m_name + ' ' + $obj[0].l_name);
                        $('#b_search_city').html('Village / City: ' + $obj[0].city);
                        $('#buyer_id').val($obj[0].id);
                        $("#buyer_add_data_form").attr("style", "display:none");
                        $("#buyer_name").html();
                        $("#msg_buyer_name").html('');
                        //  $('#buyer_name_hide').hide();
                        $("#Form_add_farmer_invoice").attr("style", "display:block");
                        $("#Form_add_farmer_invoice").attr("style", "box-shadow:0px 0px 0px 2px rgba(0, 0, 0, .09)");
                        // $("#buyer_bill_Add").attr("style", "display:block");
                    }


                }

            });
        }

    }
</script>


<script>
    //called when key is pressed in textbox
    $("#weight").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#div_weight").addClass('has-error');
            $("#msg_weight").html("Digits Only");
            return false;
        }
        else {
            $("#div_weight").removeClass('has-error');
            $("#msg_weight").html("");
        }
    });

    $("#weight").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#div_weight").addClass('has-error');
            $("#msg_weight").html("Digits Only");
            return false;
        }
        else {
            $("#div_weight").removeClass('has-error');
            $("#msg_weight").html("");
        }
    });

    $("#buyer_names").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_buyer_names").addClass('has-error');
            $("#msg_buyer_middle_name").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_buyer_names").removeClass('has-error');
            $("#msg_buyer_names").html("");
        }
    });

    $("#bags").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#div_bags").addClass('has-error');
            $("#msg_bags").html("Digits Only");
            return false;
        }
        else {
            $("#div_bags").removeClass('has-error');
            $("#msg_bags").html("");
        }
    });

    $("#price").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#div_price").addClass('has-error');
            $("#msg_price").html("Digits Only");
            return false;
        }
        else {
            $("#div_price").removeClass('has-error');
            $("#msg_price").html("");
        }
    });
    $("#market_fee").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#msg_market_fee").html("Digits Only Enter In Market Fees");
            return false;
        }
        else {
            $("#msg_market_fee").html("");
        }
    });

    $("#other_charge").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#msg_market_fee").html("Digits Only Enter In Other Charge");
            return false;
        }
        else {
            $("#msg_market_fee").html("");
        }
    });

    $("#farmer_name").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_farmer_name").addClass('has-error');
            $("#msg_farmer_name").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_farmer_name").removeClass('has-error');
            $("#msg_farmer_name").html("");
        }
    });

    $("#good_type").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_good_type").addClass('has-error');
            $("#msg_good_type").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_good_type").removeClass('has-error');
            $("#msg_good_type").html("");
        }
    });


    $("#mobile").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Digits Only");
            return false;
        }
        else {
            $("#div_mobile").removeClass('has-error');
            $("#msg_mobile").html("");
        }
    });

    $("#farmer_name").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_farmer_name").addClass('has-error');
            $("#msg_farmer_name").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_farmer_name").removeClass('has-error');
            $("#msg_farmer_name").html("");
        }
    });
    $("#last_name").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_last_name").addClass('has-error');
            $("#msg_last_namee").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_last_name").removeClass('has-error');
            $("#msg_last_namee").html("");
        }
    });
    $("#middle_name").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_middle_name").addClass('has-error');
            $("#msg_middle_name").html("Alphabate Only");
            if (scroll_element == '') {
                scroll_element = 'div_middle_name';
            }
            return false;
        }
        else {
            $("#div_middle_name").removeClass('has-error');
            $("#msg_middle_name").html("");
        }
    });
    $("#city").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#divcity").addClass('has-error');
            $("#msgcity").html("Alphabate Only");
            return false;
        }
        else {
            $("#divcity").removeClass('has-error');
            $("#msgcity").html("");
        }
    });


    $("#buyer_mobile").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            //  $("#errmsg").html("Digits Only").show().fadeOut("slow");
            $("#div_buyer_mobile").addClass('has-error');
            $("#msg_buyer_mobile").html("Digits Only");
            return false;
        }
        else {
            $("#div_buyer_mobile").removeClass('has-error');
            $("#msg_buyer_mobile").html("");
        }
    });


    $("#buyer_middle_name").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_buyer_middle_name").addClass('has-error');
            $("#msg_buyer_middle_name").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_buyer_middle_name").removeClass('has-error');
            $("#msg_buyer_middle_name").html("");
        }
    });
    $("#buyer_last_name").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_buyer_last_name").addClass('has-error');
            $("#msg_buyer_last_name").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_buyer_last_name").removeClass('has-error');
            $("#msg_buyer_last_name").html("");
        }
    });
    $("#buyer_city").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            $("#div_buyer_city").addClass('has-error');
            $("#msg_buyer_city").html("Alphabate Only");
            return false;
        }
        else {
            $("#div_buyer_city").removeClass('has-error');
            $("#msg_buyer_city").html("");
        }
    });
    var goods_display_data = [];
    function search_goods_type() {

        var search_name = $('#b_search_name').html();
        if (search_name == '') {
            $('#msg_buyer_name').html('Please First Select Buyer.');
            $("#msg_buyer_name").css("color", "red");
            $("#buyer_name").focus();
            return false;
        } else {
            $('#msg_buyer_name').html('');
        }
        $('#buyer_name').val('');
        var display_add_data = [];

        if (goods_display_data.length == 0) {
            $.ajax({
                url: '<?php echo route('good_type_serach');?>',
                method: 'POST',
                data: {
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    var obj = JSON.parse(result);

                    var length = obj.length;

                    for (var i = 0; i < length; i++) {

                        goods_display_data.push(obj[i].gt_type)
                    }
                }
            });
        }

        $("#good_type").autocomplete({
            source: goods_display_data,
            minLength: 3
        })

        $('#good_type').on('autocompletechange change', function () {
            $('#good_type_selected').val(this.value);

            var flagsss = 0;

            if (this.value.length > 3) {
                for (var a = 0; a < goods_display_data.length; a++) {

                    if (this.value == goods_display_data[a]) {
                        flagsss = 1;
                        break;
                    }

                }

                if (flagsss == 1) {

                    $("#div_hsn_no").attr("style", "display:none");
                    $("#div_gst_radio_button").attr("style", "display:none");
                    $("#div_gst_radio_button1").attr("style", "display:none");
                } else {
                    $("#div_hsn_no").attr("style", "display:block");
                    $("#div_gst_radio_button").attr("style", "display:block");
                    $("#div_gst_radio_button1").attr("style", "display:block");
                }
            }

        }).change();
    }


</script>
<script>
    var buyer_input = document.getElementById('buyer_city');
    var autocomplete = new google.maps.places.Autocomplete(buyer_input);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        /*$("#result").html('');*/
        var types_arr;
        $("#place_id").val(place.place_id);
        var city = '';
        var state = '';
        var country = '';
        console.log(place);
        $.each(place.address_components, function (index, value) {
            //$("#result").html($("#result").html()+'<label><strong>'+index+'</strong>:&nbsp;&nbsp;</label>'+value+'<br>');
            /*$.each(this.types,function(index,value){
             alert(this.index);
             });*/
            var locality = 0;
            var administrative_area_level_2 = 0;
            var administrative_area_level_1 = 0;
            var country = 0;
            //alert(place.place_id);

            $.each(this.types, function (index, value) {
                //alert(index+' -- '+value);
                if (value == 'locality') {
                    locality++;
                    return;
                }
                ;
                if (value == 'administrative_area_level_2') {
                    administrative_area_level_2++;
                    return;
                }
                ;
                if (value == 'administrative_area_level_1') {
                    administrative_area_level_1++;
                    return;
                }
                ;
                if (value == 'country') {
                    country++;
                    return;
                }
                ;
            });

            if (locality > 0) {
                city = this.long_name;
                $("#buyer_city").val(this.long_name);
            } else if (administrative_area_level_1 > 0) {
                state = this.long_name;
                if (city == '') {
                    //$("#"+element_city).val(this.long_name);
                    $("#buyer_city").val('');
                }
                $("#buyer_state").val(this.long_name);
            } else if (administrative_area_level_2 > 0) {
                distirict = this.long_name;
                if (city == '') {
                    $("#buyer_district").val('');
                }
                $("#buyer_district").val(this.long_name);
            }else if (country > 0) {
                country = this.long_name;
                if (state == '') {
                    //$("#"+element_state).val(this.long_name);
                    $("#buyer_state").val('');
                }
                if (city == '') {
                    if (state != '') {
                        //$("#"+element_city).val(state);
                        $("#buyer_state").val('');
                    } else {
                        //$("#"+element_city).val(this.long_name);
                        $("#buyer_city").val('');
                    }
                }

                $("#buyer_country").val(this.long_name);
            } else {

            }
        });
        //alert(JSON.stringify(place));
    });

    var Save_all_product_data = [];
    var product_grand_total = 0;

    $("#add_new_row_for_product").on("click", function () {

        $("#buyer_name").focus();

        var buyer_name = $("#buyer_name").val();
        var b_search_name = $("#b_search_name").html();
        var b_search_mobile = $("#b_search_mobile").html();
        var good_type = $("#good_type").val();
        var hsn_no = $("#hsn_no").val();
        var weight = $("#weight").val();
        var price = $("#price").val();
        var bags = $("#bags").val();
        var buyer_mobile = $("#buyer_mobile").val();
        var buyer_id = $("#buyer_id").val();
        var cgst_tax = $("#cgst_tax").val();
        var sgst_tax = $("#sgst_tax").val();
        var igst_tax = $("#igst_tax").val();
        var tex= $('input[type=radio][name=tex]').val();
        var flag = 0;
        var scroll_element = '';

        if (good_type == '') {
            $("#div_good_type").addClass('has-error');
            //$("#msg_good_type").html("Required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_good_type';
            }

        } else {
            $("#div_good_type").removeClass('has-error');
            $("#msg_good_type").html("");
        }


        if (weight == '') {
            $("#div_weight").addClass('has-error');
            //$("#msg_good_type").html("Required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_weight';
            }

        } else {
            $("#div_weight").removeClass('has-error');
            // $("#msg_good_type").html("");
        }

        if (price == '') {
            $("#div_price").addClass('has-error');
            //$("#msg_good_type").html("Required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_price';
            }

        } else {
            $("#div_price").removeClass('has-error');
            // $("#msg_good_type").html("");
        }

        if (bags == '') {
            $("#div_bags").addClass('has-error');
            //$("#msg_good_type").html("Required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_weight';
            }

        } else {
            $("#div_bags").removeClass('has-error');
            // $("#msg_good_type").html("");
        }


        if (flag == 0) {
            $("#msg_bags").html("");

            var kg = $("#price_kg").val().replace('Kg', '');

            if (kg != 1) {
                var kg_price = (price * 1) / kg;

            } else {
                var kg_price = (price * 1);
            }

            var total = weight * kg_price;
            if(isNaN(total)){
                $("#msg_bags").html("Please Enter Valid Input.");
                $("#msg_bags").attr("style", "color:red");
                if (scroll_element == '') {
                    scroll_element = 'div_weight';
                }
                return false;
            }else{
                $("#msg_bags").html("");
            }

            var b_search_name = b_search_name.split(":");
            var b_search_mobile = b_search_mobile.split(":");

            var cgst_tax = $("#cgst_tax").val();
            var sgst_tax = $("#sgst_tax").val();
            var igst_tax = $("#igst_tax").val();

            var tex= $('input[type=radio][name=tex]').val();

            var product_data = {
                buyers_name: b_search_name[1],
                buyer_id: buyer_id,
                buyer_mobile: b_search_mobile[1],
                good_type: good_type,
                hsn_no: hsn_no,
                weight: weight,
                price: price,
                bags: bags,
                total:(parseFloat(total).toFixed(2)),
                cgst_tax:cgst_tax,
                sgst_tax:sgst_tax,
                igst_tax:igst_tax,
                tex:tex
            }

            product_grand_total = product_grand_total + total;
            $("#grandTotal").html(parseFloat(product_grand_total).toFixed(2));
            $("#supergrandTotal").val(parseFloat(product_grand_total).toFixed(2));

            Save_all_product_data.push(product_data);

            var grandTotal = $("#supergrandTotal").val();
            var market_fee = $("#market_fee").val();
            grandTotal = grandTotal - market_fee;
            $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
            // localStorage.setItem("test", Save_all_product_data);
            //  $.session.set('key', JSON.stringify(Save_all_product_data));

            $("#buyer_name").val('');
            $("#buyer_names").val('');
            $("#buyer_middle_name").val('');
            $("#buyer_last_name").val('');
            $("#buyer_district").val('');
            $("#buyer_state").val('');
            $("#buyer_city").val('');
            $("#good_type").val('');
            $("#hsn_no").val('');
            $("#weight").val('');
            $("#price").val('');
            $("#bags").val('');
            $("#buyer_mobile").val('');
            $("#buyer_id").val('');
            $("#b_search_name").html('');
            $("#b_search_mobile").html('');
            $("#b_search_city").html('');
            $("#div_cgst").val('');
            $("#div_sgst").val('');
            $("#div_igst").val('');
            $("#div_cgst").addClass('hidden');
            $("#div_sgst").addClass('hidden');
            $("#div_igst").addClass('hidden');
            $("#div_gst_radio_button").attr("style", "display:none");
            $("#div_gst_radio_button1").attr("style", "display:none");

            $('#buyer_name_hide').show();
            // $("#total_table").css("display", "block");
            $("#Form_view_farmer_invoice").attr("style", "display:block");
            //$("#Form_view_farmer_invoice").attr("style", " margin-left: 10px");

            var newRowContent;
            $("#add_row_tr_td").html('');
            for (var i = 0; i < Save_all_product_data.length; i++) {
                var j = i + 1;
                newRowContent = '<tr data-row-id='+i+'>' +
                '<td style="text-align: center;">' + j + '</td>' +
                '<td style="text-align: center;">' + Save_all_product_data[i].buyers_name + '</td>' +
                '<td style="text-align: center;">' + Save_all_product_data[i].good_type + '</td>' +
                '<td style="text-align: center;">' + Save_all_product_data[i].weight + '</td>' +
                '<td style="text-align: center;">' + Save_all_product_data[i].price + '</td>' +
                '<td style="text-align: right;">' + Save_all_product_data[i].bags + '</td>' +
                '<td style="text-align: right;">' + Save_all_product_data[i].total + '</td>' +
                '<td style="text-align: right;" > <a href="javascript:void(0);" class="remCF">Remove</button> </td>' +
                '</tr> ';

                $("#add_row_tr_td").append(newRowContent);
            }
        } else {
            $("#msg_bags").html("Please Fill All Required Field.");
            return false;
        }
    });

    $("#add_row_tr_td").on('click','.remCF',function(){
        //var obj ='';
        $(this).parent().parent().remove();
        var row_id = $(this).parent().parent().data('row-id');
        var total = Save_all_product_data[row_id].total;
        Save_all_product_data.splice(Save_all_product_data[row_id], 1 );
        var grandTotal = $("#supergrandTotal").val();
        grandTotal = grandTotal - total;
        $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
        $("#supergrandTotal").val(grandTotal);
    });

    $("#product_submit").on('click', function () {
        $("#product_submit").prop('disabled', true);
        var data = Save_all_product_data;
        console.log(Save_all_product_data);

        //  console.log(JSON.parse(data));
        var grandTotal = $("#grandTotal").html();
        var market_fee = $("#market_fee").val();
        var other_charge = $("#other_charge").val();
        var farmer_id = $('#farmer_id').val();
        $.ajax({
            url: '<?php echo route('seller_product_add');?>',
            method: 'POST',
            data: {
                'product_data': data,
                'grandTotal': grandTotal,
                'market_fee': market_fee,
                'other_charge': other_charge,
                'farmer_mobile': farmer_id,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                var url = "seller_bills_list_pending/";
                window.location.pathname = url;
            }
        });
        Save_all_product_data = [];
        $.session.remove('key');
    });


    $("#market_fee").keyup(function () {
        var grandTotal = $("#supergrandTotal").val();
        var market_fee = $("#market_fee").val();
        grandTotal = grandTotal - market_fee;
        $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
    });

    $("#other_charge").keyup(function () {
        var grandTotal = $("#supergrandTotal").val();
        var market_fee = $("#market_fee").val();
        var other_charge = $("#other_charge").val();
        grandTotal = grandTotal - other_charge - market_fee;
        $("#grandTotal").html(parseFloat(grandTotal).toFixed(2));
    });

    var status_tax = $("#status_of_tax").val();
    if (status_tax == 'True') {
        $("#div_cgst").removeClass('hidden');
        $("#div_sgst").removeClass('hidden');
        $("#div_igst").removeClass('hidden');
    }
    else if (status_tax == 'False') {
        $("#div_cgst").addClass('hidden');
        $("#div_sgst").addClass('hidden');
        $("#div_igst").addClass('hidden');
    }
    $('input[type=radio][name=tex]').change(function () {
        if (this.value == 'True') {
            $("#div_cgst").removeClass('hidden');
            $("#div_sgst").removeClass('hidden');
            $("#div_igst").removeClass('hidden');
        }
        else if (this.value == 'False') {
            $("#div_cgst").addClass('hidden');
            $("#div_sgst").addClass('hidden');
            $("#div_igst").addClass('hidden');
        }
    });

</script>
