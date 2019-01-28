<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::post('admin_login_ajax','loginController@admin_login_ajax')->name('admin_login_ajax');

Route::post('login', ['as' => 'admin_login_ajax', 'uses' => 'loginController@admin_login_ajax']);

Route::post('check_unique_email','RegistrationController@check_unique_email')->name('check_unique_email');
Route::post('check_user_password','loginController@check_user_password')->name('check_user_password');
Route::post('check_unique_mobile','RegistrationController@check_unique_mobile')->name('check_unique_mobile');
Route::post('check_unique_goods_type','GoodsController@check_unique_goods_type')->name('check_unique_goods_type');



/*start admin route*/
Route::post('admin_list_post','UsersController@admin_list_post')->name('admin_list_post');
Route::post('admin_details_save','UsersController@admin_details_save')->name('admin_details_save');
Route::post('admin_details_update','UsersController@admin_details_update')->name('admin_details_update');
Route::post('change_user_status','UsersController@change_user_status')->name('change_user_status');
Route::post('change_password','UsersController@reset_password')->name('change_password');
/*end admin route*/

/*start agent route*/
Route::post('agent_list_post','AgentController@agent_list_post')->name('agent_list_post');
Route::post('agent_image_upload','RegistrationController@agent_image_upload')->name('agent_image_upload');
/*end agent route*/

/*start seller route*/
Route::post('seller_list_post','SellerController@seller_list_post')->name('seller_list_post');
/*end agent route*/

/*start buyer route*/
Route::post('buyer_list_post','BuyerController@buyer_list_post')->name('buyer_list_post');
/*end agent route*/

/*start registration and user data update route*/
Route::post('seller_details_save','RegistrationController@seller_details_save')->name('seller_details_save');
/*end registration and user data update route*/

Route::post('goods_details_add','GoodsController@goods_details_add')->name('goods_details_add');


Route::post('goods_list_post','GoodsController@goods_list_post')->name('goods_list_post');

/*start stock relater route*/
Route::post('get_user_data','UsersController@get_user_data')->name('get_user_data');
Route::post('get_user_data_for_stock','UsersController@get_user_data_for_stock')->name('get_user_data_for_stock');
Route::post('fetch_user_auto_complete_for_stock','UsersController@fetch_user_auto_complete_for_stock')->name('fetch_user_auto_complete_for_stock');
Route::post('get_good_type_by_biz_id','SellerController@get_good_type_by_biz_id')->name('get_good_type_by_biz_id');
Route::post('get_farmer_data_for_stock','ConsignmentController@get_farmer_data_for_stock')->name('get_farmer_data_for_stock');
Route::post('get_farmer_stock','ConsignmentController@get_farmer_stock')->name('get_farmer_stock');
Route::post('get_farmer_stock_for_buyer','ConsignmentController@get_farmer_stock_for_buyer')->name('get_farmer_stock_for_buyer');
Route::post('get_product_data','ConsignmentController@get_product_data')->name('get_product_data');
Route::post('get_product_data_by_bpi_id','BuyerInvoiceController@get_product_data_by_bpi_id')->name('get_product_data_by_bpi_id');
Route::post('stock_in_list_post','ConsignmentController@stock_in_list_post')->name('stock_in_list_post');
Route::post('stock_out_list_post','ConsignmentController@stock_out_list_post')->name('stock_out_list_post');
Route::post('price_added','ConsignmentController@price_added')->name('price_added');
Route::post('weight_added','ConsignmentController@weight_added')->name('weight_added');
Route::post('edit_stock_in_data','ConsignmentController@edit_stock_in_data')->name('edit_stock_in_data');
Route::post('add_stock_out_data','BuyerInvoiceController@add_stock_out_data')->name('add_stock_out_data');
Route::post('insert_product_invoice','BuyerInvoiceController@insert_product_invoice')->name('insert_product_invoice');
Route::post('insert_seller_invoice','SellerInvoiceController@insert_seller_invoice')->name('insert_seller_invoice');
Route::post('delete_seller_product','SellerInvoiceController@delete_seller_product')->name('delete_seller_product');
Route::post('insert_seller_product_invoice','SellerInvoiceController@insert_seller_product_invoice')->name('insert_seller_product_invoice');
Route::post('seller_bill_collection_list_post','SellerInvoiceController@seller_bill_collection_list_post')->name('seller_bill_collection_list_post');
Route::post('buyer_bill_collection_list_post','BuyerInvoiceController@buyer_bill_collection_list_post')->name('buyer_bill_collection_list_post');
Route::post('add_stock_in_data','SellerInvoiceController@add_stock_in_data')->name('add_stock_in_data');
Route::post('product_data_update_spi_si_id','SellerInvoiceController@product_data_update_spi_si_id')->name('product_data_update_spi_si_id');
Route::post('update_payment_type','SellerInvoiceController@update_payment_type')->name('update_payment_type');
Route::post('buyer_update_payment_type','BuyerInvoiceController@buyer_update_payment_type')->name('buyer_update_payment_type');
Route::post('pending_stock_out_list_post','BuyerInvoiceController@pending_stock_out_list_post')->name('pending_stock_out_list_post');
Route::post('pending_stock_in_list_post','SellerInvoiceController@pending_stock_in_list_post')->name('pending_stock_in_list_post');
Route::post('delete_buyer_product','BuyerInvoiceController@delete_buyer_product')->name('delete_buyer_product');
/*end stock relater route*/


