<?php
$ASSETS_LOCATION='/assets/';
$IMAGES_LOCATION=$ASSETS_LOCATION.'img/';
$PROFILE_LOCATION=$IMAGES_LOCATION.'profile/';
$BLOG_DESCRIPTION_IMAGES_LOCATION=$IMAGES_LOCATION.'blog-description-images/';
$DEFAULT_PICTURE_LOCATION=$IMAGES_LOCATION.'default_picture/';
$BUSINESS_LOGO_LOCATION=$IMAGES_LOCATION.'business_logo/';
$BUSINESS_PRODUCT_LOCATION=$IMAGES_LOCATION.'business_product/';
$BUSINESS_BROCHURE_LOCATION=$IMAGES_LOCATION.'business_brochure/';
$BUSINESS_VISITING_CARD_LOCATION=$IMAGES_LOCATION.'business_visiting_card/';
$BUSINESS_KYC_DOCUMENT_LOCATION=$IMAGES_LOCATION.'business_kyc_document/';
$SUPPORT_LOCATION=$IMAGES_LOCATION.'support/';
$BANNER_404_LOCATION=$IMAGES_LOCATION.'404-Banner/';
$COMPLIMENT_LOCATION=$IMAGES_LOCATION.'compliment/';
$DOCS_LOCATION=$ASSETS_LOCATION.'docs/';
$JOBSEEKER_LOCATION=$DOCS_LOCATION.'jobseeker/';
$MSG_ATTACHMENT=$IMAGES_LOCATION.'msg_attachment/';
$NOB_LOCATION=$IMAGES_LOCATION.'nature_of_business_icon/';
$PF_ICON_LOCATION=$IMAGES_LOCATION.'plan_features_icons/';
$BUSINESS_DEALS_OFFERS=$IMAGES_LOCATION.'business_deals_offers/';
$INVOICE_LOCATION_BUYER='invoice/buyer_invoice';
$INVOICE_LOCATION_SELLER='invoice/seller_invoice';

$MEETING_POINT=$IMAGES_LOCATION.'meeting_point/';

$BUCKET_FOLDER='';
//$AWS_URL='https://s3.ap-south-1.amazonaws.com/jewelxy-live-bucket/';
$AWS_URL='https://img.jewelxy.com/';




if($_SERVER['HTTP_HOST']=='nayatax.com' || $_SERVER['HTTP_HOST']=='www.nayatax.com'){
   // $SITE_URL='https://jewelxy.com/';
    $SITE_URL='https://nayatax.com/';
}else if($_SERVER['HTTP_HOST']=='localhost'){
    $SITE_URL='http://localhost:7777/server/nayatax/';
}else{
    $SITE_URL='http://localhost:7777/server/nayatax/';
}

return array(
    'SITE_URL'=>$SITE_URL,
    'ASSETS_LOCATION'=>$ASSETS_LOCATION,
    'DATE_FORMATE'=>'d-M-Y',
    'MONTH_FORMATE'=>'M-Y',
    'DATEPICKER_DATE_FORMATE'=>'dd-M-yyyy',
    'DATE_FORMATE_WITH_TIME'=>'d-M-Y h:i:s',
    'DATE_FORMATE_WITH_TIME_AM_PM'=>'d-M-Y h:i A',
    'DATE_FORMATE_MSG_TODAY'=>'h:i A',
    'DATE_FORMATE_MSG'=>'M d',
    'IMAGES_LOCATION'=>$IMAGES_LOCATION,
    'PROFILE_LOCATION'=>$PROFILE_LOCATION,
    'ADMIN_EMAIL'=>'info@nayatax.com',
    'DEFAULT_PICTURE_LOCATION'=>$DEFAULT_PICTURE_LOCATION,

    'AWS_URL'=>$AWS_URL,
    'INVOICE_LOCATION_BUYER'=>$INVOICE_LOCATION_BUYER,
    'INVOICE_LOCATION_SELLER'=>$INVOICE_LOCATION_SELLER,

);