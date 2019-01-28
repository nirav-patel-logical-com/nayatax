<?php


Route::get('/', 'homeController@index')->name('login');
Route::get('dashboard', ['middleware' => 'guest', 'as' => 'dashboard', 'uses' => 'homeController@dashboard']);
Route::get('profile/{id}', ['middleware' => 'guest', 'as' => 'user_view', 'uses' => 'homeController@user_view']);

/*start admin route*/

Route::get('admin', ['middleware' => ['role_permission', 'guest'], 'module' => 'admin', 'module_per' => ['Write', 'Read'], 'as' => 'admin', 'uses' => 'UsersController@admin']);
Route::get('admin-view/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'admin', 'module_per' => ['Write', 'Read'], 'as' => 'admin_view', 'uses' => 'UsersController@admin_view']);
Route::get('admin-edit/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'admin', 'module_per' => ['Write'], 'as' => 'admin_edit', 'uses' => 'UsersController@admin_edit']);
Route::get('change-password/{id}', ['middleware' => 'guest', 'as' => 'change_admin_password', 'uses' => 'UsersController@change_password']);
/*end admin route*/

/*start agent route*/
Route::get('agent-add', ['middleware' => ['role_permission', 'guest'], 'module' => 'agent', 'module_per' => ['Write'], 'as' => 'agent', 'uses' => 'AgentController@agent']);
Route::get('agent-edit/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'agent', 'module_per' => ['Write'], 'as' => 'agent_edit', 'uses' => 'AgentController@agent_edit']);
Route::get('agent-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'agent', 'module_per' => ['Write', 'Read'], 'as' => 'agent_list', 'uses' => 'AgentController@agent_list']);
Route::get('agent-view/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'agent', 'module_per' => ['Write', 'Read'], 'as' => 'agent_view', 'uses' => 'AgentController@agent_view']);
/*end seller route*/

/*start seller route*/
Route::get('farmer-add', ['middleware' => ['role_permission', 'guest'], 'module' => 'farmers', 'module_per' => ['Write'], 'as' => 'farmer', 'uses' => 'SellerController@farmer']);
Route::get('farmer-edit/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'farmers', 'module_per' => ['Write'], 'as' => 'farmer_edit', 'uses' => 'SellerController@farmer_edit']);
Route::get('seller-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'farmers', 'module_per' => ['Write', 'Read'], 'as' => 'seller_list', 'uses' => 'SellerController@seller_list']);
Route::get('seller-view/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'farmers', 'module_per' => ['Write', 'Read'], 'as' => 'seller_view', 'uses' => 'SellerController@seller_view']);
Route::get('seller-bills-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'seller-bill', 'module_per' => ['Write', 'Read'], 'as' => 'seller_bills_list', 'uses' => 'SellerController@seller_bills_list']);
Route::get('seller_bills_list_pending/', ['middleware' => ['role_permission', 'guest'], 'module' => 'seller-bill', 'module_per' => ['Write', 'Read'], 'as' => 'seller_bills_list_pending', 'uses' => 'SellerController@seller_bills_list_pending']);
/*end seller route*/

/*start buyer route*/
Route::get('buyer-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer', 'module_per' => ['Write', 'Read'], 'as' => 'buyer', 'uses' => 'BuyerController@buyer']);
Route::get('buyer-add', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer', 'module_per' => ['Write'], 'as' => 'buyer_add', 'uses' => 'BuyerController@buyer_add']);
Route::get('buyer-edit/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer', 'module_per' => ['Write'], 'as' => 'buyer_edit', 'uses' => 'BuyerController@buyer_edit']);
Route::get('buyer-view/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer', 'module_per' => ['Write', 'Read'], 'as' => 'buyer_view', 'uses' => 'BuyerController@buyer_view']);
Route::get('buyer-bills-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer-bill', 'module_per' => ['Write', 'Read'], 'as' => 'buyer_bills_list', 'uses' => 'BuyerController@buyer_bills_list']);
/*end buyer route*/

/*start goods route*/
Route::get('goods-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'goods-type', 'module_per' => ['Write', 'Read'], 'as' => 'goods', 'uses' => 'GoodsController@goods']);
Route::get('add-goods-type', ['middleware' => ['role_permission', 'guest'], 'module' => 'goods-type', 'module_per' => ['Write'], 'as' => 'add_goods_type', 'uses' => 'GoodsController@add_goods_type']);
Route::get('edit-goods-type/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'goods-type', 'module_per' => ['Write'], 'as' => 'edit_goods_type', 'uses' => 'GoodsController@edit_goods_type']);
Route::get('goods-type-view/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'goods-type', 'module_per' => ['Write', 'Read'], 'as' => 'goods_type_view', 'uses' => 'GoodsController@goods_type_view']);
/*end goods route*/

/*start stock related route*/
Route::get('stock-out', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-out', 'module_per' => ['Write'], 'as' => 'stock_out', 'uses' => 'ConsignmentController@stock_out']);
Route::get('invoice/{bi_id}/{date}/{gst}', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer-bill', 'module_per' => ['Write', 'Read'], 'as' => 'stock_out_invoice', 'uses' => 'BuyerInvoiceController@stock_out_invoice']);
Route::get('cancel_invoice/{bi_id}/{date}/{gst}', ['middleware' => ['role_permission', 'guest'], 'module' => 'buyer-bill', 'module_per' => ['Write', 'Read'], 'as' => 'stock_out_invoice_cancel', 'uses' => 'BuyerInvoiceController@stock_out_invoice_cancel']);
Route::get('stock-out-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-out', 'module_per' => ['Write', 'Read'], 'as' => 'stock_out_list', 'uses' => 'ConsignmentController@stock_out_list']);
Route::get('pending-buyer-bill', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-out', 'module_per' => ['Write', 'Read'], 'as' => 'buyer_stock_out_bill_create', 'uses' => 'BuyerInvoiceController@buyer_stock_out_bill_create']);
Route::get('stock-out-bill/{spi_id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-out', 'module_per' => ['Write', 'Read'], 'as' => 'stock_out_view', 'uses' => 'BuyerInvoiceController@stock_out_view']);


Route::get('stock-in-bill/{bpi_id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-in', 'module_per' => ['Write', 'Read'], 'as' => 'stock_in_view', 'uses' => 'SellerInvoiceController@stock_in_view']);
Route::get('pending-farmer-bill', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-in', 'module_per' => ['Write', 'Read'], 'as' => 'farmer_stock_in_bill_create', 'uses' => 'SellerInvoiceController@farmer_stock_in_bill_create']);
Route::get('seller-invoice/{si_id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'seller-bill', 'module_per' => ['Write', 'Read'], 'as' => 'stock_in_invoice', 'uses' => 'SellerInvoiceController@stock_in_invoice']);
Route::get('stock-in/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-in', 'module_per' => ['Write'], 'as' => 'stock_in', 'uses' => 'SellerInvoiceController@stock_in']);
Route::get('stock-in-add/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-in', 'module_per' => ['Write'], 'as' => 'stock_in_add', 'uses' => 'SellerInvoiceController@stock_in_add']);
Route::get('stock-in-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-in', 'module_per' => ['Write', 'Read'], 'as' => 'stock_in_list', 'uses' => 'ConsignmentController@stock_in_list']);
Route::get('ledger', ['middleware' => ['role_permission', 'guest'], 'module' => 'stock-in', 'module_per' => ['Write'], 'as' => 'ledger', 'uses' => 'ConsignmentController@ledger']);
Route::get('farmer-invoice', ['middleware' => ['role_permission', 'guest'], 'module' => 'farmer-report', 'module_per' => ['Write'], 'as' => 'farmer_report', 'uses' => 'SellerInvoiceController@farmer_report']);

Route::get('farmer_bill/{f_id}/{date}', ['as' => 'farmer_bill', 'uses' => 'SellerInvoiceController@farmer_bill']);
Route::get('farmer_bill_edit/{f_id}/{date}', ['as' => 'farmer_bill_edit', 'uses' => 'SellerInvoiceController@farmer_bill_edit']);
/*start stock related route*/

Route::get('bill-collection-add/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'bill-collection', 'module_per' => ['Write', 'Read'], 'as' => 'bill_collection_add', 'uses' => 'SellerInvoiceController@bill_collection_add']);
Route::get('buyer-bill-collection-add/{id}', ['middleware' => ['role_permission', 'guest'], 'module' => 'bill-collection', 'module_per' => ['Write', 'Read'], 'as' => 'buyer_bill_collection_add', 'uses' => 'BuyerInvoiceController@buyer_bill_collection_add']);
Route::get('sales-invoice', ['middleware' => ['role_permission', 'guest'], 'module' => 'sales-report', 'module_per' => ['Write', 'Read'], 'as' => 'sales_report', 'uses' => 'BuyerInvoiceController@sales_report']);


Route::get('role-create', ['middleware' => ['role_permission', 'guest'], 'module' => 'role', 'module_per' => ['Write'], 'as' => 'role_create', 'uses' => 'RoleController@role_create']);
Route::get('role-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'role', 'module_per' => ['Write', 'Read'], 'as' => 'role_list', 'uses' => 'RoleController@role_list']);
Route::get('module-create', ['middleware' => ['role_permission', 'guest'], 'module' => 'module', 'module_per' => ['Write'], 'as' => 'module_create', 'uses' => 'ModuleController@module_create']);
Route::get('module-list', ['middleware' => ['role_permission', 'guest'], 'module' => 'module', 'module_per' => ['Write', 'Read'], 'as' => 'module_list', 'uses' => 'ModuleController@module_list']);
Route::get('canel_invoice_list',['as' => 'canel_invoice_list', 'uses' => 'BuyerController@canel_invoice_list']);


// permission
Route::get('role-permission', ['middleware' => ['role_permission', 'guest'], 'module' => 'permission', 'module_per' => ['Write'], 'as' => 'set_role_module_permission', 'uses' => 'RoleModulePermissionController@set_role_module_permission']);


/* Site Setting */
Route::get('setting-setting', ['middleware' => ['role_permission', 'guest'], 'module' => 'site-settings', 'module_per' => ['Write', 'Read'], 'as' => 'setting_reference_credit', 'uses' => 'SiteSettingController@setting_reference_credit']);
/* ./Site Setting */
Route::get('logout', ['middleware' => 'guest', 'as' => 'logout', 'uses' => 'homeController@logout']);

Route::get('generate-bill', ['as' => 'generate_bill', 'uses' => 'SellerController@generate_bill']);
Route::get('generate-in-bill/{bpi_id}', ['as' => 'generate_in_view', 'uses' => 'SellerInvoiceController@generate_in_view']);
Route::get('show_farmer_data/{si_id}/{date}', ['as' => 'show_farmer_data', 'uses' => 'SellerController@show_farmer_data']);
Route::get('show_buyer_data/{bi_id}/{date}/{gst}', ['as' => 'show_buyer_data', 'uses' => 'BuyerController@show_buyer_data']);
Route::get('edit_payment_status/{si_id}', ['as' => 'edit_payment_status', 'uses' => 'SellerInvoiceController@edit_payment_status']);
Route::get('edit_buyer_payment_status/{spi_si_id}', ['as' => 'edit_buyer_payment_status', 'uses' => 'BuyerInvoiceController@edit_buyer_payment_status']);