/*start report related route*/
Route::post('sales_report_post','BuyerInvoiceController@sales_report_post')->name('sales_report_post');
Route::post('farmer_report_post','SellerInvoiceController@farmer_report_post')->name('farmer_report_post');
/*end report related route*/
Route::group(['middleware' => ['role'],'role' => ['Admin']] , function () {
    Route::post('is-unique-role','RoleController@is_unique_role')->name('is_unique_role');
    Route::post('role_list_post','RoleController@role_list_post')->name('role_list_post');

    Route::post('module-create-post','ModuleController@module_create_post')->name('module_create_post');
    Route::post('role-create-post','RoleController@role_create_post')->name('role_create_post');
    Route::post('is-unique-module','ModuleController@is_unique_module')->name('is_unique_module');
    Route::post('module_list_post','ModuleController@module_list_post')->name('module_list_post');
    Route::post('role_permission_form','RoleModulePermissionController@role_permission_form')->name('role_permission_form');
    Route::post('assign_module_permission_to_role', 'RoleModulePermissionController@assign_module_permission_to_role')->name('assign_module_permission_to_role');
});

Route::post('setting_seeting_post', ['as' => 'setting_reference_credit_post', 'uses' => 'SiteSettingController@setting_reference_credit_post']);
Route::post('setting_gst_post', ['as' => 'setting_gst_post', 'uses' => 'SiteSettingController@setting_gst_post']);
Route::post('change_lang', ['as' => 'change_lang', 'uses' => 'homeController@change_lang']);
Route::post('generate_bill_post', ['as' => 'generate_bill_post', 'uses' => 'SellerController@generate_bill_post']);

Route::post('generate_in_view_list',['as' => 'generate_in_view_list', 'uses' => 'SellerInvoiceController@generate_in_view_list']);


Route::post('get_hsn_no_by_goods_id',['as' => 'get_hsn_no_by_goods_id', 'uses' => 'GoodsController@get_hsn_no_by_goods_id']);

Route::post('farmer_bill_post',['as' => 'farmer_bill_post', 'uses' => 'SellerController@farmer_bill_post']);

Route::post('add_buyer_invoice_data',['as' => 'add_buyer_invoice_data', 'uses' => 'BuyerInvoiceController@add_buyer_invoice_data']);

Route::post('canel_invoice_list_post',['as' => 'canel_invoice_list_post', 'uses' => 'BuyerInvoiceController@canel_invoice_list_post']);

Route::post('seller_data_serach',['as' => 'seller_data_serach', 'uses' => 'SellerController@seller_data_serach']);

Route::post('buyer_data_serach',['as' => 'buyer_data_serach', 'uses' => 'SellerController@buyer_data_serach']);

Route::post('seller_product_add',['as' => 'seller_product_add', 'uses' => 'SellerController@seller_product_add']);

Route::post('farmer_data_fetch',['as' => 'farmer_data_fetch', 'uses' => 'SellerController@farmer_data_fetch']);

Route::post('farmer_data_add',['as' => 'farmer_data_add', 'uses' => 'SellerController@farmer_data_add']);

Route::post('good_type_serach',['as' => 'good_type_serach', 'uses' => 'GoodsController@good_type_serach']);

Route::post('seller_product_edit_post',['as' => 'seller_product_edit_post', 'uses' => 'SellerController@seller_product_edit_post']);

Route::post('seller_added_data_fetch',['as' => 'seller_added_data_fetch', 'uses' => 'SellerController@seller_added_data_fetch']);