@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container" >
    @include('layouts.sidebar')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"  id="page_id">
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo route('dashboard');?>">{{ trans('label_word.home') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php echo route('admin');?>">{{ trans('label_word.admin_list') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{ trans('label_word.admin_edit') }}</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">{{ trans('label_word.admin_edit') }}</h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN CREATE ADMIN-->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa icon-user font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">{{ trans('label_word.admin_edit') }}</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form">
                            <input type="hidden" id="admin_id" value="{{$admin_data->id}}">
                            <div class="form-body">
                                <div class="form-group" id="div_fname">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-icon">
                                                <i class="fa icon-user"></i>
                                                <input type="text" class="form-control" id="f_name" name="f_name" value="{{$admin_data->f_name}}" placeholder="{{ trans('label_word.first_name') }}" autofocus onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                                <p class="help-block" id="msg_fname"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div_mname">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-icon">
                                                <i class="fa icon-user"></i>
                                                <input type="text" class="form-control" id="m_name" name="m_name" value="{{$admin_data->m_name}}" placeholder="{{ trans('label_word.middle_name') }}">
                                                <p class="help-block" id="msg_mname"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div_lname">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-icon ">
                                                <i class="fa icon-user"></i>
                                                <input type="text" class="form-control" id="l_name" name="l_name" value="{{$admin_data->l_name}}" placeholder="{{ trans('label_word.last_name') }}">
                                                <p class="help-block" id="msg_lname"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div_nname">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-icon ">
                                                <i class="fa icon-user"></i>
                                                <input type="text" class="form-control" id="nick_name" name="nick_name" value="{{$admin_data-> 	nick_name}}" placeholder="{{ trans('label_word.nick_name') }}">
                                                <p class="help-block" id="msg_nname"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div_email">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-icon ">
                                                <i class="fa fa-envelope"></i>
                                                <input type="text" class="form-control" id="email" name="email" value="{{$admin_data->email}}" placeholder="{{ trans('label_word.email') }}">
                                                <p class="help-block" id="msg_email"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="div_mobile">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input-icon ">
                                                <i class="fa fa-mobile"></i>
                                                <input type="number" class="form-control" id="mobile" name="mobile" value="{{$admin_data->mobile}}" placeholder="{{ trans('label_word.mobile_no') }}">
                                                <p class="help-block" id="msg_mobile"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-md-radios">
                                            <label class="col-md-3 control-label"
                                                   for="form_control_1">{{ trans('label_word.status') }}</label>

                                            <div class="col-md-9">
                                                <?php $ichecked='';$achecked='';
                                                if($admin_data->status == 'Active'){
                                                    $achecked="checked";
                                                }elseif($admin_data->status == 'Inactive'){
                                                    $ichecked="checked";
                                                }?>
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="active"
                                                                   value="Active" {{$achecked}}> {{ trans('label_word.active') }}
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="inactive"
                                                                   value="Inactive" {{$ichecked}}> {{ trans('label_word.inactive') }}  </label>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="text-right">
                                <button type="button" class="btn green" id="admin_submit">{{ trans('label_word.save') }}</button>

                                <a href="<?php echo route('admin'); ?>" class="btn default">{{ trans('label_word.cancel') }}</a>
                            </div>
                        </form>

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
<script type="text/javascript">


    $("document").ready(function () {

        $("#admin_submit").on("click", function (e) {

            var f_name = $("#f_name").val();
            var m_name = $("#m_name").val();
            var l_name = $("#l_name").val();
            var nick_name = $("#nick_name").val();
            var email = $("#email").val();
            var status = $("input[name=status]:checked").val();
            var mobile = $("#mobile").val();
            var admin_id = $("#admin_id").val();

            var flag = 0;
            var scroll_element = '';

            var onlyAlpfaSpace_regx = BSP.regx('only_alpha_space');
            var onlyAlpfa_regx = BSP.regx('only_alpha');
            var mobile_no_regx = BSP.regx('mobile');
            var email_regx = BSP.regx('email');
            var pattern_capital = new RegExp('[A-Z]');
            var pattern_number = new RegExp('[0-9]');
            var regexp = new RegExp('[0-9 ]+');

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
                $("#div_email").removeClass('has-error');
                $("#msg_email").html("");
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

                }


            if(flag !=0){
                return false;
            }
            if (flag == 0) {
                $('#admin_submit').attr('disabled', 'disabled');
                $.ajax({
                    url: '<?php echo route("admin_details_update");?>',
                    method: 'POST',
                    data: {
                        'f_name': f_name,
                        'admin_id': admin_id,
                        'm_name': m_name,
                        'l_name': l_name,
                        'nick_name': nick_name,
                        'email': email,
                        'mobile': mobile,
                        'role_id': '1',
                        'role_name': 'Admin',
                        'status': status,
                        '_token': '<?php echo csrf_token();?>'
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        //console.log($obj);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            toastr.success($obj['MESSAGE']);
                            window.location = '<?php echo route("admin");?>';

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
