<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Module;
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


class ModuleController extends Controller
{
    /*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        parent::login_user_details();
    }

    public $param = array();


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

    /* Controller Functions*/
    public function module_create()
    {
        /*echo "hiii";
        exit;*/

        $this->param['page_title'] = 'Module Add';
        return response()
            ->view('module/create', ['data' => $this->param]);
        //return view('module/create', $this->param);
    }

    /*save module data*/
    public function module_create_post()
    {
        /*echo "<pre>";
        print_r($_REQUEST);
        echo "</pre>";
        exit;*/

        if ((isset($_POST['mod_title'])) && (!empty($_POST['mod_title']))) {
            $Module = new Module();
            $BSPController = new BSPController();
            $date = date('Y-m-d H:i:s');
            $mod_title = $_POST['mod_title'];
            $mod_group = $_POST['mod_group'];
            $mod_status = 'Inactive';
            $mod_add_by = $_SESSION['login_user']->id;
            $mod_short_code = strtolower($BSPController->remove_special_character_from_string($mod_title));
            $Module->set_mod_title($mod_title);
            $Module->set_mod_short_code($mod_short_code);
            $Module->set_mod_group($mod_group);
            $Module->set_mod_status($mod_status);
            $Module->set_mod_add_date($date);
            $Module->set_mod_add_by($mod_add_by);

            $module_create_post = $Module->module_create_post();

            if ((isset($module_create_post)) && (!empty($module_create_post))) {
                Session::put('SUCCESS', 'TRUE');
                Session::put('MESSAGE', 'Module added successfully.');
                return Redirect::route('module_list');
            } else {
                Session::put('SUCCESS', 'FALSE');
                Session::put('MESSAGE', 'Error while adding module.');
                return Redirect::route('module_create');
            }
        } else {
            Session::put('SUCCESS', 'FALSE');
            Session::put('MESSAGE', 'Invalid request.');
            return Redirect::route('module_create');
        }

    }

    /*display module list page*/
    public function module_list()
    {
        $Module = new Module();
        // $module_list=$Module->module_list();
        /*echo "<pre>";
        print_r($roles);
        echo "</pre>";
        exit;*/
        $this->param['page_title'] = 'Module List';
        //$this->param['module_list']=$module_list;
        return response()
            ->view('module/list', ['data' => $this->param]);
        //return view('module/list', $this->param);
    }

    /*get module data foe module list page*/
    public function module_list_post(Request $request)
    {
        $Module = new Module();
        $role_permission_arr = parent::login_user_details();
        $columns = array(
            0 => 'mod_id',
            1 => 'mod_title',
            2 => 'mod_group',
            3 => 'mod_add_date',
            4 => 'mod_status'
        );

        $total = $Module->module_list_count();
        $totalData = $total[0]->total;
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        if (empty($search)) {
            $posts = $Module->module_list($start, $limit, $order, $dir);
        } else {

            $posts = $Module->module_list($start, $limit, $order, $dir, $search);
            $total_rec = $Module->module_list_count($search);
            $totalFiltered = $total_rec[0]->total;
        }
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if (isset($role_permission_arr['module']) && $role_permission_arr['module'] != 'None' && $role_permission_arr['module'] != 'Read') {
                    $status = "<a class='font-green-sharp' onclick='status_change({$post->mod_id},&#39{$post->mod_status}&#39);' title='Status' ><span>" . $post->mod_status . "</span></a>";
                } else {
                    $status = $post->mod_status;
                }
                $nestedData['id'] = $post->mod_id;
                $nestedData['title'] = $post->mod_title;
                $nestedData['group'] = $post->mod_group;
                $nestedData['date'] = date('d-m-Y h:i:s', strtotime($post->mod_add_date));
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

    /*to check module name is unique or not*/
    public function is_unique_module()
    {
        $Module = new Module();
        $mod_title = $_POST['mod_title'];

        $Module->set_mod_title($mod_title);
        $is_unique_module = $Module->is_unique_module();

        if ((isset($is_unique_module)) && (!empty($is_unique_module)) && ($is_unique_module[0]->mod_id > 0)) {
            echo '0';
        } else {
            echo '1';
        }
    }

    /* ./Controller Functions*/


}

