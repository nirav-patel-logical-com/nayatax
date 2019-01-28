<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsignmentProducts extends Model
{
    protected $table = 'biz_consignment_product';

    protected $bzcp_id = '';
    protected $bzcp_bzc_id = '';
    protected $bzcp_consignment_no = '';
    protected $bzcp_biz_id = '';
    protected $bzcp_seller_id = '';
    protected $bzcp_weight = '';
    protected $bzcp_price = '';
    protected $bzcp_gt_id = '';
    protected $bzcp_add_date = '';
    protected $bzcp_add_by = '';
    protected $bzcp_modify_date = '';
    protected $bzcp_modify_by = '';
    protected $bzcp_bags='';

    public function set_bzcp_id($val)
    {
        $this->bzcp_id = $val;
    }

    public function set_bzcp_biz_id($val)
    {
        $this->bzcp_biz_id = $val;
    }

    public function set_bzcp_bzc_id($val)
    {
        $this->bzcp_bzc_id = $val;
    }

    public function set_bzcp_consignment_no($val)
    {
        $this->bzcp_consignment_no = $val;
    }

    public function set_bzcp_weight($val)
    {
        $this->bzcp_weight = $val;
    }

    public function set_bzcp_seller_id($val)
    {
        $this->bzcp_seller_id = $val;
    }

    public function set_bzcp_price($val)
    {
        $this->bzcp_price = $val;
    }

    public function set_bzcp_gt_id($val)
    {
        $this->bzcp_gt_id = $val;
    }

    public function set_bzcp_add_date($val)
    {
        $this->bzcp_add_date = $val;
    }

    public function set_bzcp_add_by($val)
    {
        $this->bzcp_add_by = $val;
    }

    public function set_bzcp_modify_date($val)
    {
        $this->bzcp_modify_date = $val;
    }

    public function set_bzcp_modify_by($val)
    {
        $this->bzcp_modify_by = $val;
    }
    public function set_bzcp_bags($val){
        $this->bzcp_bags = $val;
    }

    public function insert_product_data()
    {
        return DB::table($this->table)->insertGetId(
            [
                'bzcp_bzc_id' => $this->bzcp_bzc_id,
                'bzcp_biz_id' => $this->bzcp_biz_id,
                'bzcp_consignment_no' => $this->bzcp_consignment_no,
                'bzcp_weight' => $this->bzcp_weight,
                'bzcp_bags' => $this->bzcp_bags,
                'bzcp_seller_id' => $this->bzcp_seller_id,
                'bzcp_price' => $this->bzcp_price,
                'bzcp_gt_id' => $this->bzcp_gt_id,
                'bzcp_add_date' => $this->bzcp_add_date,
                'bzcp_add_by' => $this->bzcp_add_by
            ]
        );
    }

    public function update_product_data()
    {
        return DB::table($this->table)
            ->where('bzcp_id', $this->bzcp_id)
            ->update(
                [
                    'bzcp_biz_id' => $this->bzcp_biz_id,
                    'bzcp_consignment_no' => $this->bzcp_consignment_no,
                    'bzcp_weight' => $this->bzcp_weight,
                    'bzcp_bags' => $this->bzcp_bags,
                    'bzcp_seller_id' => $this->bzcp_seller_id,
                    'bzcp_price' => $this->bzcp_price,
                    'bzcp_gt_id' => $this->bzcp_gt_id,
                    'bzcp_modify_date' => $this->bzcp_modify_date,
                    'bzcp_modify_by' => $this->bzcp_modify_by
                ]
            );
    }

    public function update_price()
    {
        return DB::table($this->table)
            ->where('bzcp_id', $this->bzcp_id)
            ->update(
                [
                    'bzcp_price' => $this->bzcp_price
                ]
            );
    }

    public function update_weight()
    {
        return DB::table($this->table)
            ->where('bzcp_id', $this->bzcp_id)
            ->update(
                [
                    'bzcp_weight' => $this->bzcp_weight
                ]
            );
    }

    public function update_data()
    {
        return DB::table($this->table)
            ->where('bzcp_id', $this->bzcp_id)
            ->update(
                [
                    'bzcp_price' => $this->bzcp_price,
                    'bzcp_weight' => $this->bzcp_weight,
                    'bzcp_bags' => $this->bzcp_bags,

                ]
            );
    }

    public function update_qty_data($bpi_bzc_id, $bpi_biz_id, $bpi_saller_id)
    {
        return DB::table($this->table)
            ->where('bzcp_bzc_id', $bpi_bzc_id)
            ->where('bzcp_biz_id', $bpi_biz_id)
            ->where('bzcp_seller_id', $bpi_saller_id)
            ->update(
                [
                    'bzcp_weight' => $this->bzcp_weight
                ]
            );
    }

    public function get_consignment($bpi_bzc_id, $bpi_biz_id, $bpi_saller_id)
    {
        $collection = DB::table($this->table)
            ->where('bzcp_bzc_id', $bpi_bzc_id)
            ->where('bzcp_biz_id', $bpi_biz_id)
            ->where('bzcp_seller_id', $bpi_saller_id)
            ->get();
        return $collection->toArray();
    }

    public function get_stock_in_data($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "WHERE $this->table.bzcp_biz_id = $user_id";
        }
        $sql = "
         	SELECT $this->table.bzcp_id,
         	$this->table.bzcp_weight,
         	$this->table.bzcp_bags,
         	saller_invoice.si_id,
         	CASE
                WHEN `site_settings`.setting_kg_price = '20/Kg' THEN bzcp_price * REPLACE(`site_settings`.setting_kg_price, '/Kg', '')
                WHEN `site_settings`.setting_kg_price = '1/Kg' THEN   bzcp_price
                ELSE bzcp_price
            END AS bzcp_price,

         	CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,`users`.mobile,`users`.biz_id,`users`.biz_name,`goods_type`.gt_type,`users`.id,`site_settings`.setting_kg_price
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = users.biz_id
         	LEFT JOIN saller_invoice ON saller_invoice.si_biz_id = users.biz_id AND saller_invoice.si_saller_id = $this->table.bzcp_seller_id

         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id

         	$con
         	ORDER BY $this->table.bzcp_id DESC
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_stock_in_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bzcp_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
                bzcp_id LIKE '%" . $search . "%'
            OR
            bzcp_weight LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
            OR
            bzcp_price LIKE '%" . $search . "%'
            OR
            (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND `buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No'
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                 -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`. 	spi_farmer_bill_generated = 'Yes'  AND `saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT DISTINCT $this->table.bzcp_id,
         	$this->table.bzcp_weight,
         	$this->table.bzcp_bags,
            CASE
                WHEN `site_settings`.setting_kg_price = '20/Kg' THEN $this->table.bzcp_price * REPLACE(`site_settings`.setting_kg_price, '/Kg', '')
                WHEN `site_settings`.setting_kg_price = '1/Kg' THEN   $this->table.bzcp_price
                ELSE $this->table.bzcp_price
            END AS bzcp_price,
             (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND `buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No'
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                 -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`. 	spi_farmer_bill_generated = 'Yes'  AND `saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) as remain_weight,
           CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,
         	`users`.mobile,`users`.biz_id,`users`.biz_name,`goods_type`.gt_type,`users`.id,`site_settings`.setting_kg_price
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = users.biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE 1
         	$con
         	$search_con
         	ORDER BY $order $dir
         	LIMIT $start, $limit
		";//echo "<pre>".$sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function get_stock_in_list_count($role_id, $user_id, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bzcp_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
                bzcp_id LIKE '%" . $search . "%'
            OR
            bzcp_weight LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
            OR
            bzcp_price LIKE '%" . $search . "%'
 OR
            (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND `buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No'
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                 -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`. 	spi_farmer_bill_generated = 'Yes'  AND `saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT count($this->table.bzcp_id) as total


         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = users.biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE 1
         	$con
         	$search_con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_stock_in_count($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "WHERE $this->table.bzcp_biz_id = $user_id";
        }
        $sql = "
         	SELECT count($this->table.bzcp_id) as stock_in_count
         	FROM $this->table
         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_stock_out_data($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "WHERE $this->table.bzcp_biz_id = $user_id";
        }
        $sql = "
         	SELECT $this->table.*,CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,`users`.mobile,`goods_type`.gt_type,`users`.id
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id

         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function get_stock_out_count($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "WHERE $this->table.bzcp_bzc_id = $user_id";
        }
        $sql = "
         	SELECT count($this->table.bzcp_id) as stock_out_count
         	FROM $this->table
         	$con
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_consignment_data_by_bzcp_id($bzcp_id)
    {
        $sql = "
         	SELECT $this->table.bzcp_id,
         	$this->table.bzcp_bzc_id,
         	$this->table.bzcp_consignment_no,
         	$this->table.bzcp_biz_id,
         	$this->table.bzcp_seller_id,
         	$this->table.bzcp_weight,
         	$this->table.bzcp_gt_id,
         	$this->table.bzcp_price,


         	CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as buyer_name,

            CONCAT(add_user.`f_name`,' ',add_user.`m_name` ,' ',add_user.`l_name`) as added_by,
         	`users`.mobile,
         	`users`.city,
         	`users`.state,
         	`goods_type`.gt_type,
         	`goods_type`.gt_hsn_no as hsn_no,
         	`site_settings`.setting_kg_price,
         	CASE
                WHEN `site_settings`.setting_kg_price = '20/Kg' THEN $this->table.bzcp_price * REPLACE(`site_settings`.setting_kg_price, '/Kg', '')
                WHEN `site_settings`.setting_kg_price = '1/Kg' THEN   $this->table.bzcp_price
                ELSE $this->table.bzcp_price
            END AS bzcp_price
         	FROM $this->table
         	LEFT JOIN buyer_product_invoice ON buyer_product_invoice.bpi_bzc_id = $bzcp_id
         	LEFT JOIN users ON users.id = buyer_product_invoice.bzcp_seller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bzcp_biz_id
         	LEFT JOIN users add_user ON add_user.id = $this->table.bzcp_add_by
         	LEFT JOIN users copmay ON copmay.id = $this->table.bzcp_biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE $this->table.bzcp_bzc_id='$bzcp_id'

		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_farmer_data_by_bzcp_id($bzcp_id, $role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bzcp_biz_id = $user_id";
        }
        $sql = "
         	SELECT CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`)as farmer_name,`users`.mobile,
         	`users`.biz_name,
            bzcp_seller_id,
            bzcp_biz_id,
            bzcp_gt_id,
            bzcp_bzc_id,
         	`users`.biz_id,
         	`users`.city,
         	`users`.state,
         	`copmay`.biz_comission,
         	`copmay`.hsn_no,
         	`goods_type`.gt_type,
         	CASE
                WHEN `site_settings`.setting_kg_price != '' THEN `site_settings`.setting_kg_price
                ELSE '1/Kg'
            END AS setting_kg_price
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN users copmay ON copmay.id = $this->table.bzcp_biz_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bzcp_biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE $this->table.bzcp_bzc_id='$bzcp_id'
         	$con

		";
        //  echo "<pre>".$sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_data_by_id($bzcp_id)
    {
        $sql = "
         	SELECT $this->table.*
         	FROM $this->table
         	WHERE $this->table.bzcp_id=$bzcp_id;
		";//echo "<pre>";echo $sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_consignment_data_by_id($bzcp_id)
    {
        $sql = "
         	SELECT $this->table.*,
         	CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as seller_name,

         	CONCAT(add_user.`f_name`,' ',add_user.`m_name` ,' ',add_user.`l_name`) as added_by,
         	`users`.biz_name,
         	`users`.mobile,
         	`users`.city,
         	`goods_type`.gt_type,
         	CASE
                WHEN `site_settings`.setting_kg_price != '' THEN `site_settings`.setting_kg_price
                ELSE '1/Kg'
            END AS setting_kg_price
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bzcp_biz_id
         	LEFT JOIN users add_user ON add_user.id = $this->table.bzcp_add_by
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE $this->table.bzcp_id=$bzcp_id;
		";//echo "<pre>";echo $sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_farmer_stock($farmer_id, $gt_id, $bzcp_bzc_id, $bpi_bi_id)
    {
        $sql = "
         	SELECT
         	CASE
                WHEN `site_settings`.setting_kg_price = '20/Kg' THEN bzcp_price * REPLACE(`site_settings`.setting_kg_price, '/Kg', '')
                WHEN `site_settings`.setting_kg_price = '1/Kg' THEN   bzcp_price
                ELSE bzcp_price
            END AS bzcp_price,

             (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND (`buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No' OR `buyer_product_invoice`.bpi_bi_id = '$bpi_bi_id')
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                 -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`. 	spi_farmer_bill_generated = 'Yes'  AND `saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) as bzcp_weight,

         	bzcp_bzc_id,

         	bzcp_gt_id,
         	bzcp_seller_id,
         	CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as seller_name,
         	`users`.biz_name,
         	`users`.mobile,
         	`users`.city,
         	`goods_type`.gt_type,
         	`goods_type`.gt_cgst_tax,
         	`goods_type`.gt_sgst_tax,
         	`goods_type`.gt_igst_tax,
         	`goods_type`.gt_is_tax_apply
         	FROM $this->table
         	LEFT JOIN users ON users.id = $this->table.bzcp_seller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bzcp_biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE $this->table.bzcp_seller_id = '$farmer_id'
         	AND $this->table.bzcp_gt_id = '$gt_id'
         	AND $this->table.bzcp_bzc_id = '$bzcp_bzc_id'
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_farmer_stock_for_buyer($farmer_id, $gt_id, $bzcp_bzc_id, $spi_si_id)
    {
        $sql = "
         	SELECT
         	CASE
                WHEN `site_settings`.setting_kg_price = '20/Kg' THEN bzcp_price * REPLACE(`site_settings`.setting_kg_price, '/Kg', '')
                WHEN `site_settings`.setting_kg_price = '1/Kg' THEN   bzcp_price
                ELSE bzcp_price
            END AS bzcp_price,

             (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND (`buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No')
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`.spi_farmer_bill_generated != 'No'  AND `saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) as bzcp_weight,

         	bzcp_bzc_id,
            bzcp_gt_id,
            bzcp_id,

         	`goods_type`.gt_type,
         	`goods_type`.gt_hsn_no,
         	`goods_type`.gt_cgst_tax,
         	`goods_type`.gt_sgst_tax,
         	`goods_type`.gt_igst_tax,
         	`goods_type`.gt_is_tax_apply
         	FROM $this->table
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bzcp_biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE $this->table.bzcp_seller_id = '$farmer_id'
         	AND $this->table.bzcp_gt_id = '$gt_id'
         	AND $this->table.bzcp_bzc_id = '$bzcp_bzc_id'
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_consignment_data_by_biz_id($biz_id)
    {
        $sql = "
         	SELECT DISTINCT  bzcp_gt_id, `goods_type`.gt_type
         	FROM biz_consignment_product
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE $this->table.bzcp_biz_id = $biz_id
         	AND goods_type.gt_status = 'Active'
         	AND
         	 (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND (`buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No')
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) > 0

		";
        // echo "<pre>".$sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_farmer_data_by_biz_id($biz_id)
    {
        $sql = "
         	SELECT  DISTINCT bzcp_seller_id, CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as seller_name
         	FROM biz_consignment_product
         	LEFT JOIN users ON users.id = biz_consignment_product.bzcp_seller_id
         	WHERE $this->table.bzcp_biz_id = $biz_id
         	AND
         	 (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND (`buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No')
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) > 0
                GROUP BY bzcp_seller_id,`users`.`f_name`,`users`.`m_name`,`users`.`l_name`
		";
        // echo "<pre>".$sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_goods_data_by_farmer_id($farmer_id, $company_id)
    {
        $sql = "
         	SELECT  DISTINCT  bzcp_gt_id, `goods_type`.gt_type,bzcp_bzc_id
         	FROM biz_consignment_product
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bzcp_gt_id
         	WHERE biz_consignment_product.bzcp_seller_id = '$farmer_id'
         	AND goods_type.gt_status = 'Active'
         	AND biz_consignment_product.bzcp_biz_id = '$company_id'
         	AND (
                $this->table.bzcp_weight
                -
                IFNULL((
                SELECT sum(`buyer_product_invoice`.bpi_weight)
                FROM `buyer_product_invoice`
                WHERE `buyer_product_invoice`.bpi_bzc_id = $this->table.bzcp_bzc_id
                AND (`buyer_product_invoice`.bpi_is_buyer_bill_generate != 'No')
                GROUP BY `buyer_product_invoice`.bpi_bzc_id
                ),0)
                -
                IFNULL((
                SELECT sum(`saller_product_invoice`.spi_weight)
                FROM `saller_product_invoice`
                WHERE `saller_product_invoice`.spi_bzc_id = $this->table.bzcp_bzc_id
                AND (`saller_product_invoice`.spi_buyer_bill_generated = 'No')
                GROUP BY `saller_product_invoice`.spi_bzc_id
                ),0)
                ) > 0

		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

}
