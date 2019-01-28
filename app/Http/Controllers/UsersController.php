<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\ConsignmentProducts;
use App\Goods;
use App\Http\Controllers;
use App\Module;
use App\Role;
use App\Sessions;
use App\SiteSettings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

session_start();

class UsersController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::login_user_details();

    }
    /*display admin list page*/
    public function admin()
    {
        $Users = new User();
        $Users->set_role_id('1');
        $Users->set_role_name('Admin');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $admin_list = $Users->get_user_list($role_id, $user_id);
        return response()
            ->view('admin.admin-list', ['admin_list' => $admin_list]);
    }

    /*get admin data for admin list page*/
    public function admin_list_post(Request $request)
    {
        $role_permission_arr = parent::login_user_details();
        // echo "<pre>";print_r($role_permission_arr);die;
        $user = new User();
        $user->set_role_id('1');
        $user->set_role_name('Admin');
        $role_id = $_SESSION['login_user']->role_id;
        $user_id = $_SESSION['login_user']->id;
        $columns = array(
            0 => 'id',
            1 => 'f_name',
            2 => 'email',
            3 => 'mobile',
            4 => 'status',
            5 => 'id',
        );

        $total = $user->admin_count();
        $totalData = $total[0]->admin_count;
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
                $show = route('admin_view', $post->id);
                $edit = route('admin_edit', $post->id);
                if (isset($role_permission_arr['admin']) && $role_permission_arr['admin'] != 'None' && $role_permission_arr['admin'] != 'Read') {
                    $status = "<a class='font-green-sharp' onclick='status_change({$post->id},&#39{$post->status}&#39);' title='Status' ><span>" . $post->status . "</span></a>";
                    $edit_view = "&emsp;<a href='{$show}' title='SHOW' ><span class='font-green-sharp glyphicon glyphicon-list'></span></a>";
                } else {
                    $status = $post->status;
                    $edit_view = "";
                }

                $nestedData['id'] = $post->id;
                $nestedData['name'] = "<a class='font-green-sharp' href='{$show}'>" . $post->f_name . ' ' . $post->m_name . ' ' . $post->l_name . "</a>";
                $nestedData['email'] = $post->email;
                $nestedData['mobile'] = $post->mobile;
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


    /*display admin details page*/
    public function admin_view($id)
    {
        $Users = new User();
        $Users->set_id($id);
        $admin_data = $Users->get_user_details();

        $data['add_by'] = $Users->get_user_name_by_id($admin_data[0]->add_by);
        $data['modify_by'] = $Users->get_user_name_by_id($admin_data[0]->modify_by);
        $data['admin_data'] = $admin_data[0];
        //echo "<pre>";print_r($data);die;
        return response()
            ->view('admin.admin-view', ['admin_data' => $data]);

    }

    /*start insert admin details*/
    public function admin_details_save()
    {
//echo "<pre>";print_r($_POST);die;
        $Users = new User();
        if (isset($_POST['f_name']) && !empty($_POST['f_name']) &&
            isset($_POST['m_name']) && !empty($_POST['m_name']) &&
            isset($_POST['l_name']) && !empty($_POST['l_name']) &&
            isset($_POST['password']) && !empty($_POST['password']) &&
            isset($_POST['mobile']) && !empty($_POST['mobile'])
        ) {
            $date = date('Y-m-d H:i:s');
            $f_name = ucfirst($_POST['f_name']);
            $m_name = ucfirst($_POST['m_name']);
            $l_name = ucfirst($_POST['l_name']);

            $password = Hash::make(trim($_POST['password']));
            $mobile = $_POST['mobile'];
            $role_name = $_POST['role_name'];
            $role_id = $_POST['role_id'];
            $status = $_POST['status'];
            $nick_name = '';
            if (isset($_POST['nick_name']) && !empty($_POST['nick_name'])) {
                $nick_name = ucfirst($_POST['nick_name']);
            }
            $email = '';
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = $_POST['email'];
            }
            $Users->set_f_name($f_name);
            $Users->set_l_name($l_name);
            $Users->set_m_name($m_name);
            $Users->set_nick_name($nick_name);
            $Users->set_mobile($mobile);
            $Users->set_email($email);
            $Users->set_password($password);
            $Users->set_biz_id(NULL);
            $Users->set_biz_verification_status(NULL);
            $Users->set_status($status);
            $Users->set_role_id($role_id);
            $Users->set_role_name($role_name);
            $Users->set_biz_comission('0');
            $Users->set_add_by($_SESSION['login_user']->id);
            $Users->set_add_date($date);
            $Users->set_modify_date($date);

            $user_data = $Users->insert_user_details();
            if ($user_data) {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = $role_name . ' Added Successfully';
                $response['ERROR'] = '200';
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Please Try Again.';
                $response['ERROR'] = '404';
            }
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request';
            $response['ERROR'] = '404';
        }

        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*end admin admin details*/
    public function admin_edit($id)
    {
        $Users = new User();
        $Users->set_id($id);
        $admin_data = $Users->get_user_details();
        return response()
            ->view('admin.admin-edit', ['admin_data' => $admin_data[0]]);

    }

    /*start update admin details*/
    public function admin_details_update()
    {
//echo "<pre>";print_r($_POST);die;
        $Users = new User();
        if (isset($_POST['f_name']) && !empty($_POST['f_name']) &&
            isset($_POST['m_name']) && !empty($_POST['m_name']) &&
            isset($_POST['l_name']) && !empty($_POST['l_name']) &&
            isset($_POST['mobile']) && !empty($_POST['mobile']) &&
            isset($_POST['admin_id']) && !empty($_POST['admin_id'])
        ) {

            $Users->set_id($_POST['admin_id']);
            $date = date('Y-m-d H:i:s');
            $f_name = ucfirst($_POST['f_name']);
            $m_name = ucfirst($_POST['m_name']);
            $l_name = ucfirst($_POST['l_name']);
            $email = '';
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = $_POST['email'];
            }

            $user = new User();
            $mobile = $_POST['mobile'];
            $user_id = 0;
            if ((isset($_POST['user_id'])) && (!empty($_POST['user_id']))) {
                $user_id = $_POST['user_id'];
            }
            /*$user->set_id($user_id);
            $user->set_mobile($mobile);*/
            $is_unique_mobile = $user->is_unique_mobile($mobile,$user_id);

                if(!empty($is_unique_mobile) && $is_unique_mobile[0]->id != $_POST['admin_id']){

                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Mobile Exist';
                    $response['ERROR'] = '';
                    $response_json = json_encode($response, true);
                    echo $response_json;
                    exit;
                }


                $mobile = $_POST['mobile'];
            $role_name = $_POST['role_name'];
            $role_id = $_POST['role_id'];
            $admin_id = $_POST['admin_id'];
            $status = $_POST['status'];
            $nick_name = '';
            if (isset($_POST['nick_name']) && !empty($_POST['nick_name'])) {
                $nick_name = $_POST['nick_name'];
            }
            $Users->set_id($admin_id);
            $Users->set_role_id($role_id);
            $Users->set_role_name($role_name);
            $users_edit_data = $Users->check_user_for_edit();
            if (isset($users_edit_data) && !empty($users_edit_data)) {
                $Users->set_f_name($f_name);
                $Users->set_l_name($l_name);
                $Users->set_m_name($m_name);
                $Users->set_nick_name($nick_name);
                $Users->set_mobile($mobile);
                $Users->set_email($email);
                $Users->set_biz_id(NULL);
                $Users->set_biz_verification_status(NULL);
                $Users->set_status($status);
                $Users->set_biz_comission('0');
                $Users->set_modify_by($_SESSION['login_user']->id);
                $Users->set_modify_date($date);
                $Users->set_add_date($users_edit_data[0]->add_date);
                $Users->set_add_by($users_edit_data[0]->add_by);

                $user_data = $Users->update_user_detils($admin_id);

                $session = new Sessions();
                $session->set_user_id($admin_id);
                $session_data = $session->check_user_data();
                if (isset($session_data) && !empty($session_data[0])) {
                    $session->set_user_fname($f_name);
                    $session->set_user_lname($l_name);
                    $session->set_user_mname($m_name);
                    $session->set_user_mobile($mobile);
                    $session->set_user_email($email);
                    $session->set_user_role_id($role_id);
                    $session->set_user_role_name($role_name);
                    $Users->set_biz_id(NULL);
                    $session->set_user_biz_verification_status(NULL);
                    $session->set_user_modified_date($date);
                    $session->set_user_add_date($date);
                    $session->set_user_login_status($session_data[0]->user_login_status);
                    $session->update_user_session_data();
                }
                if ($user_data) {
                    $response['SUCCESS'] = 'TRUE';
                    $response['MESSAGE'] = $role_name . 'Data Updated Successfully';
                    $response['ERROR'] = '200';
                } else {
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Please Try Again.';
                    $response['ERROR'] = '404';
                }
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Request';
                $response['ERROR'] = '404';
            }
        }

        else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request';
            $response['ERROR'] = '404';
        }

        $response_json = json_encode($response, true);
        echo $response_json;
    }
    /*end update admin details*/
    /*start login user password change*/
    public function change_password($id)
    {
        return response()
            ->view('auth.password-change', ['id' => $id]);
    }
    /*end login user password change*/
    /*start admin reset password change*/
    public function reset_password()
    {
        if (isset($_POST['user_id']) && !empty($_POST['user_id']) &&
            isset($_POST['old_password']) && !empty($_POST['old_password']) &&
            isset($_POST['new_password']) && !empty($_POST['new_password'])
        ) {
            $user = new User();
            $user_id = $_POST['user_id'];
            // $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            $user->set_id($user_id);
            $user->set_password(Hash::make(trim($new_password)));
            $user_password = $user->update_password();
            if ($user_password) {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = 'Password Change Successfully.';
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Please Try Again.';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }
    /*end admin reset password change*/

    /*start get user data for stock in page*/
    public function get_user_data()
    {
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            $id = $_POST['user_id'];
            $user = new User();

            $user_data = $user->get_user_data_by_id($id);
            if (isset($user_data) && !empty($user_data[0])) {
                $biz_id = $user_data[0]->biz_id;
                $site_setting = new SiteSettings();
                $site_setting->set_fields('setting_kg_price');
                $site_setting->set_setting_add_by($biz_id);
                $site_setting_data = $site_setting->get_fields_by_add_by();
                if (isset($site_setting_data) && empty($site_setting_data[0])) {
                    $setting_kg_price = '1/Kg';
                } else {
                    $setting_kg_price = $site_setting_data[0]->setting_kg_price;
                }
                //  echo $setting_kg_price;die;
                $goods = new Goods();
                $goods->set_gt_biz_id($biz_id);
                $role_id = $_SESSION['login_user']->role_id;
                $user_id = $_SESSION['login_user']->id;
                $goods_data = $goods->get_goods_type_by_biz_id($biz_id);
                $response['SUCCESS'] = 'TRUE';
                $response['Data'] = $user_data[0];
                $response['good_data'] = $goods_data;
                $response['site_data'] = $setting_kg_price;
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
    /*end get user data for stock in page*/

    /*start get user data for stock out page*/
    public function get_user_data_for_stock()
    {
        if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            $id = $_POST['user_id'];
            $user = new User();
            $user_data = $user->get_user_data_by_id($id);
            if (isset($user_data) && !empty($user_data[0])) {
                $biz_id = $user_data[0]->biz_id;
                $consignmentProduct = new ConsignmentProducts();
                $user->set_id($biz_id);
                $company_data = $user->get_company_by_id();
                //$consignmentProduct->set_bzcp_biz_id($biz_id);
                $product_data = $consignmentProduct->get_consignment_data_by_biz_id($biz_id);
                // echo "<pre>";print_r($company_data);die;
                //$goods = new Goods();
                //$goods->set_gt_biz_id($biz_id);
                //$goods_data = $goods->get_goods_type_by_biz_id();
                //$farmer_data = $user->get_farmer_by_biz_id($biz_id);
                $response['SUCCESS'] = 'TRUE';
                $response['Data'] = $user_data[0];
                $response['good_data'] = $product_data;
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
    /*end get user data for stock in page*/

    /*start search user by name and mobile*/
    public function fetch_user_auto_complete_for_stock()
    {
        $User = new User();
        if ((isset($_POST['term'])) && (!empty($_POST['term']))) {
            $term = $_POST['term'];

            $role_id = $_SESSION['login_user']->role_id;
            $user_id = $_SESSION['login_user']->id;
            $User->set_term($term);
            if (isset($_POST['company_id']) && !empty($_POST['company_id'])) {
                $biz_id = $_POST['company_id'];
                $select_title_by_term = $User->select_title_by_term_and_biz_id($role_id, $user_id, $biz_id);
            } else {
                $select_title_by_term = $User->select_title_by_term_for_user($role_id, $user_id);
            }

            if (isset($select_title_by_term) && !empty($select_title_by_term)) {
                foreach ($select_title_by_term as $item) {
                    $biz_id = $item->biz_id;
                    $consignmentProduct = new ConsignmentProducts();
                    $User->set_id($biz_id);
                    $company_data = $User->get_company_by_id();
                    /*$good_data = $consignmentProduct->get_consignment_data_by_biz_id($biz_id);
                    $array = json_decode(json_encode($good_data), True);*/
                    $farmer_data = $consignmentProduct->get_farmer_data_by_biz_id($biz_id);
                    $array = json_decode(json_encode($farmer_data), True);
                    //echo "<pre>";print_r($good_data);die;
                    $item->company_data = $company_data[0];
                    $item->farmer_data = $array;

                }
                $result_json = json_encode($select_title_by_term);
                // echo $result_json;die;
            } else {
                $result_json = '[]';
            }
            echo $result_json;
        } else {
            echo '[]';
        }
    }

    /*and search user by name and mobile*/

    /*start change user status*/
    public function change_user_status()
    {
        if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['status']) && !empty($_POST['status'])) {
            $id = $_POST['id'];
            $date = date('Y-m-d H:i:s');
            $module = $_POST['module'];
            if ($_POST['status'] === 'Active') {
                $status = 'Inactive';
            } else {
                $status = 'Active';
            }
            if ($module === 'user') {
                $user = new User();
                $user->set_id($id);
                $user->set_status($status);
                $user_data = $user->change_status();

            } elseif ($module === 'role') {

                $role = new Role();
                $role->set_r_id($id);
                $role->set_r_status($status);
                $role->set_r_modify_date($date);
                $user_data = $role->change_status();
            } elseif ($module === 'goods') {
                $goods = new Goods();
                $goods->set_gt_id($id);
                $goods->set_gt_status($status);
                $user_data = $goods->change_status();
            } elseif ($module === 'module') {
                $module = new Module();
                $module->set_mod_id($id);
                $module->set_mod_status($status);
                $user_data = $module->change_status();
            }
            if ($user_data) {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = 'Status is ' . $status;
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Status Can not be updated..';
            }
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }
    /*end change user status*/

}