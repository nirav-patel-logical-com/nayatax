<?php
/**
 * Created by PhpStorm.
 * User: Nikita-PHP
 * Date: 10/24/2017
 * Time: 6:36 PM
 */
namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Sessions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
session_start();

class RegistrationController extends Controller
{


    public function __construct()
    {

        //$this->middleware('auth');
        parent::login_user_details();
    }
    /*
        Function check email is unique or not for given email and user id
        */
    public function check_unique_email()
    {
        $user = new User();
        $email = $_POST['email'];
        $user_id = 0;
        if ((isset($_POST['user_id'])) && (!empty($_POST['user_id']))) {
            $user_id = $_POST['user_id'];
        }
        $user->set_id($user_id);
        $user->set_email($email);

        $is_unique_email = $user->is_unique_email();
        if ((isset($email)) && (!empty($email))) {
            if ((isset($is_unique_email)) && (!empty($is_unique_email)) && ($is_unique_email[0]->id > 0)) {
                $response['SUCCESS'] = 'FALSE';
                $response['MESSAGE'] = 'Email is exist';
                $response['ERROR'] = '6';
            } else {
                $response['SUCCESS'] = 'TRUE';
                $response['MESSAGE'] = 'Email is not exist';
            }
        }else {
            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = 'Email is not exist';
        }
        $response_json = json_encode($response, true);
        echo $response_json;

    }

    /*
    Function check mobile is unique or not for given mobile and user id
    */
    public function check_unique_mobile()
    {
        $user = new User();
        $mobile = $_POST['mobile'];
        $user_id = 0;
        if ((isset($_POST['user_id'])) && (!empty($_POST['user_id']))) {
            $user_id = $_POST['user_id'];
            $is_unique_mobile = $user->is_unique_mobile_by_user_id($mobile,$user_id);
        }
        /*$user->set_id($user_id);
        $user->set_mobile($mobile);*/
        else{
            $is_unique_mobile = $user->is_unique_mobile($mobile,$user_id);
        }

        if ((isset($is_unique_mobile)) && (!empty($is_unique_mobile)) && ($is_unique_mobile[0]->id > 0)) {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Mobile is exist';
            $response['ERROR'] = '5';
        } else {
            $response['SUCCESS'] = 'TRUE';
            $response['MESSAGE'] = 'Mobile is not exist';
        }
        $response_json = json_encode($response, true);
        echo $response_json;
    }

