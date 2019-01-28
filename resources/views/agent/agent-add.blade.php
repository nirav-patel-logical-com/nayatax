
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
                        <?php if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user']) && $_SESSION['login_user']->role_name=='Admin') { ?>
                        <a href="<?php echo route('agent_list');?>">{{ trans('label_word.agent_list') }}</a>
                        <i class="fa fa-circle"></i>
                            <?php }?>
                    </li>
                    <li>
                        <span><?php if($agent_data['page_title'] === 'Agent Add'){ ?>{{ trans('label_word.agent_add_title') }} <?php } else{ ?>{{ trans('label_word.agent_edit_title') }} <?php } ?></span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> <?php if($agent_data['page_title'] === 'Agent Add'){ ?>{{ trans('label_word.agent_add_title') }} <?php } else{ ?>{{ trans('label_word.agent_edit_title') }} <?php } ?></h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN Farmer Add-->

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-user font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase"><?php if($agent_data['page_title'] === 'Agent Add'){ ?>{{ trans('label_word.agent_add_title') }} <?php } else{ ?>{{ trans('label_word.agent_edit_title') }} <?php } ?></span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" id="form_submit" enctype="multipart/form-data">
                                <input type="hidden" id="login_role" name="login_role" value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->login_role; } ?>">
                                <input type="hidden" id="agent_id" name="agent_id" value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->id; } ?>">
                                <div class="form-body">
                                    <div class="form-group" id="div_company">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="company" name-="company"
                                                            placeholder="{{ trans('label_word.company_name') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->biz_name; } ?>" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">

                                                    <p class="help-block" id="msg_company"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_fname">
                                                <div class="input-icon ">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="f_name" name="f_name"
                                                           placeholder="{{ trans('label_word.first_name') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->f_name; } ?>">

                                                    <p class="help-block" id="msg_fname"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_mname">
                                                <div class="input-icon">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="m_name" name="m_name"
                                                           placeholder="{{ trans('label_word.middle_name') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->m_name; } ?>">

                                                    <p class="help-block" id="msg_mname"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_lname">
                                                <div class="input-icon ">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="l_name" name="l_name"
                                                           placeholder="{{ trans('label_word.last_name') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->l_name; } ?>">

                                                    <p class="help-block" id="msg_lname"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_nname">
                                                <div class="input-icon ">
                                                    <i class="fa icon-user"></i>
                                                    <input type="text" class="form-control" id="nick_name"
                                                           name="nick_name" placeholder="{{ trans('label_word.nick_name') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->nick_name; } ?>">

                                                    <p class="help-block" id="msg_nname"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_mobile">
                                                <div class="input-icon ">
                                                    <i class="fa fa-mobile"></i>
                                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                                           placeholder="{{ trans('label_word.mobile_no') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->mobile; } ?>">

                                                    <p class="help-block" id="msg_mobile"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_email">
                                                <div class="input-icon ">
                                                    <i class="fa fa-envelope"></i>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                           placeholder="{{ trans('label_word.email') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->email; } ?>">

                                                    <p class="help-block" id="msg_email"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="div_city">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="input-icon ">
                                                    <i class="fa fa-map-marker"></i>
                                                    <input type="text" class="form-control" id="city" name="city"
                                                           placeholder="{{ trans('label_word.city') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->city; } ?>">

                                                    <p class="help-block" id="msg_city"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_district">
                                                <div class="input-icon ">
                                                    <i class="fa fa-map-marker"></i>
                                                    <input type="text" class="form-control" id="district"
                                                           name="district" placeholder="{{ trans('label_word.district') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->district; } ?>">

                                                    <p class="help-block" id="msg_district"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_taluko">
                                                <div class="input-icon ">
                                                    <i class="fa fa-map-marker"></i>
                                                    <input type="text" class="form-control" id="taluko" name="taluko"
                                                           placeholder="Taluko"
                                                           value="<?php //if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->taluko; } ?>">

                                                    <p class="help-block" id="msg_taluko"></p>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_state">
                                                <div class="input-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                    <input type="text" class="form-control" id="state" name="state"
                                                           placeholder="{{ trans('label_word.state') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->state; } ?>">

                                                    <p class="help-block" id="msg_state"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_address1">
                                                <div class="input-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                    <textarea class="form-control" rows="3" id="address1"
                                                              name="address1" placeholder="{{ trans('label_word.address1') }}"><?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->address1; } ?></textarea>

                                                    <p class="help-block" id="msg_address1"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" >
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_address2">
                                                <div class="input-icon ">
                                                    <i class="fa fa-map-marker"></i>
                                                    <textarea class="form-control" rows="3" id="address2"
                                                              name="address2" placeholder="{{ trans('label_word.address2') }}"><?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->address2; } ?></textarea>

                                                    <p class="help-block" id="msg_address2"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <?php  if(!isset($agent_data['agent_data']) && empty($agent_data['agent_data'])){ ?>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_password">
                                                <div class="input-icon ">
                                                    <i class="fa fa-lock"></i>
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" placeholder="{{ trans('label_word.password') }}"/>

                                                    <p class="help-block" id="msg_password"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <!--<div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-md-radios">
                                                <label class="col-md-3 control-label"
                                                       for="form_control_1">Profile</label>

                                                <div class="col-md-9">
                                                    <div>
                                                        <input type="file" id="profile" name="profile">
                                                       <p class="help-block" id="msg_img"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-md-radios">
                                                <label class="col-md-3 control-label"
                                                       for="form_control_1">{{ trans('label_word.status') }}</label>

                                                <div class="col-md-9">
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="active" value="Active"
                                                            <?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']) && $agent_data['agent_data']->status == 'Active')
                                                            { echo "checked"; } ?>>
                                                            {{ trans('label_word.active') }} </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="inactive" value="Inactive"
                                                            <?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){
                                                                    if($agent_data['agent_data']->status == 'Inactive'){ echo "checked"; }}else{ echo "checked";} ?>>
                                                            {{ trans('label_word.inactive') }} </label>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <div class="caption">
                                                <i class="fa fa-file-text-o font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.legal_details') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <hr style="margin: 15px 0;">
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_gsttin_no">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="gsttin_no"
                                                           name="gsttin_no" placeholder="{{ trans('label_word.gst_tin') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->gstin_no; } ?>">

                                                    <p class="help-block" id="msg_gsttin_no"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_hsn_no">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="hsn_no" name="hsn_no" onkeyup="BSP.only('digit','hsn_no')"
                                                           placeholder="{{ trans('label_word.hsn_no') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->hsn_no; } ?>">

                                                    <p class="help-block" id="msg_hsn_no"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_adhar_no">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="adhar_no"
                                                           name="aadhar_no" placeholder="{{ trans('label_word.adhar_no') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->aadhar_no; } ?>">

                                                    <p class="help-block" id="msg_adhar_no"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_company">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="pan_no" name="pan_no"
                                                           placeholder="{{ trans('label_word.pan_no') }}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data'])){ echo $agent_data['agent_data']->pan_no; } ?>">

                                                    <p class="help-block" id="msg_pan_no"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <div class="caption">
                                                <i class="fa fa-file-text-o font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.company_details') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <hr style="margin: 15px 0;">
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_market_name">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-building" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="market_name"
                                                           name="market_name" placeholder="{{trans('label_word.biz_market_name')}}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_market_name)){ echo $agent_data['agent_data']->biz_market_name; } ?>">

                                                    <p class="help-block" id="msg_market_name"></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group" id="div_biz_type">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-icon">
                                                    <i class="fa fa-building" aria-hidden="true"></i>
                                                    <input type="text" class="form-control" id="biz_type"
                                                           name="biz_type" placeholder="{{trans('label_word.biz_type')}}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_type)){ echo $agent_data['agent_data']->biz_type; } ?>">

                                                    <p class="help-block" id="msg_biz_type"></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_subject">
                                                <div class="input-icon ">
                                                    <i class="fa fa-building"></i>
                                                    <input type="text" class="form-control" id="subject" name="subject"
                                                           placeholder="{{trans('label_word.biz_subject_name')}}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_subject_name)){ echo $agent_data['agent_data']->biz_subject_name; } ?>">

                                                    <p class="help-block" id="msg_subject"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_biz_nick_name">
                                                <div class="input-icon ">
                                                    <i class="fa fa-building"></i>
                                                    <input type="text" class="form-control" id="biz_nick_name" name="biz_nick_name"
                                                           placeholder="{{trans('label_word.biz_nick_name')}}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_nick_name)){ echo $agent_data['agent_data']->biz_nick_name; } ?>">

                                                    <p class="help-block" id="msg_biz_nick_name"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_biz_mobile">
                                                <div class="input-icon ">
                                                    <i class="fa fa-mobile"></i>
                                                    <input type="text" class="form-control" id="biz_mobile" name="biz_mobile"
                                                           placeholder="{{trans('label_word.biz_other_no')}}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_mobile)){ echo $agent_data['agent_data']->biz_mobile; } ?>">

                                                    <p class="help-block" id="msg_biz_mobile"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group" id="div_tel_no">
                                                <div class="input-icon ">
                                                    <i class="fa fa-mobile"></i>
                                                    <input type="text" class="form-control" id="tel_no" name="tel_no"
                                                           placeholder="{{trans('label_word.biz_tel_no')}}"
                                                           value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_tel_no)){ echo $agent_data['agent_data']->biz_tel_no; } ?>">

                                                    <p class="help-block" id="msg_tel_no"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="div_logo">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group form-md-radios">
                                                    <label class="col-md-3 control-label"
                                                           for="form_control_1">{{ trans('label_word.company_logo') }}</label>

                                                    <div class="col-md-7">
                                                        <div class="col-md-6">
                                                            <input type="file" id="logo">
                                                            <input type="hidden" name="image" value="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->biz_logo)){ echo $agent_data['agent_data']->biz_logo; }?>" id="image">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <img height="60" id="image_display" width="60" src="<?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']->image)){ echo $agent_data['agent_data']->image; }?>" alt="">
                                                    </div>

                                                </div>

                                             </div>
                                            <p class="help-block pull-right" id="msg_logo"></p>
                                        </div>
                                    </div>

                                    <div id="editor" class="hidden"></div>
                                </div>
                                <div class="text-right" id="page_id">
                                   <button type="button" class="btn green" id="btnSubmit">{{ trans('label_word.submit') }}</button>
                                    <?php if(isset($agent_data['agent_data']) && !empty($agent_data['agent_data']) && $agent_data['agent_data']->login_role === 'Admin') { ?>
                                    <a href="<?php echo route('agent_list'); ?>" class="btn default">{{ trans('label_word.cancel') }}</a>
                                    <?php }else{ ?>
                                    <a href="<?php echo route('dashboard'); ?>" class="btn default">{{ trans('label_word.cancel') }}</a>
                                    <?php } ?>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!-- END Farmer Add-->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN FOOTER -->
    @include('layouts.footer')

    <!-- END FOOTER -->
    <script type="text/javascript">
        /*$('#page_id').keypress(function (e) {
            var key = e.which;
            if(key == 13)  // the enter key code
            {
                $("#btnSubmit").click();

            }
        });*/
        $("input[name=email]").change(function () {

            var email = $("#email").val();
            var email_regx = BSP.regx('email');
            var scroll_element = '';
            var admin_id = $("#agent_id").val();
            var flag=0;
            if ((email != '') && !email_regx.test(email)) {
                $("#div_email").addClass('has-error');
                $("#msg_email").html("Email is invalid");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_email';
                }
            }
            if(admin_id == ''){
                admin_id=0;
            }
            if(flag==0 && email != '') {
                $("#btnSubmit").removeAttr('disabled');
                $.ajax({

                    url: '<?php echo route("check_unique_email");?>',
                    method: 'POST',
                    data: {
                        'email': email,
                        'user_id':admin_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            $("#div_email").removeClass('has-error');
                            $("#msg_email").html("");
                            $("#btnSubmit").removeAttr('disabled');
                        } else {
                            $("#div_email").addClass('has-error');
                            $("#msg_email").html($obj['MESSAGE']);

                            if (scroll_element == '') {
                                scroll_element = 'div_email';
                            }
                            $("#btnSubmit").attr('disabled', 'disabled');
                        }

                    }
                });
            }

        });
        $("input[name=mobile]").change(function () {

            var mobile = $("#mobile").val();
            var mobile_no_regx = BSP.regx('mobile');
            var scroll_element = '';
            var admin_id = $("#agent_id").val();
            var flag=0;
            if (mobile == '') {
                $("#div_mobile").addClass('has-error');
                $("#msg_mobile").html("Please enter your Mobile Number. It's a required Field.");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_mobile';
                }

            } else if ((mobile != '') && !mobile_no_regx.test(mobile)) {
                $("#div_mobile").addClass('has-error');
                $("#msg_mobile").html("Mobile is invalid");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_mobile';
                }
            }
            if(admin_id == ''){
                admin_id=0;
            }
            if(flag==0) {
                $("#btnSubmit").removeAttr('disabled');
                $.ajax({
                    url: '<?php echo route("check_unique_mobile");?>',
                    method: 'POST',
                    data: {
                        'mobile': mobile,
                        'user_id':admin_id,
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
                            $("#msg_mobile").html($obj['MESSAGE']);
                            if (scroll_element == '') {
                                scroll_element = 'div_mobile';
                            }
                            $("#btnSubmit").attr('disabled', 'disabled');
                        }

                    }
                });
            }

        });

        $("input[name=biz_mobile]").change(function () {

            var biz_mobile = $("#biz_mobile").val();
            var mobile_no_regx = BSP.regx('mobile');
            var scroll_element = '';
            var admin_id = $("#agent_id").val();
            var flag=0;
           if ((biz_mobile != '') && !mobile_no_regx.test(biz_mobile)) {
                $("#div_biz_mobile").addClass('has-error');
                $("#msg_biz_mobile").html("Mobile is invalid");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_biz_mobile';
                }
            }
            if(admin_id == ''){
                admin_id=0;
            }
            if(flag==0) {
                $("#btnSubmit").removeAttr('disabled');
                $.ajax({
                    url: '<?php echo route("check_unique_mobile");?>',
                    method: 'POST',
                    data: {
                        'mobile': biz_mobile,
                        'user_id':admin_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            $("#div_biz_mobile").removeClass('has-error');
                            $("#msg_biz_mobile").html("");
                            $("#btnSubmit").removeAttr('disabled');
                        } else {
                            $("#div_biz_mobile").addClass('has-error');
                            $("#msg_biz_mobile").html($obj['MESSAGE']);
                            if (scroll_element == '') {
                                scroll_element = 'div_biz_mobile';
                            }
                            $("#btnSubmit").attr('disabled', 'disabled');
                        }

                    }
                });
            }

        });
        $("input[name=tel_no]").change(function () {

            var tel_no = $("#tel_no").val();
            var mobile_no_regx = BSP.regx('mobile');
            var scroll_element = '';
            var admin_id = $("#agent_id").val();
            var flag=0;
            if ((tel_no != '') && !mobile_no_regx.test(tel_no)) {
                $("#div_tel_no").addClass('has-error');
                $("#msg_tel_no").html("Mobile is invalid");
                flag++;
                if (scroll_element == '') {
                    scroll_element = 'div_tel_no';
                }
            }
            if(admin_id == ''){
                admin_id=0;
            }
            if(flag==0) {
                $("#btnSubmit").removeAttr('disabled');
                $.ajax({
                    url: '<?php echo route("check_unique_mobile");?>',
                    method: 'POST',
                    data: {
                        'mobile': tel_no,
                        'user_id':admin_id,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            $("#div_tel_no").removeClass('has-error');
                            $("#msg_tel_no").html("");
                            $("#btnSubmit").removeAttr('disabled');
                        } else {
                            $("#div_tel_no").addClass('has-error');
                            $("#msg_tel_no").html($obj['MESSAGE']);
                            if (scroll_element == '') {
                                scroll_element = 'div_tel_no';
                            }
                            $("#btnSubmit").attr('disabled', 'disabled');
                        }

                    }
                });
            }

        });
        $("#logo").on("change", function (e) {

            //alert($("#image").val())
            var scroll_element = '';
            input = document.getElementById('logo');

            var file_name = input.files[0].name;
            var ext = file_name.split('.');
            if($.inArray(ext[1], ['png','jpg','jpeg']) == -1) {
                $("#div_logo").addClass('has-error');
                $("#msg_logo").html("You have uploaded an invalid image file type");
                if (scroll_element == '') {
                    scroll_element = 'div_logo';
                }
                $('#btnSubmit').attr('disabled', 'disabled');
                return false;
            }
            var size = (input.files[0].size/1024).toFixed(2);
           
            /*to create file name*/

            if(size > 1024){
                $("#div_logo").addClass('has-error');
                $("#msg_logo").html("Upload an image less then 1MB.");
                if (scroll_element == '') {
                    scroll_element = 'div_logo';
                }
                $('#btnSubmit').attr('disabled', 'disabled');
                return false;
            }else{
                $("#image").val(file_name);

                $("#div_logo").removeClass('has-error');
                $("#msg_logo").html("");
                file = input.files[0];
                fr = new FileReader();
                fr.onload = receivedText;
                //fr.readAsText(file);
                fr.readAsDataURL(file);
            }
        });
        function receivedText() {
            document.getElementById('editor').appendChild(document.createTextNode(fr.result));
            image_upload();
        }
        function image_upload(){
            var image = $("#image").val();
            var image_base64 = $("#editor").text();
            var user_id = $("#agent_id").val();

            $.ajax({
                url: '<?php echo route('agent_image_upload');?>',
                method: 'POST',
                data: {
                    'user_id':user_id,
                    'image':image,
                    'image_base64' : image_base64,
                    '_token': '<?php echo csrf_token();?>'
                },
                success: function (result) {
                    $obj = JSON.parse(result);
                    //console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        $("#image_display").attr('src',$obj['data']);
                        $('#btnSubmit').removeAttr('disabled');
                    } else {
                        toastr.error($obj['MESSAGE']);
                    }
                }
            });

        }
        $("document").ready(function () {
            var baseUrl = document.location.origin;
            $("#btnSubmit").on("click", function (e) {


                /*var image = $('#profile').prop('files')[0];
                 $('#image_url_json_section').append(image);
                 console.log(image);
                 return false;*/
                var login_role = $("#login_role").val();
                var company = $("#company").val();
                var image = $("#image").val();

                var status = $("input[name=status]:checked").val()

                var user_id = $("#agent_id").val();

                var f_name = $("#f_name").val();
                var m_name = $("#m_name").val();
                var l_name = $("#l_name").val();
                var nick_name = $("#nick_name").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var city = $("#city").val();
                var state = $("#state").val();
                var address1 = $("#address1").val();
                var address2 = $("#address2").val();
                var taluko = $("#taluko").val();
                var district = $("#district").val();

                var mobile = $("#mobile").val();
                var gsttin_no = $("#gsttin_no").val();
                var hsn_no = $("#hsn_no").val();
                var adhar_no = $("#adhar_no").val();
                var pan_no = $("#pan_no").val();
                var commission = $("#commission").val();
                var address1 = $("#address1").val();


                var market_name = $("#market_name").val();
                var subject = $("#subject").val();
                var tel_no = $("#tel_no").val();
                var biz_mobile = $("#biz_mobile").val();
                var biz_type = $("#biz_type").val();
                var biz_nick_name = $("#biz_nick_name").val();


                var flag = 0;
                var scroll_element = '';

                var onlyAlpfaSpace_regx = BSP.regx('only_alpha_space');
                var onlyAlpfa_regx = BSP.regx('only_alpha');
                var mobile_no_regx = BSP.regx('mobile');
                var email_regx = BSP.regx('email');
                var gsttin_no_regx = BSP.regx('gst_no');
                var pattern_capital = new RegExp('[A-Z]');
                var pattern_number = new RegExp('[0-9]');
                var pattern_number = new RegExp('[0-9]');
                var regexp = new RegExp('[0-9 ]+');
                var hsn_regexp = new RegExp('^[0-9]{6}$');
                // var regexp = new RegExp(/\s/g);

                if (market_name == '') {
                    $("#div_market_name").addClass('has-error');
                    $("#msg_market_name").html("Please enter your Market Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_market_name';
                    }
                } else {
                    $("#div_market_name").removeClass('has-error');
                    $("#msg_market_name").html("");
                }
                if (subject == '') {
                    $("#div_subject").addClass('has-error');
                    $("#msg_subject").html("Please enter your Subject Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_subject';
                    }
                } else {
                    $("#div_subject").removeClass('has-error');
                    $("#msg_subject").html("");
                }
                if (biz_type == '') {
                    $("#div_biz_type").addClass('has-error');
                    $("#msg_biz_type").html("Please enter your Business Type. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_biz_type';
                    }
                } else {
                    $("#div_biz_type").removeClass('has-error');
                    $("#msg_biz_type").html("");
                }

                if((nick_name != '') && nick_name.match(pattern_number)){
                    $("#div_nname").addClass('has-error');
                    $("#msg_nname").html("Numeric Number not allowed.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_nname';
                    }
                }
                if (company == '') {
                    $("#div_company").addClass('has-error');
                    $("#msg_company").html("Please enter your Company Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_company';
                    }
                } else {
                    $("#div_company").removeClass('has-error');
                    $("#msg_company").html("");
                }
                if (city == '') {
                    $("#div_city").addClass('has-error');
                    $("#msg_city").html("Please enter your City. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_city';
                    }
                } else {
                    $("#div_city").removeClass('has-error');
                    $("#msg_city").html("");
                }
                if (state == '') {
                    $("#div_state").addClass('has-error');
                    $("#msg_state").html("Please enter your State. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_state';
                    }
                } else {
                    $("#div_state").removeClass('has-error');
                    $("#msg_state").html("");
                }
                if (district == '') {
                    $("#div_district").addClass('has-error');
                    $("#msg_district").html("Please enter your District. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_district';
                    }
                } else {
                    $("#div_district").removeClass('has-error');
                    $("#msg_district").html("");
                }
                if((nick_name != '') && nick_name.match(regexp)){
                    $("#div_nname").addClass('has-error');
                    $("#msg_nname").html("Numeric Number and Space not allowed.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_nname';
                    }
                } else {
                    $("#div_nname").removeClass('has-error');
                    $("#msg_nname").html("");
                }
                if (address1 == '') {
                    $("#div_address1").addClass('has-error');
                    $("#msg_address1").html("Please enter Address 1. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_address1';
                    }
                } else {
                    $("#div_address1").removeClass('has-error');
                    $("#msg_address1").html("");
                }

                if (f_name == '') {
                    $("#div_fname").addClass('has-error');
                    $("#msg_fname").html("Please enter your First Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_fname';
                    }
                } else if((f_name != '') && f_name.match(regexp)){
                    $("#div_fname").addClass('has-error');
                    $("#msg_fname").html("Numeric Number and Space not allowed.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_fname';
                    }
                } else {
                    $("#div_fname").removeClass('has-error');
                    $("#msg_fname").html("");
                }

                if (m_name == '') {
                    $("#div_mname").addClass('has-error');
                    $("#msg_mname").html("Please enter your Middle Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_mname';
                    }
                }else if((m_name != '') && m_name.match(regexp)){
                    $("#div_mname").addClass('has-error');
                    $("#msg_mname").html("Numeric Number and Space not allowed.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_mname';
                    }
                }  else {
                    $("#div_mname").removeClass('has-error');
                    $("#msg_mname").html("");
                }


                if (l_name == '') {
                    $("#div_lname").addClass('has-error');
                    $("#msg_lname").html("Please enter your Last Name. It's a required Field.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_lname';
                    }
                } else if((l_name != '') && l_name.match(regexp)){
                    $("#div_lname").addClass('has-error');
                    $("#msg_lname").html("Numeric Number and Space not allowed.");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_lname';
                    }
                } else {
                    $("#div_lname").removeClass('has-error');
                    $("#msg_lname").html("");
                }

                if ((email != '') && !email_regx.test(email)) {
                    $("#div_email").addClass('has-error');
                    $("#msg_email").html("Email is invalid");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_email';
                    }
                } else {
                    if (email != '') {
                        var test = $.ajax({
                            url: '<?php echo route("check_unique_email");?>',
                            method: 'POST',
                            async: false,
                            data: {
                                'email': email,
                                'user_id': user_id,
                                '_token': '<?php echo csrf_token();?>'
                            },
                            success: function (result) {
                                $obj = JSON.parse(result);
                                if ($obj['SUCCESS'] == 'TRUE') {
                                    $("#div_email").removeClass('has-error');
                                    $("#msg_email").html("");
                                    $("#btnSubmit").removeAttr('disabled');
                                } else {
                                    flag++;
                                }
                            }
                        });
                    }
                }
                if (email != '') {
                    test.done(function (msg) {
                        $obj = JSON.parse(msg);
                        if ($obj['SUCCESS'] == 'FALSE') {
                            $("#div_email").addClass('has-error');
                            $("#msg_email").html("Email is exist");
                            if (scroll_element == '') {
                                scroll_element = 'div_email';
                            }
                            $('#btnSubmit').attr('disabled', 'disabled');


                        } else {
                            $("#btnSubmit").removeAttr('disabled');
                        }
                    });
                }

                if(user_id == '') {
                    if (password == '') {
                        $("#div_password").addClass('has-error');
                        $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                        flag++;
                    } else if (password != '' && password.length < 8) {
                        $("#div_password").addClass('has-error');
                        //$("#msg_password").html("Password should contain minimum 8 characters");
                        $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_password';
                        }
                    } else if (password != '' && !password.match(pattern_capital)) {
                        $("#div_password").addClass('has-error');
                        //$("#msg_password").html("Password should contain at least 1 capital letter");
                        $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_password';
                        }
                    } else if (password != '' && !password.match(pattern_number)) {
                        $("#div_password").addClass('has-error');
                        //$("#msg_password").html("Password should contain at least 1 numeric");
                        $("#msg_password").html("Please recheck, your Password should contain minimum 8 characters that must have atleast 1 capital letter and 1 numeric character. It's a required Field.");
                        flag++;
                        if (scroll_element == '') {
                            scroll_element = 'div_password';
                        }
                    } else {
                        $("#div_password").removeClass('has-error');
                        $("#msg_password").html("");
                    }
                }


                if (mobile == '') {
                    $("#div_mobile").addClass('has-error');
                    $("#msg_mobile").html("Please enter your Mobile Number. It's a required Field.");
                    flag++;
                } else if ((mobile != '') && !mobile_no_regx.test(mobile)) {
                    $("#div_mobile").addClass('has-error');
                    $("#msg_mobile").html("Mobile is invalid");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_mobile';
                    }
                } else {
                    var mobile_test = $.ajax({
                        url: '<?php echo route("check_unique_mobile");?>',
                        method: 'POST',
                        async : false,
                        data: {
                            'mobile': mobile,
                            'user_id':user_id,
                            '_token': '<?php echo csrf_token();?>'
                        },
                        success: function (result) {
                            $obj = JSON.parse(result);
                            if ($obj['SUCCESS'] == 'TRUE') {
                                $("#div_mobile").removeClass('has-error');
                                $("#msg_mobile").html("");
                                $("#btnSubmit").removeAttr('disabled');
                            } else {
                                flag++;
                            }

                        }
                    });
                }

                mobile_test.done(function( msg ) {
                    $obj = JSON.parse(msg);
                    if($obj['SUCCESS'] == 'FALSE'){
                        $("#div_mobile").addClass('has-error');
                        $("#msg_mobile").html("Mobile is exist");
                        if (scroll_element == '') {
                            scroll_element = 'div_mobile';
                        }
                        $('#btnSubmit').attr('disabled', 'disabled');
                    }else{
                        $("#btnSubmit").removeAttr('disabled');
                    }
                });

                if ((biz_mobile != '') && !mobile_no_regx.test(biz_mobile)) {
                    $("#div_biz_mobile").addClass('has-error');
                    $("#msg_biz_mobile").html("Mobile is invalid");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_biz_mobile';
                    }
                }else{
                    if(biz_mobile != '') {
                        var biz_mobile_test = $.ajax({
                            url: '<?php echo route("check_unique_mobile");?>',
                            method: 'POST',
                            async : false,
                            data: {
                                'mobile': biz_mobile,
                                'user_id':user_id,
                                '_token': '<?php echo csrf_token();?>'
                            },
                            success: function (result) {
                                $obj = JSON.parse(result);
                                if ($obj['SUCCESS'] == 'TRUE') {
                                    $("#div_biz_mobile").removeClass('has-error');
                                    $("#msg_biz_mobile").html("");
                                    $("#btnSubmit").removeAttr('disabled');
                                } else {
                                    flag++;
                                }
                            }
                        });
                    }


                }
                if(biz_mobile != '') {
                    biz_mobile_test.done(function( msg ) {
                        $obj = JSON.parse(msg);
                        if($obj['SUCCESS'] == 'FALSE'){
                            $("#div_biz_mobile").addClass('has-error');
                            $("#msg_biz_mobile").html("Mobile is exist");
                            if (scroll_element == '') {
                                scroll_element = 'div_biz_mobile';
                            }
                            $('#btnSubmit').attr('disabled', 'disabled');
                        }else{
                            $("#btnSubmit").removeAttr('disabled');
                        }
                    });
                }

                if ((tel_no != '') && !mobile_no_regx.test(tel_no)) {
                    $("#div_tel_no").addClass('has-error');
                    $("#msg_tel_no").html("Mobile is invalid");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_tel_no';
                    }
                }else{
                    if(tel_no != ''){
                        var biz_tel_no_test = $.ajax({
                            url: '<?php echo route("check_unique_mobile");?>',
                            method: 'POST',
                            async : false,
                            data: {
                                'mobile': tel_no,
                                'user_id':user_id,
                                '_token': '<?php echo csrf_token();?>'
                            },
                            success: function (result) {
                                $obj = JSON.parse(result);
                                if ($obj['SUCCESS'] == 'TRUE') {
                                    $("#div_tel_no").removeClass('has-error');
                                    $("#msg_tel_no").html("");
                                    $("#btnSubmit").removeAttr('disabled');
                                } else {
                                    flag++;
                                }
                            }
                        });
                    }


                }
                if(tel_no != ''){
                    biz_tel_no_test.done(function( msg ) {
                        $obj = JSON.parse(msg);
                        if($obj['SUCCESS'] == 'FALSE'){
                            $("#div_tel_no").addClass('has-error');
                            $("#msg_tel_no").html("Mobile is exist");
                            if (scroll_element == '') {
                                scroll_element = 'div_tel_no';
                            }
                            $('#btnSubmit').attr('disabled', 'disabled');
                        }else{
                            $("#btnSubmit").removeAttr('disabled');
                        }
                    });
                }

                if (gsttin_no != '' && !gsttin_no_regx.test(gsttin_no)) {
                    $("#div_gsttin_no").addClass('has-error');
                    $("#msg_gsttin_no").html("GSTIN NO is invalid");
                    flag++;
                    if (scroll_element == '') {
                        scroll_element = 'div_gsttin_no';
                    }
                } else {
                    $("#div_gsttin_no").removeClass('has-error');
                    $("#msg_gsttin_no").html("");
                }
