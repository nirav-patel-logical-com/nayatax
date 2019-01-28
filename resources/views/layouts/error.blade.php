
<?php $add_path='';
if(Request::segment(2) != ''){
    $add_path = '../';
}?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    @include('layouts.head')
</head>
<!-- END HEAD -->
<body style="background-color: #f1f2f7;">
<!--Start Include header here-->
@include('layouts.header')
<!--End Include header here-->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div style="background-color: #f1f2f7;">
    <div>
        <?php if($code != '500' || $code != '402') { ?>
        <img src="{{$add_path}}assets/img/404-Banner/404.png" class="img-responsive">
        <?php } else { ?>
            <img src="{{$add_path}}assets/img/404-Banner/402.png" class="img-responsive">
        <?php } ?>

    </div>
</div>


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

@include('layouts.footer')

<!-- END FOOTER -->
</body>
</html>