    /*start insert or update agent,buyer,farmer details*/
    public function seller_details_save()
    {
        $Users = new User();

        if (isset($_POST['f_name']) && !empty($_POST['f_name']) &&
            isset($_POST['m_name']) && !empty($_POST['m_name']) &&
            isset($_POST['l_name']) && !empty($_POST['l_name']) &&
            isset($_POST['mobile']) && !empty($_POST['mobile']) &&
            isset($_POST['city']) && !empty($_POST['city']) &&
            isset($_POST['address1']) && !empty($_POST['address1']) &&
            isset($_POST['state']) && !empty($_POST['state'])
        ) {
            $date = date('Y-m-d H:i:s');
            $f_name = ucfirst($_POST['f_name']);
            $m_name = ucfirst($_POST['m_name']);
            $l_name = ucfirst($_POST['l_name']);


            $email = '';
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = $_POST['email'];
            }

            $mobile = $_POST['mobile'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $address1 = ucwords($_POST['address1']);
            $role_name = $_POST['role_name'];
            $role_id = $_POST['role_id'];
            //$status = $_POST['status'];

            if ($role_id === '2' || $role_id === '3') {
                $company_id = $_POST['company'];
                $Users->set_id($company_id);
                $company_data = $Users->get_company_by_id();
                $Users->set_biz_id($company_id);
                $company = $company_data[0]->biz_name;

            } else {
                $company_id = NULL;
                $Users->set_biz_id($company_id);
                $company = ucwords($_POST['company']);
            }

            $status = 'Inactive';
            if (isset($_POST['status']) && !empty($_POST['status'])) {
                $status = $_POST['status'];
            }

            $nick_name = '';
            if (isset($_POST['nick_name']) && !empty($_POST['nick_name'])) {
                $nick_name = ucfirst($_POST['nick_name']);
            }
            $taluko = '';
            if (isset($_POST['taluko']) && !empty($_POST['taluko'])) {
                $taluko = $_POST['taluko'];
            }
            $district = '';
            if (isset($_POST['district']) && !empty($_POST['district'])) {
                $district = $_POST['district'];
            }
            $address2 = '';
            if (isset($_POST['address2']) && !empty($_POST['address2'])) {
                $address2 = ucwords($_POST['address2']);
            }
            $gsttin_no = '';
            if (isset($_POST['gsttin_no']) && !empty($_POST['gsttin_no'])) {
                $gsttin_no = $_POST['gsttin_no'];
            }
            $pan_no = '';
            if (isset($_POST['pan_no']) && !empty($_POST['pan_no'])) {
                $pan_no = $_POST['pan_no'];
            }
            $hsn_no = '';
            if (isset($_POST['hsn_no']) && !empty($_POST['hsn_no'])) {
                $hsn_no = $_POST['hsn_no'];
            }
            $adhar_no = '';
            if (isset($_POST['adhar_no']) && !empty($_POST['adhar_no'])) {
                $adhar_no = $_POST['adhar_no'];
            }
            $commission = 0;
            if (isset($_POST['commission']) && !empty($_POST['commission'])) {
                $commission = $_POST['commission'];
            }
            if (isset($company) && !empty($company)) {
                $Users->set_biz_verification_status('Pending');
            } else {
                $Users->set_biz_verification_status(NULL);
            }

            $biz_markert_name = '';
            if (isset($_POST['market_name']) && !empty($_POST['market_name'])) {
                $biz_markert_name = ucwords(strtolower($_POST['market_name']));
            }
            $subject = '';
            if (isset($_POST['subject']) && !empty($_POST['subject'])) {
                $subject = ucwords(strtolower($_POST['subject']));
            }
            $tel_no = '';
            if (isset($_POST['tel_no']) && !empty($_POST['tel_no'])) {
                $tel_no = $_POST['tel_no'];
            }
            $biz_mobile = '';
            if (isset($_POST['biz_mobile']) && !empty($_POST['biz_mobile'])) {
                $biz_mobile = $_POST['biz_mobile'];
            }
            $biz_type = '';
            if (isset($_POST['biz_type']) && !empty($_POST['biz_type'])) {
                $biz_type = ucwords(strtolower($_POST['biz_type']));
            }
            $biz_nick_name = '';
            if (isset($_POST['biz_nick_name']) && !empty($_POST['biz_nick_name'])) {
                $biz_nick_name = $_POST['biz_nick_name'];
            }
            $image_name='';
            if(isset($_POST['image']) && !empty($_POST['image'])){
                $image_name = $_POST['image'];
             }
            $Users->set_biz_logo($image_name);
            $Users->set_biz_nick_name($biz_nick_name);
            $Users->set_biz_tel_no($tel_no);
            $Users->set_biz_type($biz_type);
            $Users->set_biz_mobiled($biz_mobile);
            $Users->set_biz_market_name($biz_markert_name);
            $Users->set_biz_subject_name($subject);
            $Users->set_biz_name($company);
            $Users->set_f_name($f_name);
            $Users->set_l_name($l_name);
            $Users->set_m_name($m_name);
            $Users->set_nick_name($nick_name);
            $Users->set_mobile($mobile);
            $Users->set_email($email);

            $Users->set_biz_comission($commission);
            $Users->set_city($city);
            $Users->set_state($state);
            $Users->set_district($district);
            $Users->set_taluko($taluko);
            $Users->set_address1($address1);
            $Users->set_address2($address2);
            $Users->set_gstin_no($gsttin_no);
            $Users->set_pan_no($pan_no);
            $Users->set_aadhar_no($adhar_no);
            $Users->set_status($status);
            $Users->set_role_id($role_id);
            $Users->set_role_name($role_name);
            $Users->set_hsn_no($hsn_no);
            if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                $Users->set_id($_POST['user_id']);
                $Users->set_role_id($role_id);
                $Users->set_role_name($role_name);
                $users_edit_data = $Users->check_user_for_edit();
                if (isset($users_edit_data) && !empty($users_edit_data)) {
                    $Users->set_modify_by($_SESSION['login_user']->id);
                    $Users->set_modify_date($date);
                    $Users->set_add_date($users_edit_data[0]->add_date);
                    $Users->set_add_by($users_edit_data[0]->add_by);
                    $user_data = $Users->update_user_detils($_POST['user_id']);
                }

                $session = new Sessions();
                $session->set_user_id($_POST['user_id']);
                $session_data = $session->check_user_data();
                if (isset($session_data) && !empty($session_data[0])) {
                    $session->set_user_fname($f_name);
                    $session->set_user_lname($l_name);
                    $session->set_user_mname($m_name);
                    $session->set_user_mobile($mobile);
                    $session->set_user_email($email);
                    $session->set_user_role_id($role_id);
                    $session->set_user_role_name($role_name);
                    $session->set_user_biz_verification_status(NULL);
                    $session->set_user_modified_date($date);
                    $session->set_user_add_date($date);
                    $session->set_user_login_status($session_data[0]->user_login_status);
                    $session->update_user_session_data();
                }
                if ($user_data) {
                    $response['SUCCESS'] = 'TRUE';
                    $response['MESSAGE'] = 'Updated Successfully';

                    $response['ERROR'] = '200';
                } else {
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Please Try Again.';
                    $response['ERROR'] = '404';
                }
            } else {
                $password = Hash::make(trim($_POST['password']));
                $Users->set_password($password);
                $Users->set_add_by($_SESSION['login_user']->id);
                $Users->set_add_date($date);
                $Users->set_modify_date($date);

                $user_data = $Users->insert_user_details();
                if ($user_data) {
                    $response['SUCCESS'] = 'TRUE';
                    $response['DATA'] = $user_data;
                    $response['MESSAGE'] = $role_name . ' Added Successfully';
                    $response['ERROR'] = '200';
                } else {
                    $response['SUCCESS'] = 'FALSE';
                    $response['MESSAGE'] = 'Please Try Again.';
                    $response['ERROR'] = '404';
                }
            }

        } else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'Invalid Request';
            $response['ERROR'] = '404';
        }

        $response_json = json_encode($response, true);

        echo $response_json;
    }

    /*agent business logo upload*/
    public function agent_image_upload(){

        /*start for image stored in folder*/
        ini_set('memory_limit', '96M');
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');

        if(isset($_POST['image']) && !empty($_POST['image']) && isset($_POST['image_base64']) && !empty($_POST['image_base64'])){
            $Users = new User();
            $image_name= $_POST['image'];
            $data = $_POST['image_base64'];
            $data1 = explode("/", $data);
            $data1= explode(';',$data1[1]);//get image extension.
            /*unlink business logo from folder and new update*/
            if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                $Users->set_fields('biz_logo');
                $biz_image=$Users->get_image_by_id($_POST['user_id']);

                if(isset($biz_image) && !empty($biz_image[0]->biz_logo)){
                   // echo "hi";die;
                    if (file_exists('business_logo/'.$biz_image[0]->biz_logo)) {
                        unlink('business_logo/'.$biz_image[0]->biz_logo);
                    }
                }
            }
            $data = str_replace('data:image/'.$data1[0].';base64,', '', $data);//remove base64
            //$data = str_replace('data:image/jpeg;base64,', '', $data);

            $data = str_replace(' ', '+', $data);

            $data = base64_decode($data);

            $file = 'business_logo/'.$image_name;
            $success = file_put_contents($file, $data);

            $image= Config::get('constant.SITE_URL').'business_logo/' .$image_name;
            $response['SUCCESS'] = 'TRUE';
            $response['data'] = $image;
            $response['MESSAGE'] = 'Image Uploaded Successfully';
        }
        else {
            $response['SUCCESS'] = 'FALSE';
            $response['MESSAGE'] = 'The selected file cannot be uploaded.';
        }
        /*end for image stored in folder*/
        $response_json = json_encode($response, true);
        echo $response_json;
    }

}