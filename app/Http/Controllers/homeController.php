<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\ConsignmentProducts;
use App\Http\Controllers;
use App\Sessions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App;
use Config;
session_start();

class homeController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
        /*$lang = Session::get ('locale');
        if ($lang != null) \App::setLocale($lang);*/
    }

    public function index()
    {
        //if user already login then open dashboard other redirect to wise login page
        if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
            return redirect::route('dashboard');
        } else {
            return response()
                ->view('auth.login');
        }
    }

    /*for login user profile*/
    public function user_view($id)
    {
        $role_name = $_SESSION['login_user']->role_name;
        $Users = new User();
        $Users->set_id($id);
        $user_data = $Users->get_user_details();
        $data['add_by'] = $Users->get_user_name_by_id($user_data[0]->add_by);
        $data['modify_by'] = $Users->get_user_name_by_id($user_data[0]->modify_by);
        $role_name = $_SESSION['login_user']->role_name;
        $user_data[0]->login_role = $role_name;

        if($role_name === 'Admin'){
            $data['admin_data'] = $user_data[0];
            return response()
                ->view('admin.admin-view', ['admin_data' => $data]);

        }elseif($role_name === 'Agent'){
            if(!empty($user_data[0]->biz_logo)){
                $user_data[0]->image = 'https://www.nayatax.com/business_logo/' . $user_data[0]->biz_logo;
            }else{
                $user_data[0]->image=''; //default logo
            }
            $data['agent_data'] = $user_data[0];
            return response()
                ->view('agent.agent-view', ['agent_data' => $data]);
        }elseif($role_name === 'Farmer'){
            $data['seller_data'] = $user_data[0];
            return response()
                ->view('seller.seller-view', ['seller_data' => $data]);
        }elseif($role_name === 'Buyer'){
            $data['buyer_data']=$user_data[0];
            return response()
                ->view('buyer.buyer-view',['buyer_data'=>$data]);
        }
    }


    /*for language change*/
    public function change_lang()
    {
        if (isset($_POST['lang']) && !empty($_POST['lang'])) {
            $lang = $_POST['lang'];
            if ($lang == 'GUJ') {
                $_SESSION['lang_local'] = 'guj';
                App::setLocale('guj');
            } else {
                $_SESSION['lang_local'] = 'en';
                App::setLocale('en');
            }
            $response['SUCCESS'] = 'TRUE';
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Please Try Again.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    //dashboard open
    public function dashboard()
    {
       /*$bspController = new BSPController();
        $data = $bspController->readNumber('12589.00');
        echo ucwords($data);die;*/

        $users = new User();
        $consignmentProduct = new ConsignmentProducts();
        $users->set_id($_SESSION['login_user']->id);
        $user_details = $users->get_login_user_details();
        $role_id = $user_details[0]->role_id;
        $user_id = $_SESSION['login_user']->id;
        $admin_count = $users->admin_count();
        $seller_count = $users->seller_count($role_id, $user_id);
        $buyer_count = $users->buyer_count($role_id, $user_id);
        $agent_count = $users->agent_count();

        $stock_in = $consignmentProduct->get_stock_in_count($role_id, $user_id);
        $stock_out = $consignmentProduct->get_stock_out_count($role_id, $user_id);


        $data['stock_in'] = $stock_in[0]->stock_in_count;
        $data['stock_out'] = $stock_out[0]->stock_out_count;
        $data['user_details'] = $user_details[0];
        $data['admin_count'] = $admin_count[0]->admin_count;
        $data['seller_count'] = $seller_count[0]->seller_count;
        $data['buyer_count'] = $buyer_count[0]->buyer_count;
        $data['agent_count'] = $agent_count[0]->agent_count;

        return response()
            ->view('layouts.dashboard', ['user_details' => $data]);
    }

    public function logout()
    {

        $Session = new Sessions();
        $Session->set_user_id($_SESSION['login_user']->id);
        $Session->set_user_login_status('Inactive');
        $Session->update_session_data();
        if (session_destroy()) // Destroying All Sessions
        {
            /*return response()
                ->view('login');*/
            return redirect::route('login');
        }
    }

}