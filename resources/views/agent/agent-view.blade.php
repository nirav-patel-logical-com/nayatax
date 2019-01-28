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
                    <?php if($agent_data['agent_data']->login_role === 'Admin') { ?>
                    <li>
                        <a href="<?php echo route('agent_list');?>">{{ trans('label_word.agent_list') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <?php } ?>
                    <li>
                        <span>{{ trans('label_word.agent_view_title') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">{{ trans('label_word.agent_view_title') }}</h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN CREATE ADMIN-->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-user font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.agent_view_title') }}</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    <button id="sample_editable_1_new" class="btn sbold green"
                                            onclick="location.href='<?php echo route('agent_edit', ['id' => $agent_data['agent_data']->id]); ?>'"> {{ trans('label_word.edit') }}
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.agent_name') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">{{$agent_data['agent_data']->f_name}}
                                                &nbsp;{{$agent_data['agent_data']->m_name}}
                                                &nbsp;{{$agent_data['agent_data']->l_name}}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.mobile_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">{{$agent_data['agent_data']->mobile}}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.address1') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if (!empty($agent_data['agent_data']->address1)) {
                                                    echo $agent_data['agent_data']->address1;
                                                } else {
                                                    echo '---';
                                                } ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.city') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">{{$agent_data['agent_data']->city}}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.state') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">{{$agent_data['agent_data']->state}}</h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.create_by') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php
                                                if (!empty($agent_data['add_by'][0]->f_name) && !empty($agent_data['add_by'][0]->m_name) && !empty($agent_data['add_by'][0]->l_name)) {
                                                    echo $agent_data['add_by'][0]->f_name . ' ' . $agent_data['add_by'][0]->m_name . ' ' . $agent_data['add_by'][0]->l_name;
                                                } else if (!empty($agent_data['add_by'][0]->f_name) && empty($agent_data['add_by'][0]->m_name) && !empty($agent_data['add_by'][0]->l_name)) {
                                                    echo $agent_data['add_by'][0]->f_name . ' ' . $agent_data['add_by'][0]->l_name;
                                                } else if (!empty($agent_data['add_by'][0]->f_name) && empty($agent_data['add_by'][0]->m_name) && empty($agent_data['add_by'][0]->l_name)) {
                                                    echo $agent_data['add_by'][0]->f_name;
                                                } else {
                                                    echo '---';
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.modify_by') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php
                                                if (!empty($agent_data['modify_by'][0]->f_name) && !empty($agent_data['modify_by'][0]->m_name) && !empty($agent_data['modify_by'][0]->l_name)) {
                                                    echo $agent_data['modify_by'][0]->f_name . ' ' . $agent_data['modify_by'][0]->m_name . ' ' . $agent_data['modify_by'][0]->l_name;
                                                } else if (!empty($agent_data['modify_by'][0]->f_name) && empty($agent_data['modify_by'][0]->m_name) && !empty($agent_data['modify_by'][0]->l_name)) {
                                                    echo $agent_data['modify_by'][0]->f_name . ' ' . $agent_data['modify_by'][0]->l_name;
                                                } else if (!empty($agent_data['modify_by'][0]->f_name) && empty($agent_data['modify_by'][0]->m_name) && empty($agent_data['modify_by'][0]->l_name)) {
                                                    echo $agent_data['modify_by'][0]->f_name;
                                                } else {
                                                    echo '---';
                                                }?>
                                            </h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.nick_name') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->nick_name != '') {
                                                    echo $agent_data['agent_data']->nick_name;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>


                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.email') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <h5 class="text-normal col-h5">{{$agent_data['agent_data']->email}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.address2') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if (!empty($agent_data['agent_data']->address2)) {
                                                echo $agent_data['agent_data']->address2;
                                            } else {
                                                echo '---';
                                            } ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.district') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <h5 class="text-normal col-h5">{{$agent_data['agent_data']->district}}</h5>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.create_date') }}
                                            &nbsp;:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if (isset($agent_data['agent_data']->add_date) && !empty($agent_data['agent_data']->add_date)) {
                                                echo date('d-m-Y h:i:s', strtotime($agent_data['agent_data']->add_date));
                                            } else {
                                                echo '---';
                                            } ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.modify_date') }}
                                            &nbsp;:</label>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if (isset($agent_data['agent_data']->modify_date) && !empty($agent_data['agent_data']->modify_date)) {
                                                echo date('d-m-Y h:i:s', strtotime($agent_data['agent_data']->modify_date));
                                            } else {
                                                echo '---';
                                            } ?>
                                        </h5>
                                    </div>
                                </div>

                            </div>
                            </div>
                            <div class="row margin-top-10 margin-bottom-10" align="center">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="caption">
                                        <i class="fa fa-file-text-o font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.company_details') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.company_name') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_name != '') {
                                                    echo $agent_data['agent_data']->biz_name;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.biz_market_name') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_market_name != '') {
                                                    echo $agent_data['agent_data']->biz_market_name;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.biz_type') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_type != '') {
                                                    echo $agent_data['agent_data']->biz_type;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.biz_nick_name') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_nick_name != '') {
                                                    echo $agent_data['agent_data']->biz_nick_name;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.biz_tel_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_tel_no != '') {
                                                    echo $agent_data['agent_data']->biz_tel_no;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.company_logo') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <img height="60" id="image_display" width="60" src="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->image)){ echo $agent_data['agent_data']->image; }?>" alt="">
                                        </div>
                                    </div>
                                    <div class="row margin-top-30">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.biz_subject_name') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_subject_name != '') {
                                                    echo $agent_data['agent_data']->biz_subject_name;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.biz_other_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->biz_mobile != '') {
                                                    echo $agent_data['agent_data']->biz_mobile;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row margin-top-10 margin-bottom-10" align="center">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="caption">
                                        <i class="fa fa-file-text-o font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.legal_details') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.adhar_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->aadhar_no != '') {
                                                    echo $agent_data['agent_data']->aadhar_no;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.gst_tin') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->gstin_no != '') {
                                                    echo $agent_data['agent_data']->gstin_no;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                   <!-- <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.commission_per') }}
                                                &nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                {{$agent_data['agent_data']->biz_comission}}
                                            </h5>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">

                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.hsn_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->hsn_no != '') {
                                                    echo $agent_data['agent_data']->hsn_no;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <label class="text-bold">{{ trans('label_word.pan_no') }}&nbsp;:</label>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            <h5 class="text-normal col-h5">
                                                <?php if ($agent_data['agent_data']->pan_no != '') {
                                                    echo $agent_data['agent_data']->pan_no;
                                                } else {
                                                    echo "---";
                                                }?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
