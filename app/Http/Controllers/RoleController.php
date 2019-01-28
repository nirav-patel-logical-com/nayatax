<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\User;
use App\Admin;
use App\Http\Controllers;
use App\Http\Controllers\BSPController;
use App\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Config;

session_start();

class RoleController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }

    public $param = array();

    public $r_id = '';
    public $r_type = '';
    public $r_status = '';
    public $r_add_date = '';
    public $r_modify_date = '';
    public $r_add_by = '';
    public $r_modify_by = '';

    public function set_r_id($val)
    {
        $this->r_id = $val;
    }

    public function set_r_type($val)
    {
        $this->r_type = $val;
    }

    public function set_r_status($val)
    {
        $this->r_status = $val;
    }

    public function set_r_add_date($val)
    {
        $this->r_add_date = $val;
    }

    public function set_r_modify_date($val)
    {
        $this->r_modify_date = $val;
    }

    public function set_r_add_by($val)
    {
        $this->r_add_by = $val;
    }

    public function set_r_modify_by($val)
    {
        $this->r_modify_by = $val;
    }


    public function get_request($request_attachment)
    {
        $request = array();
        $request['request'] = $_REQUEST;
        $request['files'] = $_FILES;
        $request['attachment'] = $request_attachment;
        $request = json_encode($request);
        $request = str_replace('\"', '"', $request);
        return $request;
    }


    /* Model Functions*/
    /*
    Function select all role.
    */
    public function select_all()
    {
        $Role = new Role();
        $select_all = $Role->select_all();
        if ((isset($select_all)) && (!empty($select_all))) {
            return $select_all;
        } else {
            return 0;
        }

    }

    /* ./Model Functions*/


    /* Controller Functions*/

    /*
    Function load view and data for role list.
    */
    public function role_list()
    {

        $Role = new Role();
        //$role_list=$Role->role_list();
        $this->param['page_title'] = 'Role List';
        //$this->param['role_list']=$role_list;
        return response()
            ->view('role/list', ['data' => $this->param]);
        //return view('role/list', $this->param);
    }

    /*to get role data for role list*/
    public function role_list_post(Request $request)
    {
        $role_permission_arr = parent::login_user_details();
        $Role = new Role();
        $columns = array(
            0 => 'r_id',
            1 => 'r_type',
            2 => 'users_count',
            3 => 'r_status'
        );

        $total = $Role->role_list_count();
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($search)) {
            $posts = $Role->role_list($start, $limit, $order, $dir);
        } else {

            $posts = $Role->role_list($start, $limit, $order, $dir, $search);
            $total_rec = $Role->role_list_count($search);
            $totalFiltered = $total_rec[0]->total;
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if (isset($role_permission_arr['role']) && $role_permission_arr['role'] != 'None' && $role_permission_arr['role'] != 'Read') {
                    $status = "<a class='font-green-sharp' onclick='status_change({$post->r_id},&#39{$post->r_status}&#39);' title='Status' ><span>" . $post->r_status . "</span></a>";
                } else {
                    $status = $post->r_status;
                }

                $nestedData['id'] = $post->r_id;
                $nestedData['role'] = $post->r_type;
                $nestedData['user'] = $post->users_count;
                $nestedData['status'] = "{$status}";
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

    /*
    Function load view for role create.
    */
    public function role_create()
    {
        $this->param['page_title'] = 'Role Add';
        return response()
            ->view('role/create', ['data' => $this->param]);
        //return view('role/create', $this->param);
    }

    /*
    Function checks role is unique or not ?
    */
    public function is_unique_role()
    {
        /* echo "<pre>";
         print_r($_REQUEST);
         echo "</pre>";
         exit;*/
        $Role = new Role();
        $r_type = $_POST['r_type'];

        $Role->set_r_type($r_type);
        $is_unique_role = $Role->is_unique_role();

        if ((isset($is_unique_role)) && (!empty($is_unique_role)) && ($is_unique_role[0]->r_id > 0)) {
            echo '0';
        } else {
            echo '1';
        }
    }

    /*
    Function handel request from role create form.
    */
    public function role_create_post()
    {
        /* echo "<pre>";
          print_r($_POST);
          echo "</pre>";
          exit;*/

        if ((isset($_POST['rl_title'])) && (!empty($_POST['rl_title']))) {
            $Role = new Role();
            $r_type = $_POST['rl_title'];
            $r_status = 'Inactive';
            $r_add_date = date('Y-m-d H:i:s');
            $r_add_by = $_SESSION['login_user']->id;

            $Role->set_r_type($r_type);
            $Role->set_r_status($r_status);
            $Role->set_r_add_date($r_add_date);
            $Role->set_r_add_by($r_add_by);

            $role_create_post = $Role->role_create_post();
//echo $role_create_post;die;
            if ((isset($role_create_post)) && (!empty($role_create_post))) {
                Session::put('SUCCESS', 'TRUE');
                Session::put('MESSAGE', 'Role added successfully.');
                return Redirect::route('role_list');
            } else {
                Session::put('SUCCESS', 'FALSE');
                Session::put('MESSAGE', 'Error while adding role.');
                return Redirect::route('role_create');
            }

        } else {
            Session::put('SUCCESS', 'FALSE');
            Session::put('MESSAGE', 'Invalid request.');
            return Redirect::route('role_create');
        }
    }
    /* ./Controller Functions*/


}

