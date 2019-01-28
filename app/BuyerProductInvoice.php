<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuyerProductInvoice extends Model
{
    protected $table = 'buyer_product_invoice';

    protected $bpi_id = '';
    protected $bpi_bi_id = '';
    protected $bpi_invoice_no = '';
    protected $bpi_biz_id = '';
    protected $bpi_saller_id = '';
    protected $bpi_gt_id = '';
    protected $bpi_bzc_id = '';
    protected $bpi_no_of_bags = '';
    protected $bpi_weight = '';
    protected $bpi_bid_price = '';
    protected $bpi_sgst = '';
    protected $bpi_cgst = '';
    protected $bpi_igst = '';
    protected $bpi_cgst_price = '';
    protected $bpi_sgst_price = '';
    protected $bpi_igst_price = '';
    protected $bpi_amount = '';
    protected $bpi_total = '';
    protected $bpi_payment_status = '';
    protected $bpi_add_date = '';
    protected $bpi_add_by = '';
    protected $bpi_modify_date = '';
    protected $bpi_modify_by = '';
    protected $bpi_is_farmer_bill_generate = '';
    protected $bpi_is_buyer_bill_generate = '';


    public function set_bpi_id($val)
    {
        $this->bpi_id = $val;
    }

    public function set_bpi_is_farmer_bill_generate($val)
    {
        $this->bpi_is_farmer_bill_generate = $val;
    }

    public function set_bpi_is_buyer_bill_generate($val)
    {
        $this->bpi_is_buyer_bill_generate = $val;
    }

    public function set_bpi_bi_id($val)
    {
        $this->bpi_bi_id = $val;
    }

    public function set_bpi_saller_id($val)
    {
        $this->bpi_saller_id = $val;
    }

    public function set_bpi_invoice_no($val)
    {
        $this->bpi_invoice_no = $val;
    }

    public function set_bpi_biz_id($val)
    {
        $this->bpi_biz_id = $val;
    }

    public function set_bpi_gt_id($val)
    {
        $this->bpi_gt_id = $val;
    }

    public function set_bpi_bzc_id($val)
    {
        $this->bpi_bzc_id = $val;
    }

    public function set_bpi_no_of_bags($val)
    {
        $this->bpi_no_of_bags = $val;
    }

    public function set_bpi_weight($val)
    {
        $this->bpi_weight = $val;
    }

    public function set_bpi_bid_price($val)
    {
        $this->bpi_bid_price = $val;
    }

    public function set_bpi_sgst($val)
    {
        $this->bpi_sgst = $val;
    }

    public function set_bpi_cgst($val)
    {
        $this->bpi_cgst = $val;
    }

    public function set_bpi_igst($val)
    {
        $this->bpi_igst = $val;
    }

    public function set_bpi_cgst_price($val)
    {
        $this->bpi_cgst_price = $val;
    }

    public function set_bpi_sgst_price($val)
    {
        $this->bpi_sgst_price = $val;
    }

    public function set_bpi_igst_price($val)
    {
        $this->bpi_igst_price = $val;
    }

    public function set_bpi_amount($val)
    {
        $this->bpi_amount = $val;
    }

    public function set_bpi_total($val)
    {
        $this->bpi_total = $val;
    }

    public function set_bpi_payment_status($val)
    {
        $this->bpi_payment_status = $val;
    }

    public function set_bpi_add_date($val)
    {
        $this->bpi_add_date = $val;
    }

    public function set_bpi_add_by($val)
    {
        $this->bpi_add_by = $val;
    }

    public function set_bpi_modify_date($val)
    {
        $this->bpi_modify_date = $val;
    }

    public function set_bpi_modify_by($val)
    {
        $this->bpi_modify_by = $val;
    }


    public function insert_product_data()
    {
        return DB::table($this->table)->insertGetId(
            [
                'bpi_invoice_no' => $this->bpi_invoice_no,
                'bpi_is_farmer_bill_generate' => $this->bpi_is_farmer_bill_generate,
                'bpi_is_buyer_bill_generate' => $this->bpi_is_buyer_bill_generate,
                'bpi_bi_id' => $this->bpi_bi_id,
                'bpi_saller_id' => $this->bpi_saller_id,
                'bpi_biz_id' => $this->bpi_biz_id,
                'bpi_gt_id' => $this->bpi_gt_id,
                'bpi_bzc_id' => $this->bpi_bzc_id,
                'bpi_no_of_bags' => $this->bpi_no_of_bags,
                'bpi_weight' => $this->bpi_weight,
                'bpi_bid_price' => $this->bpi_bid_price,
                'bpi_sgst' => $this->bpi_sgst,
                'bpi_cgst' => $this->bpi_cgst,
                'bpi_igst' => $this->bpi_igst,
                'bpi_cgst_price' => $this->bpi_cgst_price,
                'bpi_sgst_price' => $this->bpi_sgst_price,
                'bpi_igst_price' => $this->bpi_igst_price,
                'bpi_amount' => $this->bpi_amount,
                'bpi_total' => $this->bpi_total,
                'bpi_payment_status' => $this->bpi_payment_status,
                'bpi_add_date' => $this->bpi_add_date,
                'bpi_add_by' => $this->bpi_add_by
            ]
        );
    }

   public function add_buyer_product_invoice_data($bpi_gst){
       return DB::table($this->table)->insertGetId(
           [
               'bpi_is_farmer_bill_generate' => $this->bpi_is_farmer_bill_generate,
               'bpi_is_buyer_bill_generate' => $this->bpi_is_buyer_bill_generate,
               'bpi_saller_id' => $this->bpi_saller_id,
               'bpi_gt_id' => $this->bpi_gt_id,
               'bpi_weight' => $this->bpi_weight,
               'bpi_bid_price' => $this->bpi_bid_price,
               'bpi_sgst' => $this->bpi_sgst,
               'bpi_cgst' => $this->bpi_cgst,
               'bpi_igst' => $this->bpi_igst,
               'bpi_cgst_price' => $this->bpi_cgst_price,
               'bpi_sgst_price' => $this->bpi_sgst_price,
               'bpi_igst_price' => $this->bpi_igst_price,
               'bpi_amount' => $this->bpi_amount,
               'bpi_total' => $this->bpi_total,
               'bpi_payment_status' => $this->bpi_payment_status,
               'bpi_add_date' => $this->bpi_add_date,
               'bpi_add_by' => $this->bpi_add_by,
               'bpi_bi_id'=>$this->bpi_bi_id,
               'bpi_gst'=>$bpi_gst
           ]
       );
    }
    public function update_product_data()
    {
        return DB::table($this->table)
            ->where('bpi_id', $this->bpi_id)
            ->update(
                [
                    'bpi_saller_id' => $this->bpi_saller_id,
                    'bpi_is_farmer_bill_generate' => $this->bpi_is_farmer_bill_generate,
                    'bpi_is_buyer_bill_generate' => $this->bpi_is_buyer_bill_generate,
                    'bpi_biz_id' => $this->bpi_biz_id,
                    'bpi_gt_id' => $this->bpi_gt_id,
                    'bpi_bzc_id' => $this->bpi_bzc_id,
                    'bpi_no_of_bags' => $this->bpi_no_of_bags,
                    'bpi_weight' => $this->bpi_weight,
                    'bpi_bid_price' => $this->bpi_bid_price,
                    'bpi_sgst' => $this->bpi_sgst,
                    'bpi_cgst' => $this->bpi_cgst,
                    'bpi_igst' => $this->bpi_igst,
                    'bpi_cgst_price' => $this->bpi_cgst_price,
                    'bpi_sgst_price' => $this->bpi_sgst_price,
                    'bpi_igst_price' => $this->bpi_igst_price,
                    'bpi_amount' => $this->bpi_amount,
                    'bpi_total' => $this->bpi_total,
                    'bpi_payment_status' => $this->bpi_payment_status,
                    'bpi_modify_date' => $this->bpi_modify_date,
                    'bpi_modify_by' => $this->bpi_modify_by
                ]
            );
    }

    public function delete_product()
    {
        return DB::table($this->table)
            ->where('bpi_id', $this->bpi_id)
            ->delete();
    }

    public function get_buyer_product_data_by_bpi_bi_id($bi_id)
    {
        $sql = "
        SELECT $this->table.*,goods_type.gt_type,`goods_type`.gt_hsn_no,
                CONCAT(users.`f_name`,' ',users.`m_name`,' ',users.`l_name`) as farmer_name,
                `users`.`gstin_no` as seller_gstin_no
                 FROM $this->table
                LEFT JOIN `users` ON users.id = $this->table.bpi_saller_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = $this->table.bpi_gt_id
                WHERE $this->table.bpi_bi_id = $bi_id
                AND $this->table.bpi_status = 'Active'

        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_buyer_product_data($bpi_id)
    {
        $sql = "
        SELECT $this->table.bpi_bzc_id,$this->table.bpi_weight
                 FROM $this->table
               WHERE $this->table.bpi_id = $bpi_id
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function update_product_payment_status()
    {
        return DB::table($this->table)
            ->where('bpi_bi_id', $this->bpi_bi_id)
            ->update(
                [
                    'bpi_payment_status' => $this->bpi_payment_status
                ]
            );
    }

    public function update_product_buyer_bill_status()
    {
        return DB::table($this->table)
            ->where('bpi_bi_id', $this->bpi_bi_id)
            ->update(
                [
                    'bpi_is_buyer_bill_generate' => $this->bpi_is_buyer_bill_generate
                ]
            );
    }

    public function update_product_farmer_bill_status($bi_id, $spi_saller_id)
    {
        return DB::table($this->table)
            ->where('bpi_id', $bi_id)
            ->where('bpi_saller_id', $spi_saller_id)
            ->update(
                [
                    'bpi_is_farmer_bill_generate' => 'Yes',
                ]
            );
    }

    public function update_bpi_product_add_status()
    {
        return DB::table($this->table)
            ->where('bpi_bi_id', $this->bpi_bi_id)
            ->update(
                [
                    'bpi_product_add' => $this->bpi_product_add
                ]
            );
    }


    public function get_stock_out_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bpi_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
                bpi_id LIKE '%" . $search . "%'
            OR
             	bpi_weight LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
            OR
            bpi_bid_price LIKE '%" . $search . "%'

            )";
        }
        $sql = "
         	SELECT bpi_id,
         	bpi_weight,
         	 bpi_bid_price,
         	CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as name,
         	`users`.mobile,`users`.biz_id,`users`.biz_name,`goods_type`.gt_type,`users`.id,`site_settings`.setting_kg_price
         	FROM $this->table
         	LEFT JOIN buyer_invoice ON buyer_invoice.bi_id = bpi_bi_id
         	LEFT JOIN users ON users.id = buyer_invoice.bi_buyer_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = users.biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = bpi_gt_id
         	WHERE bpi_is_buyer_bill_generate != 'No'
         	$con
         	$search_con
         	ORDER BY $order $dir
         	LIMIT $start, $limit
		";
        //echo "<pre>";echo $sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function get_stock_out_list_count($role_id, $user_id, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bpi_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
                bpi_id LIKE '%" . $search . "%'
            OR
             	bpi_weight LIKE '%" . $search . "%'
            OR
            CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) LIKE '%" . $search . "%'
            OR
            biz_name LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
            OR
            bpi_bid_price LIKE '%" . $search . "%'

            )";
        }
        $sql = "
         	SELECT count(bpi_id) as total
         	FROM $this->table
         	LEFT JOIN buyer_invoice ON buyer_invoice.bi_id = bpi_bi_id
         	LEFT JOIN users ON users.id = buyer_invoice.bi_buyer_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = users.biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = bpi_gt_id
         	WHERE bpi_is_buyer_bill_generate != 'No'
         	$con
         	$search_con
		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_buyer_product_data_by_bzc_id($bpi_id)
    {
        $sql = "
         	SELECT $this->table.*,
         	CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as seller_name,
         	CONCAT(`buyer`.`f_name`,' ',`buyer`.`m_name` ,' ',`buyer`.`l_name`) as buyer_name,
            buyer_invoice.bi_buyer_id,
            CONCAT(add_user.`f_name`,' ',add_user.`m_name` ,' ',add_user.`l_name`) as added_by,
         	`users`.mobile,
         	`users`.city,
         	`users`.state,
         	`goods_type`.gt_type,
         	`goods_type`.gt_hsn_no as hsn_no,
         	`site_settings`.setting_kg_price,
         	biz_consignment_product.bzcp_weight,
         	CASE
                WHEN `site_settings`.setting_kg_price = '20/Kg' THEN biz_consignment_product.bzcp_price * REPLACE(`site_settings`.setting_kg_price, '/Kg', '')
                WHEN `site_settings`.setting_kg_price = '1/Kg' THEN   biz_consignment_product.bzcp_price
                ELSE biz_consignment_product.bzcp_price
            END AS consignment_bzcp_price
         	FROM $this->table
         	LEFT JOIN buyer_invoice ON buyer_invoice.bi_id = $this->table.bpi_bi_id
         	LEFT JOIN biz_consignment_product ON biz_consignment_product.bzcp_bzc_id = $this->table.bpi_bzc_id
         	LEFT JOIN users as buyer ON buyer.id = buyer_invoice.bi_buyer_id
         	LEFT JOIN users ON users.id = $this->table.bpi_saller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bpi_biz_id
         	LEFT JOIN users add_user ON add_user.id = $this->table.bpi_add_by
         	LEFT JOIN users copmay ON copmay.id = $this->table.bpi_biz_id
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bpi_gt_id
         	WHERE $this->table.bpi_id='$bpi_id'
         	AND  $this->table.bpi_is_farmer_bill_generate='No'
         	AND  $this->table.bpi_is_buyer_bill_generate='Yes'
		";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_consignment_data_by_bpi_id($bpi_id)
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
         	LEFT JOIN users ON users.id = $this->table.bpi_saller_id
         	LEFT JOIN site_settings ON site_settings.setting_add_by = $this->table.bpi_biz_id
         	LEFT JOIN users add_user ON add_user.id = $this->table.bpi_add_by
         	LEFT JOIN goods_type ON goods_type.gt_id = $this->table.bpi_gt_id
         	WHERE $this->table. 	bpi_id=$bpi_id;
		";//echo "<pre>";echo $sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function count_data($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bi_biz_id = $user_id";
        }

        $sql = "
        SELECT count($this->table.bpi_id) as total
                 FROM $this->table
              WHERE $this->table.bpi_is_buyer_bill_generate != 'No'
                $con
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '', $date, $from_date = '', $to_date = '', $company = '', $amount = '', $gst_tin = '')
    {
        $con = '';
        $search_con = '';
        $company_con = '';
        $amount_con = '';
        $gstin_con = '';
        $date_con = '';
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        if (isset($company) && !empty($company)) {
            $company_con = "AND users.`biz_name` LIKE '%" . $company . "%'";
        }
        if ($from_date == $date) {
            $date_con = " AND saller_product_invoice.spi_add_date >= '$date'";
        } elseif (empty($company) && empty($from_date) && empty($to_date) && empty($amount) && empty($gst_tin)) {

        } elseif (isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date)) {
            $date_con = " AND saller_product_invoice.spi_add_date >= '$from_date'
                 AND saller_product_invoice.spi_add_date <= '$to_date'";
        }

        $order = 'spi_add_date';
        if (isset($search) && !empty($search)) {
            $search_con = "AND (

            users.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(users.`f_name`,' ',users.`m_name`,' ',users.`l_name`) LIKE '%" . $search . "%'
            OR
            users.biz_name LIKE '%" . $search . "%'
            OR
            spi_total LIKE '%" . $search . "%'
            )";
        }
        $sql = "
       SELECT
             saller_product_invoice.*,
             saller_invoice.*,
             users.id,
             users.f_name ,
             users.biz_id,
             users.city,
             users.biz_name,
             users.email,
             users.mobile,
             users.l_name,
             users.nick_name,
             users.status,
             users.profile,
             users.pan_no,
             users.biz_subject_name,
             company.`biz_name`,
             users.`gstin_no`,
             DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d') as buyer_date
            FROM saller_product_invoice
        LEFT JOIN `users` ON users.id = saller_product_invoice.spi_buyer_id
        LEFT JOIN `users` company ON company.id = users.biz_id
        LEFT JOIN `saller_invoice` ON saller_invoice.si_id = saller_product_invoice.spi_si_id
        LEFT JOIN `goods_type` ON goods_type.gt_id = saller_product_invoice.spi_gt_id
         WHERE  users.role_id=3 AND users.status='Active'
         AND saller_invoice.si_amount IS NOT NULL
         AND saller_invoice.si_amount != 0
          $date_con
          $search_con
          $company_con
            $con
        ORDER BY $order $dir
        LIMIT $start, $limit
        ";
        //echo "<pre>".$sql;
        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_invoice_data_count($role_id, $user_id, $search = '', $date, $from_date = '', $to_date = '', $company = '', $amount = '', $gst_tin = '')
    {
        $con = '';
        $search_con = '';
        $company_con = '';
        $amount_con = '';
        $gstin_con = '';
        $date_con = '';
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        if (isset($company) && !empty($company)) {
            $company_con = "AND users.`biz_name` LIKE '%" . $company . "%'";
        }
        if ($from_date == $date) {
            $date_con = " AND saller_product_invoice.spi_add_date >= '$date'";
        } elseif (empty($company) && empty($from_date) && empty($to_date) && empty($amount) && empty($gst_tin)) {

        } elseif (isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date)) {
            $date_con = " AND saller_product_invoice.spi_add_date >= '$from_date'
                 AND saller_product_invoice.spi_add_date <= '$to_date'";
        }


        if (isset($search) && !empty($search)) {
            $search_con = "AND (

            users.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(users.`f_name`,' ',users.`m_name`,' ',users.`l_name`) LIKE '%" . $search . "%'
            OR
            users.biz_name LIKE '%" . $search . "%'
            OR
            spi_total LIKE '%" . $search . "%'
            )";
        }
        $sql = "
       SELECT
            count(DISTINCT(users.id)) as total
            FROM saller_product_invoice
        LEFT JOIN `users` ON users.id = saller_product_invoice.spi_buyer_id
        LEFT JOIN `users` company ON company.id = users.biz_id
        LEFT JOIN `saller_invoice` ON saller_invoice.si_id = saller_product_invoice.spi_si_id
        LEFT JOIN `goods_type` ON goods_type.gt_id = saller_product_invoice.spi_gt_id
        WHERE  users.role_id=3
         AND users.status='Active'
          $date_con
          $search_con
          $con
          $company_con
        ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_pending_farmer_bill($role_id, $user_id,$start, $limit, $order, $dir, $search)
    {
        $date = date("Y-m-d");
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            users.f_name LIKE '%" . $search . "%'
            OR
            users.email LIKE '%" . $search . "%'
            OR
            users.mobile LIKE '%" . $search . "%'
            )";
        }
        $sql = "
          SELECT users.id,users.f_name,users.m_name,users.l_name,users.email,users.mobile From users
           WHERE users.status='Active'
          AND users.role_id=2
          AND users.id NOT IN (SELECT si_saller_id FROM saller_invoice WHERE DATE (saller_invoice.si_add_date)= '$date')
           $con
           $search_con
                ORDER BY $order $dir
         	LIMIT $start, $limit
        ";
        $results = DB::select(DB::raw($sql));

       /* if (empty($results)) {
            $sql = "
        SELECT users.id,users.f_name,users.m_name,users.l_name,users.email,users.mobile
        FROM `users` WHERE users.role_id=2
        AND users.status='Active'
           $search_con
                ORDER BY $order $dir
         	LIMIT $start, $limit
        ";

            $results = DB::select(DB::raw($sql));
            return $results;
        }*/
        return $results;
    }

    public function get_pending_farmer_bill_count($role_id, $user_id, $search = '')
    {
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            users.f_name LIKE '%" . $search . "%'
            OR
            users.email LIKE '%" . $search . "%'
            OR
            users.mobile LIKE '%" . $search . "%'
            )";
        }
        $date = date("Y-m-d");
        $sql = "
            SELECT count(DISTINCT users.id)  as total From users
           WHERE users.status='Active'
          AND users.role_id=2
          AND users.id NOT IN (SELECT si_saller_id FROM saller_invoice WHERE DATE (saller_invoice.si_add_date)= '$date')
        $search_con
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }




    public function get_pending_bill_by_bpi_id($id)
    {
        $sql = "
         SELECT *
        FROM `users`
            WHERE  `users`.id = '$id' ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

}
