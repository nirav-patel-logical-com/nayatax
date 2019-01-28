<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = 'users';
    protected $id = '';
    protected $biz_name = '';
    protected $f_name = '';
    protected $m_name = '';
    protected $l_name = '';
    protected $nick_name = '';
    protected $email = '';
    protected $password = '';
    protected $user_mobile = '';
    protected $mobile = '';
    protected $status = '';
    protected $biz_verification_status = '';
    protected $hsn_no = '';
    protected $gstin_no = '';
    protected $pan_no = '';
    protected $aadhar_no = '';
    protected $address1 = '';
    protected $address2 = '';
    protected $city = '';
    protected $district = '';
    protected $taluko = '';
    protected $state = '';
    protected $role_id = '';
    protected $role_name = '';
    protected $biz_comission = '';
    protected $add_date = '';
    protected $add_by = '';
    protected $modify_date = '';
    protected $modify_by = '';
    protected $biz_id = '';
    protected $biz_market_name = '';
    protected $biz_subject_name = '';
    protected $biz_tel_no = '';
    protected $biz_mobile = '';
    protected $biz_logo = '';
    protected $biz_type = '';
    protected $biz_nick_name = '';
    protected $market_fees='';

    public function set_biz_nick_name($val)
    {
        $this->biz_nick_name = $val;
    }
    public function set_biz_type($val)
    {
        $this->biz_type = $val;
    }
    public function set_biz_logo($val)
    {
        $this->biz_logo = $val;
    }
    public function set_biz_mobiled($val)
    {
        $this->biz_mobile = $val;
    }
    public function set_biz_tel_no($val)
    {
        $this->biz_tel_no = $val;
    }
    public function set_biz_subject_name($val)
    {
        $this->biz_subject_name = $val;
    }
    public function set_biz_market_name($val)
    {
        $this->biz_market_name = $val;
    }

    public function set_id($val)
    {
        $this->id = $val;
    }

    public function set_biz_id($val)
    {
        $this->biz_id = $val;
    }

    public function set_biz_name($val)
    {
        $this->biz_name = $val;
    }

    public function set_f_name($val)
    {
        $this->f_name = $val;
    }

    public function set_m_name($val)
    {
        $this->m_name = $val;
    }

    public function set_l_name($val)
    {
        $this->l_name = $val;
    }

    public function set_nick_name($val)
    {
        $this->nick_name = $val;
    }

    public function set_email($val)
    {
        $this->email = $val;
    }

    public function set_password($val)
    {
        $this->password = $val;
    }

    public function set_mobile($val)
    {
        $this->mobile = $val;
    }

    public function set_status($val)
    {
        $this->status = $val;
    }

    public function set_biz_verification_status($val)
    {
        $this->biz_verification_status = $val;
    }

    public function set_hsn_no($val)
    {
        $this->hsn_no = $val;
    }

    public function set_gstin_no($val)
    {
        $this->gstin_no = $val;
    }

    public function set_pan_no($val)
    {
        $this->pan_no = $val;
    }

    public function set_aadhar_no($val)
    {
        $this->aadhar_no = $val;
    }

    public function set_address1($val)
    {
        $this->address1 = $val;
    }

    public function set_address2($val)
    {
        $this->address2 = $val;
    }

    public function set_city($val)
    {
        $this->city = $val;
    }

    public function set_district($val)
    {
        $this->district = $val;
    }

    public function set_taluko($val)
    {
        $this->taluko = $val;
    }

    public function set_state($val)
    {
        $this->state = $val;
    }

    public function set_role_id($val)
    {
        $this->role_id = $val;
    }

    public function set_role_name($val)
    {
        $this->role_name = $val;
    }

    public function set_biz_comission($val)
    {
        $this->biz_comission = $val;
    }

    public function set_add_date($val)
    {
        $this->add_date = $val;
    }

    public function set_add_by($val)
    {
        $this->add_by = $val;
    }

    public function set_modify_date($val)
    {
        $this->modify_date = $val;
    }

    public function set_modify_by($val)
    {
        $this->modify_by = $val;
    }

    function set_fields($val)
    {
        $this->fields = $val;
    }

    function set_term($val)
    {
        $this->term = $val;
    }

    public function check_admin_login()
    {
        $collection = DB::table($this->table)->where('status', 'Active')
            ->where('mobile', $this->mobile)
            ->get();
        return $collection->toArray();
    }

    public function get_login_user_details()
    {
        $collection = DB::table($this->table)->where('users.status', 'Active')
            ->where('id', $this->id)
            ->get();

        return $collection->toArray();
    }

    public function get_company_by_id()
    {
        /* $collection = DB::table($this->table)
             ->where('id', $this->id)
             ->get();
         return $collection->toArray();*/

        $sql = "
         	SELECT $this->table.*,`site_settings`.setting_kg_price
         	FROM $this->table
         	LEFT JOIN site_settings ON site_settings.setting_add_by = users.id
         	WHERE $this->table.id=$this->id
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_user_list($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }

        $sql = "
         	SELECT `id`,`biz_name`,`f_name`,`m_name`,`l_name`,`email`,`mobile`,`city`,`status`,`biz_verification_status`,`hsn_no`
         	FROM $this->table
         	WHERE $this->table.role_id= $this->role_id
         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_user_list_post($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';

        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            users.id LIKE '%" . $search . "%'
            OR
            agent.biz_name LIKE '%" . $search . "%'
            OR
            users.f_name LIKE '%" . $search . "%'
            OR
            users.email LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            users.mobile LIKE '%" . $search . "%'
             OR
            users.city LIKE '%" . $search . "%'
            OR
            users.status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT $this->table.`id`,$this->table.`f_name`,$this->table.`m_name`,$this->table.`l_name`,$this->table.`email`,$this->table.`mobile`,$this->table.`city`,$this->table.`status`,$this->table.`biz_verification_status`,$this->table.`hsn_no`,
         	agent.biz_name
         	FROM $this->table
         	LEFT JOIN users as agent ON agent.id = $this->table.biz_id
         	WHERE $this->table.role_id= $this->role_id
         	$con
         	$search_con
         	ORDER BY users.$order $dir
         	LIMIT $start, $limit
		";


        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_user_post($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            id LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            f_name LIKE '%" . $search . "%'
            OR
            email LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
             OR
            city LIKE '%" . $search . "%'
            OR
            status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT $this->table.`id`,$this->table.`f_name`,$this->table.`m_name`,$this->table.`l_name`,$this->table.`email`,$this->table.`mobile`,$this->table.`city`,$this->table.`status`,$this->table.`biz_verification_status`,$this->table.`hsn_no`,
         	$this->table.`biz_name`
         	FROM $this->table
         	WHERE $this->table.role_id= $this->role_id
         	AND $this->table.role_name = '$this->role_name'
         	$con
         	$search_con
         	ORDER BY $order $dir
         	LIMIT $start, $limit
		";
       // echo "<pre>";print_r($sql);die;

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_user_post_count($role_id, $user_id, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            id LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            f_name LIKE '%" . $search . "%'
            OR
            email LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
             OR
            city LIKE '%" . $search . "%'
            OR
            status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT count(`id`) as total
         	FROM $this->table
         WHERE $this->table.role_id= $this->role_id
         	AND $this->table.role_name = '$this->role_name'
         	$con
         	$search_con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_user_list_post_count($role_id, $user_id, $search = '')
    {

        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            $this->table.id LIKE '%" . $search . "%'
            OR
            CONCAT(users.`f_name`,' ',users.`m_name` ,' ',users.`l_name`) LIKE '%" . $search . "%'
            OR
            $this->table.f_name LIKE '%" . $search . "%'
            OR
            $this->table.email LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            $this->table.mobile LIKE '%" . $search . "%'
             OR
            $this->table.city LIKE '%" . $search . "%'
            OR
            $this->table.status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT count($this->table.id) as total
         	FROM $this->table
         	WHERE $this->table.role_id= $this->role_id
         	$con
         	$search_con
		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function get_agent_list($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.id = $user_id";
        }

        $sql = "
         	SELECT `id`,`biz_name`
         	FROM $this->table
         	WHERE $this->table.role_id='4'
         	AND $this->table.role_name ='Agent'
         	AND $this->table.status ='Active'
         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function check_user_for_edit()
    {
        $collection = DB::table($this->table)
            ->where('id', $this->id)
            ->where('role_id', $this->role_id)
            ->get();
        return $collection->toArray();
    }

    public function get_user_details()
    {
        $collection = DB::table($this->table)
            ->where('id', $this->id)
            ->get();
        return $collection->toArray();
    }

    public function get_user_name_by_id($id)
    {
        $collection = DB::table($this->table)
            ->select('f_name', 'm_name', 'l_name')
            ->where('id', $id)
            ->get();
        return $collection->toArray();
    }

    public function get_password_user_details()
    {
        $collection = DB::table($this->table)
            ->select('password')
            ->where('id', $this->id)
            ->get();
        return $collection->toArray();
    }

    public function admin_count()
    {
        $sql = "
         	SELECT count($this->table.id) as admin_count
         	FROM $this->table
         	WHERE $this->table.role_id='1'
         	AND $this->table.role_name ='Admin';
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function seller_count($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "
         	SELECT count($this->table.id) as seller_count
         	FROM $this->table
         	WHERE $this->table.role_id='2'
         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function seller_data($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "
                SELECT CONCAT(`f_name`,' ',`l_name` , ' - (',`mobile`,')') as seller_name,id
                FROM $this->table
                WHERE $this->table.role_id='2'
                AND $this->table.role_name ='Farmer'
                AND $this->table.status !='Inactive'
                $con
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_user_data_by_id($id)
    {
        $sql = "
        SELECT id,city,biz_name,biz_id,state,biz_id,pan_no,
                CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,mobile
                FROM $this->table
                WHERE $this->table.id=$id;
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_farmer_by_biz_id($id)
    {
        $sql = "
        SELECT id,city,biz_name,biz_id,
                CONCAT(`biz_name`,' (',`f_name`,' ',`l_name` , ' - (',`mobile`,'))') as name,mobile,
                CONCAT(`f_name`,' ',`m_name`,' ',`l_name`) as farmer_name
                FROM $this->table
                WHERE $this->table.biz_id = $id
                AND $this->table.role_id='2'
                AND $this->table.role_name ='Farmer';
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_buyer_by_biz_id($id)
    {
        $sql = "
        SELECT id,city,biz_name,biz_id,
                CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,
                CONCAT(`f_name`,' ',`m_name`,' ',`l_name`) as buyer_name,mobile
                FROM $this->table
                WHERE $this->table.biz_id = $id
                AND $this->table.role_id='3'
                AND $this->table.role_name ='Buyer';
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_buyer_list($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        $sql = "
        SELECT id,city,biz_name,biz_id,
                CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,
                CONCAT(`f_name`,' ',`m_name`,' ',`l_name`) as buyer_name,mobile
                FROM $this->table
                WHERE $this->table.role_id='3'
                AND $this->table.role_name ='Buyer'
                 AND $this->table.status ='Active'
                 $con
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function agent_count()
    {
        $sql = "
         	SELECT count($this->table.id) as agent_count
         	FROM $this->table
         	WHERE $this->table.role_id='4';
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function buyer_count($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "
         	SELECT count($this->table.id) as buyer_count
         	FROM $this->table
         	WHERE $this->table.role_id='3'
         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function buyer_data($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "
                SELECT CONCAT(`f_name`,' ',`l_name` , ' - (',`mobile`,')') as buyer_name,id
                FROM $this->table
                WHERE $this->table.role_id='3'
                AND $this->table.role_name ='Buyer'
                $con
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function is_unique_mobile($mobile,$user_id)
    {
        $sql = "
         	SELECT $this->table.id
         	FROM $this->table
         	WHERE ($this->table.mobile = '$mobile' OR $this->table.biz_tel_no = '$mobile' )

		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function is_unique_mobile_by_user_id($mobile,$user_id)
    {
        $sql = "
         	SELECT $this->table.id
         	FROM $this->table
         	WHERE ($this->table.mobile = '$mobile' OR $this->table.biz_tel_no = '$mobile')
            AND  $this->table.id != $user_id;
		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function is_unique_email()
    {
        $sql = "
         	SELECT $this->table.id
         	FROM $this->table
         	WHERE $this->table.email='$this->email'
         	AND $this->table.id !='$this->id';
		";
        //echo $sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function insert_user_details()
    {
        return DB::table($this->table)->insertGetId(
            [
                'biz_name' => $this->biz_name,
                'biz_id' => $this->biz_id,
                'f_name' => $this->f_name,
                'm_name' => $this->m_name,
                'l_name' => $this->l_name,
                'nick_name' => $this->nick_name,
                'email' => $this->email,
                'password' => $this->password,
                'mobile' => $this->mobile,
                'status' => $this->status,
                'biz_verification_status' => $this->biz_verification_status,
                'hsn_no' => $this->hsn_no,
                'pan_no' => $this->pan_no,
                'gstin_no' => $this->gstin_no,
                'aadhar_no' => $this->aadhar_no,
                'address1' => $this->address1,
                'address2' => $this->address2,
                'city' => $this->city,
                'district' => $this->district,
                'taluko' => $this->taluko,
                'state' => $this->state,
                'role_id' => $this->role_id,
                'role_name' => $this->role_name,
                'biz_comission' => $this->biz_comission,
                'biz_subject_name' => $this->biz_subject_name,
                'biz_market_name' => $this->biz_market_name,
                'biz_tel_no' => $this->biz_tel_no,
                'biz_logo' => $this->biz_logo,
                'biz_mobile' => $this->biz_mobile,
                'biz_type' => $this->biz_type,
                'biz_nick_name' => $this->biz_nick_name,
                'add_date' => $this->add_date,
                'add_by' => $this->add_by
            ]
        );
    }

    public function update_user_detils()
    {
        return DB::table($this->table)
            ->where('id', $this->id)
            ->update([
                    'biz_name' => $this->biz_name,
                    'biz_id' => $this->biz_id,
                    'f_name' => $this->f_name,
                    'm_name' => $this->m_name,
                    'l_name' => $this->l_name,
                    'nick_name' => $this->nick_name,
                    'email' => $this->email,
                    'mobile' => $this->mobile,
                    'status' => $this->status,
                    'biz_verification_status' => $this->biz_verification_status,
                    'hsn_no' => $this->hsn_no,
                    'pan_no' => $this->pan_no,
                    'gstin_no' => $this->gstin_no,
                    'aadhar_no' => $this->aadhar_no,
                    'address1' => $this->address1,
                    'address2' => $this->address2,
                    'city' => $this->city,
                    'district' => $this->district,
                    'taluko' => $this->taluko,
                    'state' => $this->state,
                    'role_id' => $this->role_id,
                    'role_name' => $this->role_name,
                    'biz_comission' => $this->biz_comission,
                    'biz_subject_name' => $this->biz_subject_name,
                    'biz_market_name' => $this->biz_market_name,
                    'biz_tel_no' => $this->biz_tel_no,
                    'biz_logo' => $this->biz_logo,
                    'biz_mobile' => $this->biz_mobile,
                    'biz_type' => $this->biz_type,
                    'biz_nick_name' => $this->biz_nick_name,
                    'add_date' => $this->add_date,
                    'add_by' => $this->add_by,
                    'modify_date' => $this->modify_date,
                    'modify_by' => $this->modify_by
                ]
            );

    }

    public function update_password()
    {
        return DB::table($this->table)
            ->where('id', $this->id)
            ->update(['password' => $this->password
            ]);
    }

    public function change_status()
    {
        return DB::table($this->table)
            ->where('id', $this->id)
            ->update(['status' => $this->status
            ]);
    }

    public function update_site_setting_user_data()
    {

        return DB::table($this->table)
            ->where('id', $this->id)
            ->update([
                'biz_comission' => $this->biz_comission,
                'hsn_no' => $this->hsn_no,
                'gstin_no' => $this->gstin_no,
                'pan_no' => $this->pan_no,
                'aadhar_no' => $this->aadhar_no,

            ]);
    }

    public function select_field_by_id()
    {
        return DB::table($this->table)
            ->select($this->fields)
            ->where('id', $this->id)
            ->get();
    }
    public function get_image_by_id($id)
    {
        $collection = DB::table($this->table)
            ->select($this->fields)
            ->where('id', $id)
            ->get();
        return $collection->toArray();
    }

    public function auth_user_role()
    {
        $collection = DB::table($this->table)
            ->join('role', 'role.r_id', '=', 'users.role_id')
            ->select([
                'users.id',
                'users.status',
                'users.role_id',
                'role.r_id',
                'role.r_type'
            ])
            ->where('role.r_status', 'Active')
            ->where('id', $this->id)
            ->get();
        return $collection->toArray();
    }

    public function select_title_by_term_for_user($role_id, $user_id)
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "SELECT id,city,biz_name,biz_id,state,biz_id,pan_no,
                CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,mobile,
                biz_id,biz_name
            FROM $this->table
            WHERE (`f_name` LIKE '%$this->term%'
            OR `m_name` LIKE '%$this->term%'
            OR `l_name` LIKE '%$this->term%'
            OR concat_ws(' ',`f_name`,`l_name`) LIKE '%$this->term%'
            OR concat_ws(' ',`f_name`,`m_name`,`l_name`) LIKE '%$this->term%'
            OR `mobile` LIKE '%$this->term%'
            OR `biz_name` LIKE '%$this->term%'
            OR `users`.id LIKE '%$this->term%'
            )
            AND $this->table.role_id='3'
                AND $this->table.role_name ='Buyer'
                AND $this->table.status !='Inactive'
            $con
            LIMIT 0,10
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function select_title_by_term_and_biz_id($role_id, $user_id, $biz_id)
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "SELECT id,city,biz_name,biz_id,state,biz_id,pan_no,
                CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,mobile,
                biz_id,biz_name
            FROM $this->table
            WHERE (`f_name` LIKE '%$this->term%'
            OR `m_name` LIKE '%$this->term%'
            OR `l_name` LIKE '%$this->term%'
            OR concat_ws(' ',`f_name`,`l_name`) LIKE '%$this->term%'
            OR concat_ws(' ',`f_name`,`m_name`,`l_name`) LIKE '%$this->term%'
            OR `mobile` LIKE '%$this->term%'
            OR `biz_name` LIKE '%$this->term%'
            OR `users`.id LIKE '%$this->term%'
            )
            AND $this->table.role_id='3'
           AND $this->table.role_name ='Buyer'
           AND $this->table.biz_id ='$biz_id'
           AND $this->table.status !='Inactive'
            $con
            LIMIT 0,10
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_farmer_list($role_id, $user_id){
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.biz_id = $user_id";
        }
        $sql = "
         	SELECT $this->table.`id`,$this->table.`f_name`,$this->table.`m_name`,$this->table.`l_name`,$this->table.`email`,$this->table.`mobile`,$this->table.`city`,$this->table.`district`,$this->table.`state`,$this->table.`status`
         	FROM $this->table
         	LEFT JOIN users as agent ON agent.id = $this->table.biz_id
         	WHERE $this->table.role_id= $this->role_id
         	AND  $this->table.status = 'Active'
            $con
		";


        $results = DB::select(DB::raw($sql));
        return $results;

     }

    public function get_farmer_data_fetch($mobile){
      $sql = "
         	SELECT $this->table.`id`,$this->table.`f_name`,$this->table.`m_name`,$this->table.`l_name`,$this->table.`email`,$this->table.`mobile`,$this->table.`city`,$this->table.`status`,$this->table.`biz_verification_status`,$this->table.`hsn_no`
         	FROM $this->table
         	WHERE $this->table.role_id= $this->role_id
            AND $this->table.mobile = '$mobile'
		";

        $results = DB::select(DB::raw($sql));
        return $results;

    }

    public function get_buyer_by_id($mobile){
        $sql = "
         	SELECT $this->table.`id`,$this->table.`f_name`,$this->table.`m_name`,$this->table.`state`,$this->table.`l_name`,$this->table.`email`,$this->table.`mobile`,$this->table.`city`,$this->table.`status`,$this->table.`biz_verification_status`,$this->table.`hsn_no`,
         	agent.biz_name
         	FROM $this->table
         	LEFT JOIN users as agent ON agent.id = $this->table.biz_id
         	WHERE $this->table.role_id= 3
            AND $this->table.mobile = '$mobile'
		";


        $results = DB::select(DB::raw($sql));
        return $results;

    }

    public function get_farmer_by_id($mobile){
        $sql = "
         	SELECT $this->table.`id`,$this->table.`f_name`,$this->table.`m_name`,$this->table.`l_name`,$this->table.`email`,$this->table.`mobile`,$this->table.`city`,$this->table.`status`,$this->table.`biz_verification_status`,$this->table.`hsn_no`,
         	agent.biz_name,$this->table.biz_id
         	FROM $this->table
         	LEFT JOIN users as agent ON agent.id = $this->table.biz_id
         	WHERE $this->table.role_id= 2
            AND $this->table.mobile = '$mobile'
		";


        $results = DB::select(DB::raw($sql));
        return $results;

    }

    public function insert_farmer_details($biz_id,$mobile,$city,$name,$m_name,$l_name,$buyer_district,$buyer_state,$user_id)
    {
        $add_date = date('Y-m-d H:i:s');
        return DB::table($this->table)->insertGetId(
            [
                'biz_id' => $biz_id,
                'mobile' => $mobile,
                'f_name'=>$name,
                'm_name'=>$m_name,
                'l_name'=>$l_name,
                'status' => 'Active',
                'biz_verification_status' => 'Active',
                'city' => $city,
                'role_id'=>$this->role_id,
                'district' =>$buyer_district,
                'state' => $buyer_state,
                'add_by' => $user_id,
                'add_date' => $add_date
            ]
        );
    }


}
