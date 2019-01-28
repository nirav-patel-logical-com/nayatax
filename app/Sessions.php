<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sessions extends Model
{
    protected $table = 'sessions';
    protected $id = '';
    protected $user_id = '';
    protected $user_fname = '';
    protected $user_lname = '';
    protected $user_mname = '';
    protected $user_bd_name = '';
    protected $user_password = '';
    protected $user_email = '';
    protected $user_mobile = '';
    protected $user_biz_verification_status = '';
    protected $user_hsn_no = '';
    protected $user_gstin_no = '';
    protected $user_pan_no = '';
    protected $user_aadhar_no = '';
    protected $user_city = '';
    protected $user_state = '';
    protected $user_role_id = '';
    protected $user_role_name = '';
    protected $user_add_date = '';
    protected $user_modified_date = '';
    protected $user_login_status = '';
    protected $ip_address = '';

    public function set_id($val)
    {
        $this->id = $val;
    }

    public function set_user_id($val)
    {
        $this->user_id = $val;
    }

    public function set_user_fname($val)
    {
        $this->user_fname = $val;
    }

    public function set_user_mname($val)
    {
        $this->user_mname = $val;
    }

    public function set_user_lname($val)
    {
        $this->user_lname = $val;
    }

    public function set_user_bd_name($val)
    {
        $this->user_bd_name = $val;
    }

    public function set_user_password($val)
    {
        $this->user_password = $val;
    }

    public function set_user_email($val)
    {
        $this->user_email = $val;
    }

    public function set_user_mobile($val)
    {
        $this->user_mobile = $val;
    }

    public function set_user_biz_verification_status($val)
    {
        $this->user_biz_verification_status = $val;
    }

    public function set_user_hsn_no($val)
    {
        $this->user_hsn_no = $val;
    }

    public function set_user_gstin_no($val)
    {
        $this->user_gstin_no = $val;
    }

    public function set_user_pan_no($val)
    {
        $this->user_pan_no = $val;
    }

    public function set_user_aadhar_no($val)
    {
        $this->user_aadhar_no = $val;
    }

    public function set_user_city($val)
    {
        $this->user_city = $val;
    }

    public function set_user_state($val)
    {
        $this->user_state = $val;
    }

    public function set_user_role_id($val)
    {
        $this->user_role_id = $val;
    }

    public function set_user_role_name($val)
    {
        $this->user_role_name = $val;
    }

    public function set_user_add_date($val)
    {
        $this->user_add_date = $val;
    }

    public function set_user_modified_date($val)
    {
        $this->user_modified_date = $val;
    }

    public function set_user_login_status($val)
    {
        $this->user_login_status = $val;
    }

    public function set_ip_address($val)
    {
        $this->ip_address = $val;
    }

    public function insert_session_data()
    {
        return DB::table($this->table)->insertGetId(
            [
                'user_id' => $this->user_id,
                'user_fname' => $this->user_fname,
                'user_mname' => $this->user_mname,
                'user_lname' => $this->user_lname,
                'user_bd_name' => $this->user_bd_name,
                'user_password' => $this->user_password,
                'user_mobile' => $this->user_mobile,
                'user_biz_verification_status' => $this->user_biz_verification_status,
                'user_hsn_no' => $this->user_hsn_no,
                'user_gstin_no' => $this->user_gstin_no,
                'user_pan_no' => $this->user_pan_no,
                'user_aadhar_no' => $this->user_aadhar_no,
                'user_city' => $this->user_city,
                'user_state' => $this->user_state,
                'user_role_id' => $this->user_role_id,
                'user_role_name' => $this->user_role_name,
                'user_add_date' => $this->user_add_date,
                'user_modified_date' => $this->user_modified_date,
                'user_login_status' => $this->user_login_status
            ]
        );
    }

    public function update_user_session_data()
    {
        return DB::table($this->table)
            ->where('user_id', $this->user_id)
            ->update(
                [
                    'user_fname' => $this->user_fname,
                    'user_mname' => $this->user_mname,
                    'user_lname' => $this->user_lname,
                    'user_bd_name' => $this->user_bd_name,
                    'user_password' => $this->user_password,
                    'user_mobile' => $this->user_mobile,
                    'user_biz_verification_status' => $this->user_biz_verification_status,
                    'user_hsn_no' => $this->user_hsn_no,
                    'user_gstin_no' => $this->user_gstin_no,
                    'user_pan_no' => $this->user_pan_no,
                    'user_aadhar_no' => $this->user_aadhar_no,
                    'user_city' => $this->user_city,
                    'user_state' => $this->user_state,
                    'user_role_id' => $this->user_role_id,
                    'user_role_name' => $this->user_role_name,
                    'user_add_date' => $this->user_add_date,
                    'user_modified_date' => $this->user_modified_date,
                    'user_login_status' => $this->user_login_status
                ]
            );
    }

    public function check_user_data()
    {
        return DB::table($this->table)
            ->where('user_id', $this->user_id)
            ->get();
    }

    public function update_session_data()
    {
        return DB::table($this->table)
            ->where('user_id', $this->user_id)
            ->update(['user_login_status' => $this->user_login_status
            ]);
    }
    // ->where('user_login_status', 'Inactive')

}
