<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>NayaTax</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/bsp-layouts/css/bsp-style.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="public/favicon.ico" /> </head>
<!-- END HEAD -->

<body class="login" id="page_id" >
<!-- BEGIN LOGO -->
<div class="logo" >
    <img src="assets/img/nayataxlogo.png" alt="" />
</div>
<!-- END LOGO -->

<!-- BEGIN LOGIN -->
<div class="content" >
    <!-- BEGIN LOGIN FORM -->

        <h3 class="form-title font-green">Sign In</h3>
        <!--<div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>-->
        <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
        <div class="alert alert-danger hidden" id="alert-success">
            <button class="close" data-close="alert"></button>
            <span id="error_msg"></span>
        </div>

        <div class="form-group" id="div_mobile">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Number</label>
            <input class="form-control form-control-solid placeholder-no-fix" onkeyup="BSP.only('digit','mobile')" type="text" id="mobile" autocomplete="off" placeholder="Mobile Number" name="mobile" />
            <p class="help-block" id="msg_mobile" style="color: #e73d4a;"></p>
        </div>

        <div class="form-group" id="div_password">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password" autocomplete="off" placeholder="Password" name="password" />
            <p class="help-block" id="msg_password" style="color: #e73d4a;"></p>
        </div>

        <div class="form-actions" >
            <input type='button' class="btn green uppercase" id='btnSubmit' value='Login'/>
           <!-- <button type="submit" id="btnSubmit" >Login</button>-->
        </div>

    <!-- END LOGIN FORM -->
</div>
<div class="copyright" style="color: rgb(54,65,80);"> 2017 &copy; registerme.in by
    <a href="http://registerme.in" title="BSP Technologies." target="_blank" style="color: rgb(212,117,34);">RegisterMe.</a></div>
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/login.min.js" type="text/javascript"></script>
<script src="assets/js/bsp_script.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->

<script type="text/javascript">

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    var mobile = localStorage.getItem('mobile');
    var password = localStorage.getItem('password');

    $("#btnSubmit").click(function(e){
        var baseUrl = document.location.origin;
        $mobile = $("#mobile").val();
        $password = $("#password").val();
        $flag = 0;
        if (($mobile == '')) {
            $flag++;
            $("#div_mobile").addClass('has-error');
            $("#msg_mobile").html("Please enter the Mobile Number, It's a required field.");
        } else {
            $("#div_email").removeClass('has-error');
            $("#div_mobile").removeClass('has-error');

            $("#msg_email").html('');
            $("#msg_mobile").html('');
        }

        if ($password == '') {
            $flag++;
            $("#div_password").addClass('has-error');
            $("#msg_password").html("Please enter the Password, It's a required field.");
        } else {
            $("#div_password").removeClass('has-error');
            $("#msg_password").html('');
        }
        /* alert($mobile);
         alert($password);return false;*/
        if ($flag == 0) {
            e.preventDefault();
           // var path = $(this).attr("href");
            $.ajax(
                    {
                        url: '<?php  echo route('admin_login_ajax'); ?>',
                        data: {
                            'mobile': $mobile,
                            'password': $password,
                            '_token': '<?php echo csrf_token();?>'
                        },
                        type: 'POST'
                       // async: true
                    })
                    .done(function(response)
                    {
                        $obj = JSON.parse(response);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            toastr.success($obj['MESSAGE']);
                            window.location = 'dashboard';
                            localStorage.removeItem('mobile');
                            localStorage.removeItem('password');
                            localStorage.clear();
                        }
                        else {
                            localStorage.setItem("mobile", $('#mobile').val());
                            localStorage.setItem("password", $('#password').val());
                            window.location.reload();
                        }
                    }).error(function(xhr){
                        localStorage.setItem("mobile", $('#mobile').val());
                        localStorage.setItem("password", $('#password').val());
                        window.location.href = baseUrl;
                    })
           /* $.ajax({
                url: '<?php // echo route('admin_login_ajax'); ?>',
                //method: 'POST',
                type: 'POST',
                data: {
                    'mobile': $mobile,
                    'password': $password,
                    '_token': '<?php //echo csrf_token();?>'
                },
                async: true,

                success: function (result) {
                    $obj = JSON.parse(result);
                    //console.log(result);
                   // console.log($obj);
                    if ($obj['SUCCESS'] == 'TRUE') {
                        toastr.success($obj['MESSAGE']);
                        window.location = 'dashboard';
                        localStorage.removeItem('mobile');
                        localStorage.removeItem('password');
                        localStorage.clear();
                    }
                    else {
             localStorage.setItem("mobile", $('#mobile').val());
             localStorage.setItem("password", $('#password').val());
             window.location.reload();
                    }
                },
                error: AjaxFailed*//*function(xhr) {
                    flag++;
                    AjaxFailed,
                    //console.log(path, arguments);
                     alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    localStorage.setItem("mobile", $('#mobile').val());
                    localStorage.setItem("password", $('#password').val());
                    window.location.reload();
                }
*//*

            });*/


          //  e.preventDefault();

        }
    });
    if(mobile != null && password != null) {
        $("#mobile").val(mobile);
        $("#password").val(password);
       // $("#error_msg").text("Invalid Credential.");
        toastr.error("Invalid Mobile Number or Password.");
        localStorage.removeItem('mobile');
        localStorage.removeItem('password');
        localStorage.clear();
    }
    $('document').ready(function(){
        var baseUrl = document.location.origin;
        var format = /[ ?]/;
        var url      = window.location.href;
        /*if(format.test(url) == true){
            localStorage.setItem("mobile", $('#mobile').val());
            localStorage.setItem("password", $('#password').val());
            window.location.reload();
        }*/

       /* $('#mobile').keypress(function(e){
            if(e.which == 13){//Enter key pressed
                alert("hi");
                $('#btnSubmit').click();//Trigger search button click event
            }
        });
        $('#password').keypress(function (e) {
            if(e.which == 13){//Enter key pressed
                $('#btnSubmit').click();//Trigger search button click event
            }
        });*/
    });

    function validateFormOnSubmit() {
        $("#btnSubmit").click();
    }

    $('#mobile').keypress(function(e){
        if(e.which == 13){//Enter key pressed
           // $('#btnSubmit').click();//Trigger search button click event
            validateFormOnSubmit();
        }
    });
    $('#password').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            // $('#btnSubmit').click();//Trigger search button click event
            validateFormOnSubmit();
        }
    });
</script>

</body>
</html>