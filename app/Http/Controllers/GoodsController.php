<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;
use App\Goods;
use App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
session_start();
class GoodsController extends Controller {

    public function __construct(){

        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*to display goods type of list*/
    public function goods(){
        $goods = new Goods();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $goods_details = $goods->get_goods_type($role_id,$user_id);
        return response()
            ->view('goodstype.goods-type-list',['goods_data'=>$goods_details]);
    }

    public function good_type_serach(){
        $goods = new Goods();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        if(isset($_POST['company_id']) && !empty($_POST['company_id'])){
            $user_id = $_POST['company_id'];
            $role_id = 0 ;
        }
        $response = $goods->get_goods_type($role_id,$user_id);
        $response_json=json_encode($response,true);
        echo $response_json;
    }
    /*to get goods data for goods list page.*/
    public function goods_list_post(Request $request){
        $goods = new Goods();
        $role_permission_arr = parent::login_user_details();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 =>'gt_id',
            1 =>'gt_type',
            2=> 'biz_name',
            3=> 'gt_hsn_no',
            4=> 'gt_is_tax_apply',
            5=> 'gt_status',
            6=> 'gt_id',
        );

        $total = $goods->get_goods_type_list_count($role_id,$user_id);
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if(empty($search))
        {
            $posts = $goods->get_goods_type_list_post($role_id,$user_id,$start,$limit,$order,$dir);
        }
        else {

            $posts = $goods->get_goods_type_list_post($role_id,$user_id,$start,$limit,$order,$dir,$search);
            $total_rec = $goods->get_goods_type_list_count($role_id,$user_id,$search);
            $totalFiltered = $total_rec[0]->total;
        }
        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)

