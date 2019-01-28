<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;
use App\BuyerInvoice;
use App\Http\Controllers;
use App\Sessions;
use App\Goods;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App\BuyerProductInvoice;
use App\SellerProductInvoice;
use App\SiteSettings;
session_start();
class BuyerController extends Controller {

    public function __construct(){

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*to open buyer list page*/
    public function buyer(){
        $Users = new User();
        $Users->set_role_id('3');
        $Users->set_role_name('Buyer');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $buyer_list = $Users->get_user_list($role_id,$user_id);

        return response()
            ->view('buyer.buyer-list',['buyer_list'=>$buyer_list]);
    }
    /*to open buyer add page*/
    public function buyer_add(){
        $user = new User();
        $data['page_title'] = 'Buyer Add';
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['company_list'] = $user->get_agent_list($role_id,$user_id);
        return response()
            ->view('buyer.buyer-add',['buyer_data'=>$data]);
    }

    /*to send buyer data on buyer list page page*/
    public function buyer_list_post(Request $request){
        $user = new User();
        $role_permission_arr = parent::login_user_details();
        $user->set_role_id('3');
        $user->set_role_name('Buyer');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 =>'id',
            1 =>'biz_name',
            2 =>'f_name',
            3=> 'email',
            4=> 'mobile',
            5=> 'city',
            6=> 'status',
            7=> 'id',
        );

        $total = $user->buyer_count($role_id,$user_id);
        $totalData = $total[0]->buyer_count;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        if(empty($search))
        {
            $posts = $user->get_user_list_post($role_id,$user_id,$start,$limit,$order,$dir);
        }
        else {

            $posts = $user->get_user_list_post($role_id,$user_id,$start,$limit,$order,$dir,$search);
            $total_rec = $user->get_user_list_post_count($role_id,$user_id,$search);
            $totalFiltered = $total_rec[0]->total;
        }
        $data = array();
        if(!empty($posts))
        {
            /*tp set data in td*/
            foreach ($posts as $post)

            {
                $show =  route('buyer_view',$post->id);
                $edit =  route('buyer_edit',$post->id);
                if(isset($role_permission_arr['buyer']) && $role_permission_arr['buyer'] != 'None' && $role_permission_arr['buyer'] != 'Read'){
                    $status ="<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->status}&#39);' title='Status' ><span>" . $post->status . "</span></a>";
                    $edit_view = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp glyphicon glyphicon-list'></span></a>";
                }else{
                    $status = $post->status;
                    $edit_view = "";
                }

                $nestedData['id'] = $post->id;
                $nestedData['company'] = $post->biz_name;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show}'>".$post->f_name .' '.$post->m_name.' '.$post->l_name."</a>";
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
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    /*to open buyer details page.*/
    public function buyer_view($id){
        $Users =  new User();
        $Users->set_id($id);
        $buyer_data = $Users->get_user_details();
        $data['add_by'] = $Users->get_user_name_by_id($buyer_data[0]->add_by);
        $data['modify_by'] = $Users->get_user_name_by_id($buyer_data[0]->modify_by);
        $role_name = $_SESSION['login_user']->role_name;
        $buyer_data[0]->login_role = $role_name;
        $data['buyer_data']=$buyer_data[0];
        return response()
            ->view('buyer.buyer-view',['buyer_data'=>$data]);

    }
    /*to open buyer edit page*/
    public function buyer_edit($id){
        $Users =  new User();
        $Users->set_id($id);
        $buyer_data = $Users->get_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $role_name = $_SESSION['login_user']->role_name;
        $buyer_data[0]->login_role = $role_name;
        $data['buyer_data']=$buyer_data[0];
        $data['company_list'] = $Users->get_agent_list($role_id,$user_id);
        $data['page_title'] = 'Buyer Edit';
        $data['buyer_data'] = $buyer_data[0];
        return response()
            ->view('buyer.buyer-add',['buyer_data'=>$data]);
    }
    /*to open buyer bill list page*/
    public function buyer_bills_list(){
        $data['page_title'] = 'Buyer Invoice List';
        $buyerInvoice = new BuyerInvoice();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $buyer_data = $buyerInvoice->get_invoice_data($role_id,$user_id);
        $data['buyer_data'] =$buyer_data;
        return response()
            ->view('buyer.buyer-bill-list',['data'=>$data]);
    }
    /*to open buyer bill collection page*/




    public function bill_collection_add(){
        return response()
            ->view('buyer.bill-collection');
    }

    public  function show_buyer_data($bi_id,$date,$gst){
        $buyerInvoice = new BuyerInvoice();
        $BuyerInvoice = new BuyerInvoice();
        $BSPController =new BSPController();
        $BuyerProductInvoice = new BuyerProductInvoice();
        $SellerProductInvoice = new SellerProductInvoice();
//        $buyer_invoice_data = $SellerProductInvoice->get_faramer_data_for_payment($si_id,$date);
        $buyer_invoice_data = $BuyerInvoice->get_buyer_invoice_data_by_bi_id($bi_id, $date,$gst);


        $buyer_invoices_data = $BuyerInvoice->get_buyer_invoice_data_by_total_count_bi_id($bi_id,$gst);

        $buyer_product_invoice_data = $BuyerProductInvoice->get_buyer_product_data_by_bpi_bi_id($bi_id, $date);

        $SiteSettings= new SiteSettings();
        $login_id= $_SESSION['login_user']->id;
        $setting_data=$SiteSettings->select_site_settings($login_id);

        $market_fees=$setting_data[0]->market_fees;
        $biz_comission=$setting_data[0]->biz_comission;

        $bpi_cgst=$setting_data[0]->setting_CGST;
        $bpi_sgst=$setting_data[0]->setting_SGST;
        $bpi_igst=$setting_data[0]->setting_IGST;
        $today= date('Y-m-d');

        $totals=0;
        $login_user = $_SESSION['login_user']->id;
        $role_id = $_SESSION['login_user']->role_id;
        $goodstype = new Goods();
        foreach($buyer_invoice_data as $invoice){

            $goods_data = $goodstype->get_good_type_by_id($invoice->gt_type,$login_user,$role_id);
            $invoice->bpi_cgst=$goods_data[0]->gt_cgst_tax;
            $invoice->bpi_sgst=$goods_data[0]->gt_sgst_tax;
            $invoice->bpi_igst=$goods_data[0]->gt_igst_tax;
            $invoice->bpi_cgst_price=($invoice->spi_total*$goods_data[0]->gt_cgst_tax)/100;
            $invoice->bpi_sgst_price=($invoice->spi_total*$goods_data[0]->gt_sgst_tax)/100;
            $invoice->bpi_igst_price=($invoice->spi_total*$goods_data[0]->gt_igst_tax)/100;
            if($buyer_invoice_data[0]->state == 'Gujarat' || empty($buyer_invoice_data[0]->state->state)) {
                $invoice->spi_total= $invoice->spi_total + $invoice->bpi_cgst_price + $invoice->bpi_sgst_price;
            }else{
                $invoice->spi_total= $invoice->spi_total +  $invoice->bpi_igst_price;
            }

            $totals = $totals + $invoice->spi_total;
            $invoice->bpi_cgst_price=number_format((float)$invoice->bpi_cgst_price, 2, '.', '');
            $invoice->bpi_sgst_price=number_format((float)$invoice->bpi_sgst_price, 2, '.', '');
            $invoice->bpi_igst_price=number_format((float)$invoice->bpi_igst_price, 2, '.', '');
            $invoice->spi_total=number_format((float)$invoice->spi_total, 2, '.', '');

        }
        $buyer_invoices_data[0]->total=$totals;
        $buyer_invoices_data[0]->total=number_format((float)$buyer_invoices_data[0]->total, 2, '.', '');


        $result = $buyer_invoices_data[0]->total ;
        $buyer_invoices_data[0]->market_fees=$setting_data[0]->market_fees;
        $buyer_invoices_data[0]->biz_comission=$setting_data[0]->biz_comission;
        $grandtotal1=($result*$market_fees)/100;
        $grandtotal2=($result*$biz_comission)/100;
        $buyer_invoices_data[0]->grandtotal1=$grandtotal1;
        $buyer_invoices_data[0]->grandtotal2=$grandtotal2;
        $grandtotals=$result+$grandtotal1+ $grandtotal2;
        $buyer_invoices_data[0]->grandtotals=$grandtotals;
        $buyer_invoices_data[0]->grandtotal1=number_format((float) $buyer_invoices_data[0]->grandtotal1, 2, '.', '');
        $buyer_invoices_data[0]->grandtotal2=number_format((float)$buyer_invoices_data[0]->grandtotal2, 2, '.', '');
        $buyer_invoices_data[0]->grandtotals=number_format((float)$buyer_invoices_data[0]->grandtotals, 2, '.', '');
        foreach ($buyer_invoice_data as $invoice) {
            $buyer_invoice_data_select = $BuyerInvoice->select_buyer_data_for_invoice($bi_id, $date, $invoice->gt_is_tax_apply);



                $buyer_invoices_data[0]->total = $buyer_invoice_data_select[0]->bi_amount;
                $buyer_invoices_data[0]->biz_comission = $buyer_invoice_data_select[0]->bi_comission;
                $buyer_invoices_data[0]->grandtotal2 = $buyer_invoice_data_select[0]->bi_commission_price;
                $buyer_invoices_data[0]->market_fees = $buyer_invoice_data_select[0]->bi_market_fee;
                $buyer_invoices_data[0]->grandtotal1 = $buyer_invoice_data_select[0]->bi_market_fee_per;
                $buyer_invoices_data[0]->grandtotals = $buyer_invoice_data_select[0]->bi_total;
                $buyer_invoices_data[0]->total = number_format((float)$buyer_invoices_data[0]->total, 2, '.', '');


        }
        $buyer_details = $buyerInvoice->get_buyer_details($bi_id);
        $data['buyer_invoice_data'] = $buyer_invoice_data;

        $buyer_invoices_data[0]->grand_total_word = ucwords(strtolower($BSPController->readNumber(round($buyer_invoices_data[0]->grandtotals))));
        $data['buyer_invoices_data'] =$buyer_invoices_data[0];

        $bi_id = $bi_id;
        $date = $date;
        $gst = $gst;

        return view('buyer.buyer-bill-data', compact('data', 'buyer_details','bi_id','date','gst'));
    }

}