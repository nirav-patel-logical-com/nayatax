<?php

namespace App\Http\Controllers;

use App\Permissions;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
Use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
	Function return login details.
	*/
    /*to get login user details like role,permission,name,id ect..*/
    public function login_user_details(){

      /*  echo "<pre>";
        print_r($_SESSION['login_user']);
        exit;*/
        $User = new User();


        if(isset($_SESSION['login_user']->id) && !empty($_SESSION['login_user']->id)){

            $user_param=array();
            $user_name=$_SESSION['login_user']->f_name;
            $user_middle_name=$_SESSION['login_user']->m_name;
            $user_surname=$_SESSION['login_user']->l_name;
            //$user_role=$_SESSION['login_user']->user_role()->first()->ur_role;
            $user_id=$_SESSION['login_user']->id;

            $User->set_id($user_id);
            $auth_user_role=$User->auth_user_role();
            //echo "<pre>";print_r($auth_user_role);die;
            $user_role=$auth_user_role[0]->r_type;
            if(isset($auth_user_role) && !empty($auth_user_role[0])){

                $user_param['biz_id'] = '';
                if($user_role ==='Farmer' || $user_role ==='Buyer'){
                    $User->set_fields('biz_id');
                    $User->select_field_by_id($user_id);

                    if(!empty($bd_id_arr)){
                        $user_param['biz_id'] = $bd_id_arr[0]->biz_id;
                    }
                }

                $user_param['name']=ucfirst($user_name).' '.ucfirst($user_middle_name).' '.ucfirst($user_surname);
                $user_param['user_name']=ucfirst($user_name);
                $user_param['user_middle_name']=ucfirst($user_middle_name);
                $user_param['user_surname']=ucfirst($user_surname);
                $user_param['id']=$user_id;
                $user_param['user_role']=ucfirst($user_role);
                /*echo "<pre>";
                print_r($user_param);
                exit;*/

                View::share("user_param",$user_param);

                /* role permission */
                $role_permission_arr=array();
                $Permissions=new Permissions();
                $Permissions->set_per_rl_id($auth_user_role[0]->r_id);
                $select_permission_by_role = $Permissions->select_permission_by_role();
                foreach($select_permission_by_role as $single_per){
                    $role_permission_arr[$single_per->mod_short_code] = $single_per->per_permission;
                }

                View::share("role_permission_arr",$role_permission_arr);
                return $role_permission_arr;
                /* role permission */

            }
        }else{
            return response()
                ->view('auth.login');
        }
    }

}
