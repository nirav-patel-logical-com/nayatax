<?php

/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\BuyerInvoice;
use App\BuyerProductInvoice;
use App\Consignment;
use App\ConsignmentProducts;
use App\Goods;
use App\Http\Controllers;
use App\SellerProductInvoice;
use Dompdf\FrameDecorator\NullFrameDecorator;
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
use App\SellerInvoice;

session_start();

class BuyerInvoiceController extends Controller
{

    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*display buyer bill collection list*/
    public function buyer_bill_collection_list()
    {
        $data['page_title'] = "Buyer Bill Collection List";

        return response()
            ->view('buyer.buyer-bill-collection-list', ['data' => $data]);
    }

    /*start flow 2
    1st farmer bill create then after buyer bill.*/
    public function buyer_stock_out_bill_create()
    {
        return response()
            ->view('buyer.pending_buyer_bill');
    }

    public function pending_stock_out_list_post(Request $request)
    {
        $SellerProductInvoice = new SellerProductInvoice();

        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'spi_id',
            1 => 'buyer_name',
            2 => 'biz_name',
            3 => 'mobile',
            4 => 'gt_type',
            5 => 'spi_weight',
            6 => 'spi_rate',
            7 => 'spi_id'
        );
        $total = $SellerProductInvoice->get_pending_buyer_bill_count($role_id, $user_id);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $SellerProductInvoice->get_pending_buyer_bill($role_id, $user_id, $start, $limit, $order, $dir);

        } else {

            $posts = $SellerProductInvoice->get_pending_buyer_bill($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $SellerProductInvoice->get_pending_buyer_bill_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }
        //echo "<pre>";print_r($posts);die;
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show_user = route('buyer_view', $post->spi_buyer_id);
                $show_stock_out = route('stock_out_view', $post->spi_id);

                $nestedData['id'] = $post->spi_id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->buyer_name . "</a>";
                $nestedData['company'] = $post->biz_name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['goods'] = $post->gt_type;
                $nestedData['qty'] = $post->spi_weight;
                $nestedData['price'] = "{$post->spi_rate}";
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

    public function stock_out_view($spi_id)
    {
        $sellerProductInvoice = new SellerProductInvoice();
        $stock_out_data = $sellerProductInvoice->get_pending_bill_by_spi_id($spi_id);
        $data['stock_out_data'] = $stock_out_data[0];
        return response()
            ->view('stock.stock_out_bill', ['data' => $data]);

    }

    /*end flow 2
   1st farmer bill create then after buyer bill.*/
    public function sales_report()
    {
        return response()
            ->view('seller.sales_report');
    }

    public function sales_report_post(Request $request)
    {

        $BuyerProductInvoice = new BuyerProductInvoice();
        $role_permission_arr = parent::login_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'bpi_add_date',
            1 => 'biz_name',
            2 => 'seller_name',
            3 => 'gstin_no',
            4 => 'bpi_total',
        );

        $company = $request->input('form.company_name');
        $amount = $request->input('form.amount');
        $daterange = $request->input('form.daterange');
        $from_date = '';
        $to_date = '';
        if (!empty($daterange)) {
            $date = explode(' - ', $daterange);
            $from_date = date('Y-m-d' . ' 00:00:00', strtotime($date[0]));
            $to_date = date('Y-m-d' . ' 24:60:60', strtotime($date[1]));
        }

        $date = date('Y-m-d') . ' 00:00:00';


        $total = $BuyerProductInvoice->get_invoice_data_count($role_id, $user_id, $search = '', $date, $from_date, $to_date, $company, $amount);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $BuyerProductInvoice->get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '', $date, $from_date, $to_date, $company, $amount);

        } else {

            $posts = $BuyerProductInvoice->get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search, $date, $from_date, $to_date, $company, $amount);
            $total_rec = $BuyerProductInvoice->get_invoice_data_count($role_id, $user_id, $search, $date, $from_date, $to_date, $company, $amount);
            $totalFiltered = $total_rec[0]->total;
        }
        $count = count($posts);

        $array = [];
        foreach ($posts as $key => $post) {

            if ($key < ($count - 1)) {
                if ($posts[$key]->id == $posts[$key + 1]->id && $posts[$key]->buyer_date == $posts[$key + 1]->buyer_date) {

                    array_push($array, [$key + 1]);
                }
            }
        }
        if (!empty($array)) {
            foreach ($array as $key => $arr) {
                unset($posts[$arr[0]]);
            }
        }

        $posts = array_values($posts);
        $totalFiltered = count($posts);
        $totalData = $totalFiltered;
        $SiteSettings = new SiteSettings();
        $login_id = $_SESSION['login_user']->id;
        $setting_data = $SiteSettings->select_site_settings($login_id);
        //print_r($setting_data);

        $market_fees = $setting_data[0]->market_fees;
        $biz_comission = $setting_data[0]->biz_comission;
        $bpi_cgst = $setting_data[0]->setting_CGST;
        $bpi_sgst = $setting_data[0]->setting_SGST;
        $bpi_igst = $setting_data[0]->setting_IGST;

        $data = array();
        if (!empty($posts)) {
            /*to set data in td.*/
            foreach ($posts as $post) {

                $post->bpi_cgst_price = ($post->spi_rate * $setting_data[0]->setting_CGST) / 100;
                $post->bpi_sgst_price = ($post->spi_rate * $setting_data[0]->setting_SGST) / 100;
                $post->bpi_igst_price = ($post->spi_rate * $setting_data[0]->setting_IGST) / 100;
                $igst = 0;
                if (isset($post->bpi_igst) && !empty($post->bpi_igst)) {
                    $igst = $post->bpi_igst;
                } else {
                    $igst = $bpi_igst;
                }
                $sgst = 0;
                if (isset($post->bpi_sgst) && !empty($post->bpi_sgst)) {
                    $sgst = $post->bpi_sgst;
                } else {
                    $sgst = $bpi_sgst;
                }
                $cgst = 0;
                if (isset($post->bpi_cgst) && !empty($post->bpi_cgst)) {
                    $cgst = $post->bpi_cgst;
                } else {
                    $cgst = $bpi_cgst;
                }
                $show = route('stock_out_invoice', ['id' => $post->id, 'date' => date('Y-m-d', strtotime($post->spi_add_date))]);
                $nestedData['date'] = date('d-m-Y', strtotime($post->spi_add_date));
                $nestedData['company'] = "<a class='font-green-sharp' href='{$show}'>" . $post->biz_name . "</a>";
                $nestedData['name'] = $post->f_name;
                $nestedData['gsttin'] = $post->gstin_no;
                $nestedData['cgst_tax'] = $cgst;
                $nestedData['sgst_tax'] = $sgst;
                $nestedData['igst_tax'] = $igst;
                $nestedData['cgst'] = $post->bpi_cgst_price;
                $nestedData['sgst'] = $post->bpi_sgst_price;
                $nestedData['igst'] = $post->bpi_igst_price;
//                 $nestedData['total_amount'] = $post->si_amount;

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

    public function get_product_data_by_bpi_id()
    {
        if (isset($_POST['bpi_id']) && !empty($_POST['bpi_id'])) {
            $bpi_id = $_POST['bpi_id'];
            $BuyerProductInvoice = new BuyerProductInvoice();
            $consignment_data = $BuyerProductInvoice->get_consignment_data_by_bpi_id($bpi_id);
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

    /*display buyer bill collection add page*/
    public function buyer_bill_collection_add($id)
    {

        $BuyerInvoice = new BuyerInvoice();
        $data['page_title'] = 'Add Bill Collection';
        $seller_data = $BuyerInvoice->get_invoice_data_by_bi_id($id);

        $data['buyer_data'] = $seller_data[0];

        return response()
            ->view('buyer.buyer-bill-collection', ['data' => $data]);
    }

    public function delete_buyer_product()
    {
        if (isset($_POST['bpi_id']) && !empty($_POST['bpi_id'])) {
            $bpi_id = $_POST['bpi_id'];
            $buyerProductInvoice = new BuyerProductInvoice();
            $buyerProductInvoice->set_bpi_id($bpi_id);
            $buyerProductInvoice->delete_product();
            $response['SUCCESS'] = 'TRUE';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*update payment status*/
    public function buyer_update_payment_type()
    {
        //echo "<pre>";print_r($_POST);die;
        if (isset($_POST['bi_id']) && !empty($_POST['bi_id']) &&
            isset($_POST['payment_type']) && !empty($_POST['payment_type'])
        ) {

            $BuyerInvoice = new BuyerInvoice();

            $bi_id = $_POST['bi_id'];
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
            $BuyerInvoice->set_bi_id($bi_id);
            $BuyerInvoice->set_bi_payment_type($payment_type);
            $BuyerInvoice->set_bi_cheque_no($cheque_no);
            $BuyerInvoice->set_bi_bank_name($bank_name);
            $BuyerInvoice->set_bi_ac_no($ac_no);
            $BuyerInvoice->set_bi_ifs_code($ifsc_code);
            $BuyerInvoice->set_bi_modify_by($_SESSION['login_user']->id);
            $BuyerInvoice->set_bi_modify_date($date);
            $BuyerInvoice->set_bi_payment_status('Approved');
            $si_data = $BuyerInvoice->update_product_payment_status();

            $BuyerProductInvoice = new BuyerProductInvoice();
            $BuyerProductInvoice->set_bpi_bi_id($bi_id);
            $BuyerProductInvoice->set_bpi_payment_status('Approved');
            $BuyerProductInvoice->update_product_payment_status();
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


    /*to send data to bill collection list page.*/
    public function buyer_bill_collection_list_post(Request $request)
    {

        $BuyerInvoice = new BuyerInvoice();
        $role_permission_arr = parent::login_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'bi_id',
            1 => 'spi_add_date',
            2 => 'f_name',
            3 => 'mobile',
            4 => 'bi_payment_status',
            5 => 'bi_id',
        );
        $total = $BuyerInvoice->get_invoice_data_list_count($role_id, $user_id);
        $totalData = count($total);
        $totalFiltered = $totalData;
        foreach ($total as $ttl) {

            $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_from_invoice($ttl->id, $ttl->buyer_date,$ttl->bi_gst);
            if($buyer_invoice_data_select[0]->total ==0){
                unset($post);
                $totalData = $totalData-1;
                if($request->input('draw') == 1){
                    $totalFiltered =$totalData;
                }
            }

        }

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $BuyerInvoice->get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir);

        } else {
            $posts = $BuyerInvoice->get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $totalFiltered = count($posts);
        }
      $i=0;
        foreach ($posts as $post) {

            $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_from_invoice($post->id, $post->buyer_date,$post->bi_gst);
            if($buyer_invoice_data_select[0]->total ==0){
                unset($post);
                $totalFiltered = $totalFiltered-1;
            }

        }


        $count = count($posts);

        $array=[];
        foreach ($posts as $key => $post) {
            $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_from_invoice($post->id, $post->buyer_date,$post->bi_gst);
            if($buyer_invoice_data_select[0]->total ==0){
                array_push($array,[$key]);
            }
        }

        foreach ($array as $key => $arr) {
            unset($posts[$arr[0]]);
        }
        $posts=array_values($posts);
        $data = array();
        $i = 1;
        if (!empty($posts)) {
            /*to set data in td.*/
            foreach ($posts as $post) {

                $good = new Goods();

                //$good_type = $good->get_good_type_by_gt_id(rtrim($post->bi_gt_id,","));
                $show_user = route('buyer_view', $post->id);
                $show = route('stock_out_invoice', ['id' => $post->id, 'date' => $post->buyer_date, 'gst' => $post->bi_gst]);
                $status = route('show_buyer_data', ['id' => $post->id, 'date' => $post->buyer_date, 'gst' => $post->bi_gst]);
                //    if (isset($role_permission_arr['buyer-bill']) && $role_permission_arr['buyer-bill'] != 'None' && $role_permission_arr['buyer-bill'] != 'Read' && $post->bi_payment_status != 'Approved') {
                $status_view = "<a class='font-green-sharp' href='{$status}' title='Status' ><span></span></a>";
//                } else {
//                    $status_view = $post->bi_payment_status;
//                }
                if ($post->bi_payment_status == 'Pending') {
                    $status_view = "<a class='font-green-sharp' href='{$status}' title='Status' ><span>" . $post->bi_payment_status . "</span></a>";
                } else {
                    $status_view = "<span>" . $post->bi_payment_status . "</span>";
                }


                $nestedData['id'] = $post->bi_id;
                $nestedData['date'] = $post->add_date;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->f_name . "</a>";
//                $nestedData['company'] = $post->biz_name;
//                $nestedData['amount'] = $post->bi_total;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['type'] = $post->bi_gst;
                $nestedData['status'] = "{$status_view}";
                $nestedData['action'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp fa fa-eye'></span></a>";
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

    public function edit_buyer_payment_status($spi_si_id)
    {

        $SellerInvoice = new SellerInvoice();
        $SellerProductInvoice = new SellerProductInvoice();

        if (isset($spi_si_id) && !empty($spi_si_id)) {
            $SellerProductInvoice->set_spi_payment_status('Approved');
            $SellerProductInvoice->set_spi_si_id($spi_si_id);
            $SellerProductInvoice->update_buyer_bill_status();

        }
        return redirect()->route('buyer_bills_list');

    }

    /*insert buyer purchase good data in buyer product invoice*/
    public function insert_product_invoice()
    {
        if (isset($_POST['bpi_biz_id']) && !empty($_POST['bpi_biz_id']) &&
            isset($_POST['bpi_buyer_id']) && !empty($_POST['bpi_buyer_id']) &&
            isset($_POST['bpi_gt_id']) && !empty($_POST['bpi_gt_id']) &&
            isset($_POST['bpi_saller_id']) && !empty($_POST['bpi_saller_id'])
        ) {
            $BuyerProductInvoice = new BuyerProductInvoice();
            $BuyerInvoice = new BuyerInvoice();
            $date = date('Y-m-d H:i:s');
            $login_user = $_SESSION['login_user']->id;

            $bpi_biz_id = $_POST['bpi_biz_id'];
            $bpi_invoice_no = $_POST['bpi_invoice_no'];
            $bpi_buyer_id = $_POST['bpi_buyer_id'];
            $bpi_gt_id = $_POST['bpi_gt_id'];
            $bpi_saller_id = $_POST['bpi_saller_id'];
            $bpi_bzc_id = $_POST['bpi_bzc_id'];
            $bpi_weight = $_POST['bpi_weight'];
            $bpi_bid_price = $_POST['bpi_bid_price'];
            $bpi_cgst = $_POST['bpi_cgst'];
            $bpi_sgst = $_POST['bpi_sgst'];
            $bpi_igst = $_POST['bpi_igst'];
            $bpi_cgst_price = 0;
            if (isset($_POST['bpi_cgst_price']) && !empty($_POST['bpi_cgst_price']) && $_POST['bpi_cgst_price'] != 'NaN') {
                $bpi_cgst_price = $_POST['bpi_cgst_price'];
            }
            $bpi_igst_price = 0;
            if (isset($_POST['bpi_igst_price']) && !empty($_POST['bpi_igst_price']) && $_POST['bpi_igst_price'] != 'NaN') {
                $bpi_igst_price = $_POST['bpi_igst_price'];
            }
            $bpi_sgst_price = 0;
            if (isset($_POST['bpi_sgst_price']) && !empty($_POST['bpi_sgst_price']) && $_POST['bpi_sgst_price'] != 'NaN') {
                $bpi_sgst_price = $_POST['bpi_sgst_price'];
            }
            $bpi_amount = $_POST['bpi_amount'];
            $bpi_total = $_POST['bpi_total'];


            $BuyerProductInvoice->set_bpi_amount($bpi_amount);
            $BuyerProductInvoice->set_bpi_bid_price($bpi_bid_price);
            $BuyerProductInvoice->set_bpi_biz_id($bpi_biz_id);
            $BuyerProductInvoice->set_bpi_is_farmer_bill_generate('No');
            $BuyerProductInvoice->set_bpi_is_buyer_bill_generate('No');
            //$BuyerProductInvoice->set_bpi_buyer_id($bpi_buyer_id);
            $BuyerProductInvoice->set_bpi_saller_id($bpi_saller_id);
            $BuyerProductInvoice->set_bpi_gt_id($bpi_gt_id);
            $BuyerProductInvoice->set_bpi_bzc_id($bpi_bzc_id);
            $BuyerProductInvoice->set_bpi_weight($bpi_weight);
            $BuyerProductInvoice->set_bpi_cgst($bpi_cgst);
            $BuyerProductInvoice->set_bpi_sgst($bpi_sgst);
            $BuyerProductInvoice->set_bpi_igst($bpi_igst);
            $BuyerProductInvoice->set_bpi_cgst_price($bpi_cgst_price);
            $BuyerProductInvoice->set_bpi_sgst_price($bpi_sgst_price);
            $BuyerProductInvoice->set_bpi_igst_price($bpi_igst_price);
            $BuyerProductInvoice->set_bpi_total($bpi_total);
            if (isset($_POST['bpi_bi_id']) && !empty($_POST['bpi_bi_id'])) {
                $bpi_bi_id = $_POST['bpi_bi_id'];
                if (isset($_POST['bpi_id']) && !empty($_POST['bpi_id'])) {
                    $bpi_id = $_POST['bpi_id'];
                    $BuyerProductInvoice->set_bpi_bi_id($bpi_bi_id);
                    $BuyerProductInvoice->set_bpi_id($bpi_id);
                    $BuyerProductInvoice->set_bpi_invoice_no($bpi_invoice_no);
                    $BuyerProductInvoice->set_bpi_modify_by($login_user);
                    $BuyerProductInvoice->set_bpi_modify_date($date);
                    $BuyerProductInvoice->set_bpi_payment_status('Pending');
                    $update_data = $BuyerProductInvoice->update_product_data();
                    if ($update_data) {
                        $response['SUCCESS'] = 'TRUE';
                        $response['bpi_id'] = $bpi_id;
                        $response['bpi_bi_id'] = $_POST['bpi_bi_id'];
                        $response['bpi_invoice_no'] = $bpi_bi_id;
                        $response['MESSAGE'] = 'Updated Product Invoice Successfully';
                    } else {
                        $response['SUCCESS'] = 'FALSE';
                        $response['MESSAGE'] = 'Invalid Request.';
                    }
                } else {

                    $BuyerProductInvoice->set_bpi_invoice_no($bpi_invoice_no);
                    $BuyerProductInvoice->set_bpi_bi_id($bpi_bi_id);
                    $BuyerProductInvoice->set_bpi_add_by($login_user);
                    $BuyerProductInvoice->set_bpi_add_date($date);
                    $BuyerProductInvoice->set_bpi_payment_status('Pending');
                    $bpi_id = $BuyerProductInvoice->insert_product_data();
                    if ($bpi_id) {
                        $response['SUCCESS'] = 'TRUE';
                        $response['bpi_id'] = $bpi_id;
                        $response['bpi_bi_id'] = $bpi_biz_id;
                        $response['bpi_invoice_no'] = $bpi_invoice_no;
                        $response['MESSAGE'] = 'Insert Product Invoice Successfully';
                    } else {
                        $response['SUCCESS'] = 'FALSE';
                        $response['MESSAGE'] = 'Invalid Request.';
                    }

                }

            } else {
                $invoice_details = $BuyerInvoice->get_invoice_number($bpi_biz_id, $bpi_buyer_id);
                $invoice_no = 1;
                if (isset($invoice_details) && !empty($invoice_details)) {
                    $invoice_no = $invoice_details[0]->bi_invoice_no + 1;
                }
                /*insert buyer purchase good data in buyer invoice*/
                $BuyerInvoice->set_bi_biz_id($bpi_biz_id);
                $BuyerInvoice->set_bi_buyer_id($bpi_buyer_id);
                $BuyerInvoice->set_bi_invoice_no($invoice_no);
                $BuyerInvoice->set_bi_payment_status('Pending');
                $BuyerInvoice->set_bi_add_by($login_user);
                $BuyerInvoice->set_bi_add_date($date);
                $bi_id = $BuyerInvoice->insert_product_data();

                if ($bi_id) {
                    $BuyerProductInvoice->set_bpi_bi_id($bi_id);
                    $BuyerProductInvoice->set_bpi_invoice_no($invoice_no);
                    $BuyerProductInvoice->set_bpi_add_date($date);
                    $BuyerProductInvoice->set_bpi_add_by($login_user);
                    $BuyerProductInvoice->set_bpi_payment_status('Pending');
                    $bpi_id = $BuyerProductInvoice->insert_product_data();
                    if ($bpi_id) {

                        $response['SUCCESS'] = 'TRUE';
                        $response['bpi_id'] = $bpi_id;
                        $response['bpi_bi_id'] = $bi_id;
                        $response['bpi_invoice_no'] = $invoice_no;
                        $response['MESSAGE'] = 'Insert Product Invoice Successfully';
                    } else {
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

    /*update buyer purchase good data in buyer product invoice*/
    public function add_stock_out_data()
    {
        //echo "<pre>";print_r($_POST);die;
        if (
            isset($_POST['buyer_id']) && !empty($_POST['buyer_id'])
            && isset($_POST['bpi_bi_id']) && !empty($_POST['bpi_bi_id'])
            && isset($_POST['company_id']) && !empty($_POST['company_id'])
        ) {

            $BuyerInvoice = new BuyerInvoice();
            $BuyerInvoiceProduct = new BuyerProductInvoice();

            $buyer_id = $_POST['buyer_id'];
            $bi_id = $_POST['bpi_bi_id'];
            $comapny_id = $_POST['company_id'];

            $amount = $_POST['amount'];

            $commission = 0;
            if (isset($_POST['commission']) && !empty($_POST['commission'])) {
                $commission = $_POST['commission'];
            }
            $commission_val = 0;
            if (isset($_POST['commission_val']) && !empty($_POST['commission_val'])) {
                $commission_val = $_POST['commission_val'];
            }
            $market_fee = 0;
            if (isset($_POST['market_fee']) && !empty($_POST['market_fee'])) {
                $market_fee = $_POST['market_fee'];
            }
            $bi_market_fee_per = 0;
            if (isset($_POST['bi_market_fee_per']) && !empty($_POST['bi_market_fee_per'])) {
                $bi_market_fee_per = $_POST['bi_market_fee_per'];
            }
            $total = $_POST['total'];
            $cheque_no = '';
            $bank_name = '';
            $ifsc_code = '';
            $ac_no = '';
            $payment_type = null;

            if (isset($_POST['payment_type']) && !empty($_POST['payment_type'])) {
                $payment_type = $_POST['payment_type'];
                if ($payment_type != 'Cash') {
                    $cheque_no = $_POST['cheque_no'];
                    $bank_name = $_POST['bank_name'];
                    $ifsc_code = $_POST['ifsc_code'];
                    $ac_no = $_POST['ac_no'];
                }
                $BuyerInvoice->set_bi_payment_type($payment_type);
                $BuyerInvoice->set_bi_cheque_no($cheque_no);
                $BuyerInvoice->set_bi_bank_name($bank_name);
                $BuyerInvoice->set_bi_ac_no($ac_no);
                $BuyerInvoice->set_bi_ifs_code($ifsc_code);
                $BuyerInvoice->set_bi_payment_status('Approved');

                $BuyerInvoiceProduct = new BuyerProductInvoice();
                $BuyerInvoiceProduct->set_bpi_bi_id($bi_id);
                $BuyerInvoiceProduct->set_bpi_payment_status('Approved');
                $BuyerInvoiceProduct->update_product_payment_status();

            } else {
                $BuyerInvoice->set_bi_payment_status('Pending');
                $BuyerInvoice->set_bi_payment_type($payment_type);
            }

            $BuyerInvoice->set_bi_id($bi_id);
            $BuyerInvoice->set_bi_buyer_id($buyer_id);
            $BuyerInvoice->set_bi_biz_id($comapny_id);

            $BuyerInvoice->set_bi_amount($amount);
            $BuyerInvoice->set_bi_comission($commission);
            $BuyerInvoice->set_bi_commission_price($commission_val);
            $BuyerInvoice->set_bi_market_fee($market_fee);
            $BuyerInvoice->set_bi_market_fee_per($bi_market_fee_per);
            $BuyerInvoice->set_bi_total($total);

            $BuyerInvoice->update_product_data();

            /*update buyer bill status after create buyer invoice*/
            $BuyerInvoiceProduct->set_bpi_is_buyer_bill_generate('Yes');
            $BuyerInvoiceProduct->set_bpi_bi_id($bi_id);
            $BuyerInvoiceProduct->update_product_buyer_bill_status();

            if (isset($_POST['spi_id']) && !empty($_POST['spi_id'])) {
                /*update seller invoice table buyer bill status*/
                $SellerProductInvoice = new SellerProductInvoice();
                $SellerProductInvoice->set_spi_id($_POST['spi_id']);
                $SellerProductInvoice->update_saller_buyer_bill_status();
                $SellerProductInvoice->set_spi_bpi_id($_POST['bpi_id']);
                $SellerProductInvoice->update_saller_bpi_id();
                $BuyerInvoiceProduct->update_product_farmer_bill_status($_POST['bpi_id'], $_POST['farmer_id']);
            }
            $response['SUCCESS'] = 'TRUE';
            $response['bpi_bi_id'] = $bi_id;
            $response['MESSAGE'] = 'Save Successfully';
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Please fill Qty.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    public function add_buyer_invoice_data(Request $request)
    {
        $BuyerInvoice = new BuyerInvoice();
        $BSPController = new BSPController();
        $BuyerProductInvoice = new BuyerProductInvoice();
        if (isset($_POST['buyer_id']) && !empty($_POST['buyer_id'])) {

            $cheque_no = '';
            $bank_name = '';
            $ifsc_code = '';
            $ac_no = '';
            $payment_type = null;
            $buyer_id = $_POST['buyer_id'];
            $bi_id = $_POST['bi_id'];
            $gst = $_POST['gst'];
            $b_date = $_POST['b_date'];
            $BuyerInvoice->set_bi_buyer_id($buyer_id);
            $bi_si_id = $_POST['si_id'];
          //  $bi_id = $BuyerInvoice->insert_product_data($bi_si_id);
            $bi_id = $BuyerInvoice->select_bi_id_data($bi_id,$gst,$b_date);
            if (isset($_POST['payment_type']) && !empty($_POST['payment_type'])) {
                $payment_type = $_POST['payment_type'];

                if ($payment_type != 'Cash') {
                    $cheque_no = $_POST['cheque_no'];
                    $bank_name = $_POST['bank_name'];
                    $ifsc_code = $_POST['ifsc_code'];
                    $ac_no = $_POST['ac_no'];
                }
                $BuyerInvoice->set_bi_payment_type($payment_type);
                $BuyerInvoice->set_bi_cheque_no($cheque_no);
                $BuyerInvoice->set_bi_bank_name($bank_name);
                $BuyerInvoice->set_bi_ac_no($ac_no);
                $BuyerInvoice->set_bi_ifs_code($ifsc_code);
                $BuyerInvoice->set_bi_id($bi_id[0]->bi_id);
                $BuyerInvoice->set_bi_add_date(time());
                $SellerProductInvoice = new SellerProductInvoice();
                $BuyerInvoice->set_bi_payment_status('Approved');


                if (isset($bi_si_id) && !empty($bi_si_id)) {
                    $SellerProductInvoice->set_spi_payment_status('Approved');
                    $SellerProductInvoice->set_spi_si_id($bi_si_id);
                    $SellerProductInvoice->update_buyer_bill_status();

                }

                $BuyerInvoice->update_product_payment_status();

            } else {
                $BuyerInvoice->set_bi_payment_status('Pending');
                $BuyerInvoice->set_bi_payment_type($payment_type);
            }
            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = 'Save Successfully';
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Please fill Qty.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*display buyer invoice pge for print and download pdf.*/
    public function stock_out_invoice($bi_id, $date ,$gst)
    {

        $today = date('Y-m-d');
        $BuyerInvoice = new BuyerInvoice();
        $BSPController = new BSPController();
        $BuyerProductInvoice = new BuyerProductInvoice();

        $login_user = $_SESSION['login_user']->id;
        $role_id = $_SESSION['login_user']->role_id;

        $data['page_title'] = 'Invoice';

        $buyer_invoice_data = $BuyerInvoice->get_buyer_invoice_data_by_bi_id($bi_id, $date,$gst);


            $buyer_invoices_data = $BuyerInvoice->get_buyer_invoice_data_by_total_count_bi_id($bi_id,$gst);

            $buyer_product_invoice_data = $BuyerProductInvoice->get_buyer_product_data_by_bpi_bi_id($bi_id, $date);


//
            if (isset($buyer_invoice_data) && !empty($buyer_invoice_data[0]->company_biz_logo)) {
                $buyer_invoices_data[0]->image = Config::get('constant.SITE_URL') . 'business_logo/' . $buyer_invoice_data[0]->company_biz_logo;;
            } else {
                $buyer_invoices_data[0]->image = '';
            }

            $SiteSettings = new SiteSettings();
            $login_id = $_SESSION['login_user']->id;
            $setting_data = $SiteSettings->select_site_settings($login_id);

            $market_fees = $setting_data[0]->market_fees;
            $biz_comission = $setting_data[0]->biz_comission;


            $totals = 0;
            $goodstype = new Goods();

            foreach ($buyer_invoice_data as $invoice) {
                if($setting_data[0]->setting_kg_price == '20Kg') {
                    $invoice->spi_rate = $invoice->spi_rate * 20;
                    $invoice->spi_total = ($invoice->spi_weight * $invoice->spi_rate) / 20;
                }
                $goods_data = $goodstype->get_good_type_by_id_buyer($invoice->gt_type, $login_user, $role_id);
                $invoice->gt_is_tax_apply = $goods_data[0]->gt_is_tax_apply;
                $invoice->bpi_cgst = $goods_data[0]->gt_cgst_tax;
                $invoice->bpi_sgst = $goods_data[0]->gt_sgst_tax;
                $invoice->bpi_igst = $goods_data[0]->gt_igst_tax;
                $invoice->bpi_cgst_price = ($invoice->spi_total * $goods_data[0]->gt_cgst_tax) / 100;
                $invoice->bpi_sgst_price = ($invoice->spi_total * $goods_data[0]->gt_sgst_tax) / 100;
                $invoice->bpi_igst_price = ($invoice->spi_total * $goods_data[0]->gt_igst_tax) / 100;
                $invoice->bpi_cgst_price = number_format((float)$invoice->bpi_cgst_price, 2, '.', '');
                $invoice->bpi_sgst_price = number_format((float)$invoice->bpi_sgst_price, 2, '.', '');
                $invoice->bpi_igst_price = number_format((float)$invoice->bpi_igst_price, 2, '.', '');

                if ($buyer_invoice_data[0]->state == 'Gujarat' || empty($buyer_invoice_data[0]->state->state) || $buyer_invoice_data[0]->state == 'ગુજરાત') {
                    $invoice->spi_total = $invoice->spi_total + $invoice->bpi_cgst_price + $invoice->bpi_sgst_price;
                } else {
                    $invoice->spi_total = $invoice->spi_total + $invoice->bpi_igst_price;
                }
                $invoice->spi_total = number_format((float)$invoice->spi_total, 2, '.', '');
                $totals = $totals + $invoice->spi_total;

            }




            $data['buyer_invoice_data'] = $buyer_invoice_data;
            $data['site_setting_data'] = $setting_data[0];

           // $buyer_invoices_data[0]->grand_total_word = ucwords(strtolower($BSPController->readNumber(round($buyer_invoices_data[0]->grandtotals))));

            $data['buyer_invoices_data'] = $buyer_invoices_data[0];

            $data['buyer_product_invoice_data'] = $buyer_product_invoice_data;


            $invoice_no = $buyer_invoice_data[0]->id;
            foreach ($buyer_invoice_data as $invoice) {
                $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_for_invoice($bi_id, $date, $invoice->gt_is_tax_apply);
                 //print_r($buyer_invoice_data_select);exit;


                    $data['buyer_invoices_data']->total =$totals;
                    $data['buyer_invoices_data']->total = number_format((float)$data['buyer_invoices_data']->total, 2, '.', '');
                    if($buyer_invoice_data_select[0]->bi_comission == 0){
                        $buyer_invoice_data_select[0]->bi_comission=$biz_comission;
                        $buyer_invoice_data_select[0]->bi_commission_price = ($totals *$biz_comission)/100;
                        $buyer_invoice_data_select[0]->bi_total =$buyer_invoice_data_select[0]->bi_total+$buyer_invoice_data_select[0]->bi_commission_price;
                     }

                    $data['buyer_invoices_data']->biz_comission = $buyer_invoice_data_select[0]->bi_comission;
                    $data['buyer_invoices_data']->grandtotal2 =  ($totals *$buyer_invoice_data_select[0]->bi_comission)/100;
                    $data['buyer_invoices_data']->grandtotal2 = number_format((float)$data['buyer_invoices_data']->grandtotal2, 2, '.', '');

                    $data['buyer_invoices_data']->market_fees = $buyer_invoice_data_select[0]->bi_market_fee;
                    $data['buyer_invoices_data']->grandtotal1 = ($totals *$buyer_invoice_data_select[0]->bi_market_fee)/100;
                    $data['buyer_invoices_data']->grandtotal1 = number_format((float)$data['buyer_invoices_data']->grandtotal1, 2, '.', '');

                    $data['buyer_invoices_data']->grandtotals =$totals+ $data['buyer_invoices_data']->grandtotal1 +$data['buyer_invoices_data']->grandtotal2;
                    $data['buyer_invoices_data']->grandtotals = number_format((float)$data['buyer_invoices_data']->grandtotals, 2, '.', '');

                    $data['buyer_invoices_data']->grand_total_word = ucwords(strtolower($BSPController->readNumber(round($buyer_invoices_data[0]->grandtotals))));
                    $data['buyer_invoice_data'][0]->si_invoice_no = $buyer_invoice_data_select[0]->bi_invoice_no;

            }
            $data['buyer_invoice_download'] = '';
            $html = view('buyer.buyer_invoice_pdf', array('invoice_data' => $data))->render();
            //echo $html;exit;
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
            $pdf_file_path = base_path('invoice/buyer_invoice/' . $file_name);//base_path("invoice\buyer_invoice".'\\' . $file_name);
            $mpdf->SetProtection(array('print'), '', '');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->autoLangToFont = true;
            $mpdf->WriteHTML($html);
            $mpdf->Output($pdf_file_path, \Mpdf\Output\Destination::FILE);

            if (isset($buyer_bi_id) && !empty($buyer_bi_id)) {
                $BuyerInvoice->set_bi_id($buyer_bi_id);
            } else {
                $BuyerInvoice->set_bi_id($buyer_invoice_data_select[0]->bi_id);
            }

            $BuyerInvoice->set_bi_invoice_pdf($file_name);
           // $BuyerInvoice->update_invoice_pdf_data();
            $data['buyer_invoice_download'] = Config::get('constant.SITE_URL') . Config::get('constant.INVOICE_LOCATION_BUYER') . '/' . $file_name;



        return response()
            ->view('buyer.buyer_invoice', ['invoice_data' => $data]);
    }

}