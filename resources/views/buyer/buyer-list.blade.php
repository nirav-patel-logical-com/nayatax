@include('layouts.header')

<div class="clearfix"></div>

<div class="page-container">
    @include('layouts.sidebar')

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
                        <span>{{ trans('label_word.buyer_list') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.buyer_list') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->

            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-user font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.buyer_list') }}</span>
                            </div>
                            <?php if(isset($role_permission_arr['buyer']) && $role_permission_arr['buyer'] != 'None' && $role_permission_arr['buyer'] != 'Read'){ ?>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button id="sample_editable_1_new" class="btn sbold green"
                                            onclick="location.href='<?php echo route('buyer_add');?>'"> {{ trans('label_word.add_new') }}
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-bordered" id="posts">
                                <thead>
                                <tr>
                                    <th> {{ trans('label_word.id') }} </th>
                                    <th> {{ trans('label_word.company_name') }} </th>
                                    <th> {{ trans('label_word.buyer_name') }} </th>
                                    <th> {{ trans('label_word.email') }} </th>
                                    <th> {{ trans('label_word.mobile_no') }} </th>
                                    <th> {{ trans('label_word.city') }} </th>
                                    <th> {{ trans('label_word.status') }} </th>
                                    <th> {{ trans('label_word.action') }} </th>
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
    </div>

    <!-- END CONTENT -->
    <!-- BEGIN FOOTER -->
    @include('layouts.footer')
    <!-- END FOOTER -->
    <script type="text/javascript">
        function status_change(id, status) {
            $.ajax({
                url: 'api/change_user_status',
                method: 'POST',
                data: {
                    'id': id,
                    'status': status,
                    'module': 'user',
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    //console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        setTimeout(function () {
                            BSP.redirect_to(window.location.href);
                        }, 1000);
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#posts').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo route('buyer_list_post'); ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },
                "columns": [
                    {"data": "id"},
                    {"data": "company"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "mobile"},
                    {"data": "city"},
                    {"data": "status"},
                    {"data": "action"}
                ]

            });
        });
    </script>

