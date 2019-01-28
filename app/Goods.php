<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
    protected $table = 'goods_type';

    protected $gt_id = '';
    protected $gt_type = '';
    protected $gt_biz_id = '';
    protected $gt_cgst_tax = '';
    protected $gt_sgst_tax = '';
    protected $gt_igst_tax = '';
    protected $gt_status = '';
    protected $gt_is_tax_apply = '';
    protected $gt_add_date = '';
    protected $gt_add_by = '';
    protected $gt_modify_date = '';
    protected $gt_modify_by = '';
    protected $gt_hsn_no = '';
    public function set_gt_id($val)
    {
        $this->gt_id = $val;
    }

    public function set_gt_biz_id($val)
    {
        $this->gt_biz_id = $val;
    }

    public function set_gt_type($val)
    {
        $this->gt_type = $val;
    }

    public function set_gt_cgst_tax($val)
    {
        $this->gt_cgst_tax = $val;
    }

    public function set_gt_sgst_tax($val)
    {
        $this->gt_sgst_tax = $val;
    }

    public function set_gt_igst_tax($val)
    {
        $this->gt_igst_tax = $val;
    }

    public function set_gt_status($val)
    {
        $this->gt_status = $val;
    }

    public function set_gt_add_date($val)
    {
        $this->gt_add_date = $val;
    }

    public function set_gt_is_tax_apply($val)
    {
        $this->gt_is_tax_apply = $val;
    }

    public function set_gt_add_by($val)
    {
        $this->gt_add_by = $val;
    }

    public function set_gt_modify_date($val)
    {
        $this->gt_modify_date = $val;
    }

    public function set_gt_modify_by($val)
    {
        $this->gt_modify_by = $val;
    }

    public function set_gt_hsn_no($val)
    {
        $this->gt_hsn_no = $val;
    }


    public function insert_goods_type_data()
    {
        return DB::table($this->table)->insertGetId(
            [
                'gt_biz_id' => $this->gt_biz_id,
                'gt_hsn_no' => $this->gt_hsn_no,
                'gt_cgst_tax' => $this->gt_cgst_tax,
                'gt_sgst_tax' => $this->gt_sgst_tax,
                'gt_igst_tax' => $this->gt_igst_tax,
                'gt_type' => $this->gt_type,
                'gt_status' => $this->gt_status,
                'gt_add_date' => $this->gt_add_date,
                'gt_is_tax_apply' => $this->gt_is_tax_apply,
                'gt_add_by' => $this->gt_add_by

            ]
        );
    }

    public function insert_goods_type_data_by_type($good_type,$hsn_no,$cgst_tax,$sgst_tax,$igst_tax,$tex,$login_user)
    {
        return DB::table($this->table)->insertGetId(
            [
                'gt_type' => $good_type,
                'gt_hsn_no' => $hsn_no,
                'gt_cgst_tax' => $cgst_tax,
                'gt_sgst_tax' => $sgst_tax,
                'gt_igst_tax' => $igst_tax,
                'gt_is_tax_apply' => $tex,
                'gt_biz_id'=>$login_user,
                'gt_add_by'=>$login_user,
                'gt_status'=>'Active'

            ]
        );
    }

    public function update_goods_type_data()
    {
        return DB::table($this->table)
            ->where('gt_id', $this->gt_id)
            ->update(
                [
                    'gt_biz_id' => $this->gt_biz_id,
                    'gt_hsn_no' => $this->gt_hsn_no,
                    'gt_cgst_tax' => $this->gt_cgst_tax,
                    'gt_sgst_tax' => $this->gt_sgst_tax,
                    'gt_igst_tax' => $this->gt_igst_tax,
                    'gt_status' => $this->gt_status,
                    'gt_add_date' => $this->gt_add_date,
                    'gt_is_tax_apply' => $this->gt_is_tax_apply,
                    'gt_add_by' => $this->gt_add_by,
                    'gt_modify_date' => $this->gt_modify_date,
                    'gt_modify_by' => $this->gt_modify_by,
                    'gt_type' => $this->gt_type
                ]
            );
    }

    public function change_status()
    {
        return DB::table($this->table)
            ->where('gt_id', $this->gt_id)
            ->update(['gt_status' => $this->gt_status
            ]);
    }

    public function get_goods_type($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "where $this->table.gt_biz_id = $user_id";
        }
        $sql = "
                SELECT *
                FROM $this->table
                $con
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_goods_type_list($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.gt_biz_id = $user_id";
        }
        $sql = "
                SELECT *
                FROM $this->table
                 WHERE $this->table.gt_status ='Active'
                 $con
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_good_type_by_gt_id($bi_gt_id)
    {

        $sql = "
                SELECT GROUP_CONCAT(goods_type.`gt_type`) as gt_type
                FROM $this->table
                WHERE gt_id IN($bi_gt_id)

            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_good_type_by_id($good_type,$user_id,$role_id){
        $con = '';
        if (isset($user_id)&& !empty($user_id)) {
            $con = "AND $this->table.gt_biz_id = $user_id";
        }
        $sql = "
                SELECT  *
                FROM $this->table
                WHERE gt_type = '$good_type'
                $con
            ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_good_type_by_id_buyer($good_type,$user_id,$role_id){
        $con = '';
        if ($role_id != 1) {
            $con = "where $this->table.gt_biz_id = $user_id";
        }
        $sql = "
                SELECT  *
                FROM $this->table
                WHERE gt_type = '$good_type'
                $con
            ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_hsn_no_by_gt_id()
    {

         $sql = "
                SELECT  gt_hsn_no
                FROM $this->table
                WHERE gt_id = $this->gt_id

            ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }



    public function get_goods_type_list_post($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.gt_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            if ($search === 'yes') {
                $search = 'True';
            }
            if ($search === 'no') {
                $search = 'False';
            }
            $search_con = "AND (
            gt_id LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            gt_status LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
            OR
            gt_hsn_no LIKE '%" . $search . "%'
            OR
            gt_is_tax_apply LIKE '%" . $search . "%'

            )";
        }
        $sql = "
                SELECT *,users.biz_name
                FROM $this->table
                LEFT JOIN users ON users.id = $this->table.gt_biz_id
                WHERE 1
                $con
                $search_con
                ORDER BY $order $dir
         	LIMIT $start, $limit
            ";
        //echo "<pre>";echo $sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_goods_type_list_count($role_id, $user_id, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.gt_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            if ($search == 'yes') {
                $search = 'True';
            }
            if ($search == 'no') {
                $search = 'False';
            }
            $search_con = "AND (
            gt_id LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            gt_status LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
             OR
            gt_hsn_no LIKE '%" . $search . "%'
            OR
            gt_is_tax_apply LIKE '%" . $search . "%'

            )";
        }
        $sql = "
                SELECT count(gt_id) as total
                FROM $this->table
                LEFT JOIN users ON users.id = $this->table.gt_biz_id
                WHERE 1
                $con
                $search_con
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_goods_type_by_id()
    {

        $sql = "
         	SELECT $this->table.*,users.biz_name
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.gt_biz_id
         	WHERE  $this->table.gt_id ='$this->gt_id'

		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_goods_type_by_biz_id($biz_id)
    {
        $collection = DB::table($this->table)
            ->where('gt_biz_id', $biz_id)
            ->where('gt_status', 'Active')
            ->get();
        return $collection->toArray();
    }

    public function check_goods_for_update()
    {
        $collection = DB::table($this->table)
            ->where('gt_id', $this->gt_id)
            ->get();
        return $collection->toArray();
    }

    public function check_unique_name()
    {
        $sql = "
         	SELECT $this->table.gt_id
         	FROM $this->table
         	WHERE $this->table.gt_type='$this->gt_type'
         	AND $this->table.gt_id !='$this->gt_id'
         	AND $this->table.gt_biz_id ='$this->gt_biz_id';
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

}
