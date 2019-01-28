<?php

/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;
session_start();

use App\Http\Controllers;
use App\Sessions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class loginController extends Controller
{
//    public function __construct(){
//        //$this->middleware('auth');
//        //parent::login_user_details();
//    }

    /*check user login Credential*/
    public function admin_login_ajax()
    {
         //print_r($_REQUEST);exit;
        if (isset($_POST['mobile']) && !empty($_POST['mobile']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
            $User = new User();
            $User->set_mobile($mobile);
            $User->set_password(Hash::make(trim($password)));
            //$User->set_password($password);
            $date = date('Y-m-d H:i:s');
            $login_data = $User->check_admin_login();
            $Session = new Sessions();

            if (isset($login_data) && !empty($login_data[0])) {
                if (Hash::check(trim($password), $login_data[0]->password)) {

                    $Session->set_user_id($login_data[0]->id);
                    $user_session_dsata = $Session->check_user_data();
                    if (isset($user_session_dsata) && !empty($user_session_dsata[0])) {

                        $Session->set_user_login_status('Active');
                        $Session->update_session_data();

                    } else {

                        $Session->set_user_bd_name($login_data[0]->biz_name);
                        $Session->set_user_fname($login_data[0]->f_name);
                        $Session->set_user_mname($login_data[0]->m_name);
                        $Session->set_user_lname($login_data[0]->l_name);
                        $Session->set_user_email($login_data[0]->email);
                        $Session->set_user_password($login_data[0]->password);
                        $Session->set_user_mobile($login_data[0]->mobile);
                        $Session->set_user_biz_verification_status($login_data[0]->biz_verification_status);
                        $Session->set_user_hsn_no($login_data[0]->hsn_no);
                        $Session->set_user_gstin_no($login_data[0]->gstin_no);
                        $Session->set_user_pan_no($login_data[0]->pan_no);
                        $Session->set_user_aadhar_no($login_data[0]->aadhar_no);
                        $Session->set_user_city($login_data[0]->city);
                        $Session->set_user_state($login_data[0]->state);
                        $Session->set_user_role_id($login_data[0]->role_id);
                        $Session->set_user_role_name($login_data[0]->role_name);
                        $Session->set_user_login_status('Active');
                        $Session->set_ip_address($_SERVER['SERVER_ADDR']);
                        $Session->set_user_add_date($date);
                        $Session->set_user_modified_date($date);

                        $Session->insert_session_data();
                    }
                    $_SESSION['lang_local'] = 'en';

                    $_SESSION['login_user'] = $login_data[0];
                    $response['SUCCESS'] = 'TRUE';
                    $response['MESSAGE'] = 'Login Successfully.';
                } else {
                    /*Session::put('SUCCESS','FALSE');
                    Session::put('MESSAGE', 'Invalid Credential.');*/
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Invalid Credential.';
                }
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Invalid Mobile Number or Password.';
            }
        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Number And Password.';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*check password ro reset password or change password*/
    public function check_user_password()
    {
        $user = new User();
        $password = $_POST['old_password'];
        if ((isset($_POST['user_id'])) && (!empty($_POST['user_id']))) {
            $user_id = $_POST['user_id'];

            $user->set_id($user_id);
            $user->set_password(Hash::make(trim($password)));
            $user_data = $user->get_password_user_details();
            if (isset($user_data) && !empty($user_data[0])) {
                if (Hash::check(trim($password), $user_data[0]->password)) {
                    $response['SUCCESS'] = 'TRUE';
                    $response['MESSAGE'] = 'Current Password match';
                } else {
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Incorrect Password';
                }
            } else {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'InCorrect Current Password.';
                $response['ERROR'] = '404';
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Incorrect Password';
            $response['ERROR'] = '404';
        }
        $response_json = json_encode($response, true);
        echo $response_json;

    }
}