<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\BuyerInvoice;
use App\Goods;
use App\Http\Controllers;
use App\SellerInvoice;
use App\Sessions;
use App\User;
use Illuminate\Http\Request;
use App\SellerProductInvoice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App\BuyerProductInvoice;
use App\SiteSettings;
session_start();

class SellerController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*open farmer insert page*/
    public function farmer()
    {
        $user = new User();
        $data['page_title'] = 'Farmer Add';
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['company_list'] = $user->get_agent_list($role_id, $user_id);

        return response()
            ->view('seller.seller-add', ['seller_data' => $data]);
    }

    /*display farmer list page*/
    public function seller_list()
    {
        $Users = new User();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $Users->set_role_id('2');
        $Users->set_role_name('Farmer');
        $seller_list = $Users->get_user_list($role_id, $user_id);

        return response()
            ->view('seller.seller-list', ['seller_list' => $seller_list]);
    }

    /*get farmer data for farmer list page.*/
    public function seller_list_post(Request $request)
    {

        $role_permission_arr = parent::login_user_details();
        $user = new User();
        $user->set_role_id('2');
        $user->set_role_name('Farmer');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'id',
            1 => 'biz_name',
            2 => 'f_name',
            3 => 'email',
            4 => 'mobile',
            5 => 'city',
            6 => 'status',
            7 => 'id',
        );

        $total = $user->seller_count($role_id, $user_id);
        $totalData = $total[0]->seller_count;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if (empty($search)) {
            $posts = $user->get_user_list_post($role_id, $user_id, $start, $limit, $order, $dir);
        } else {

            $posts = $user->get_user_list_post($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $user->get_user_list_post_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show = route('seller_view', $post->id);
                $edit = route('farmer_edit', $post->id);

                if (isset($role_permission_arr['farmers']) && $role_permission_arr['farmers'] != 'None' && $role_permission_arr['farmers'] != 'Read') {
                    $status = "<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->status}&#39);' title='Status' ><span>" . $post->status . "</span></a>";
                    $edit_view = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp glyphicon glyphicon-list'></span></a>";
                } else {
                    $status = $post->status;
                    $edit_view = "";
                }
                $nestedData['id'] = $post->id;
                $nestedData['company'] = $post->biz_name;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show}'>" . $post->f_name . ' ' . $post->m_name . ' ' . $post->l_name . "</a>";
                $nestedData['email'] = $post->email;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['city'] = $post->city;
                $nestedData['status'] = "{$status}";

                $nestedData['action'] = "{$edit_view}
                                          &emsp;<a href='{$edit}' title='EDIT' ><span class='font-green-sharp glyphicon glyphicon-edit'></span></a>";
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

    /*display farmer details page*/
    public function seller_view($id)
    {
        $Users = new User();
        $Users->set_id($id);
        $seller_data = $Users->get_user_details();
        $data['add_by'] = $Users->get_user_name_by_id($seller_data[0]->add_by);
        $data['modify_by'] = $Users->get_user_name_by_id($seller_data[0]->modify_by);
        $role_name = $_SESSION['login_user']->role_name;
        $seller_data[0]->login_role = $role_name;
        $data['seller_data'] = $seller_data[0];
        return response()
            ->view('seller.seller-view', ['seller_data' => $data]);

    }

    /*to open farmer edit page*/
    public function farmer_edit($id)
    {
        $Users = new User();
        $Users->set_id($id);
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $seller_data = $Users->get_user_details();
        $data['company_list'] = $Users->get_agent_list($role_id, $user_id);
        $data['page_title'] = 'Farmer Edit';
        $role_name = $_SESSION['login_user']->role_name;
        $seller_data[0]->login_role = $role_name;
        $data['seller_data'] = $seller_data[0];
        return response()
            ->view('seller.seller-add', ['seller_data' => $data]);
    }

    /*to open farmer  bills list*/
    public function seller_bills_list()
    {
        $data['page_title'] = 'Farmer Invoice List';
        $sellerInvoice = new SellerInvoice();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $seller_data = $sellerInvoice->get_invoice_data($role_id, $user_id);
        $data['seller_data'] = $seller_data[0];
        return response()
            ->view('seller.seller-bill-list', ['data' => $data]);
    }

    public function seller_bills_list_pending()
    {
        $data['page_title'] = 'Farmer Bill List';
        $sellerInvoice = new SellerInvoice();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $seller_data = $sellerInvoice->get_invoice_data($role_id, $user_id);
        $data['seller_data'] = $seller_data;
        return response()
            ->view('farmer.farmer_bill', ['data' => $data]);
    }

    public function farmer_bill_post(Request $request)
    {
        $SellerProductInvoice = new SellerProductInvoice();

        $BuyerInvoice = new BuyerInvoice();
        $role_permission_arr = parent::login_user_details();

        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'si_id',
            1 => 'si_add_date',
            2 => 'si_invoice_no',
            3 => 'f_name',
            4 => 'mobile',
            5 => 'city',
            6 => 'si_total',
            7 => 'si_payment_status',
            8 => 'si_id'
        );

        $total = $SellerProductInvoice->get_invoice_data_list_count_data($role_id, $user_id);

        $totalData = count($total);
        $totalFiltered = $totalData;


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($search)) {
            $posts = $SellerProductInvoice->get_invoice_data_list_data($role_id, $user_id, $start, $limit, $order, $dir);
        } else {
            $posts = $SellerProductInvoice->get_invoice_data_list_data($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $totalFiltered = count($posts);
        }

        $data = array();
        if (!empty($posts)) {
            /*to set data in td.*/
            $i = 1;
            foreach ($posts as $post) {
                $show_user = route('seller_view', $post->id);
                $edit = route('farmer_bill_edit', ['id' => $post->id, 'date' => $post->seller_date]);
                $status = route('show_farmer_data', ['id' => $post->id, 'date' => $post->seller_date]);
                $show = route('farmer_bill', ['id' => $post->id, 'date' => $post->seller_date]);
                if ($post->si_payment_status == 'Pending') {
                    $status_view = "<a class='font-green-sharp' href='{$status}' title='Status' ><span>" . $post->si_payment_status . "</span></a>";
                } else {
                    $status_view = "<span>" . $post->si_payment_status . "</span>";
                }


                $nestedData['id'] = $post->si_id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->f_name . ' ' . $post->m_name . ' ' . $post->l_name . "</a>";
//                $nestedData['company'] = $post->biz_name;
                $nestedData['date'] = $post->add_date;
                $nestedData['si_invoice_no'] = $post->si_invoice_no;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['city'] = $post->city;
                $nestedData['total'] = $post->si_total;
                $nestedData['payment_status'] = $status_view;
                $nestedData['status'] = "{$status_view}";
                $nestedData['action'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp fa fa-eye'></span></a>&emsp;<a href='{$edit}' title='EDIT' ><span class='font-green-sharp glyphicon glyphicon-edit'></span></a>";
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

    public function  show_farmer_data($si_id, $date)
    {

        $SellerProductInvoice = new SellerProductInvoice();
        $data = $SellerProductInvoice->get_faramer_data_for_payment($si_id, $date);
        $faramer_details = $SellerProductInvoice->get_faramer_details($si_id);
        $data[0]->si_other_charge = number_format((float)$data[0]->si_other_charge, 2, '.', '');
        $data[0]->si_amount = number_format((float)$data[0]->si_amount, 2, '.', '');
        $data[0]->si_wages = number_format((float)$data[0]->si_wages, 2, '.', '');
        $data[0]->si_total = number_format((float)$data[0]->si_total, 2, '.', '');
        return view('farmer.farmer-bill-data', compact('data', 'faramer_details'));
    }

    /*get goods type by selecting comapny for stock out*/
    public function get_good_type_by_biz_id()
    {

        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            $id = $_POST['user_id'];
            $user = new User();
            $user_data = $user->get_user_data_by_id($id);
            if (isset($user_data) && !empty($user_data[0])) {
                $biz_id = $user_data[0]->biz_id;
                $user->set_id($biz_id);
                $company_data = $user->get_company_by_id();
                //echo "<pre>";print_r($company_data);die;
                $goods = new Goods();
                $goods_data = $goods->get_goods_type_by_biz_id($biz_id);
                $response['SUCCESS'] = 'TRUE';
                $response['Data'] = $user_data[0];
                $response['good_data'] = $goods_data;
                $response['company_data'] = $company_data[0];
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

    //Generate Bill For Farmer

    public function generate_bill()
    {

        $BuyerProductInvoice = new BuyerProductInvoice();
        $User = new User();
        $Goods = new Goods();
        $SiteSettings = new SiteSettings();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['company_list'] = $User->get_agent_list($role_id, $user_id);
        $buyer_list = $User->get_buyer_list($role_id, $user_id);
        $data['buyer_list'] = $buyer_list;
        $goods_type_list = $Goods->get_goods_type_list($role_id, $user_id);
        $data['goods_type_list'] = $goods_type_list;
        $site_setting_data = $SiteSettings->get_site_setting();
       // print_r($site_setting_data);exit;
        $data['site_setting_data'] = $site_setting_data[0];
        $data['role_id']=$role_id;
        return response()
            ->view('seller.generate_bill', ['data' => $data]);


    }

    public function generate_bill_post(Request $request)
    {
        $BuyerProductInvoice = new BuyerProductInvoice();

        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'id',
            1 => 'farmer_name',
            3 => 'mobile',
            4 => 'id'
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
            $posts = $BuyerProductInvoice->get_pending_farmer_bill($role_id, $user_id, $start, $limit, $order, $dir, $search);
        } else {
            $posts = $BuyerProductInvoice->get_pending_farmer_bill($role_id, $user_id, $start, $limit, $order, $dir, $search);
            $total_rec = $BuyerProductInvoice->get_pending_farmer_bill_count($role_id, $user_id, $search);
            $totalFiltered = $total_rec[0]->total;
        }
        //  $posts = $BuyerProductInvoice->get_pending_farmer_bill();

        //echo "<pre>";print_r($posts);die;
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $show_user = route('seller_view', $post->id);
                $show_stock_out = route('generate_in_view', $post->id);

                $nestedData['id'] = $post->id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show_user}'>" . $post->f_name . "</a>";
                $nestedData['mobile'] = $post->mobile;
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

    public function seller_data_serach()
    {
        $role_permission_arr = parent::login_user_details();
        $user = new User();
        $user->set_role_id('2');
        $user->set_role_name('Farmer');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        if(isset($_POST['company_id']) && !empty($_POST['company_id'])){
            $user_id = $_POST['company_id'];
            $role_id = 0 ;
        }
        $response = $user->get_farmer_list($role_id, $user_id);
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    public function buyer_data_serach()
    {
        $role_permission_arr = parent::login_user_details();
        $user = new User();
        $user->set_role_id('3');
        $user->set_role_name('buyer');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        if(isset($_POST['company_id']) && !empty($_POST['company_id'])){
            $user_id = $_POST['company_id'];
            $role_id = 0 ;
        }
        $response = $user->get_farmer_list($role_id, $user_id);
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    public function seller_product_add()
    {

        //print_r($_POST);exit;
        $product_data = $_POST['product_data'];
        $SellerProductInvoice = new SellerProductInvoice();
        $SellerInvoice = new SellerInvoice();
        $User = new User();
        $Goods = new Goods();
        $BuyerProductInvoice = new BuyerProductInvoice();
        $BuyerInvoice = new BuyerInvoice();
        $date = date('Y-m-d H:i:s');
        $login_user = $_SESSION['login_user']->id;

        $SiteSettings = new SiteSettings();
        //$total = (array)$product_data;
        // $total=$total[0];
        $arrayData = $product_data;

        $grandTotal = $_POST['grandTotal'];
        $market_fee = $_POST['market_fee'];
        $farmer_mobile = $_POST['farmer_mobile'];
        $si_other_charge = $_POST['other_charge'];
        $farmer_data = $User->get_farmer_by_id($farmer_mobile);

        $farmer_id = $farmer_data[0]->id;
        $date = date("Y-m-d");
        $seller_invoice_data_old = $SellerInvoice->get_seller_data_by_date($farmer_id, $date);
        //print_r($seller_invoice_data_old);exit;
        $market_fee = 0;

        if (isset($_POST['market_fee']) && !empty($_POST['market_fee'])) {
            $market_fee = $_POST['market_fee'];
        }
        $si_other_charge = 0;

        if (isset($_POST['other_charge']) && !empty($_POST['other_charge'])) {
            $si_other_charge = $_POST['other_charge'];
        }
        $market_fee_val = 0;
        if (isset($_POST['market_fee_val']) && !empty($_POST['market_fee_val'])) {
            $market_fee_val = $_POST['market_fee_val'];
        }
        $totals = $grandTotal + $market_fee + $si_other_charge;
        $buyers_total=$totals;
        $payment_type = NULL;
        $site_setting_data = $SiteSettings->get_site_setting();
        $si_kg = $site_setting_data[0]->setting_kg_price;

        if (isset($seller_invoice_data_old) && !empty($seller_invoice_data_old)) {
            $SellerInvoice->set_si_payment_type($payment_type);
            $SellerInvoice->set_si_payment_status('Pending');
            $SellerInvoice->set_si_saller_id($farmer_id);
            $totals = $totals + $seller_invoice_data_old[0]->si_amount;
            $SellerInvoice->set_si_amount($totals);
            if (!empty($seller_invoice_data_old[0]->si_wages)) {
                $market_fee = $market_fee + 0;
            } else {
                $market_fee = $market_fee + 0;
            }
            $SellerInvoice->set_si_wages($market_fee);
            $market_fee_val = $market_fee_val + $seller_invoice_data_old[0]->si_wages_total;
            $SellerInvoice->set_si_wages_total($market_fee_val);
            $SellerInvoice->set_si_add_date(date('Y-m-d H:i:s'));
            $grandTotal = $totals - $market_fee - $si_other_charge;
            $SellerInvoice->set_si_total($grandTotal);
            $SellerInvoice->set_si_id($seller_invoice_data_old[0]->si_id);
            $si_other_charge = $si_other_charge + $seller_invoice_data_old[0]->si_other_charge ;
            $SellerInvoice->set_other_charge($si_other_charge);

            $SellerInvoice->update_product_data();
            $spi_si_id = $seller_invoice_data_old[0]->si_id;
        } else {
            $SellerInvoice->set_si_payment_type($payment_type);
            $SellerInvoice->set_si_payment_status('Pending');
            $SellerInvoice->set_si_saller_id($farmer_id);
            $SellerInvoice->set_si_amount($totals);
            $SellerInvoice->set_si_wages($market_fee);
            $SellerInvoice->set_si_wages_total($market_fee_val);
            $SellerInvoice->set_si_add_date(date('Y-m-d H:i:s'));
            $SellerInvoice->set_si_total($grandTotal);
            $SellerInvoice->set_other_charge($si_other_charge);
            $SellerInvoice->set_si_add_by($farmer_data[0]->biz_id);
            $SellerInvoice->set_si_kg($si_kg);
            $spi_si_id = $SellerInvoice->insert_product_data();
//            $invoice_no = 'NT' . $spi_si_id;
            $invoice_date_compare=date('m-d');
            $last_invoice_number=$BuyerInvoice->find_max_id_for_seller_invoice($farmer_data[0]->biz_id);
            if($invoice_date_compare =='04-01' || $last_invoice_number[0]->max_id == 0){
                $invoice_no = 1;
            }else{
                $invoice_no = $last_invoice_number[0]->max_id +1;
            }
            $SellerInvoice->update_invoice_no($invoice_no, $spi_si_id);
        }
        foreach ($arrayData as $key => $array) {
            //print_r($array);exit;
            $date = date('Y-m-d H:i:s');
            $login_user = $_SESSION['login_user']->id;
            $role_id = $_SESSION['login_user']->role_id;
            if (isset($_POST['bzcp_bzc_id']) && empty($_POST['bzcp_bzc_id'])) {
                $spi_bzc_id = $_POST['bzcp_bzc_id'];
            } else {
                $spi_bzc_id = 0;
            }
            //get with api
            /*start insert seller product invoice data*/

//            if (isset($array['buyer_id']) && !empty($array['buyer_id'])) {
//                $spi_buyer_id = $array['buyer_id'];
//            } else {

            $buyer_mobile = trim($array['buyer_mobile']);
            $buyer_data = $User->get_buyer_by_id($buyer_mobile);
            $spi_buyer_id = $buyer_data[0]->id;
            // }

            $spi_biz_id = 0;
            $bpi_id = 0;

            if(isset($_POST['company_id']) && !empty($_POST['company_id'])){
                $login_user = $_POST['company_id'];
            }
            $good_type = $array['good_type'];
            $good_type_data = $Goods->get_good_type_by_id($good_type, $login_user, $role_id);
            if (!empty($good_type_data)) {
                $spi_gt_id = $good_type_data[0]->gt_id;
            } else {
                if (isset($array['hsn_no']) && !empty($array['hsn_no'])) {
                    $hsn_no = $array['hsn_no'];
                } else {
                    $hsn_no = '';
                }
                if (isset($array['cgst_tax']) && !empty($array['cgst_tax'])) {
                    $cgst_tax = $array['cgst_tax'];
                } else {
                    $cgst_tax = '';
                }
                if (isset($array['sgst_tax']) && !empty($array['sgst_tax'])) {
                    $sgst_tax = $array['sgst_tax'];
                } else {
                    $sgst_tax = '';
                }
                if (isset($array['igst_tax']) && !empty($array['igst_tax'])) {
                    $igst_tax = $array['igst_tax'];
                } else {
                    $igst_tax = '';
                }
                if (isset($array['tex']) && !empty($array['tex'])) {
                    $tex = $array['tex'];
                } else {
                    $tex = '';
                }
                if (isset($role_id) && !empty($role_id) && $role_id != 1) {
                    $login_users = $login_user;
                } else {
                    $login_users = '';
                }
                if(isset($_POST['company_id']) && !empty($_POST['company_id'])){
                    $login_users = $_POST['company_id'];
                }else{
                    $login_users =$login_users;
                }
                $id = $Goods->insert_goods_type_data_by_type($good_type, $hsn_no, $cgst_tax, $sgst_tax, $igst_tax, $tex, $login_users);
                if (!empty($id)) {
                    $good_type_data = $Goods->get_good_type_by_id($good_type, $login_users, $role_id);
                    $spi_gt_id = $good_type_data[0]->gt_id;
                }

            }

            $spi_weight = $array['weight'];
            $spi_bid_price = $array['price'];
            $spi_total = $array['total'];
            $spi_no_of_bags = $array['bags'];


            $SellerProductInvoice->set_spi_rate($spi_bid_price);
            $SellerProductInvoice->set_spi_si_id($spi_si_id);
            $SellerProductInvoice->set_spi_saller_id($farmer_id);
            $SellerProductInvoice->set_spi_buyer_id($spi_buyer_id);
            $SellerProductInvoice->set_spi_gt_id($spi_gt_id);
            $SellerProductInvoice->set_spi_bzc_id($spi_bzc_id);
            $SellerProductInvoice->set_spi_weight($spi_weight);
            $SellerProductInvoice->set_spi_no_of_bags($spi_no_of_bags);
            $SellerProductInvoice->set_spi_total($spi_total);
            $SellerProductInvoice->set_spi_bpi_id($bpi_id);
            $SellerProductInvoice->set_spi_si_id($spi_si_id);
            $SellerProductInvoice->set_spi_add_date($date);
            $SellerProductInvoice->set_spi_add_by($login_user);
            $SellerProductInvoice->set_spi_payment_status('Pending');

            $spi_id = $SellerProductInvoice->insert_product_data();
//------------------------------------Buyer Data Add--------------------------------
            $login_id = $_SESSION['login_user']->id;
            $role_id = $_SESSION['login_user']->role_id;

            //gt_type

            $goodstype = new Goods();
            if(isset($_POST['company_id']) && !empty($_POST['company_id'])){
                $login_user = $_POST['company_id'];
            }
            $goods_data = $goodstype->get_good_type_by_id($good_type, $login_user, $role_id);
            $bpi_cgst = $goods_data[0]->gt_cgst_tax;
            $bpi_sgst = $goods_data[0]->gt_sgst_tax;
            $bpi_igst = $goods_data[0]->gt_igst_tax;
            $gt_is_tax_apply = $goods_data[0]->gt_is_tax_apply;
            $bpi_cgst_price = ($spi_total * $goods_data[0]->gt_cgst_tax) / 100;
            $bpi_sgst_price = ($spi_total * $goods_data[0]->gt_sgst_tax) / 100;
            $bpi_igst_price = ($spi_total * $goods_data[0]->gt_igst_tax) / 100;
            if($buyer_data[0]->state == 'Gujarat' || empty($buyer_data[0]->state)) {
                $spi_total = $spi_total + $bpi_cgst_price + $bpi_sgst_price;
            }else{
                $spi_total = $spi_total + $bpi_igst_price;
            }
            //$totals = $totals + $spi_total;
            $bpi_cgst_price = number_format((float)$bpi_cgst_price, 2, '.', '');
            $bpi_sgst_price = number_format((float)$bpi_sgst_price, 2, '.', '');
            $bpi_igst_price = number_format((float)$bpi_igst_price, 2, '.', '');
            $spi_total = number_format((float)$spi_total, 2, '.', '');

            //$BuyerProductInvoice->set_bpi_amount($bpi_amount);
            $BuyerProductInvoice->set_bpi_bid_price($spi_bid_price);
            // $BuyerProductInvoice->set_bpi_biz_id($bpi_biz_id);
            $BuyerProductInvoice->set_bpi_is_farmer_bill_generate('No');
            $BuyerProductInvoice->set_bpi_is_buyer_bill_generate('No');
            $BuyerProductInvoice->set_bpi_bi_id($spi_buyer_id);
            $BuyerProductInvoice->set_bpi_saller_id($farmer_id);
            $BuyerProductInvoice->set_bpi_gt_id($spi_gt_id);
            $BuyerProductInvoice->set_bpi_weight($spi_weight);
            $BuyerProductInvoice->set_bpi_cgst($bpi_cgst);
            $BuyerProductInvoice->set_bpi_sgst($bpi_sgst);
            $BuyerProductInvoice->set_bpi_igst($bpi_igst);
            $BuyerProductInvoice->set_bpi_cgst_price($bpi_cgst_price);
            $BuyerProductInvoice->set_bpi_sgst_price($bpi_sgst_price);
            $BuyerProductInvoice->set_bpi_igst_price($bpi_igst_price);
            $BuyerProductInvoice->set_bpi_total($spi_total);
            $BuyerProductInvoice->set_bpi_add_by($login_user);
            $BuyerProductInvoice->set_bpi_add_date($date);
            $BuyerProductInvoice->set_bpi_payment_status('Pending');
            $BuyerProductInvoice->add_buyer_product_invoice_data($gt_is_tax_apply);

            $BuyerInvoice = new BuyerInvoice();
            $SiteSettings = new SiteSettings();
            $login_id = $_SESSION['login_user']->id;
            $setting_data = $SiteSettings->select_site_settings($login_id);

            $b_date = date('Y-m-d');
            $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_for_invoice($spi_buyer_id, $b_date,$gt_is_tax_apply);


            if (isset($buyer_invoice_data_select) && !empty($buyer_invoice_data_select) && $buyer_invoice_data_select[0]->bi_gst ==$gt_is_tax_apply) {

//                $result = $buyer_invoice_data_select[0]->bi_amount + $buyers_total;
                $market_fees = $setting_data[0]->market_fees;

                if(isset($setting_data[0]->biz_comission) && !empty($setting_data[0]->biz_comission)){
                    $biz_comission = $setting_data[0]->biz_comission;
                }else{
                    $biz_comission =0;
                }
                $date = date('Y-m-d');
                $calculate_total=$BuyerInvoice->calculate_total($spi_buyer_id,$gt_is_tax_apply,$date);
                $result = $calculate_total[0]->total;
                $grandtotal1 = ($result * $market_fees) / 100;
                $grandtotal1 = round($grandtotal1, 2);
                $grandtotal2 = ($result * $biz_comission) / 100;
                $grandtotal2 = round($grandtotal2, 2);
                $grandtotals = $result + $grandtotal1 + $grandtotal2;
                $grandtotals = round($grandtotals, 2);

                $BuyerInvoice->set_bi_amount($result);
                $BuyerInvoice->set_bi_comission($biz_comission);
                $BuyerInvoice->set_bi_commission_price($grandtotal2);
                $BuyerInvoice->set_bi_market_fee($market_fees);
                $BuyerInvoice->set_bi_market_fee_per($grandtotal1);
                $BuyerInvoice->set_bi_total($grandtotals);
                $BuyerInvoice->set_bi_buyer_id($buyer_invoice_data_select[0]->bi_buyer_id);
                $BuyerInvoice->set_bi_id($buyer_invoice_data_select[0]->bi_id);
                $BuyerInvoice->update_buyer_product_invoice_data1();
            } else {
                $date = date('Y-m-d');
                $calculate_total=$BuyerInvoice->calculate_total($spi_buyer_id,$gt_is_tax_apply,$date);

                $result = $calculate_total[0]->total;
                $market_fees = $setting_data[0]->market_fees;
                $biz_comission = $setting_data[0]->biz_comission;
                $grandtotal1 = ($result * $market_fees) / 100;
                $grandtotal1 = round($grandtotal1, 2);
                $grandtotal2 = ($result * $biz_comission) / 100;
                $grandtotal2 = round($grandtotal2, 2);
                $grandtotals = $result + $grandtotal1 + $grandtotal2;
                $grandtotals = round($grandtotals, 2);

                $BuyerInvoice->set_bi_buyer_id($spi_buyer_id);
                $BuyerInvoice->set_bi_amount($calculate_total[0]->total);
                $BuyerInvoice->set_bi_comission($biz_comission);
                $BuyerInvoice->set_bi_commission_price($grandtotal2);
                $BuyerInvoice->set_bi_market_fee($market_fees);
                $BuyerInvoice->set_bi_market_fee_per($grandtotal1);
                $BuyerInvoice->set_bi_total($grandtotals);
                $BuyerInvoice->set_bi_gst($gt_is_tax_apply);
                $BuyerInvoice->set_bi_add_by($farmer_data[0]->biz_id);
                $BuyerInvoice->set_bi_add_date(date('Y-m-d H:i:s'));
                $buyer_bi_id = $BuyerInvoice->add_buyer_product_invoice_data();
                $invoice_date_compare=date('m-d');
                $last_invoice_number=$BuyerInvoice->find_max_id_for_buyer_invoice($farmer_data[0]->biz_id);
                if($invoice_date_compare =='04-01' || $last_invoice_number[0]->max_id == 0){
                    $invoice_number = 1;
                }else{
                    $invoice_number = $last_invoice_number[0]->max_id +1;
                }
                $BuyerInvoice->set_bi_invoice_no($invoice_number);
                $BuyerInvoice->update_invoice_number($buyer_bi_id);
            }
        }


        $response['SUCCESS'] = 'TRUE';
        $response['MESSAGE'] = 'Save Successfully';

        $response_json = json_encode($response, true);
        echo $response_json;
    }

    public function seller_product_edit_post()
    {
        if (isset($_POST['product_data']) && !empty($_POST['product_data'])) {
            $product_data = $_POST['product_data'];

            $SellerProductInvoice = new SellerProductInvoice();
            $SellerInvoice = new SellerInvoice();
            $User = new User();
            $Goods = new Goods();
            $BuyerProductInvoice = new BuyerProductInvoice();
            $BuyerInvoice = new BuyerInvoice();
            $farmer_id = $_POST['farmer_id'];
            $si_add_date = $_POST['si_add_date'];
            $SellerInvoice->update_si_status($farmer_id, $si_add_date);
            $SellerInvoice->update_spi_status($farmer_id, $si_add_date);
            $SellerInvoice->update_bpi_status($farmer_id, $si_add_date);
            $farmer_mobile = $_POST['farmer_mobile'];
            $farmer_data = $User->get_farmer_by_id($farmer_mobile);
            $farmer_id = $farmer_data[0]->id;
            $date = date('Y-m-d H:i:s');
            $login_user = $_SESSION['login_user']->id;

            $SiteSettings = new SiteSettings();
            //$total = (array)$product_data;
            // $total=$total[0];
            $arrayData = $product_data;

            $grandTotal = $_POST['grandTotal'];
            $market_fee = $_POST['market_fee'];

            $si_other_charge = $_POST['other_charge'];

            $date = $si_add_date;
            $seller_invoice_data_old = $SellerInvoice->get_seller_data_by_date($farmer_id, $date);
            //print_r($seller_invoice_data_old);exit;
            $market_fee = 0;

            if (isset($_POST['market_fee']) && !empty($_POST['market_fee'])) {
                $market_fee = $_POST['market_fee'];
            }
            $si_other_charge = 0;

            if (isset($_POST['other_charge']) && !empty($_POST['other_charge'])) {
                $si_other_charge = $_POST['other_charge'];
            }
            $market_fee_val = 0;
            if (isset($_POST['market_fee_val']) && !empty($_POST['market_fee_val'])) {
                $market_fee_val = $_POST['market_fee_val'];
            }
            $totals = $grandTotal + $market_fee + $si_other_charge;
            $buyers_total = $totals;
            $payment_type = NULL;
            $site_setting_data = $SiteSettings->get_site_setting();
            $si_kg = $site_setting_data[0]->setting_kg_price;

            if (isset($seller_invoice_data_old) && !empty($seller_invoice_data_old)) {
                $SellerInvoice->set_si_payment_type($payment_type);
                $SellerInvoice->set_si_payment_status('Pending');
                $SellerInvoice->set_si_saller_id($farmer_id);
                $totals = $totals;
                $SellerInvoice->set_si_amount($totals);
                if (!empty($seller_invoice_data_old[0]->si_wages)) {
                    $market_fee = $market_fee + 0;
                } else {
                    $market_fee = $market_fee + 0;
                }
                $SellerInvoice->set_si_wages($market_fee);
                $market_fee_val = $market_fee_val + $seller_invoice_data_old[0]->si_wages_total;
                $SellerInvoice->set_si_wages_total($market_fee_val);
                $SellerInvoice->set_si_add_date($si_add_date);
                $grandTotal = $totals - $market_fee - $si_other_charge;
                $SellerInvoice->set_si_total($grandTotal);
                $SellerInvoice->set_si_id($seller_invoice_data_old[0]->si_id);
                $si_other_charge = $si_other_charge + 0;
                $SellerInvoice->set_other_charge($si_other_charge);

                $SellerInvoice->update_product_data();
                $spi_si_id = $seller_invoice_data_old[0]->si_id;
            } else {
                $SellerInvoice->set_si_payment_type($payment_type);
                $SellerInvoice->set_si_payment_status('Pending');
                $SellerInvoice->set_si_saller_id($farmer_id);
                $SellerInvoice->set_si_amount($totals);
                $SellerInvoice->set_si_wages($market_fee);
                $SellerInvoice->set_si_wages_total($market_fee_val);
                $SellerInvoice->set_si_add_date(date('Y-m-d H:i:s'));
                $SellerInvoice->set_si_total($grandTotal);
                $SellerInvoice->set_other_charge($si_other_charge);
                $SellerInvoice->set_si_add_by($farmer_data[0]->biz_id);
                $SellerInvoice->set_si_kg($si_kg);
                $spi_si_id = $SellerInvoice->insert_product_data();
//            $invoice_no = 'NT' . $spi_si_id;
                $invoice_date_compare = date('m-d');
                $last_invoice_number = $BuyerInvoice->find_max_id_for_seller_invoice($farmer_data[0]->biz_id);
                if ($invoice_date_compare == '04-01' || $last_invoice_number[0]->max_id == 0) {
                    $invoice_no = 1;
                } else {
                    $invoice_no = $last_invoice_number[0]->max_id + 1;
                }
                $SellerInvoice->update_invoice_no($invoice_no, $spi_si_id);
            }
            foreach ($arrayData as $key => $array) {
                //print_r($array);exit;
                $date = date('Y-m-d H:i:s');
                $login_user = $_SESSION['login_user']->id;
                $role_id = $_SESSION['login_user']->role_id;
                if (isset($_POST['bzcp_bzc_id']) && empty($_POST['bzcp_bzc_id'])) {
                    $spi_bzc_id = $_POST['bzcp_bzc_id'];
                } else {
                    $spi_bzc_id = 0;
                }
                //get with api
                /*start insert seller product invoice data*/

//            if (isset($array['buyer_id']) && !empty($array['buyer_id'])) {
//                $spi_buyer_id = $array['buyer_id'];
//            } else {

                $buyer_mobile = trim($array['buyer_mobile']);
                $buyer_data = $User->get_buyer_by_id($buyer_mobile);
                $spi_buyer_id = $buyer_data[0]->id;
                // }

                $spi_biz_id = 0;
                $bpi_id = 0;


                $good_type = $array['good_type'];
                $good_type_data = $Goods->get_good_type_by_id($good_type, $login_user, $role_id);
                if (!empty($good_type_data)) {
                    $spi_gt_id = $good_type_data[0]->gt_id;
                } else {
                    if (isset($array['hsn_no']) && !empty($array['hsn_no'])) {
                        $hsn_no = $array['hsn_no'];
                    } else {
                        $hsn_no = '';
                    }
                    if (isset($array['cgst_tax']) && !empty($array['cgst_tax'])) {
                        $cgst_tax = $array['cgst_tax'];
                    } else {
                        $cgst_tax = '';
                    }
                    if (isset($array['sgst_tax']) && !empty($array['sgst_tax'])) {
                        $sgst_tax = $array['sgst_tax'];
                    } else {
                        $sgst_tax = '';
                    }
                    if (isset($array['igst_tax']) && !empty($array['igst_tax'])) {
                        $igst_tax = $array['igst_tax'];
                    } else {
                        $igst_tax = '';
                    }
                    if (isset($array['tex']) && !empty($array['tex'])) {
                        $tex = $array['tex'];
                    } else {
                        $tex = '';
                    }
                    if (isset($role_id) && !empty($role_id) && $role_id != 1) {
                        $login_users = $login_user;
                    } else {
                        $login_users = '';
                    }
                    if (isset($_POST['company_id']) && !empty($_POST['company_id'])) {
                        $login_users = $_POST['company_id'];
                    }
                    $id = $Goods->insert_goods_type_data_by_type($good_type, $hsn_no, $cgst_tax, $sgst_tax, $igst_tax, $tex, $login_users);
                    if (!empty($id)) {
                        $good_type_data = $Goods->get_good_type_by_id($good_type, $login_users, $role_id);
                        $spi_gt_id = $good_type_data[0]->gt_id;
                    }

                }

                $spi_weight = $array['weight'];
                $spi_bid_price = $array['price'];
                $spi_total = $array['total'];
                $spi_no_of_bags = $array['bags'];


                $SellerProductInvoice->set_spi_rate($spi_bid_price);
                $SellerProductInvoice->set_spi_si_id($spi_si_id);
                $SellerProductInvoice->set_spi_saller_id($farmer_id);
                $SellerProductInvoice->set_spi_buyer_id($spi_buyer_id);
                $SellerProductInvoice->set_spi_gt_id($spi_gt_id);
                $SellerProductInvoice->set_spi_bzc_id($spi_bzc_id);
                $SellerProductInvoice->set_spi_weight($spi_weight);
                $SellerProductInvoice->set_spi_no_of_bags($spi_no_of_bags);
                $SellerProductInvoice->set_spi_total($spi_total);
                $SellerProductInvoice->set_spi_bpi_id($bpi_id);
                $SellerProductInvoice->set_spi_si_id($spi_si_id);
                $SellerProductInvoice->set_spi_add_date($si_add_date);
                $SellerProductInvoice->set_spi_add_by($login_user);
                $SellerProductInvoice->set_spi_payment_status('Pending');

                $spi_id = $SellerProductInvoice->insert_product_data();
//------------------------------------Buyer Data Add--------------------------------
                $login_id = $_SESSION['login_user']->id;
                $role_id = $_SESSION['login_user']->role_id;

                //gt_type

                $goodstype = new Goods();
                if (isset($_POST['company_id']) && !empty($_POST['company_id'])) {
                    $login_users = $_POST['company_id'];
                }
                $goods_data = $goodstype->get_good_type_by_id($good_type, $login_users, $role_id);
                $bpi_cgst = $goods_data[0]->gt_cgst_tax;
                $bpi_sgst = $goods_data[0]->gt_sgst_tax;
                $bpi_igst = $goods_data[0]->gt_igst_tax;
                $gt_is_tax_apply = $goods_data[0]->gt_is_tax_apply;
                $bpi_cgst_price = ($spi_total * $goods_data[0]->gt_cgst_tax) / 100;
                $bpi_sgst_price = ($spi_total * $goods_data[0]->gt_sgst_tax) / 100;
                $bpi_igst_price = ($spi_total * $goods_data[0]->gt_igst_tax) / 100;
                if ($buyer_data[0]->state == 'Gujarat' || empty($buyer_data[0]->state)) {
                    $spi_total = $spi_total + $bpi_cgst_price + $bpi_sgst_price;
                } else {
                    $spi_total = $spi_total + $bpi_igst_price;
                }
                //$totals = $totals + $spi_total;
                $bpi_cgst_price = number_format((float)$bpi_cgst_price, 2, '.', '');
                $bpi_sgst_price = number_format((float)$bpi_sgst_price, 2, '.', '');
                $bpi_igst_price = number_format((float)$bpi_igst_price, 2, '.', '');
                $spi_total = number_format((float)$spi_total, 2, '.', '');

                //$BuyerProductInvoice->set_bpi_amount($bpi_amount);
                $BuyerProductInvoice->set_bpi_bid_price($spi_bid_price);
                // $BuyerProductInvoice->set_bpi_biz_id($bpi_biz_id);
                $BuyerProductInvoice->set_bpi_is_farmer_bill_generate('No');
                $BuyerProductInvoice->set_bpi_is_buyer_bill_generate('No');
                $BuyerProductInvoice->set_bpi_bi_id($spi_buyer_id);
                $BuyerProductInvoice->set_bpi_saller_id($farmer_id);
                $BuyerProductInvoice->set_bpi_gt_id($spi_gt_id);
                $BuyerProductInvoice->set_bpi_weight($spi_weight);
                $BuyerProductInvoice->set_bpi_cgst($bpi_cgst);
                $BuyerProductInvoice->set_bpi_sgst($bpi_sgst);
                $BuyerProductInvoice->set_bpi_igst($bpi_igst);
                $BuyerProductInvoice->set_bpi_cgst_price($bpi_cgst_price);
                $BuyerProductInvoice->set_bpi_sgst_price($bpi_sgst_price);
                $BuyerProductInvoice->set_bpi_igst_price($bpi_igst_price);
                $BuyerProductInvoice->set_bpi_total($spi_total);
                $BuyerProductInvoice->set_bpi_add_by($login_user);
                $BuyerProductInvoice->set_bpi_add_date($si_add_date);
                $BuyerProductInvoice->set_bpi_payment_status('Pending');
                $BuyerProductInvoice->add_buyer_product_invoice_data($gt_is_tax_apply);

                $BuyerInvoice = new BuyerInvoice();
                $SiteSettings = new SiteSettings();
                $login_id = $_SESSION['login_user']->id;
                $setting_data = $SiteSettings->select_site_settings($login_id);

                $b_date = date('Y-m-d');
                $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_for_invoice($spi_buyer_id, $b_date,$gt_is_tax_apply);


                if (isset($buyer_invoice_data_select) && !empty($buyer_invoice_data_select) && $buyer_invoice_data_select[0]->bi_gst ==$gt_is_tax_apply) {

                } else {
                    $date =$si_add_date;
                    $calculate_total=$BuyerInvoice->calculate_total($spi_buyer_id,$gt_is_tax_apply,$date);

                    $result = $calculate_total[0]->total;
                    $market_fees = $setting_data[0]->market_fees;
                    $biz_comission = $setting_data[0]->biz_comission;
                    $grandtotal1 = ($result * $market_fees) / 100;
                    $grandtotal1 = round($grandtotal1, 2);
                    $grandtotal2 = ($result * $biz_comission) / 100;
                    $grandtotal2 = round($grandtotal2, 2);
                    $grandtotals = $result + $grandtotal1 + $grandtotal2;
                    $grandtotals = round($grandtotals, 2);

                    $BuyerInvoice->set_bi_buyer_id($spi_buyer_id);
                    $BuyerInvoice->set_bi_amount($calculate_total[0]->total);
                    $BuyerInvoice->set_bi_comission($biz_comission);
                    $BuyerInvoice->set_bi_commission_price($grandtotal2);
                    $BuyerInvoice->set_bi_market_fee($market_fees);
                    $BuyerInvoice->set_bi_market_fee_per($grandtotal1);
                    $BuyerInvoice->set_bi_total($grandtotals);
                    $BuyerInvoice->set_bi_gst($gt_is_tax_apply);
                    $BuyerInvoice->set_bi_add_by($farmer_data[0]->biz_id);
                    $BuyerInvoice->set_bi_add_date($date);
                    $buyer_bi_id = $BuyerInvoice->add_buyer_product_invoice_data();
                    $invoice_date_compare=date('m-d');
                    $last_invoice_number=$BuyerInvoice->find_max_id_for_buyer_invoice($farmer_data[0]->biz_id);
                    if($invoice_date_compare =='04-01' || $last_invoice_number[0]->max_id == 0){
                        $invoice_number = 1;
                    }else{
                        $invoice_number = $last_invoice_number[0]->max_id +1;
                    }
                    $BuyerInvoice->set_bi_invoice_no($invoice_number);
                    $BuyerInvoice->update_invoice_number($buyer_bi_id);
                }
            }
//            foreach ($arrayData as $key => $array) {
//                $buyer_mobile = trim($array['buyer_mobile']);
//                $buyer_data = $User->get_buyer_by_id($buyer_mobile);
//                $spi_buyer_id = $buyer_data[0]->id;
//                $goods_data = $goodstype->get_good_type_by_id($good_type, $login_user, $role_id);
//                $bpi_cgst = $goods_data[0]->gt_cgst_tax;
//                $bpi_sgst = $goods_data[0]->gt_sgst_tax;
//                $bpi_igst = $goods_data[0]->gt_igst_tax;
//                $gt_is_tax_apply = $goods_data[0]->gt_is_tax_apply;
//                $b_date = $si_add_date;
//                $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_from_invoice($spi_buyer_id, $b_date, $gt_is_tax_apply);
//                print_r($buyer_invoice_data_select);exit;
//                if ($buyer_invoice_data_select[0]->total==0) {
//                    $SellerInvoice->update_bi_status($spi_buyer_id, $si_add_date,$gt_is_tax_apply);
//                }
//            }
            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = 'Save Successfully';
        }else{
            $response['SUCCESS'] = 'False';
            $response['MESSAGE'] = 'You Can Not Remove All Product';
        }


        $response_json = json_encode($response, true);
        echo $response_json;

    }

    public function farmer_data_fetch(){
        $mobile_no=$_POST['mobile_no'];
        $user = new User();
        $user->set_role_id('2');
        $user->set_role_name('Farmer');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;

        $response = $user->get_farmer_data_fetch($mobile_no);


        $response_json=json_encode($response,true);
        echo $response_json;


    }

    public  function farmer_data_add(){

        if(isset($_POST['name']) && !empty($_POST['name']) ){
            // echo preg_match('/\s/',$_POST['name']); exit;
            if( preg_match('/\s/',$_POST['name']) >= 1){
                $names = explode(" ",$_POST['name']);
                $name = $names[0];
                if(isset($names[1]) && !empty($names[1])){
                    $m_name = $names[1];
                } else{
                    $m_name='';
                }
                if(isset($names[2]) && !empty($names[2])){
                    $l_name = $names[2];
                }else{
                    $l_name = '';
                }
            }else{
                $name = $_POST['name'];
                $m_name='';
                $l_name = '';
            }
        }
        $user_id = $_SESSION['login_user']->id;
        $user = new User();
        $mobile_no=$_POST['mobile_no'];
        $city=$_POST['city'];
        $nick_name=$_POST['nick_name'];
        if(isset($_POST['type'])){
            $buyer_district= $_POST['buyer_district'];
            $buyer_state=$_POST['buyer_state'];
            $user->set_role_id('3');
            $user->set_role_name('buyer');
//            date('Y-m-d H:i:s')
            $id=$user->insert_farmer_details($nick_name,$mobile_no,$city,$name,$m_name,$l_name,$buyer_district,$buyer_state,$user_id);
        }
        else{
            $buyer_district='';
            $buyer_state='';
            $user->set_role_id('2');
            $user->set_role_name('Farmer');
            $id=$user->insert_farmer_details($nick_name,$mobile_no,$city,$name,$m_name,$l_name,$buyer_district,$buyer_state,$user_id);
        }

        if(!empty($id)){
            $response = $user->get_farmer_data_fetch($mobile_no);
        }


        $response_json=json_encode($response,true);
        echo $response_json;
    }

    public function seller_added_data_fetch(){
        $SellerProductInvoice = new SellerProductInvoice();
        $saller_id=$_POST['farmer_id'];
        $date= $_POST['date'];
        $response = $SellerProductInvoice->get_seller_product_data_by_spi_saller_id($saller_id,$date);

        $response_json=json_encode($response,true);
        echo $response_json;
    }
}