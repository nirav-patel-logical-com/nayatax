<!--Start Include header here-->
@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
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
                    <span>List Stock Out</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">List Stock Out</h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!--Start farmer stock section-->
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa icon-user font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">List Stock Out</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <!--<button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='admin-create.php'";> Add New
                                    <i class="fa fa-plus"></i>
                                </button>-->
                                <button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='seller-add.php'";> {{ trans('label_word.add_new') }}
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> Company Name </th>
                                <th> Farmer Name </th>
                                <th> On hand Stock </th>
                                <th> On hand Qut </th>
                                <th> Agent Name </th>
                                <th> Purchase Qut </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                <td> 1 </td>
                                <td> BSP Technologies 1 </td>
                                <td>
                                    <a class="font-green-sharp" href="stock-out.php"> Jitu Parmar</a>
                                </td>
                                <td>
                                    Danger
                                </td>
                                <td>
                                    200
                                </td>
                                <td>
                                    John
                                </td>
                                <td>
                                    150
                                </td>
                            </tr>
                            <tr class="odd gradeX">
                                <td> 1 </td>
                                <td> BSP Technologies 2 </td>
                                <td>
                                    <a class="font-green-sharp" href="stock-out.php"> Jatin Mandhaviya</a>
                                </td>
                                <td>
                                    Danger
                                </td>
                                <td>
                                    200
                                </td>
                                <td>
                                    John
                                </td>
                                <td>
                                    150
                                </td>
                            </tr>
                            <tr class="odd gradeX">
                                <td> 1 </td>
                                <td> BSP Technologies 1 </td>
                                <td>
                                    <a class="font-green-sharp" href="stock-out.php"> Jitu Parmar</a>
                                </td>
                                <td>
                                    Gau
                                </td>
                                <td>
                                    100
                                </td>
                                <td>
                                    John
                                </td>
                                <td>
                                    50
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
