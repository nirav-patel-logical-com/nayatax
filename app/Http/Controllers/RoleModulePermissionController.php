<?php

namespace App\Http\Controllers;

session_start();
use App\Http\Requests;
use App\Module;
use App\ModulePermissionRole;
use App\Permissions;
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

class RoleModulePermissionController extends Controller
{
    public $param = array();

    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }
    /*
    Function load view for set/update permission with role.
    */
    public function set_role_module_permission()
    {
        $Role = new Role();
        $role_for_permission = $Role->select_all_without_member();

        if (isset($role_for_permission) && !empty($role_for_permission)) {
            $this->param['page_title'] = 'Set Permission';
            $this->param['role_for_permission'] = $role_for_permission;
            return response()
                ->view('role_permission/main_page', ['data' => $this->param]);
            //return view('role_permission/main_page', $this->param);
        } else {
            Session::put('SUCCESS', 'FALSE');
            Session::put('MESSAGE', 'Invalid request.');
            return redirect()->back();
        }
    }

    /*
    Function load data for set/update permission with role.
    */
    public function role_permission_form()
    {
        $Module = new Module();
        $Permissions = new Permissions();

        $select_all_module = $Module->select_all_module_for_form();

        if (isset($select_all_module) && !empty($select_all_module) && isset($_POST['role_id']) && !empty($_POST['role_id'])) {
            $module_with_group = array();
            foreach ($select_all_module as $data) {
                $Permissions->set_per_mod_id($data->mod_id);
                $Permissions->set_per_rl_id($_POST['role_id']);
                $check = $Permissions->check_by_module_and_role();
                if (isset($check) && !empty($check)) {
                    $data->per_permission = $check[0]->per_permission;
                } else {
                    $data->per_permission = '';
                }

                $id = $data->mod_group;
                if (isset($module_with_group[$id])) {
                    $module_with_group[$id][] = $data;
                } else {
                    $module_with_group[$id] = array($data);
                }
            }

            $this->param['module_with_group'] = $module_with_group;
            $this->param['role_id'] = $_POST['role_id'];

            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = '';
            $response['DATA'] = view('role_permission/permission_form', $this->param)->render();
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid request.';
        }

        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*
    Function update role permission.
    */
    public function assign_module_permission_to_role()
    {
        if ((isset($_POST['mod_id']) && !empty($_POST['mod_id'])) &&
            (isset($_POST['permission']) && !empty($_POST['permission'])) &&
            (isset($_POST['rl_id']) && !empty($_POST['rl_id']))
        ) {
            $Permissions = new Permissions();

            $Permissions->set_per_mod_id($_POST['mod_id']);
            $Permissions->set_per_rl_id($_POST['rl_id']);
            $Permissions->set_per_permission($_POST['permission']);
            $check = $Permissions->check_by_module_and_role();

            if (isset($check) && !empty($check)) {
                $Permissions->set_per_id($check[0]->per_id);
                $Permissions->set_per_modify_by($_SESSION['login_user']->id);
                $Permissions->set_per_modify_date(time());
                $Permissions->update_module_permission_role();

            } else {
                $Permissions->set_per_add_by($_SESSION['login_user']->id);
                $Permissions->set_per_add_date(time());
                $Permissions->insert_module_permission_role();
            }
            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = 'Permission set successfully.';
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid request.';
        }

        $response_json = json_encode($response, true);
        echo $response_json;
    }


}

