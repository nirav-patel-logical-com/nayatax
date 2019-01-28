<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Log;
use App\SiteSettings;
use App\User;
use App\UserRole;
use App\PasswordResets;
use App\BizNatureOfBusinesses;
use App\BizDetails;
use App\VerifyMobileByMisdail;
use App\Member;

use App\UsersOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

session_start();

class SiteSettingController extends Controller
{

    public $param = array();

    public function __construct()
    {
        //$this->middleware('auth');
        parent::login_user_details();
    }

    /*
    Function load view for site setting update.
    */
    public function setting_reference_credit()
    {

        $SiteSettings = new SiteSettings();
        $login_id = $_SESSION['login_user']->id;
        $select_site_settings = $SiteSettings->select_site_settings($login_id);

        $this->param['page_title'] = 'Site Setting';
        $this->param['select_site_settings'] = $select_site_settings;

        return view('site_setting/update_reference_credit', $this->param);
    }


    /*
    Function handel request for site setting update form.
    */

    //add or update gst details -nikita
    public function setting_gst_post()
    {

        $SiteSettings = new SiteSettings();
        $login_id = $_SESSION['login_user']->id;
        $date = date('Y-m-d H:i:s');
        $gstin = '';
        $hsn = '';
        $pan = '';
        $adhar = '';
        $commission = 0;
        $settings_wages =0;
        if (isset($_POST['setting_gstin']) && !empty($_POST['setting_gstin'])) {
            $gstin = $_POST['setting_gstin'];
        }
        if (isset($_POST['setting_hsn_sac']) && !empty($_POST['setting_hsn_sac'])) {
            $hsn = $_POST['setting_hsn_sac'];
        }
        if (isset($_POST['setting_pan']) && !empty($_POST['setting_pan'])) {
            $pan = $_POST['setting_pan'];
        }
        if (isset($_POST['setting_aadhar']) && !empty($_POST['setting_aadhar'])) {
            $adhar = $_POST['setting_aadhar'];
        }
        if (isset($_POST['setting_commission']) && !empty($_POST['setting_commission'])) {
            $commission = $_POST['setting_commission'];
        }
        if (isset($_POST['market_fees']) && !empty($_POST['market_fees'])) {
            $market_fees = $_POST['market_fees'];
        }
        if (isset($_POST['setting_wages']) && !empty($_POST['setting_wages'])) {
            $settings_wages = $_POST['setting_wages'];
        }

        $setting_kg_price='1Kg';
        if (isset($_POST['setting_kg_price']) && !empty($_POST['setting_kg_price'])) {
            $setting_kg_price = $_POST['setting_kg_price'];
        }

        $user = new User();
        $user->set_gstin_no($gstin);
        $user->set_aadhar_no($adhar);
        $user->set_hsn_no($hsn);
        $user->set_pan_no($pan);
        $user->set_biz_comission($commission);
        $user->set_id($login_id);
        $user->update_site_setting_user_data();
        if (isset($_POST['setting_id']) && !empty($_POST['setting_id'])) {
            $SiteSettings->set_setting_id($_POST['setting_id']);
//            $SiteSettings->set_setting_SGST($_POST['setting_sgst']);
//            $SiteSettings->set_setting_CGST($_POST['setting_cgst']);
//            $SiteSettings->set_setting_IGST($_POST['setting_igst']);
            $SiteSettings->set_setting_kg_price($setting_kg_price);
            $SiteSettings->set_setting_modify_by($login_id);
            $SiteSettings->set_setting_modify_date($date);
            $update = $SiteSettings->update_site_settings_gst($market_fees,$settings_wages);


            if (isset($update) && !empty($update)) {
                Session::put('SUCCESS', 'TRUE');
                Session::put('MESSAGE', 'Successfully update.');
            } else {
                Session::put('SUCCESS', 'FALSE');
                Session::put('MESSAGE', 'Error while update.');
            }
        } else {


            $SiteSettings->set_setting_SGST($_POST['setting_sgst']);
            $SiteSettings->set_setting_CGST($_POST['setting_cgst']);
            $SiteSettings->set_setting_IGST($_POST['setting_igst']);
            $SiteSettings->set_setting_kg_price($setting_kg_price);
            $SiteSettings->set_setting_add_by($login_id);
            $SiteSettings->set_setting_add_date($date);
            $setting_id = $SiteSettings->insert_site_settings_gst($market_fees,$settings_wages);
            if (isset($setting_id) && !empty($setting_id)) {
                Session::put('SUCCESS', 'TRUE');
                Session::put('MESSAGE', 'Successfully insert.');
            } else {
                Session::put('SUCCESS', 'FALSE');
                Session::put('MESSAGE', 'Error while insert.');
            }
        }

        return redirect()->back();
    }
}

?>