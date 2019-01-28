<?php

/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\User;
use App\Goods;
use App\SellerInvoice;
use App\BuyerProductInvoice;
use App\Consignment;
use App\ConsignmentProducts;
use App\Http\Controllers;
use App\SellerProductInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\ServiceProvider;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade;
use Illuminate\Support\Facades\Config;
use Mpdf\Mpdf;
use App\SiteSettings;


session_start();

class SellerInvoiceController extends Controller
{

    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*seller bill collection page open*/
    public function bill_collection_add($id)
    {

        $sellerinvoice = new SellerInvoice();
        $data['page_title'] = 'Add Bill Collection';
        $seller_data = $sellerinvoice->get_invoice_data_by_si_id($id);
        $data['seller_data'] = $seller_data[0];

        return response()
            ->view('invoice.bill-collection', ['data' => $data]);
    }
    /*start flow 1
    1st buyer bill create then after farmer bill.*/
    public function farmer_stock_in_bill_create()
    {
        return response()
            ->view('seller.pending_seller_bill');
    }

    public function pending_stock_in_list_post(Request $request)
    {
        $BuyerProductInvoice = new BuyerProductInvoice();

        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'bpi_id',
            1 => 'farmer_name',
            2 => 'biz_name',
            3 => 'mobile',
            4 => 'gt_type',
            5 => 'bpi_weight',
            6 => 'bpi_bid_price',
            7 => 'bpi_id'
        );
        $total = $BuyerProductInvoice->get_pending_farmer_bill_count($role_id, $user_id);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $BuyerProductInvoice->get_pending_farmer_bill($role_id, $user_id, $start, $limit, $order, $dir);

        } else {

            $posts = $BuyerProductInvoice->get_pending_farmer_bill($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $BuyerProductInvoice->get_pending_farmer_bill_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }
        //echo "<pre>";print_r($posts);die;
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show_user = route('seller_view', $post->bpi_saller_id);
                $show_stock_out = route('stock_in_view', $post->bpi_id);

                $nestedData['id'] = $post->bpi_id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->farmer_name . "</a>";
                $nestedData['company'] = $post->biz_name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['goods'] = $post->gt_type;
                $nestedData['qty'] = $post->bpi_weight;
                $nestedData['price'] = "{$post->bpi_bid_price}";
                $nestedData['action'] = "<a class='font-green-sharp glyphicon glyphicon-print' title='Generate Bill' type='button' href='{$show_stock_out}'></a> ";
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
    public function stock_in_view($bpi_id)
    {
        $BuyerProductInvoice = new BuyerProductInvoice();
        $stock_in_data = $BuyerProductInvoice->get_pending_bill_by_bpi_id($bpi_id);
        $data['stock_in_data'] = $stock_in_data[0];
        return response()
            ->view('stock.stock-in-add', ['data' => $data]);

    }


    public function generate_in_view($id)
    {
        $BuyerProductInvoice = new BuyerProductInvoice();
        $User=new User();
        $Goods=new Goods();
        $SiteSettings = new SiteSettings();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $buyer_list=$User->get_buyer_list($role_id, $user_id);
        $data['buyer_list'] = $buyer_list;
        $goods_type_list=$Goods->get_goods_type_list($role_id, $user_id);
        $data['goods_type_list'] = $goods_type_list;
        $stock_in_data = $BuyerProductInvoice->get_pending_bill_by_bpi_id($id);
        $data['stock_in_data'] = $stock_in_data;
        $site_setting_data=$SiteSettings->get_site_setting();
        $data['site_setting_data'] = $site_setting_data[0];
//        print_r($site_setting_data[0]->setting_kg_price);
//        exit;
        return response()
            ->view('seller.generate-add-bill', ['data' => $data]);

    }

    public function generate_in_view_list()
    {
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $User=new User();
        $Goods=new Goods();
        $buyer_list=$User->get_buyer_list($role_id, $user_id);
        $data['buyer_list'] = $buyer_list;
        $goods_type_list=$Goods->get_goods_type_list($role_id, $user_id);
        $data['goods_type_list'] = $goods_type_list;
        $json_data = array(
//            "data" => $data
              "buyer_list" => $buyer_list,
             "goods_type_list" => $goods_type_list
        );

        echo json_encode($json_data);

    }
    /*start 2 flow
    first farmer bill created then after buyer bill
    */
    public function stock_in_add($bzcp_id)
    {
        if (isset($bzcp_id) && !empty($bzcp_id)) {
            $consignmentProduct = new ConsignmentProducts();
            $role_id = $_SESSION['login_user']->role_id;
            $user_id = $_SESSION['login_user']->id;
            $seller_data = $consignmentProduct->get_farmer_data_by_bzcp_id($bzcp_id, $role_id, $user_id);

            $data['page_title'] = 'Create Farmer Bill';
            $data['farmer_consignment_data'] = $seller_data[0];
            return response()
                ->view('stock.stock_in_bill', ['data' => $data]);
        } else {
            redirect::route('stock_in_list');
        }
    }

    /*end 2 flow
    first farmer bill created then after buyer bill
    */
    public function farmer_report()
    {
        return response()
            ->view('farmer.farmer_report');
    }

    public function farmer_report_post(Request $request)
    {

        $SellerProductInvoice = new SellerProductInvoice();
        $role_permission_arr = parent::login_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'si_add_date',
            1 => 'biz_name',
            2 => 'seller_name',
            3 => 'gstin_no',
            4 => 'si_total',
        );

        $company = $request->input('form.company_name');
        $amount = $request->input('form.amount');
        $gst_tin = $request->input('form.gst_tin');
        $farmer_name = $request->input('form.farmer_name');
        $daterange = $request->input('form.daterange');
        $from_date = '';
        $to_date = '';
        if (!empty($daterange)) {
            $getdate = explode(' - ', $daterange);
            $from_date = date('Y-m-d' . ' 00:00:00', strtotime($getdate[0]));
            $to_date = date('Y-m-d' . ' 24:60:60', strtotime($getdate[1]));
        }
            $date = date('Y-m-d') . ' 00:00:00';



        $total = $SellerProductInvoice->get_invoice_data_count( $role_id, $user_id,$search = '', $date, $from_date, $to_date, $company, $amount, $farmer_name);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($search)) {

            $posts = $SellerProductInvoice->get_invoice_data_list($role_id, $user_id,$start, $limit, $order, $dir, $search = '', $date, $from_date, $to_date, $company, $amount, $farmer_name);

        } else {

            $posts = $SellerProductInvoice->get_invoice_data_list( $role_id, $user_id,$start, $limit, $order, $dir, $search,$date, $from_date, $to_date, $company, $amount, $farmer_name);
            $total_rec = $SellerProductInvoice->get_invoice_data_count($role_id, $user_id,$search, $date, $from_date, $to_date, $company, $amount,$farmer_name);
            $totalFiltered = $total_rec[0]->total;
        }
        //exit;

        $data = array();
        if (!empty($posts)) {
            /*to set data in td.*/
            foreach ($posts as $post) {
                $show = route('farmer_bill',['id'=>$post->id,'date'=>date('Y-m-d', strtotime($post->si_add_date))]);
                $nestedData['date'] = date('d-m-Y', strtotime($post->si_add_date));
                $nestedData['company'] = "<a class='font-green-sharp' href='{$show}'>" . $post->biz_name . "</a>";
                $nestedData['name'] = $post->seller_name;
                $nestedData['gsttin'] = $post->gstin_no;
//                $nestedData['total_amount'] = $post->si_total;
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

    /*update farmer payment type*/
    public function update_payment_type()
    {
        //echo "<pre>";print_r($_POST);die;
        if (isset($_POST['si_id']) && !empty($_POST['si_id']) &&
            isset($_POST['payment_type']) && !empty($_POST['payment_type'])
        ) {

            $SellerInvoice = new SellerInvoice();

            $si_id = $_POST['si_id'];
            $payment_type = $_POST['payment_type'];
            $bank_name = '';
            $cheque_no = '';
            $ac_no = '';
            $ifsc_code = '';
            $date = date('Y-m-d H:i:s');


            if ($payment_type != 'Cash') {
                $cheque_no = $_POST['cheque_no'];
                $bank_name = $_POST['bank_name'];
                $ifsc_code = $_POST['ifsc_code'];
                $ac_no = $_POST['ac_no'];
            }
            $SellerInvoice->set_si_id($si_id);
            $SellerInvoice->set_si_payment_type($payment_type);
            $SellerInvoice->set_si_cheque_no($cheque_no);
            $SellerInvoice->set_si_bank_name($bank_name);
            $SellerInvoice->set_si_ac_no($ac_no);
            $SellerInvoice->set_si_ifs_code($ifsc_code);
            $SellerInvoice->set_si_modify_by($_SESSION['login_user']->id);
            $SellerInvoice->set_si_modify_date($date);
            $SellerInvoice->set_si_payment_status('Approved');
            $si_data = $SellerInvoice->update_product_payment_status();

            $SellerProductInvoice = new SellerProductInvoice();
            $SellerProductInvoice->set_spi_si_id($si_id);
            $SellerProductInvoice->set_spi_payment_status('Approved');
            $SellerProductInvoice->update_seller_payment_status();
            if ($si_data) {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = 'Payment Stored Successfully.';
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

    /*start 1st flow
        first buyer bill created then after farmer bill*/
    /*get data for bill collection list page.*/
    public function seller_bill_collection_list_post(Request $request)
    {
        $sellerinvoice = new SellerInvoice();
        $role_permission_arr = parent::login_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'si_invoice_no',
            1 => 'seller_name',
            2 => 'biz_name',
            3 => 'gt_type',
            4 => 'spi_weight',
            5 => 'si_total',
            6 => 'si_payment_type',
            7 => 'si_payment_status',
            8 => 'si_invoice_no',
        );
        $total = $sellerinvoice->count_data($role_id, $user_id);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $sellerinvoice->get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir);

        } else {

            $posts = $sellerinvoice->get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search);
            //$total_rec = $sellerinvoice->get_invoice_data_count($role_id, $user_id, $search);
            $totalFiltered = count($posts);
            /*if (!empty($total_rec[0])) {
                $totalFiltered = $total_rec[0]->total;
            } else {
                $totalFiltered = 0;
            }*/
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show_user = route('seller_view', $post->seller_id);
                $show = route('stock_in_invoice', $post->si_id);
                $status = route('bill_collection_add', $post->si_id);
                if (isset($role_permission_arr['seller-bill']) && $role_permission_arr['seller-bill'] != 'None' && $role_permission_arr['seller-bill'] != 'Read' && $post->si_payment_status != 'Approved') {
                    $status_view = "<a class='font-green-sharp' href='{$status}' title='Status' ><span>" . $post->si_payment_status . "</span></a>";
                } else {
                    $status_view = $post->si_payment_status;
                }
                $nestedData['id'] = $post->si_invoice_no;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->seller_name . "</a>";
                $nestedData['company'] = $post->biz_name;
                $nestedData['goods'] = $post->gt_type;
                $nestedData['qty'] = $post->spi_weight;
                $nestedData['amount'] = $post->si_total;
                $nestedData['type'] = $post->si_payment_type;
                $nestedData['status'] = "{$status_view}";

                $nestedData['action'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp glyphicon glyphicon-list'></span></a>";
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

    /*insert buyer purchase data in farmer invoice.*/

    public function insert_seller_invoice()
    {
        if (isset($_POST['biz_id']) && !empty($_POST['biz_id']) &&
            isset($_POST['seller_id']) && !empty($_POST['seller_id'])
        ) {
            $SellerInvoice = new SellerInvoice();
            $spi_biz_id = $_POST['biz_id'];
            $spi_saller_id = $_POST['seller_id'];
            $date = date('Y-m-d H:i:s');
            $login_user = $_SESSION['login_user']->id;
            $invoice_details = $SellerInvoice->get_invoice_number($spi_biz_id, $spi_saller_id);
            $invoice_no = 1;
            if (isset($invoice_details) && !empty($invoice_details)) {
                $invoice_no = $invoice_details[0]->si_invoice_no + 1;
            }
            $SellerInvoice->set_si_biz_id($spi_biz_id);
            $SellerInvoice->set_si_saller_id($spi_saller_id);
            $SellerInvoice->set_si_invoice_no($invoice_no);
            $SellerInvoice->set_si_payment_status('Pending');
            $SellerInvoice->set_si_add_by($login_user);
            $SellerInvoice->set_si_add_date($date);
            $si_id = $SellerInvoice->insert_product_data();
            if ($si_id) {
                $response['SUCCESS'] = 'TRUE';
                $response['spi_si_id'] = $si_id;
                $response['spi_invoice_no'] = $invoice_no;
                $response['MESSAGE'] = 'Insert Product Invoice Successfully';

            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request.';
            }

        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*insert buyer purchase data in farmer product invoice.*/
    public function insert_seller_product_invoice()
    {


        if (
            isset($_POST['spi_gt_id']) && !empty($_POST['spi_gt_id']) &&
            isset($_POST['spi_seller_id']) && !empty($_POST['spi_seller_id'])
        ) {
            /* echo "<pre>";
             print_r($_POST['bpi_id']);die;*/
            $SellerProductInvoice = new SellerProductInvoice();
            $SellerInvoice = new SellerInvoice();
            $consignmentProduct = new ConsignmentProducts();
            $date = date('Y-m-d H:i:s');
            $login_user = $_SESSION['login_user']->id;
            if(isset($_POST['bzcp_bzc_id']) && empty($_POST['bzcp_bzc_id'])){
                $spi_bzc_id = $_POST['bzcp_bzc_id'];
            }else{
                $spi_bzc_id =0;
            }
            //get with api
            /*start insert seller product invoice data*/

            $spi_biz_id = 0;

            $spi_gt_id = $_POST['spi_gt_id'];
            $spi_saller_id = $_POST['spi_seller_id'];
            $spi_buyer_id = $_POST['spi_buyer_id'];
            $spi_weight = $_POST['spi_weight'];
            $spi_bid_price = $_POST['spi_bid_price'];
            $spi_total = $_POST['spi_total'];
            $spi_invoice_no = $_POST['spi_invoice_no'];
            $spi_no_of_bags = $_POST['spi_no_of_bags'];


            $bpi_id = 0;
            if (isset($_POST['bpi_id']) && !empty($_POST['bpi_id'])) {
                $bpi_id = $_POST['bpi_id'];
                $SellerProductInvoice->set_spi_buyer_bill_generated('Yes');
                $BuyerProductInvoice = new BuyerProductInvoice();
                $BuyerProductInvoice->update_product_farmer_bill_status($_POST['bpi_id'], $spi_saller_id);

            } else {
                $SellerProductInvoice->set_spi_buyer_bill_generated('No');
            }
         /*start insert invoice*/
            $spi_si_id = $_POST['spi_si_id'] ;
            $spi_si_id= $spi_si_id + 1;
            $SellerProductInvoice->set_spi_rate($spi_bid_price);
            $SellerProductInvoice->set_spi_si_id($spi_si_id);
            $SellerProductInvoice->set_spi_saller_id($spi_saller_id);
            $SellerProductInvoice->set_spi_buyer_id($spi_buyer_id);
            $SellerProductInvoice->set_spi_gt_id($spi_gt_id);
            $SellerProductInvoice->set_spi_bzc_id($spi_bzc_id);
            $SellerProductInvoice->set_spi_weight($spi_weight);
            $SellerProductInvoice->set_spi_no_of_bags($spi_no_of_bags);
            $SellerProductInvoice->set_spi_total($spi_total);
            $SellerProductInvoice->set_spi_bpi_id($bpi_id);


                $SellerInvoice->set_si_biz_id($spi_biz_id);
                $SellerInvoice->set_si_saller_id($spi_saller_id);
                //$SellerInvoice->set_si_invoice_no($invoice_no);
                $SellerInvoice->set_si_payment_status('Pending');
                $SellerInvoice->set_si_add_by($login_user);
                $SellerInvoice->set_si_add_date($date);
             //   $si_id = $SellerInvoice->insert_product_data();


                    $SellerProductInvoice->set_spi_si_id($spi_si_id);
//                    $SellerProductInvoice->set_spi_invoice_no($invoice_no);
                    $SellerProductInvoice->set_spi_add_date($date);
                    $SellerProductInvoice->set_spi_add_by($login_user);
                    $SellerProductInvoice->set_spi_payment_status('Pending');

                    $spi_id = $SellerProductInvoice->insert_product_data();
                    if ($spi_id) {
                        $response['SUCCESS'] = 'TRUE';
                        $response['spi_id'] = $spi_id;
                        //$response['spi_si_id'] = $si_id;
//                        $response['spi_invoice_no'] = $invoice_no;
                        $response['MESSAGE'] = 'Insert Product Invoice Successfully';
                    } else {
                        $response['SUCCESS'] = 'FALSE';
                        $response['MESSAGE'] = 'Invalid Request.';
                    }

            }


        $response_json = json_encode($response, true);
        echo $response_json;
    }

    public function delete_seller_product()
    {
        if (isset($_POST['spi_id']) && !empty($_POST['spi_id'])) {
            $spi_id = $_POST['spi_id'];
            $sellerProductInvoice = new SellerProductInvoice();
            $sellerProductInvoice->set_spi_id($spi_id);
            $sellerProductInvoice->delete_product();
            $response['SUCCESS'] = 'TRUE';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }
    /*end 1st flow
    first buyer bill created then after farmer bill*/
    /*update farmer invoice.*/
    public function add_stock_in_data()
    {


           $SellerInvoice = new SellerInvoice();
            $SellerProductInvoice = new SellerProductInvoice();

           if(isset($_POST['si_id']) && !empty($_POST['si_id'])){
               if (isset($_POST['payment_type']) && !empty($_POST['payment_type'])) {
                   $payment_type = $_POST['payment_type'];
                   $cheque_no = '';
                   $bank_name = '';
                   $ifsc_code = '';
                   $ac_no = '';
                   if ($payment_type != 'Cash') {
                       $cheque_no = $_POST['cheque_no'];
                       $bank_name = $_POST['bank_name'];
                       $ifsc_code = $_POST['ifsc_code'];
                       $ac_no = $_POST['ac_no'];
                   }
//                   if($payment_type == 'Cash'){
//                       $SellerInvoice->set_si_payment_status('Approved');
//                   }else{
//                       if(isset($_POST['payment']) && !empty($_POST['payment']) && $_POST['payment']== 1){
//                           $SellerInvoice->set_si_payment_status('Approved');
//                       }else{
//                           $SellerInvoice->set_si_payment_status('Pending');
//                       }
//
//                   }
                   $SellerInvoice->set_si_payment_status('Approved');
                   $SellerInvoice->set_si_payment_type($payment_type);
                   $SellerInvoice->set_si_id($_POST['si_id']);
                   $SellerInvoice->set_si_cheque_no($cheque_no);
                   $SellerInvoice->set_si_bank_name($bank_name);
                   $SellerInvoice->set_si_ac_no($ac_no);
                   $SellerInvoice->set_si_ifs_code($ifsc_code);
                   $SellerInvoice->set_si_modify_date(date('Y-m-d H:i:s'));
                   $SellerInvoice->update_product_payment_status();

               }
           }else{
               $farmer_id = $_POST['seller_id'];
               // $si_id = $_POST['spi_si_id'];
               // $comapny_id = $_POST['company_id'];
               $amount = $_POST['amount'];
               $market_fee = 0;

               if (isset($_POST['market_fee']) && !empty($_POST['market_fee'])) {
                   $market_fee = $_POST['market_fee'];
               }
               $market_fee_val = 0;
               if (isset($_POST['market_fee_val']) && !empty($_POST['market_fee_val'])) {
                   $market_fee_val = $_POST['market_fee_val'];
               }



               $total = $_POST['total'];
               $cheque_no = '';
               $bank_name = '';
               $ifsc_code = '';
               $ac_no = '';

                   $payment_type = NULL;

                   $SellerInvoice->set_si_payment_type($payment_type);
                   $SellerInvoice->set_si_payment_status('Pending');
                   $SellerInvoice->set_si_saller_id($_POST['seller_id']);
                   $SellerInvoice->set_si_amount($_POST['amount']);
                   $SellerInvoice->set_si_wages($market_fee);
                   $SellerInvoice->set_si_wages_total($market_fee_val);
                   $SellerInvoice->set_si_add_date(date('Y-m-d H:i:s'));
                   $SellerInvoice->set_si_total($total);
                    $spi_si_id=$SellerInvoice->insert_product_data();
                     $invoice_no='NT'.date('Ymd').$spi_si_id;
                      $SellerInvoice->update_invoice_no($invoice_no,$spi_si_id);
                   $response['spi_si_id'] = $spi_si_id;
               }



            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = 'Save Successfully';

        $response_json = json_encode($response, true);
        echo $response_json;

    }

    public function edit_payment_status($si_id)
    {


        $SellerInvoice = new SellerInvoice();
        $SellerProductInvoice = new SellerProductInvoice();

        if(isset($si_id) && !empty($si_id)) {
            $SellerInvoice->set_si_payment_status('Approved');
            $SellerInvoice->set_si_id($si_id);
            $SellerInvoice->update_payment_status();

        }
        return redirect()->route('seller_bills_list_pending');
    }

    /*display farmer invoice for print and download pdf */
    public function stock_in_invoice($si_id)
    {
        $SellerInvoice = new SellerInvoice();
        $BSPController = new BSPController();
        $SellerProductInvoice = new SellerProductInvoice();
        $data['page_title'] = 'Invoice';
        $seller_invoice_data = $SellerInvoice->get_seller_invoice_data_by_si_id($si_id);
        $seller_product_invoice_data = $SellerProductInvoice->get_seller_product_data_by_spi_si_id($si_id);
        if(isset($seller_invoice_data) && !empty($seller_invoice_data[0]->biz_logo)){
            $seller_invoice_data[0]->image=Config::get('constant.SITE_URL').'business_logo/' . $seller_invoice_data[0]->biz_logo;;
        }else{
            $seller_invoice_data[0]->image='';
        }

        $check_kg = $seller_invoice_data[0]->setting_kg_price;
        if (isset($check_kg) && !empty($check_kg)) {
            $seller_invoice_data[0]->kg = $check_kg;
        } else {
            $seller_invoice_data[0]->kg = '1Kg';
        }
        $seller_invoice_data[0]->si_total= round($seller_invoice_data[0]->si_total['amount']);
        $seller_invoice_data[0]->grand_total_word = ucwords(strtolower($BSPController->readNumber($seller_invoice_data[0]->si_total)));
        $data['seller_invoice_data'] = $seller_invoice_data[0];
        $data['seller_product_invoice_data'] = $seller_product_invoice_data[0];
        /*echo "<pre>";
        print_r($seller_invoice_data);
        print_r($seller_product_invice_data);
        die;*/
        $invoice_no = $seller_invoice_data[0]->si_invoice_no;
        $si_invoice_pdf = $seller_invoice_data[0]->si_invoice_pdf;
        $si_id = $seller_invoice_data[0]->si_id;
        $data['asset']=asset('');

        $html = view('seller.seller_invoice_pdf', array('invoice_data' => $data))->render();

        if (isset($si_invoice_pdf) && empty($si_invoice_pdf) || $si_invoice_pdf == NULL) {

            $file_name = 'invc_' . time() . '_' . $invoice_no . '.pdf';

            $mpdf = new Mpdf(
                [
                    'format' => 'A4',
                    'margin_left' => 5,
                    'margin_right' => 5,
                    'margin_top' => 5,
                    'margin_bottom' => 5,
                    'margin_header' => 5,
                    'margin_footer' => 5,
                ]);
            $pdf_file_path = base_path('invoice/seller_invoice/' . $file_name);//base_path("invoice\seller_invoice".'\\' . $file_name);

            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetProtection(array('print'),'', '');
            $mpdf->autoLangToFont = true;
            $mpdf->WriteHTML($html);

            $mpdf->Output($pdf_file_path, \Mpdf\Output\Destination::FILE);

            $SellerInvoice->set_si_id($si_id);
            $SellerInvoice->set_si_invoice_pdf($file_name);
            $SellerInvoice->update_invoice_pdf_data();
            $data['seller_invoice_download'] = Config::get('constant.SITE_URL') . Config::get('constant.INVOICE_LOCATION_SELLER') . '/' . $file_name;
        } else {
            $data['seller_invoice_download'] = Config::get('constant.SITE_URL') . Config::get('constant.INVOICE_LOCATION_SELLER') . '/' . $seller_invoice_data[0]->si_invoice_pdf;
        }
        //echo "<pre>";print_r($data);die;
        return response()
            ->view('seller.seller_invoice', ['invoice_data' => $data]);
    }
    public  function farmer_bill($saller_id,$date){

        $SellerInvoice = new SellerInvoice();
        $BSPController = new BSPController();
        $SellerProductInvoice = new SellerProductInvoice();
        $SiteSettings = new SiteSettings();
        $data['page_title'] = 'Invoice';
        $site_setting_data=$SiteSettings->get_site_setting();

        $seller_invoice_data = $SellerInvoice->get_seller_invoice_data_by_saller_id($saller_id,$date);

        $seller_product_invoice_data = $SellerProductInvoice->get_seller_product_data_by_spi_saller_id($saller_id,$date);
//        print_r($seller_product_invoice_data);exit;
        if(isset($seller_invoice_data) && !empty($seller_invoice_data[0]->company_biz_logo)){
            $seller_invoice_data[0]->image=Config::get('constant.SITE_URL').'business_logo/' . $seller_invoice_data[0]->company_biz_logo;;
        }
        else{
            $seller_invoice_data[0]->image='';
        }

        $check_kg = $seller_invoice_data[0]->setting_kg_price;
        if (isset($check_kg) && !empty($check_kg)) {
            $seller_invoice_data[0]->kg = $check_kg;
        } else {
            $seller_invoice_data[0]->kg = '1Kg';
        }
        foreach($seller_product_invoice_data as $seller_product){
            $seller_product->spi_total = number_format((float)$seller_product->spi_total, 2, '.', '');
        }
        $grandtotal=0;
        if($site_setting_data[0]->setting_kg_price == '20Kg'){

            foreach($seller_product_invoice_data as $seller_product){

                $seller_product->spi_rate = $seller_product->spi_rate * 20;
                $seller_product->spi_total = ($seller_product->spi_weight * $seller_product->spi_rate)/20;
                $grandtotal= $grandtotal+ $seller_product->spi_total;
                $seller_product->spi_total = number_format((float)$seller_product->spi_total, 2, '.', '');

            }
            $seller_invoice_data[0]->si_amount=$grandtotal;
            $seller_invoice_data[0]->si_total=$grandtotal - $seller_invoice_data[0]->si_wages-$seller_invoice_data[0]->si_other_charge;
        }

        $seller_invoice_data[0]->si_amount=number_format((float)$seller_invoice_data[0]->si_amount, 2, '.', '');
        $seller_invoice_data[0]->si_wages=number_format((float)$seller_invoice_data[0]->si_wages, 2, '.', '');
        $seller_invoice_data[0]->si_other_charge=number_format((float)$seller_invoice_data[0]->si_other_charge, 2, '.', '');
        $seller_invoice_data[0]->si_total=number_format((float)$seller_invoice_data[0]->si_total, 2, '.', '');
        $seller_invoice_data[0]->grand_total_word = ucwords(strtolower($BSPController->readNumber(round($seller_invoice_data[0]->si_total))));


        $data['site_setting_data'] = $site_setting_data[0];
        $data['seller_invoice_data'] = $seller_invoice_data[0];
        $data['seller_product_invoice_data'] = $seller_product_invoice_data;

        $invoice_no = $seller_invoice_data[0]->si_invoice_no;
        $si_invoice_pdf = $seller_invoice_data[0]->si_invoice_pdf;
        $si_id = $seller_invoice_data[0]->si_id;
        $data['asset']=asset('');

        $html = view('seller.seller_invoice_pdf', array('invoice_data' => $data))->render();
         // echo $html;exit;
        if (isset($si_invoice_pdf) && empty($si_invoice_pdf) || $si_invoice_pdf == NULL) {

            $file_name = 'invc_' . time() . '_' . $invoice_no . '.pdf';

            $mpdf = new Mpdf(
                [
                    'format' => 'A4',
                    'margin_left' => 5,
                    'margin_right' => 5,
                    'margin_top' => 5,
                    'margin_bottom' => 5,
                    'margin_header' => 5,
                    'margin_footer' => 5,
                ]);
            $pdf_file_path = base_path('invoice/seller_invoice/' . $file_name);//base_path("invoice\seller_invoice".'\\' . $file_name);

            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetProtection(array('print'),'', '');
            $mpdf->autoLangToFont = true;
            $mpdf->WriteHTML($html);

            $mpdf->Output($pdf_file_path, \Mpdf\Output\Destination::FILE);

            $SellerInvoice->set_si_id($si_id);
            $SellerInvoice->set_si_invoice_pdf($file_name);
           // $SellerInvoice->update_invoice_pdf_data();
            $data['seller_invoice_download'] = Config::get('constant.SITE_URL') . Config::get('constant.INVOICE_LOCATION_SELLER') . '/' . $file_name;
        } else {
            $data['seller_invoice_download'] = Config::get('constant.SITE_URL') . Config::get('constant.INVOICE_LOCATION_SELLER') . '/' . $seller_invoice_data[0]->si_invoice_pdf;
        }

        $data['seller_invoice_edit_data'] = 'farmer_bill_edit/'.$saller_id.'/'.$date;
        return response()
            ->view('seller.seller_invoice', ['invoice_data' => $data]);
    }


    public function farmer_bill_edit($saller_id,$date){
        $SellerInvoice = new SellerInvoice();
        $BSPController = new BSPController();
        $SellerProductInvoice = new SellerProductInvoice();
        $SiteSettings = new SiteSettings();
        $data['page_title'] = 'Invoice';
        $site_setting_data=$SiteSettings->get_site_setting();

        $seller_invoice_data = $SellerInvoice->get_seller_invoice_data_by_saller_id($saller_id,$date);

        $seller_product_invoice_data = $SellerProductInvoice->get_seller_product_data_by_spi_saller_id($saller_id,$date);

        if(isset($seller_invoice_data) && !empty($seller_invoice_data[0]->company_biz_logo)){
            $seller_invoice_data[0]->image=Config::get('constant.SITE_URL').'business_logo/' . $seller_invoice_data[0]->company_biz_logo;;
        }
        else{
            $seller_invoice_data[0]->image='';
        }

        $check_kg = $seller_invoice_data[0]->setting_kg_price;
        if (isset($check_kg) && !empty($check_kg)) {
            $seller_invoice_data[0]->kg = $check_kg;
        } else {
            $seller_invoice_data[0]->kg = '1Kg';
        }
        $grandtotal=0;
        if($site_setting_data[0]->setting_kg_price == '20Kg'){

            foreach($seller_product_invoice_data as $seller_product){

                $seller_product->spi_rate = $seller_product->spi_rate * 20;
                $seller_product->spi_total = ($seller_product->spi_weight * $seller_product->spi_rate)/20;
                $grandtotal= $grandtotal+ $seller_product->spi_total;

            }
            $seller_invoice_data[0]->si_amount=$grandtotal;
            $seller_invoice_data[0]->si_total=$grandtotal - $seller_invoice_data[0]->si_wages-$seller_invoice_data[0]->si_other_charge;
        }

        $seller_invoice_data[0]->si_date_invoice=$date;
        $seller_invoice_data[0]->si_amount=number_format((float)$seller_invoice_data[0]->si_amount, 2, '.', '');
        $seller_invoice_data[0]->si_wages=number_format((float)$seller_invoice_data[0]->si_wages, 2, '.', '');
        $seller_invoice_data[0]->si_other_charge=number_format((float)$seller_invoice_data[0]->si_other_charge, 2, '.', '');
        $seller_invoice_data[0]->si_total=number_format((float)$seller_invoice_data[0]->si_total, 2, '.', '');
        $seller_invoice_data[0]->grand_total_word = ucwords(strtolower($BSPController->readNumber(round($seller_invoice_data[0]->si_total))));
        $seller_invoice_data[0]->role_id=$_SESSION['login_user']->role_id;

        $data['site_setting_data'] = $site_setting_data[0];
        $data['seller_invoice_data'] = $seller_invoice_data[0];
        $data['seller_product_invoice_data'] = $seller_product_invoice_data;
        $invoice_no = $seller_invoice_data[0]->si_invoice_no;
        $si_invoice_pdf = $seller_invoice_data[0]->si_invoice_pdf;
        $si_id = $seller_invoice_data[0]->si_id;
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['asset']=asset('');
        $Goods = new Goods();
        $goods_type_list = $Goods->get_goods_type_list($role_id, $user_id);
        $data['goods_type_list'] = $goods_type_list;
        $data['seller_invoice_edit_data'] = 'farmer_bill_edit/'.$saller_id.'/'.$date;

                return response()
            ->view('seller.seller_invoice_edit', ['invoice_data' => $data]);
    }
}