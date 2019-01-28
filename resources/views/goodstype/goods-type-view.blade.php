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
                    <a href="<?php echo route('goods');?>">{{ trans('label_word.goods_type_list') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{ trans('label_word.goods_type_details') }}</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">{{ trans('label_word.goods_type_details') }}</h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN CREATE ADMIN-->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cubes font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.goods_type_details') }}</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <button id="sample_editable_1_new" class="btn sbold green" onclick="location.href='<?php echo route('edit_goods_type',['id'=>$data['goods_details']->gt_id]); ?>'"> {{ trans('label_word.edit') }}
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.company_name') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">{{$data['goods_details']->biz_name}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.good_type_sidebar') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">{{$data['goods_details']->gt_type}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.hsn_no') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">{{$data['goods_details']->gt_hsn_no}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.gst_item') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if($data['goods_details']->gt_is_tax_apply === 'True') {?> {{ trans('label_word.yes') }} <?php }
                                                else{ ?> {{ trans('label_word.no') }} <?php }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.cgst') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if($data['goods_details']->gt_cgst_tax != '') { echo $data['goods_details']->gt_cgst_tax; }
                                            else{ echo "--"; }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.sgst') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if($data['goods_details']->gt_sgst_tax != '') { echo $data['goods_details']->gt_sgst_tax; }
                                            else{ echo "--"; }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.igst') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if($data['goods_details']->gt_igst_tax != '') { echo $data['goods_details']->gt_igst_tax; }
                                            else{ echo "--"; }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.status') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if($data['goods_details']->gt_status === 'Active') {?> {{ trans('label_word.active') }} <?php }
                                            else{ ?> {{ trans('label_word.inactive') }} <?php }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.create_date') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if (isset($data['goods_details']->gt_add_date) && !empty($data['goods_details']->gt_add_date)) {
                                                echo date('d-m-Y h:i:s', strtotime($data['goods_details']->gt_add_date));
                                            } else {
                                                echo '---';
                                            } ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.modify_date') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php if (isset($data['goods_details']->gt_modify_date) && !empty($data['goods_details']->gt_modify_date)) {
                                                echo date('d-m-Y h:i:s', strtotime($data['goods_details']->gt_modify_date));
                                            } else {
                                                echo '---';
                                            } ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.create_by') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php
                                            if (!empty($data['add_by']->f_name) && !empty($data['add_by']->m_name) && !empty($data['add_by']->l_name)) {
                                                echo $data['add_by']->f_name . ' ' . $data['add_by']->m_name . ' ' . $data['add_by']->l_name;
                                            } else if (!empty($data['add_by']->f_name) && empty($data['add_by']->m_name) && !empty($data['add_by']->l_name)) {
                                                echo $data['add_by']->f_name . ' ' . $data['add_by']->l_name;
                                            } else if (!empty($data['add_by']->f_name) && empty($data['add_by']->m_name) && empty($data['add_by']->l_name)) {
                                                echo $data['add_by']->f_name;
                                            } else {
                                                echo '---';
                                            }?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <label class="text-bold">{{ trans('label_word.modify_by') }}&nbsp;:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-6">
                                        <h5 class="text-normal col-h5">
                                            <?php
                                            if (!empty($data['modify_by']->f_name) && !empty($data['modify_by']->m_name) && !empty($data['modify_by']->l_name)) {
                                                echo $data['modify_by']->f_name . ' ' . $data['modify_by']->m_name . ' ' . $data['modify_by']->l_name;
                                            } else if (!empty($data['modify_by']->f_name) && empty($data['modify_by']->m_name) && !empty($data['modify_by']->l_name)) {
                                                echo $data['modify_by']->f_name . ' ' . $data['modify_by']->l_name;
                                            } else if (!empty($data['modify_by']->f_name) && empty($data['modify_by']->m_name) && empty($data['modify_by']->l_name)) {
                                                echo $data['modify_by']->f_name;
                                            } else {
                                                echo '---';
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
