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
                        <span>{{ trans('label_word.stock_in_list') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.stock_in_list') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-arrow-up font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.stock_in_list') }}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>-->
                                    <?php if(isset($role_permission_arr['stock-in']) && $role_permission_arr['stock-in'] != 'None' && $role_permission_arr['stock-in'] != 'Read'){ ?>
                                    <button id="sample_editable_1_new" class="btn sbold green add"
                                            href="#create_stock_in"
                                            data-toggle="modal"> {{ trans('label_word.add_new') }}
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-bordered" id="posts">
                                <thead>
                                <tr>
                                    <th width="10%"> {{ trans('label_word.stock_in_id') }}</th>
                                    <th> {{ trans('label_word.farmer_name') }}</th>
                                    <th> {{ trans('label_word.company_name') }}</th>
                                    <th> {{ trans('label_word.mobile_no') }}</th>
                                    <th> {{ trans('label_word.good_type_sidebar') }}</th>
                                    <th> {{ trans('label_word.weight') }}</th>
                                     <th> {{ trans('label_word.bags') }}</th>-
                                    <th> {{ trans('label_word.remain_weight') }}</th>
                                    <th width="15%"> {{ trans('label_word.price') }}</th>
                                    <th> {{ trans('label_word.action') }}</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END CREATE ADMIN-->
            <!--Start Add new stock popup-->
            <div class="modal fade bs-modal-sm" id="create_stock_in" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg_grey_1">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 id="stock_in" class="modal-title"></h4>
                        </div>
                        <div class="modal-body bg_grey_1">
                            <form role="form">
                                <input type="hidden" name="bzcp_id" id="bzcp_id">

                                <div class="form-body">
                                    <div class="form-group" id="div_seller">
                                        <label for="single-prepend-text"
                                               class="control-label">{{ trans('label_word.com_far_mob') }}</label>

                                        <div class="input-group select2-bootstrap-prepend">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"
                                                        data-select2-open="single-prepend-text">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                            <select id="single-prepend-text" class="form-control select2">
                                                <option disabled selected hidden
                                                        value="select_farmer">{{ trans('label_word.select_farmer') }}</option>
                                                @foreach($data['seller_data'] as $item)
                                                    <option value="{{$item->id}}">{{$item->seller_name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <p class="help-block" id="msg_seller"></p>
                                    </div>
                                    <div class="hidden" id="farmer_details">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <label class="text-bold">{{ trans('label_word.company_name') }}
                                                    &nbsp;:</label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-6">
                                                <h5 id="company" class="text-normal col-h5"></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <label class="text-bold">{{ trans('label_word.farmer_name') }}
                                                    &nbsp;:</label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-6">
                                                <h5 id="seller_name" class="text-normal col-h5"></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <label class="text-bold">{{ trans('label_word.city') }}&nbsp;:</label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-6">
                                                <h5 id="city" class="text-normal col-h5"></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <label class="text-bold">{{ trans('label_word.mobile_no') }}
                                                    &nbsp;:</label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-6">
                                                <h5 id="mobile" class="text-normal col-h5"><a href=""></a></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_goods">
                                        <div class="row">
                                            <div class="col-md-15 col-sm-15 col-xs-15">
                                                <div class="col-md-11 col-sm-12 col-xs-12">
                                                    <div class="input-icon">

                                                        <select id="goods_type" class="form-control select2">

                                                        </select>

                                                    </div>
                                                </div>
                                                <button type="button" class="btn default" href="#create_goods"
                                                        data-toggle="modal"><i class="fa fa-plus"></i></button>

                                            </div>
                                        </div>
                                        <p class="help-block" id="msg_goods"></p>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-6" id="div_weight">
                                                <div class="input-icon ">
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="weight"
                                                           onkeyup="BSP.only('digit','weight')" name="weight"
                                                           placeholder="{{ trans('label_word.weight') }}">

                                                    <p class="help-block" id="msg_weight"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-icon ">
                                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="price" name="price"
                                                           onkeyup="BSP.only('digit','price')"
                                                           placeholder="{{ trans('label_word.price') }}">
                                                </div>

                                            </div>
                                            <div class="col-md-1">
                                                <label id="kg_price" class="control-label margin-top-10 margin-right-10"
                                                        ></label>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-6" id="div_bags">
                                                <div class="input-icon ">
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="bags"
                                                           onkeyup="BSP.only('digit','bags')" name="bags"
                                                           placeholder="{{ trans('label_word.bags') }}">

                                                    <p class="help-block" id="msg_bags"></p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg_grey_1">
                            <button type="button" id="btn_submit"
                                    class="btn green">{{ trans('label_word.submit') }}</button>
                            <a id="stock_cancel" class="btn dark btn-outline"
                               data-dismiss="modal">{{ trans('label_word.cancel') }}</a>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--End Add new admin popup-->
            <!--Start admin view popup-->
            <div class="modal fade bs-modal-sm" id="view_admin" tabindex="-1" role="view_admin" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg_grey_1">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{ trans('label_word.stock_in_view_title') }}</h4>
                        </div>
                        <div class="modal-body bg_grey_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.company_name') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="company_name"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.farmer_name') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="farmer"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.city') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="city_view"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.mobile_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="mobile_view"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.good_type_sidebar') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="goods_view"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.weight') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="weight_view"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.price') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-6">
                                            <h5 class="text-normal col-h5" id="price_view"></h5>
                                        </div>
                                        <h5 class="text-normal col-h5" id="kg_price_view"></h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.create_by') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 class="text-normal col-h5" id="created_by_view"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg_grey_1">
                            <button type="button" class="btn dark btn-outline" id="model_close_view"
                                    data-dismiss="modal">{{ trans('label_word.close') }}</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--End admin view popup-->
            <!--Start Add new goods popup-->
            <div class="modal fade bs-modal-sm" id="create_goods" tabindex="-1" role="create_goods" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{ trans('label_word.goods_type_add') }}</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group" id="div_company">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <select id="company_good" class="form-control select2">
                                                        <option>{{ trans('label_word.company_select') }}</option>
                                                        @foreach($data['company_list'] as $item)
                                                            <option value="{{$item->id}}"
                                                            <?php if (isset($data['goods_details']) && !empty($data['goods_details']) && $item->id === $data['goods_details'][0]->gt_biz_id) {
                                                                echo 'selected';
                                                            }?>
                                                                    >{{$item->biz_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <p class="help-block" id="msg_company"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_gt_type">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-cube"></i>
                                                    <input type="text" name="gt_type" id="gt_type" class="form-control"
                                                           placeholder="{{ trans('label_word.good_type_sidebar') }}">

                                                    <p class="help-block" id="msg_gt_type"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_gt_hsn">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon margin-top-10">
                                                    <i class="fa fa-briefcase"></i>
                                                    <input type="text" name="gt_hsn_no" id="gt_hsn_no"
                                                           class="form-control" onkeyup="BSP.only('digit','gt_hsn_no')"
                                                           placeholder="{{ trans('label_word.hsn_no') }}">

                                                    <p class="help-block" id="msg_gt_hsn"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="margin-top-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.gst_item_include') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="radio-list">
                                                    <div class="col-md-6">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="tex" id="yes" value="True"
                                                                    > {{ trans('label_word.yes') }} </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="tex" id="no" value="False"
                                                                   Checked> {{ trans('label_word.no') }}  </label>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="div_cgst">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.c_tax') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="cgst_tax" id="cgst_tax"
                                                       onkeyup="BSP.only('digit','cgst_tax')" class="form-control"
                                                       placeholder="{{ trans('label_word.c_tax') }}">

                                                <p class="help-block" id="msg_cgst"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="div_sgst">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.s_tax') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="sgst_tax" id="sgst_tax"
                                                       onkeyup="BSP.only('digit','sgst_tax')" class="form-control"
                                                       placeholder="{{ trans('label_word.s_tax') }}">

                                                <p class="help-block" id="msg_sgst"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden" id="div_igst">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.i_tax') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="igst_tax" id="igst_tax"
                                                       onkeyup="BSP.only('digit','igst_tax')" class="form-control"
                                                       placeholder="{{ trans('label_word.i_tax') }}">

                                                <p class="help-block" id="msg_igst"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="margin-top-12">
                                            <div class="col-md-4">
                                                <label>{{ trans('label_word.status') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="radio-list">
                                                    <div class="col-md-6">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="active" value="Active"
                                                                    > {{ trans('label_word.active') }} </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="inactive"
                                                                   value="Inactive"
                                                                   Checked> {{ trans('label_word.inactive') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn green"
                                    id="btn_submit_good">{{ trans('label_word.submit') }}</button>
                            <button data-dismiss="modal" id="goods_cancel" aria-hidden="true"
                                    class="btn default">{{ trans('label_word.cancel') }}</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--End Add new goods popup-->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->
<script type="text/javascript">

    $('#create_stock_in').on('hidden.bs.modal', function (e) {
        $("#single-prepend-text").select2('val', 'select_farmer');
        $("#goods_type").empty();
        var option = '';
        option += '<option value="select_good" disabled selected hidden selected>{{ trans('label_word.goods_select') }}</option>'
        $("#farmer_details").addClass('hidden');
        $('#goods_type').append(option);
        $("#goods_type").select2('val', 'select_good');
        $("#div_goods").removeClass('has-error');
        $("#msg_goods").html("");
        $("#stock_in").text('');
        $("#company").text('');
        $("#seller_name").text('');
        $("#city").text('');
        $("#mobile").text('');
        $("#weight").val('');
        $("#kg_price").empty('');
        $("#price").val('');
        $("#div_seller").removeClass('has-error');
        $("#msg_seller").html("");
        $("#div_weight").removeClass('has-error');
        $("#msg_weight").html("");
        $("#div_bags").removeClass('has-error');
        $("#msg_bags").html("");
        $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

    });
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
    $('#create_goods').on('hidden.bs.modal', function (e) {
        $("#company_good").select2('val', '');
        $("#gt_type").val('');
        $("#cgst_tax").val('');
        $("#sgst_tax").val('');
        $("#igst_tax").val('');

        $("#div_gt_type").removeClass('has-error');
        $("#msg_gt_type").html("");

        $("#div_cgst").removeClass('has-error');
        $("#msg_cgst").html("");
        $("#div_sgst").removeClass('has-error');
        $("#msg_sgst").html("");
        $("#div_ighst").removeClass('has-error');
        $("#msg_igst").html("");
        $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

    });
    function priceInfo(price, id) {
        var r = $("#price_kg_" + id).text();

        var kg = r.replace("/Kg", "");
        if (kg == 20) {
            var kg_price = price / kg;
        } else {
            var kg_price = price;
        }

        $.ajax({
            url: '<?php echo route('price_added');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                'price': kg_price,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    toastr.success($obj['MESSAGE']);
                    //$("#price_").attr('readonly');
                    $("#price_" + id).attr('disabled', 'disabled');
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    ;

    function weightInfo(weight, id) {

        $.ajax({
            url: '<?php echo route('weight_added');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                'weight': weight,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    $("#weight_" + id).attr('disabled', 'disabled');
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    ;

    $("#goods_cancel").on("click", function (e) {
        $("#company_good").select2('val', '');
        $("#gt_type").val('');
        $("#cgst_tax").val('');
        $("#sgst_tax").val('');
        $("#igst_tax").val('');

        $("#div_gt_type").removeClass('has-error');
        $("#msg_gt_type").html("");

        $("#div_cgst").removeClass('has-error');
        $("#msg_cgst").html("");
        $("#div_sgst").removeClass('has-error');
        $("#msg_sgst").html("");
        $("#div_ighst").removeClass('has-error');
        $("#msg_igst").html("");

    });
    $("#stock_cancel").on("click", function (e) {
        $("#single-prepend-text").select2('val', 'select_farmer');
        $("#stock_in").text('');
        $("#company").text('');
        $("#seller_name").text('');
        $("#city").text('');
        $("#mobile").text('');
        $("#goods_type").empty();
        $("#kg_price").empty();
        $("#farmer_details").addClass('hidden');
        var option = '';
        option += '<option value="select_good" disabled selected hidden selected>{{ trans('label_word.goods_select') }}</option>'

        $('#goods_type').append(option);
        $("#goods_type").select2('val', 'select_good');
        $("#div_goods").removeClass('has-error');
        $("#msg_goods").html("");
        $("#weight").val('');
        $("#price").val('');
        $("#div_seller").removeClass('has-error');
        $("#msg_seller").html("");

        $("#div_weight").removeClass('has-error');
        $("#msg_weight").html("");
    });

    $("#btn_submit_good").on("click", function (e) {
        // var selected_value = $("#single-seller").find("option:selected").attr("value");

        var gt_type = $("#gt_type").val();
        var gt_hsn_no = $("#gt_hsn_no").val();
        var sgst_tax = $("#sgst_tax").val();
        var cgst_tax = $("#cgst_tax").val();
        var igst_tax = $("#igst_tax").val();
        var gt_id = $("#gt_id").val();
        var status = $("input[name=status]:checked").val();
        var tax = $("input[name=tex]:checked").val();

        var company = $("#company_good").find("option:selected").attr("value");
        var flag = 0;
        var scroll_element = '';

        var onlyAlpfaSpace_regx = BSP.regx('only_alpha_space');
        var onlyAlpfa_regx = BSP.regx('only_alpha');
        var hsn_regexp = new RegExp('^[0-9]{6}$');
        /*if (gt_hsn_no == '') {
         $("#div_gt_hsn").addClass('has-error');
         $("#msg_gt_hsn").html("Please fill Goods Type HSN NO. It's a required Field.");
         flag++;
         if (scroll_element == '') {
         scroll_element = 'div_gt_hsn';
         }
         }else{
         $("#div_gt_hsn").removeClass('has-error');
         $("#msg_gt_hsn").html("");
         }*/
        if (gt_hsn_no != '' && !hsn_regexp.test(gt_hsn_no)) {
            $("#div_gt_hsn").addClass('has-error');
            $("#msg_gt_hsn").html("HSN NO is invalid");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_gt_hsn';
            }
        } else {
            $("#div_gt_hsn").removeClass('has-error');
            $("#msg_gt_hsn").html("");
        }
        if (gt_type == '') {
            $("#div_gt_type").addClass('has-error');
            $("#msg_gt_type").html("Please enter your Goods Type. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_gt_type';
            }
        } else {

            $.ajax({
                url: '<?php echo route('check_unique_goods_type');?>',
                method: 'POST',
                data: {
                    'gt_type': gt_type,
                    'gt_id': gt_id,
                    'company': company,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        $("#div_gt_type").removeClass('has-error');
                        $("#msg_gt_type").html("");
                    } else {
                        $("#div_gt_type").addClass('has-error');
                        $("#msg_gt_type").html($obj['MESSAGE']);
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_gt_type';
                        }
                    }
                }
            });
        }
        if (company == '' || company == undefined) {
            $("#div_company").addClass('has-error');
            $("#msg_company").html("Please select your Company Name. It's a required Field.");
            flag++;
            if (scroll_element == '') {
                scroll_element = 'div_company';
            }
        } else {
            $("#div_company").removeClass('has-error');
            $("#msg_company").html("");
        }

        if (flag == 0) {
            $('#btn_submit_good').attr('disabled', 'disabled');
            $.ajax({
                url: '<?php echo route('goods_details_add');?>',
                method: 'POST',
                data: {
                    'gt_type': gt_type,
                    'gt_id': gt_id,
                    'gt_hsn_no': gt_hsn_no,
                    'status': status,
                    'sgst_tax': sgst_tax,
                    'igst_tax': igst_tax,
                    'cgst_tax': cgst_tax,
                    'company': company,
                    'tax': tax,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    //console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        //$("#create_goods").addClass('hidden');
                        // window.history.back();
                        $(".modal").modal("hide");
                        $("#single-goods_type").empty();
                        //good_type(selected_value);
                        window.location;
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });
        } else if (scroll_element != '') {
            BSP.scroll_upto_div(scroll_element);
        }
    });
    function edit(id, user_id) {
        $("#create_stock_in").css("display", "block");
        $("#stock_in").append("{{ trans('label_word.stock_in_edit_title') }}");
        $("#bzcp_id").val(id);
        $("#single-prepend-text").select2("val", user_id);
        $.ajax({
            url: '<?php echo route('get_product_data');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    $("#price").val($obj['Data']['bzcp_price']);
                    $("#weight").val($obj['Data']['bzcp_weight']);
                    $("#kg_price").text($obj['Data']['setting_kg_price']);
                    $("#goods_type").select2("val", $obj['Data']['bzcp_gt_id']);
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    function view(id, user_id) {
        $("#view_admin").css("display", "block");
        $("#bzcp_id").val(id);
        $.ajax({
            url: '<?php echo route('get_product_data');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    $("#weight_view").text($obj['Data']['bzcp_weight']);
                    $("#price_view").text($obj['Data']['bzcp_price']);
                    $("#kg_price_view").text($obj['Data']['setting_kg_price']);
                    $("#goods_view").text($obj['Data']['gt_type']);
                    $("#created_by_view").text($obj['Data']['added_by']);
                    $("#mobile_view").text($obj['Data']['mobile']);
                    $("#city_view").text($obj['Data']['city']);
                    $("#farmer").text($obj['Data']['seller_name']);
                    $("#company_name").text($obj['Data']['biz_name']);
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });

    }
    $(document).ready(function () {
        var option = '';
        option += '<option value="select_good" disabled selected hidden selected>{{ trans('label_word.goods_select') }}</option>'
        $('#goods_type').append(option);
        $("#goods_type").select2('val', 'select_good');
        $(".add").click(function () {
            $("#stock_in").append("{{ trans('label_word.stock_in_add_title') }}");

        });


        $("#model_close_view").click(function () {
            $("#weight_view").empty();
            $("#price_view").empty();
            $("#kg_price_view").empty();
            $("#goods_view").empty();
            $("#created_by_view").empty();
            $("#mobile_view").empty();
            $("#city_view").empty();
            $("#farmer").empty();
            $("#company_name").empty();
        });
        $("#single-prepend-text").on("change", function () {
            var selected_value = $(this).find("option:selected").attr("value");
            $("#goods_type").empty();
            var option = '';
            option += '<option value="select_good" disabled selected hidden selected>{{ trans('label_word.goods_select') }}</option>'

            $('#goods_type').append(option);
            $("#goods_type").select2("val", 'select_good');
            /* */

            if (selected_value != undefined && selected_value != 'select_farmer') {
                $.ajax({
                    url: '<?php echo route('get_user_data');?>',
                    method: 'POST',
                    data: {
                        'user_id': selected_value,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        $("h5").empty();
                        if ($obj['SUCCESS'] == 'TRUE') {
                            $("#farmer_details").removeClass('hidden');
                            $("#company").append($obj['Data']['biz_name']);
                            $("#seller_name").append($obj['Data']['name']);
                            $("#city").append($obj['Data']['city']);
                            $("#mobile").append($obj['Data']['mobile']);
                            $("#kg_price").html($obj['site_data']);
                            var gt_id = $obj['good_data'];
                            var option = '';
                            for (var i = 0; i < gt_id.length; i++) {
                                option += '<option var gt_type = "' + gt_id[i]['gt_type'] + '" value="' + gt_id[i]['gt_id'] + '">' + gt_id[i]['gt_type'] + '</option>';
                            }
                            $('#goods_type').append(option);

                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                    }
                });
            }
        });
        $("#btn_submit").click(function () {
            var selected_seller_value = $("#single-prepend-text").find("option:selected").attr("value");
            var selected_goods_value = $("#goods_type").find("option:selected").attr("value");
            var kg = $("#kg_price").text().replace('/Kg', '');

            var price = $("#price").val();
            if (kg == 20) {
                var kg_price = price / kg;
            } else {
                var kg_price = price;
            }
            var bags = $("#bags").val();
            var bzcp_id = $("#bzcp_id").val();
            var weight = $("#weight").val();
            $flag = 0;
            if ((selected_seller_value == 'select_farmer' || selected_seller_value == undefined)) {
                $flag++;
                $("#div_seller").addClass('has-error');
                $("#msg_seller").html('Seller is required.');
            } else {
                $("#div_seller").removeClass('has-error');
                $("#msg_seller").html('');
            }

            if (selected_goods_value == 'select_good' || selected_goods_value == undefined) {
                $flag++;
                $("#div_goods").addClass('has-error');
                $("#msg_goods").html('Goods Type is required.');
            } else {
                $("#div_goods").removeClass('has-error');
                $("#msg_goods").html('');
            }
            if (bags == '' || bags == undefined) {
                $flag++;
                $("#div_bags").addClass('has-error');
                $("#msg_bags").html('Bags is required.');
            } else {
                $("#div_bags").removeClass('has-error');
                $("#msg_bags").html('');
            }


            if ($flag == 0) {
                $('#btn_submit').attr('disabled', 'disabled');
                $.ajax({
                    url: '<?php echo route('edit_stock_in_data'); ?>',
                    method: 'POST',
                    data: {
                        'seller_id': selected_seller_value,
                        'gt_id': selected_goods_value,
                        'bzcp_id': bzcp_id,
                        'price': kg_price,
                        'weight': weight,
                        'bags':bags,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            toastr.success($obj['MESSAGE']);
                            window.location = 'stock-in-list';

                        } else {
                            toastr.error($obj['MESSAGE']);

                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo route('stock_in_list_post'); ?>",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "company"},
                {"data": "mobile"},
                {"data": "goods"},
                {"data": "qty"},
                {"data": "bags"},
                {"data": "remain_qty"},
                {"data": "price"},
                {"data": "action"}
            ]

        });
    });
</script>
