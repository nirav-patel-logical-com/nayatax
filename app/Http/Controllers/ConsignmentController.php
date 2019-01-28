<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\BuyerProductInvoice;
use App\Consignment;
use App\ConsignmentProducts;
use App\Goods;
use App\Http\Controllers;
use App\SellerInvoice;
use App\SellerProductInvoice;
use App\SiteSettings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

session_start();

class ConsignmentController extends Controller
{

    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*display stock out list*/
    public function ledger()
    {
        return response()
            ->view('stock.list-stock-out');
    }

    /*get consignment data for stock out*/
    public function get_product_data()
    {
        // echo $_POST['bzcp_id'];die;
        if (isset($_POST['bzcp_id']) && !empty($_POST['bzcp_id'])) {
            $bzcp_id = $_POST['bzcp_id'];
            $product = new ConsignmentProducts();
            $consignment_data = $product->get_consignment_data_by_id($bzcp_id);
            //echo "<pre>";print_r($consignment_data);die;
            if (isset($consignment_data) && !empty($consignment_data[0])) {
                $response['SUCCESS'] = 'TRUE';
                $response['Data'] = $consignment_data[0];

            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /* price update or insert when change on stock in list page*/
    public function price_added()
    {
        if (isset($_POST['bzcp_id']) && !empty($_POST['bzcp_id'])
            && isset($_POST['price']) && !empty($_POST['price'])
        ) {

            $consignmentProduct = new ConsignmentProducts();
            $consignmentProduct->set_bzcp_price($_POST['price']);
            $consignmentProduct->set_bzcp_id($_POST['bzcp_id']);
            $update_data = $consignmentProduct->update_price();
            if ($update_data) {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = 'Price Added Successfully.';
                $response['Data'] = $_POST['price'];
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /* weight update or insert when change on stock in list page*/
    public function weight_added()
    {
        if (isset($_POST['bzcp_id']) && !empty($_POST['bzcp_id'])
            && isset($_POST['weight']) && !empty($_POST['weight'])
        ) {

            $consignmentProduct = new ConsignmentProducts();
            $consignmentProduct->set_bzcp_weight($_POST['weight']);
            $consignmentProduct->set_bzcp_id($_POST['bzcp_id']);
            $update_data = $consignmentProduct->update_weight();
            if ($update_data) {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = 'Price Added Successfully.';
                $response['Data'] = $_POST['weight'];
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*display stock in list page.*/
    public function stock_in_list()
    {
        $consignmentProduct = new ConsignmentProducts();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['stock_in_data'] = $consignmentProduct->get_stock_in_data($role_id, $user_id);
        //echo "<pre>";print_r($data['stock_in_data']);die;

        $users = new User();
        $data['seller_data'] = $users->seller_data($role_id, $user_id);
        $data['page_title'] = 'Stock In';
        $data['company_list'] = $users->get_agent_list($role_id, $user_id);
        $goods = new Goods();
        $data['goods_data'] = $goods->get_goods_type($role_id, $user_id);

        return response()
            ->view('stock.stock-in', ['data' => $data]);
    }

    /*get stock in data for stock in list page*/
    public function stock_in_list_post(Request $request)
    {
        $consignmentProduct = new ConsignmentProducts();
        $role_permission_arr = parent::login_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'bzcp_id',
            1 => 'name',
            2 => 'biz_name',
            3 => 'mobile',
            4 => 'gt_type',
            5 => 'bzcp_weight',
            6 => 'bzcp_bags',
            7 => 'remain_weight',
            8 => 'bzcp_id'
        );
        $total = $consignmentProduct->get_stock_in_list_count($role_id, $user_id);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $consignmentProduct->get_stock_in_list($role_id, $user_id, $start, $limit, $order, $dir);

        } else {

            $posts = $consignmentProduct->get_stock_in_list($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $consignmentProduct->get_stock_in_list_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }
        // echo "<pre>";print_r($posts);die;
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show_user = route('seller_view', $post->id);
                $print = route('stock_in', $post->bzcp_id);
                $generate_bill = route('stock_in_add', $post->bzcp_id);
                $disable = '';
                $weight_disable='';
                if ($post->bzcp_price > 0) {
                    $disable = 'disabled';
                }
                if ($post->bzcp_weight > 0) {
                    $weight_disable = 'disabled';
                }
                $kg = '1/Kg';


                if (isset($post->setting_kg_price) && !empty($post->setting_kg_price) ) {
                    $kg = $post->setting_kg_price;
                }
                if (isset($role_permission_arr['stock-in']) && $role_permission_arr['stock-in'] != 'None' && $role_permission_arr['stock-in'] != 'Read') {

                    if ($post->remain_weight > 0) {
                        $edit_view = "&nbsp;<a class='font-green-sharp glyphicon glyphicon-edit' onclick='edit({$post->bzcp_id},{$post->id});' var bzcp_id='{$post->bzcp_id}' var sellerid='{$post->id}'title='Edit' type='button' href='#create_stock_in'
                                                    data-toggle='modal'>
                                 </a>&nbsp;";
                        $create_bill = "<a class='font-green-sharp glyphicon glyphicon-print' title='Generate Bill' type='button' href='{$generate_bill}'
                                                    data-toggle='modal'>
                                          </a>&nbsp;";
                    } else {
//                        $create_bill = "";
//                        $edit_view = "";
                        $edit_view = "&nbsp;<a class='font-green-sharp glyphicon glyphicon-edit' onclick='edit({$post->bzcp_id},{$post->id});' var bzcp_id='{$post->bzcp_id}' var sellerid='{$post->id}'title='Edit' type='button' href='#create_stock_in'
                                                    data-toggle='modal'>
                                 </a>&nbsp;";
                        $create_bill = "<a class='font-green-sharp glyphicon glyphicon-print' title='Generate Bill' type='button' href='{$generate_bill}'
                                                    data-toggle='modal'>
                                          </a>&nbsp;";
                    }

                    $price = " <span id='price_kg_{$post->bzcp_id}' ondblclick='document.getElementById(&#39price_{$post->bzcp_id}&#39).disabled=false;'>

                 <input type='text' name='price' style='width: 60%;'  id='price_{$post->bzcp_id}' onkeyup='BSP.only(&#39digit&#39,&#39price_{$post->bzcp_id}&#39)' onchange='priceInfo(this.value,{$post->bzcp_id});' value='{$post->bzcp_price}' {$disable}>
                                         {$kg}
                                        </span>";



                } else {
                    $edit_view = "";
                    $price = "";
                }


                    $weight = " <span id='weight_{$post->bzcp_id}' ondblclick='document.getElementById(&#39weight_{$post->bzcp_id}&#39).disabled=false;'>

                 <input type='text' name='weight' style='width: 60%;'  id='weight_{$post->bzcp_id}' onkeyup='BSP.only(&#39digit&#39,&#weight{$post->bzcp_id}&#39)' onchange='weightInfo(this.value,{$post->bzcp_id});' value='{$post->bzcp_weight}' {$weight_disable}>
                                         {$kg}
                                        </span>";


                $nestedData['id'] = $post->bzcp_id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->name . "</a>";
                $nestedData['company'] = $post->biz_name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['goods'] = $post->gt_type;
                $nestedData['qty'] = "{$weight}";
                $nestedData['bags'] = $post->bzcp_bags;
                $nestedData['remain_qty'] = $post->remain_weight;
                $nestedData['price'] = "{$price}";
                $nestedData['action'] = "
                                            <a class='font-green-sharp glyphicon glyphicon-list' onclick='view({$post->bzcp_id},{$post->id});' title='View' var bzcp_id='{$post->bzcp_id}' var sellerid='{$post->id}' type='button' href='#view_admin'
                                                    data-toggle='modal'>
                                            </a>&nbsp;
                                            {$create_bill}
                                            {$edit_view}";

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    /*open stock out insert page*/
    public function stock_out()
    {
        $user = new User();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['buyer_data'] = $user->buyer_data($role_id, $user_id);
        $data['page_title'] = 'Stock Out';
        return response()
            ->view('stock.stock-out', ['data' => $data]);
    }

    /*display stock out list page*/
    public function stock_out_list()
    {
        $consignmentProduct = new ConsignmentProducts();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['stock_out_data'] = $consignmentProduct->get_stock_out_data($role_id, $user_id);

        $users = new User();
        $data['seller_data'] = $users->seller_data($role_id, $user_id);
        $data['page_title'] = 'Stock-Out List';

        $goods = new Goods();
        $data['goods_data'] = $goods->get_goods_type($role_id, $user_id);

        return response()
            ->view('stock.stock-out-list', ['data' => $data]);
    }

    /*get stock out data for stock out list page*/
    public function stock_out_list_post(Request $request)
    {
        $BuyerProductInvoice = new BuyerProductInvoice();

        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'bpi_id',
            1 => 'name',
            2 => 'biz_name',
            3 => 'mobile',
            4 => 'gt_type',
            5 => 'bpi_weight',
            6 => 'bpi_bid_price',
            7 => 'bpi_id'
        );
        $total = $BuyerProductInvoice->get_stock_out_list_count($role_id, $user_id);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $BuyerProductInvoice->get_stock_out_list($role_id, $user_id, $start, $limit, $order, $dir);

        } else {

            $posts = $BuyerProductInvoice->get_stock_out_list($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $BuyerProductInvoice->get_stock_out_list_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }
        //echo "<pre>";print_r($posts);die;
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show_user = route('buyer_view', $post->id);

                $nestedData['id'] = $post->bpi_id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->name . "</a>";
                $nestedData['company'] = $post->biz_name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['goods'] = $post->gt_type;
                $nestedData['qty'] = $post->bpi_weight;
                $nestedData['price'] = "{$post->bpi_bid_price}";
                $nestedData['action'] = "<a class='font-green-sharp glyphicon glyphicon-list' onclick='view({$post->bpi_id},{$post->id});' title='View' var bzcp_id='{$post->bpi_id}' var sellerid='{$post->id}' type='button' href='#view_admin'
                                                    data-toggle='modal'>
                                            </a> ";

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }


    /*insert or update stock in data*/

    public function edit_stock_in_data()
    {

        if (isset($_POST['seller_id']) && !empty($_POST['seller_id'])
            && isset($_POST['gt_id']) && !empty($_POST['gt_id'])
        ) {
            $seller_id = $_POST['seller_id'];
            $gt_id = $_POST['gt_id'];
            $price = 0;
            $date = date('Y-m-d H:i:s');
            if (isset($_POST['price']) && !empty($_POST['price'])) {
                $price = $_POST['price'];
            }
            $weight = $_POST['weight'];
            $bags = $_POST['bags'];
            /*to get business id*/
            $user = new User();
            $user->set_id($seller_id);
            $biz_data = $user->get_company_by_id();
            $consignment = new Consignment();
            $consignmentProduct = new ConsignmentProducts();

            $consignment->set_bzc_seller_user_id($seller_id);
            $consignment->set_bzc_biz_id($biz_data[0]->biz_id);
            $seller_data = $consignment->get_goods_type_seller_id();

            /*get comapnay site seting for price per kg or 20kg */

            $siteSetting = new SiteSettings();
            $siteSetting->set_fields('setting_kg_price');
            $siteSetting->set_setting_add_by($biz_data[0]->biz_id);
            $setting_data = $siteSetting->get_fields_by_add_by();
            if (isset($setting_data) && !empty($setting_data[0])) {
                $kg_price = str_replace('-Kg', '', $setting_data[0]->setting_kg_price);
                if ($kg_price === '20') {
                    $price = $price / $kg_price;
                }
            }

            $consignment_no = 1;
            if (isset($seller_data) && !empty($seller_data)) {
                $consignment_no = $seller_data[0]->bzc_consignment_no + 1;
            }
            $consignment->set_bzc_consignment_no($consignment_no);

            /*start to set data for add data in consignment product table*/
            $consignmentProduct->set_bzcp_consignment_no($consignment_no);
            $consignmentProduct->set_bzcp_biz_id($biz_data[0]->biz_id);
            $consignmentProduct->set_bzcp_gt_id($gt_id);
            $consignmentProduct->set_bzcp_seller_id($seller_id);
            $consignmentProduct->set_bzcp_price($price);
            $consignmentProduct->set_bzcp_weight($weight);
            $consignmentProduct->set_bzcp_bags($bags);
            /*edn to set data for add data in consignment product table*/

            if (isset($_POST['bzcp_id']) && !empty($_POST['bzcp_id'])) {
                $consignment_id = $_POST['bzcp_id'];

                $consignmentProduct->set_bzcp_id($consignment_id);
                $consignmentProduct->set_bzcp_modify_by($_SESSION['login_user']->id);
                $consignmentProduct->set_bzcp_modify_date($date);
                $product_data = $consignmentProduct->update_product_data();
                if ($product_data) {
                    $response['SUCCESS'] = 'TRUE';
                    $response['MESSAGE'] = 'Stock Updated Successfully';
                } else {
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Invalid Request.';
                }

            } else {
                $consignment->set_bzc_add_by($_SESSION['login_user']->id);
                $consignment->set_bzc_add_date($date);
                $consignment_id = $consignment->insert_consignment_data();
                if ($consignment_id) {

                    $consignmentProduct->set_bzcp_add_by($_SESSION['login_user']->id);
                    $consignmentProduct->set_bzcp_bzc_id($consignment_id);
                    $consignmentProduct->set_bzcp_add_date($date);
                    $product_id = $consignmentProduct->insert_product_data();
                    if ($product_id) {
                        $response['SUCCESS'] = 'TRUE';
                        $response['MESSAGE'] = 'Stock Added Successfully';
                    } else {
                        $consignment->delete_consignment($consignment_id);
                        $response['SUCCESS'] = 'FALSE';
                        $response['MESSAGE'] = 'Invalid Request.';
                    }

                } else {
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Invalid Request.';
                }
            }
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*get farmer data for stock out page when select company or goods type*/
    public function get_farmer_data_for_stock()
    {
        if (isset($_POST['farmer_id']) && !empty($_POST['farmer_id']) && isset($_POST['company_id']) && !empty($_POST['company_id'])) {
            $farmer_id = $_POST['farmer_id'];
            $company_id = $_POST['company_id'];
            $consignmentProduct = new ConsignmentProducts();
            //$consignmentProduct->set_bzcp_gt_id($gt_id);
            $product_data = $consignmentProduct->get_goods_data_by_farmer_id($farmer_id, $company_id);
            // echo "<pre>";print_r($product_data);die;
            if (isset($product_data) && !empty($product_data)) {

                $response['SUCCESS'] = 'TRUE';
                $response['good_data'] = $product_data;
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*get selected farmer stock out data for stock out*/
    public function get_farmer_stock()
    {
        if (isset($_POST['gt_id']) && !empty($_POST['gt_id']) && isset($_POST['farmer_id']) && !empty($_POST['farmer_id']) && isset($_POST['bzcp_bzc_id']) && !empty($_POST['bzcp_bzc_id'])) {
            $gt_id = $_POST['gt_id'];
            $farmer_id = $_POST['farmer_id'];
            $bzcp_bzc_id = $_POST['bzcp_bzc_id'];
            $bpi_bi_id = $_POST['bpi_bi_id'];
            $consignmentProduct = new ConsignmentProducts();
            $stock_data = $consignmentProduct->get_farmer_stock($farmer_id, $gt_id, $bzcp_bzc_id, $bpi_bi_id);
            if (isset($stock_data) && !empty($stock_data)) {

                $response['SUCCESS'] = 'TRUE';
                $response['Data'] = $stock_data;
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*get selected farmer stock out data for stock out for flow 2nd*/
    public function get_farmer_stock_for_buyer()
    {
        if (isset($_POST['gt_id']) && !empty($_POST['gt_id']) && isset($_POST['farmer_id']) && !empty($_POST['farmer_id']) && isset($_POST['bzcp_bzc_id']) && !empty($_POST['bzcp_bzc_id'])) {
            $gt_id = $_POST['gt_id'];
            $farmer_id = $_POST['farmer_id'];
            $bzcp_bzc_id = $_POST['bzcp_bzc_id'];
            $spi_si_id = $_POST['spi_si_id'];
            $consignmentProduct = new ConsignmentProducts();
            $stock_data = $consignmentProduct->get_farmer_stock_for_buyer($farmer_id, $gt_id, $bzcp_bzc_id, $spi_si_id);
            if (isset($stock_data) && !empty($stock_data)) {

                $response['SUCCESS'] = 'TRUE';
                $response['Data'] = $stock_data;
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

}