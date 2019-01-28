<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
<meta charset="utf-8" />
<title>NayaTax</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php $add_path='';

if(Request::segment(2) != ''){
    $add_path = '../';

}
    if(Request::segment(3) != ''){
        $add_path = '../../';
    }
    if(Request::segment(4) != ''){
        $add_path = '../../../';
    } if(Request::segment(5) != ''){
        $add_path = '../../../../';
    }

    ?>


<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{$add_path}}assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{$add_path}}assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{$add_path}}assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="{{$add_path}}assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="{{$add_path}}assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" type="image/x-icon" href="{{$add_path}}assets/bsp-layouts/images/naya_tax_favicon.png"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{$add_path}}assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{$add_path}}assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{$add_path}}assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!--Start Invoice css-->
<link href="{{$add_path}}assets/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />
<!--End Invoice css-->
<!--Start Profile Section-->
<link href="{{$add_path}}assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
<!--End Profile Section-->
<!-- BEGIN BSP LAYOUT -->
<link href="{{$add_path}}assets/bsp-layouts/css/bsp-style.css" rel="stylesheet" type="text/css" />
<!-- END BSP LAYOUT-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb-qg_fHWzfnf_eudkd-4_ZtVWBtLNs_U&types=(regions)&radius=50000&sensor=false&libraries=places&language=en"></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
</head>
</html>