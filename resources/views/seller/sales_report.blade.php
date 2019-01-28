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
                        <span>{{ trans('label_word.sales_report') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!--Start farmer stock section-->
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet">
                        <div class="portlet-title" style="background-color: white; border: 1px solid #eee;">
                            <div class="caption" style="margin-left: 1%;">
                                <i class="fa fa-file-text font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.sales_report') }}</span>
                            </div>


                        </div>
                        <div class="portlet-body">
                            <div class="invoice">
                                <div class="col-md-12 col-xs-12 col-sm-12 " style="background-color: white; border: 1px solid #eee;">
                                    <form id="frm">
                                    <div class="form-group col-md-6">
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <label for="single-seller"
                                                       class="control-label text-bold">{{ trans('label_word.company_name') }}&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="{{ trans('label_word.company_name') }}">
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <label for="single-seller"
                                                       class="control-label text-bold">{{ trans('label_word.amount') }}&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="amount" id="amount" placeholder="{{ trans('label_word.amount') }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <label for="single-seller"
                                                       class="control-label text-bold">{{ trans('label_word.date') }}&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="daterange" id="daterange" placeholder="{{ trans('label_word.date') }}" value="">
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" id="btn_submit"
                                                        class="btn green text-uppercase pull-right">Apply
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END CREATE ADMIN-->
            </div>
            <div class="row margin-top-10">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <table class="table table-bordered" id="posts">
                                <thead>
                                <tr>
                                    <th width="20%"> {{ trans('label_word.date') }}</th>
                                    <th> {{ trans('label_word.company_name') }}</th>
                                    <th> {{ trans('label_word.buyer_name') }}</th>
                                    <th> {{ trans('label_word.gst_tin') }}</th>



                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End farmer stock section-->
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

    $("#btn_cancel").on("click", function (e) {
        $("#daterange").val('');
        $("#gst_tin").val('');
        $("#amount").val('');
        $("#company_name").val('');
        $('#posts').DataTable().ajax.reload();
    });
    $("#btn_submit").on("click", function (e) {
        var date = $("#daterange").val();
        var gst_tin = $("#gst_tin").val();
        var amount = $("#amount").val();
        var comapny = $("#company_name").val();

        $('#posts').DataTable().ajax.reload();


    });
//    $('input[name="daterange"]').daterangepicker(
//            {
//               // autoUpdateInput: false,
//                locale: {
//                    format: 'DD-MM-YYYY'
//                },
//                maxDate: new Date()
//            });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#posts').DataTable({
           // "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo route('sales_report_post'); ?>",
                "dataType": "json",
                "type": "POST",
                "data":function(d){
                    d.form = $('#frm').serializeObject();
                }
            },
            "columns": [
                { "data": "date" },
                { "data": "company" },
                { "data": "name" },
                { "data": "gsttin" },

            ]

        });
    });



    // Converts object with "name" and "value" keys
    // into object with "name" key having "value" as value
    // See http://stackoverflow.com/a/12399106/3549014 for more details
    $.fn.serializeObject = function(){
        var obj = {};

        $.each( this.serializeArray(), function(i,o){
            var n = o.name, v = o.value;

            obj[n] = obj[n] === undefined ? v
                    : $.isArray( obj[n] ) ? obj[n].concat( v )
                    : [ obj[n], v ];
        });

        return obj;
    };


</script>
<script type="text/javascript">
    $(function() {

        $('input[name="daterange"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            var s = $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            $('#daterange').html(s);

        });

        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });
</script>
