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
                        <span>{{ trans('label_word.stock_out_list') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.stock_out_list') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-arrow-down font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.stock_out_list') }}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>-->
                                    <?php if(isset($role_permission_arr['stock-out']) && $role_permission_arr['stock-out'] != 'None' && $role_permission_arr['stock-out'] != 'Read'){ ?>
                                    <a id="sample_editable_1_new" class="btn sbold green add"
                                       href="<?php echo route('stock_out');?>"
                                       data-toggle="modal"> {{ trans('label_word.add_new') }}
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-bordered" id="posts">
                                <thead>
                                <tr>
                                    <th> {{ trans('label_word.stock_out_id') }}</th>
                                    <th> {{ trans('label_word.buyer_name') }}</th>
                                    <th> {{ trans('label_word.company_name') }}</th>
                                    <th> {{ trans('label_word.mobile_no') }}</th>
                                    <th> {{ trans('label_word.good_type_sidebar') }}</th>
                                    <th> {{ trans('label_word.weight') }}</th>
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
            <!--Start admin view popup-->
            <div class="modal fade bs-modal-sm" id="view_admin" tabindex="-1" role="view_admin" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg_grey_1">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">{{ trans('label_word.stock_out_view_title') }}</h4>
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
                                            <h5 id="view_company" class="text-normal col-h5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.buyer_name') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_name" class="text-normal col-h5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.buyer_name') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_city" class="text-normal col-h5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.buyer_name') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_mobile" class="text-normal col-h5"><a href="#"></a></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.city') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_goods_type" class="text-normal col-h5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.mobile_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_weight" class="text-normal col-h5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.weight') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_price" class="text-normal col-h5"></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.price') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <h5 id="view_added_by" class="text-normal col-h5"></h5>
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
    function priceInfo(price, id) {

        $.ajax({
            url: '<?php echo route('price_added');?>',
            method: 'POST',
            data: {
                'bzcp_id': id,
                'price': price,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    toastr.success($obj['MESSAGE']);
                    //$("#price").attr('readonly');
                    $("#price").attr('disabled', 'disabled');
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    ;
    function view(id, user_id) {
        $("#view_admin").css("display", "block");
        $("#stock_in").append("Stock Details");
        var bzcp_id = $(this).attr('bzcp_id');
        var sellerid = $(this).attr('sellerid');
        $("h5").empty();
        $.ajax({
            url: '<?php echo route('get_product_data_by_bpi_id');?>',
            method: 'POST',
            data: {
                'bpi_id': id,
                '_token': '<?php echo csrf_token();?>'
            },
            success: function (result) {
                $obj = JSON.parse(result);
                if ($obj['SUCCESS'] == 'TRUE') {
                    if ($obj['Data']['bzcp_price'] === '0') {
                        $("#view_price").append('');
                    }
                    else {
                        $("#view_price").append($obj['Data']['bpi_bid_price']);
                    }
                    $("#view_weight").append($obj['Data']['bpi_weight']);
                    $("#view_goods_type").append($obj['Data']['gt_type']);
                    $("#view_mobile").append($obj['Data']['mobile']);
                    $("#view_city").append($obj['Data']['city']);
                    $("#view_name").append($obj['Data']['seller_name']);
                    $("#view_company").append($obj['Data']['biz_name']);
                    $("#view_added_by").append($obj['Data']['added_by']);
                } else {
                    toastr.error($obj['MESSAGE']);
                }
            }
        });
    }
    $(document).ready(function () {
        $("#model_close_view").click(function () {
            $("#view_price").empty();
            $("#view_weight").empty();
            $("#view_goods_type").empty();
            $("#view_mobile").empty();
            $("#view_city").empty();
            $("#view_name").empty();
            $("#view_company").empty();
            $("#view_added_by").empty();
        });


    });
</script>
<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo route('stock_out_list_post'); ?>",
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
                {"data": "price"},
                {"data": "action"}
            ]


        });
    });
</script>