//                if (hsn_no != '' && !hsn_regexp.test(hsn_no)) {
//                    $("#div_hsn_no").addClass('has-error');
//                    $("#msg_hsn_no").html("HSN NO is invalid");
//                    flag++;
//                    if (scroll_element == '') {
//                        scroll_element = 'div_hsn_no';
//                    }
//                } else {
//                    $("#div_hsn_no").removeClass('has-error');
//                    $("#msg_hsn_no").html("");
//                }
                if(flag !=0){
                    return false;
                }
                
                if (flag == 0) {
                    $('#btnSubmit').attr('disabled', 'disabled');
                    var formData = new FormData(this);

                    $.ajax({
                        url: '<?php echo route('seller_details_save');?>',
                        method: 'POST',
                        data: {
                            'user_id':user_id,
                            'image':image,
                            'market_name':market_name,
                            'subject':subject,
                            'tel_no':tel_no,
                            'biz_mobile':biz_mobile,
                            'biz_type':biz_type,
                            'biz_nick_name':biz_nick_name,
                            'company': company,
                            'f_name': f_name,
                            'm_name': m_name,
                            'l_name': l_name,
                            'nick_name': nick_name,
                            'email': email,
                            'password': password,
                            'mobile': mobile,
                            'city': city,
                            'state': state,
                            'taluko': taluko,
                            'district': district,
                            'address1': address1,
                            'address2': address2,
                            'gsttin_no': gsttin_no,
                            'adhar_no': adhar_no,
                            'pan_no': pan_no,
                            'hsn_no': hsn_no,
                            'commission': commission,
                            'role_id': '4',
                            'role_name': 'Agent',
                            'status': status,
                            '_token': '<?php echo csrf_token();?>'
                        },
                        success: function (result) {
                            $obj = JSON.parse(result);
                            console.log($obj);

                            if ($obj['SUCCESS'] == 'TRUE') {
                                toastr.success($obj['MESSAGE']);

                                if(user_id==''){
                                    user_id = $obj['DATA'];
                                }
                                if(login_role == 'Admin'){
                                    window.location = '<?php echo route('agent_list');?>';
                                }else{
                                    window.location = '<?php echo route('agent_list');?>';
                                }

                            } else {
                                toastr.error($obj['MESSAGE']);
                            }
                        }
                    });
                } else if (scroll_element != '') {
                    BSP.scroll_upto_div(scroll_element);
                }


            });

        });
    </script>
    <script>
        var input = document.getElementById('city');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            $("#result").html('');
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
                    $("#city").val(this.long_name);
                } else if (administrative_area_level_1 > 0) {
                    state = this.long_name;
                    if (city == '') {
                        $("#city").val('');
                    }
                    $("#state").val(this.long_name);
                } else if (administrative_area_level_2 > 0) {
                    distirict = this.long_name;
                    if (city == '') {
                        $("#district").val('');
                    }
                    $("#district").val(this.long_name);
                }else if (country > 0) {
                    country = this.long_name;
                    if (state == '') {
                        $("#state").val('');
                    }
                    if (city == '') {
                        if (state != '') {
                           $("#state").val('');
                        } else {
                           $("#city").val('');
                        }
                    }

                    $("#country").val(this.long_name);
                } else {

                }
            });
            //alert(JSON.stringify(place));
        });
    </script>
