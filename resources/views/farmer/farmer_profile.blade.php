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
                    <a href="<?php echo route('dashboard');?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Farmer Profile</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Farmer Profile</h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN Farmer Full Profile-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <div>
                            <h4 class="profile-desc-title">Jitendra Parmar</h4>
                            <span class="profile-desc-text">BSP Technologies</span><br>
                            <span class="profile-desc-text">
                                1 - Syndicate, Society,<br>
                                    Gulabnagar,<br>
                                    Jamnagar - 361007
                            </span>
                            <h4 class="profile-desc-title">Legal Details</h4>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <span class="font-blue-madison bold">GST No. - 123456789012</span>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <span class="font-blue-madison bold">Adhar No. - 123456789012</span>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <span class="font-blue-madison bold">Pan No. - 123456789012</span>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-green-sharp bold uppercase">Farmer Detail</span>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <a href="#" class="font-green-sharp" onclick="location.href='seller-add.php'"> Edit
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">First name&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Jitendra</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Last name&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Parmar</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Mobile&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5"><a href="#">9601024567</a></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">City/Village&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Jamnagar</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">District&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Jamnagar</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Created Date&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">5-9-2017</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Last modified by&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Smita</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Middle name&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Ramnikbhai</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Nick name&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Jitu</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Email&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5"><a href="#">jitendra@bsptechno.com</a></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Taluko&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Jamnagar</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">State&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Gujarat</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Created by&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">Nikita Patel</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <label class="text-bold">Last modified date&nbsp;:</label>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-6">
                                                    <h5 class="text-normal col-h5">6-9-2017</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Payment</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Pending </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Received </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> Complete </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div><!--class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2"-->
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                    <thead>
                                                        <tr>
                                                            <th> ID </th>
                                                            <th> Company Name </th>
                                                            <th> Mobile </th>
                                                            <th> Type Of Goods </th>
                                                            <th> Total Pending Amount </th>
                                                            <th> Type </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="odd gradeX">
                                                        <td> 1 </td>
                                                        <td>
                                                            <a class="font-green-sharp" href="#"> Jitu Parmar</a>
                                                        </td>
                                                        <td>
                                                            9601024567
                                                        </td>
                                                        <td>
                                                            Danger
                                                        </td>
                                                        <td><i class="fa fa-inr" aria-hidden="true"></i> 20,000</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td> 2 </td>
                                                        <td>
                                                            <a class="font-green-sharp" href="#"> Nikita Jambukiya </a>
                                                        </td>
                                                        <td class="center">
                                                            9723615129
                                                        </td>
                                                        <td>
                                                            Danger
                                                        </td>
                                                        <td><i class="fa fa-inr" aria-hidden="true"></i> 20,000</td>
                                                        <td>Cheque</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_3">
                                            <div><!--class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2"-->
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                    <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> Company Name </th>
                                                        <th> Mobile </th>
                                                        <th> Type Of Goods </th>
                                                        <th> Total Amount </th>
                                                        <th> Type </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="odd gradeX">
                                                        <td> 1 </td>
                                                        <td>
                                                            <a class="font-green-sharp" href="#"> Jitu Parmar</a>
                                                        </td>
                                                        <td>
                                                            9601024567
                                                        </td>
                                                        <td>
                                                            Danger
                                                        </td>
                                                        <td><i class="fa fa-inr" aria-hidden="true"></i> 20,000</td>
                                                        <td>Cheque</td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td> 2 </td>
                                                        <td>
                                                            <a class="font-green-sharp" href="#"> Nikita Jambukiya </a>
                                                        </td>
                                                        <td class="center">
                                                            9723615129
                                                        </td>
                                                        <td>
                                                            Danger
                                                        </td>
                                                        <td><i class="fa fa-inr" aria-hidden="true"></i> 20,000</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_2">
                                            <div><!--class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2"-->
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                    <thead>
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> Company Name </th>
                                                        <th> Mobile </th>
                                                        <th> Type Of Goods </th>
                                                        <th> Total Amount </th>
                                                        <th> Type </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="odd gradeX">
                                                        <td> 1 </td>
                                                        <td>
                                                            <a class="font-green-sharp" href="#"> Jitu Parmar</a>
                                                        </td>
                                                        <td>
                                                            9601024567
                                                        </td>
                                                        <td>
                                                            Danger
                                                        </td>
                                                        <td><i class="fa fa-inr" aria-hidden="true"></i> 20,000</td>
                                                        <td>Cash</td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td> 2 </td>
                                                        <td>
                                                            <a class="font-green-sharp" href="#"> Nikita Jambukiya </a>
                                                        </td>
                                                        <td class="center">
                                                            9723615129
                                                        </td>
                                                        <td>
                                                            Danger
                                                        </td>
                                                        <td><i class="fa fa-inr" aria-hidden="true"></i> 20,000</td>
                                                        <td>Cheque</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
        <!-- END Farmer Full Profile-->
    </div>
    <!-- END CONTENT BODY -->
</div>
    </div>
<!-- END CONTENT -->
<!-- BEGIN FOOTER -->
        @include('footer')
        @include('footer-js')
<!-- END FOOTER -->
    <style type="text/css">
        table.dataTable.no-footer {
            border-bottom: none;
        }
    </style>