            {
                $show =  route('goods_type_view',$post->gt_id);
                $edit =  route('edit_goods_type',$post->gt_id);
                if(isset($role_permission_arr['goods-type']) && $role_permission_arr['goods-type'] != 'None' && $role_permission_arr['goods-type'] != 'Read'){
                    $status ="<a class='font-green-sharp' onclick='status_change({$post->gt_id},&#39{$post->gt_status}&#39);' title='Status' ><span>" . $post->gt_status . "</span></a>";
                    $edit_view = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp glyphicon glyphicon-list'></span></a>";
                }else{
                    $status = $post->gt_status;
                    $edit_view = "";
                }
                if($post->gt_is_tax_apply == 'True') { $tax= "Yes"; }
                    else{ $tax = "No"; }

                $nestedData['id'] = $post->gt_id;
                $nestedData['type'] = "<a class='font-green-sharp' href='{$show}'>".ucfirst($post->gt_type) ."</a>";
                $nestedData['company'] = $post->biz_name;
                $nestedData['gt_hsn_no'] = $post->gt_hsn_no;
                $nestedData['gst'] = $tax;
                $nestedData['status'] = "$status";
                $nestedData['action'] = "$edit_view
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

    /*open goods insert page*/
    public function add_goods_type(){
        $data['page_title'] = "Add Goods Type";
        $user = new User();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['company_list'] = $user->get_agent_list($role_id,$user_id);
        return response()
            ->view('goodstype.add-goods-type',['data'=>$data]);
    }
    /*to open goods edit page*/
    public function edit_goods_type($id){
        $goods = new Goods();
        $goods->set_gt_id($id);
        $user = new User();
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $data['company_list'] = $user->get_agent_list($role_id,$user_id);
        $data['goods_details'] = $goods->get_goods_type_by_id();
        $data['page_title'] = "Edit Goods Type";
        return response()
            ->view('goodstype.add-goods-type',['data'=>$data]);
    }
    /*to display particular goods type details*/
    public function goods_type_view($id){
        $goods = new Goods();
        $Users = new User();
        $goods->set_gt_id($id);
        $goods_details = $goods->get_goods_type_by_id();
        $add_by = $Users->get_user_name_by_id($goods_details[0]->gt_add_by);
        $modify_by = $Users->get_user_name_by_id($goods_details[0]->gt_modify_by);
        $data['goods_details'] = $goods_details[0];
        $data['add_by'] = $add_by[0];
        $data['modify_by'] = '';
        if(isset($modify_by) && !empty($modify_by[0])){
            $data['modify_by'] = $modify_by[0];
        }

        return response()
            ->view('goodstype.goods-type-view',['data'=>$data]);
    }
    /*insert or update goods details*/
    public function goods_details_add(){
       if(isset($_POST['gt_type']) && !empty($_POST['gt_type'])){
           $gt_type = ucfirst($_POST['gt_type']);
           $company = $_POST['company'];
           $gt_status = $_POST['status'];
           $gt_hsn_no = $_POST['gt_hsn_no'];
           $gt_is_tax_apply = $_POST['tax'];
           $date =date('Y-m-d H:i:s');
           $goods = new Goods();
           $goods->set_gt_type($gt_type);
           $goods->set_gt_hsn_no($gt_hsn_no);
           $goods->set_gt_status($gt_status);
           $goods->set_gt_is_tax_apply($gt_is_tax_apply);
            $goods->set_gt_biz_id($company);
           $cgst=0;
           $sgst=0;
           $igst=0;
           if($gt_is_tax_apply === 'True') {

               if(isset($_POST['cgst_tax']) && !empty($_POST['cgst_tax'])){
                   $cgst = $_POST['cgst_tax'];
               }

               if(isset($_POST['sgst_tax']) && !empty($_POST['sgst_tax'])){
                   $sgst = $_POST['sgst_tax'];
               }

               if(isset($_POST['igst_tax']) && !empty($_POST['igst_tax'])){
                   $igst = $_POST['igst_tax'];
               }

           }
           $goods->set_gt_cgst_tax($cgst);
           $goods->set_gt_sgst_tax($sgst);
           $goods->set_gt_igst_tax($igst);
           if(isset($_POST['gt_id']) && !empty($_POST['gt_id'])) {
              $goods->set_gt_id($_POST['gt_id']);
               $goods_data = $goods->check_goods_for_update();
               $goods->set_gt_modify_date($date);
               $goods->set_gt_add_date($goods_data[0]->gt_add_date);
               $goods->set_gt_add_by($goods_data[0]->gt_add_by);
               $goods->set_gt_modify_by($_SESSION['login_user']->id);
               $gt_id= $goods->update_goods_type_data();

           }else{
               $goods->set_gt_add_date($date);
               $goods->set_gt_add_by($_SESSION['login_user']->id);
               $gt_id = $goods->insert_goods_type_data();
           }

           if(isset($gt_id) && !empty($gt_id)){
               $response['SUCCESS']='TRUE';
               if(isset($_POST['gt_id']) && !empty($_POST['gt_id'])) {
                   $response['MESSAGE'] = $gt_type . ' Updated Successfully';
               }
               else{
                   $response['MESSAGE'] = $gt_type . ' Added Successfully';
               }
               $response['ERROR']='200';
           }
           else{
               $response['SUCCESS']='FALSE';
               $response['MESSAGE']='Please Try Again.';
               $response['ERROR']='404';
           }

       }else{
           $response['SUCCESS']='FALSE';
           $response['MESSAGE']='Invalid Request.';
           $response['ERROR']='';
       }
        $response_json=json_encode($response,true);
        echo $response_json;
    }

    /*check unique goods type for different company*/
    public function check_unique_goods_type(){
        $goods = new Goods();
        $gt_id ='';
        if(isset($_POST['gt_id']) && !empty($_POST['gt_id'])){
            $gt_id = $_POST['gt_id'];
        }

        $company_id = $_POST['company'];
        $goods->set_gt_id($gt_id);
        $goods->set_gt_biz_id($company_id);
        $goods->set_gt_type($_POST['gt_type']);
        $goods_unique_name = $goods->check_unique_name();
        if ((isset($goods_unique_name)) && (!empty($goods_unique_name)) && ($goods_unique_name[0]->gt_id > 0)) {
            $response['SUCCESS']='FALSE';
            $response['MESSAGE']='Goods Type is existed';
            $response['ERROR']='5';
        } else {
            $response['SUCCESS']='TRUE';
            $response['MESSAGE']='Goods Type is not existed';
        }
        $response_json=json_encode($response,true);
        echo $response_json;
    }

    public function get_hsn_no_by_goods_id(){
        $Goods = new Goods();

        $goods_id=$_POST['goods_id'];
        $Goods->set_gt_id($goods_id);
        $hsn_data=$Goods->get_hsn_no_by_gt_id();
        $response=$hsn_data[0]->gt_hsn_no;

        $response_json=json_encode($response,true);
        echo $response_json;
    }


}