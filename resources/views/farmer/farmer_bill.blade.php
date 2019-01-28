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
                        <span>{{ trans('label_word.seller_bill_sidebar_list') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.seller_bill_sidebar_list') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-alt font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.seller_bill_sidebar_list') }}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided">
                                    <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>-->
                                    @if($errors->any())
                                        <h4>{{$errors->first()}}</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-bordered" id="posts">
                                <thead>
                                <tr>
                                    <th> {{ trans('label_word.id') }}</th>
                                    <th> {{ trans('label_word.date')}}</th>
                                    <th> {{ trans('label_word.invoice_no')}}</th>
                                    <th> {{ trans('label_word.farmer_name') }}</th>
                                    <th> {{ trans('label_word.mobile_no') }}</th>
                                    <th> {{ trans('label_word.city') }} </th>
                                    <th> {{ trans('label_word.total') }} </th>
                                    <th> {{ trans('label_word.payment_status') }}</th>
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

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('layouts.footer')

<!-- END FOOTER -->

<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            //"processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo route('farmer_bill_post'); ?>",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "id" },
                { "data": "date" },
                { "data": "si_invoice_no" },
                { "data": "name" },
                { "data": "mobile" },
                { "data": "city" },
                { "data": "total" },
                { "data": "payment_status" },
                { "data": "action" }
            ]
        });
    });
</script>
