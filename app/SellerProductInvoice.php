<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SellerProductInvoice extends Model
{
    protected $table = 'saller_product_invoice';
    protected $spi_id = '';
    protected $spi_si_id = '';
    protected $spi_invoice_no = '';
    protected $spi_biz_id = '';
    protected $spi_saller_id = '';
    protected $spi_buyer_id = '';
    protected $spi_gt_id = '';
    protected $spi_bzc_id = '';
    protected $spi_no_of_bags = '';
    protected $spi_weight = '';
    protected $spi_rate = '';
    protected $spi_comission = '';
    protected $spi_market_fee = '';

    protected $spi_amount = '';
    protected $spi_total = '';
    protected $spi_payment_status = '';
    protected $spi_add_date = '';
    protected $spi_add_by = '';
    protected $spi_modify_date = '';
    protected $spi_modify_by = '';
    protected $spi_bpi_id = '';
    protected $spi_buyer_bill_generated = '';
    protected $spi_farmer_bill_generated = '';


    public function set_spi_id($val)
    {
        $this->spi_id = $val;
    }

    public function set_spi_bpi_id($val)
    {
        $this->spi_bpi_id = $val;
    }

    public function set_spi_si_id($val)
    {
        $this->spi_si_id = $val;
    }

    public function set_spi_saller_id($val)
    {
        $this->spi_saller_id = $val;
    }

    public function set_spi_invoice_no($val)
    {
        $this->spi_invoice_no = $val;
    }

    public function set_spi_biz_id($val)
    {
        $this->spi_biz_id = $val;
    }

    public function set_spi_gt_id($val)
    {
        $this->spi_gt_id = $val;
    }

    public function set_spi_buyer_id($val)
    {
        $this->spi_buyer_id = $val;
    }

    public function set_spi_bzc_id($val)
    {
        $this->spi_bzc_id = $val;
    }

    public function set_spi_no_of_bags($val)
    {
        $this->spi_no_of_bags = $val;
    }

    public function set_spi_weight($val)
    {
        $this->spi_weight = $val;
    }

    public function set_spi_rate($val)
    {
        $this->spi_rate = $val;
    }

    public function set_spi_comission($val)
    {
        $this->spi_comission = $val;
    }

    public function set_spi_market_fee($val)
    {
        $this->spi_market_fee = $val;
    }

    public function set_spi_amount($val)
    {
        $this->spi_amount = $val;
    }

    public function set_spi_total($val)
    {
        $this->spi_total = $val;
    }

    public function set_spi_payment_status($val)
    {
        $this->spi_payment_status = $val;
    }

    public function set_spi_add_date($val)
    {
        $this->spi_add_date = $val;
    }

    public function set_spi_add_by($val)
    {
        $this->spi_add_by = $val;
    }

    public function set_spi_modify_date($val)
    {
        $this->spi_modify_date = $val;
    }

    public function set_spi_modify_by($val)
    {
        $this->spi_modify_by = $val;
    }

    public function set_spi_buyer_bill_generated($val)
    {
        $this->spi_buyer_bill_generated = $val;
    }

    public function set_spi_farmer_bill_generated($val)
    {
        $this->spi_farmer_bill_generated = $val;
    }

    public function spi_no_of_bags($val)
    {
        $this->spi_no_of_bags = $val;
    }

    public function update_saller_buyer_bill_status()
    {
        return DB::table($this->table)
            ->where('spi_id', $this->spi_id)
            ->update(
                [
                    'spi_buyer_bill_generated' => 'Yes'
                ]
            );
    }

    public function update_buyer_bill_status()
    {
        return DB::table($this->table)
            ->where('spi_si_id', $this->spi_si_id)
            ->update(
                [
                    'spi_payment_status' => $this->spi_payment_status,
                ]
            );
    }

    public function update_saller_bpi_id()
    {
        return DB::table($this->table)
            ->where('spi_id', $this->spi_id)
            ->update(
                [
                    'spi_bpi_id' => $this->spi_bpi_id
                ]
            );
    }

    public function update_saller_farmer_bill_status($si_id)
    {
        return DB::table($this->table)
            ->where('spi_si_id', $si_id)
            ->update(
                [
                    'spi_farmer_bill_generated' => 'Yes'
                ]
            );
    }

    public function delete_product()
    {
        return DB::table($this->table)
            ->where('spi_id', $this->spi_id)
            ->delete();
    }

    public function insert_product_data()
    {
        $this->spi_biz_id = 0;

        return DB::table($this->table)->insertGetId(
            [
                'spi_buyer_bill_generated' => $this->spi_buyer_bill_generated,
                'spi_invoice_no' => $this->spi_invoice_no,
                'spi_bpi_id' => $this->spi_bpi_id,
                'spi_si_id' => $this->spi_si_id,
                'spi_buyer_id' => $this->spi_buyer_id,
                'spi_saller_id' => $this->spi_saller_id,
                'spi_biz_id' => $this->spi_biz_id,
                'spi_gt_id' => $this->spi_gt_id,
                'spi_bzc_id' => $this->spi_bzc_id,
                'spi_weight' => $this->spi_weight,
                'spi_rate' => $this->spi_rate,
                'spi_total' => $this->spi_total,
                'spi_payment_status' => $this->spi_payment_status,
                'spi_add_date' => $this->spi_add_date,
                'spi_add_by' => $this->spi_add_by,
                'spi_no_of_bags' => $this->spi_no_of_bags
            ]
        );
    }

    public function update_product_data()
    {
        return DB::table($this->table)
            ->where('spi_id', $this->spi_id)
            ->update(
                [
                    'spi_bpi_id' => $this->spi_bpi_id,
                    'spi_buyer_bill_generated' => $this->spi_buyer_bill_generated,
                    'spi_buyer_id' => $this->spi_buyer_id,
                    'spi_biz_id' => $this->spi_biz_id,
                    'spi_gt_id' => $this->spi_gt_id,
                    'spi_bzc_id' => $this->spi_bzc_id,
                    'spi_no_of_bags' => $this->spi_no_of_bags,
                    'spi_weight' => $this->spi_weight,
                    'spi_rate' => $this->spi_rate,
                    'spi_amount' => $this->spi_amount,
                    'spi_total' => $this->spi_total,
                    'spi_modify_date' => $this->spi_modify_date,
                    'spi_modify_by' => $this->spi_modify_by,
                ]
            );
    }


    public function update_spi_si_id_data($spi_id, $spi_si_id)
    {
        return DB::table($this->table)
            ->where('spi_id', $spi_id)
            ->update(
                [
                    'spi_si_id' => $spi_si_id,
                ]
            );
    }

    public function get_seller_product_data_by_spi_si_id($si_id)
    {
        $sql = "
        SELECT $this->table.*, CONVERT(goods_type.gt_type USING utf8) as gt_type,`goods_type`.gt_hsn_no,
        CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as buyer_name,`users`.`gstin_no` as buyer_gstin_no


                FROM $this->table
                LEFT JOIN users ON users.id = $this->table.spi_buyer_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = $this->table.spi_gt_id
                WHERE $this->table.spi_si_id = $si_id
                 AND $this->table.spi_status='Active'
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_seller_product_data_by_spi_saller_id($saller_id, $date)
    {
        $sql = "
        SELECT $this->table.*, CONVERT(goods_type.gt_type USING utf8) as gt_type,`goods_type`.gt_hsn_no,
        `goods_type`.gt_cgst_tax,`goods_type`.gt_sgst_tax,`goods_type`.gt_is_tax_apply,
        CONCAT(`users`.`f_name`,' ',`users`.`m_name` ,' ',`users`.`l_name`) as buyer_name,
        `users`.`gstin_no` as buyer_gstin_no ,`users`.`mobile` as buyer_mobile


                FROM $this->table
                LEFT JOIN users ON users.id = $this->table.spi_buyer_id
                join users company on company.id=users.biz_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = $this->table.spi_gt_id
                WHERE $this->table.spi_saller_id = $saller_id
                AND DATE (spi_add_date)='$date'
                AND $this->table.spi_status='Active'
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function update_seller_payment_status()
    {
        return DB::table($this->table)
            ->where('spi_si_id', $this->spi_si_id)
            ->update(
                [
                    'spi_payment_status' => $this->spi_payment_status
                ]
            );
    }

    public function get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '', $date, $from_date = '', $to_date = '', $company = '', $amount = '', $farmer_name = '')
    {


        $con = '';
        $search_con = '';
        $company_con = '';
        $amount_con = '';
        $gstin_con = '';
        $date_con = '';
        $gt_type_con = '';
        $farmer_con = '';
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        if (isset($farmer_name) && !empty($farmer_name)) {
            $farmer_con = "AND CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) LIKE '%" . $farmer_name . "%'";
        }
        if (isset($company) && !empty($company)) {
            $company_con = "AND company.`biz_name` LIKE '%" . $company . "%'";
        }
        if ($from_date == $date) {
            $date_con = " AND $this->table.spi_add_date >= '$date'";
        } elseif (empty($company) && empty($from_date) && empty($to_date) && empty($amount) && empty($farmer_name)) {
//            $date_con = " AND $this->table.spi_add_date <= '$date'";
        } else if (isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date)) {
            $date_con = " AND saller_invoice.si_add_date  >= '$from_date'
                 AND saller_invoice.si_add_date <= '$to_date'";
        }

        if (isset($amount) && !empty($amount)) {
            $amount_con = "AND (
            si_total LIKE '%" . $amount . "%'
            )";
        }

        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            seller_user.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) LIKE '%" . $search . "%'
            OR
            company.biz_name LIKE '%" . $search . "%'
            OR
            si_total LIKE '%" . $search . "%'
            )";
        }
        $sql = "
        SELECT
              DISTINCT users.id,
              users.f_name ,
              users.biz_id,
              users.city,
              users.biz_name,
              users.email,
              users.mobile,
              saller_invoice.si_add_date,
              users.l_name,
              users.nick_name,
              users.status,
              users.profile,
              users.pan_no,
              users.biz_subject_name,
              saller_invoice.si_payment_status,
              DATE_FORMAT(saller_invoice.si_add_date,'%Y-%m-%d') as seller_date,
              company.`biz_name`,company.`gstin_no`,users.id,saller_invoice.si_total,saller_invoice.si_add_date,
                  CONCAT(users.`f_name`,' ',users.`m_name`,' ',users.`l_name`) as seller_name,
                CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) as seller_names,
             saller_invoice.si_id
        FROM `users`
       left join saller_invoice on saller_invoice.si_saller_id=users.id
       LEFT JOIN `users` seller_user ON seller_user.id = saller_invoice.si_saller_id
       LEFT JOIN `users` company ON company.id = seller_user.biz_id
       WHERE users.role_id=2
       AND users.status='Active'
       AND saller_invoice.si_add_date IS NOT NULL
          $search_con
          $company_con
          $gstin_con
          $amount_con
          $date_con
          $con
          $farmer_con

        ORDER BY $order $dir
        LIMIT $start, $limit
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_count($role_id, $user_id, $search = '', $date, $from_date = '', $to_date = '', $company = '', $amount = '', $farmer_name = '')
    {
        $con = '';
        $search_con = '';
        $company_con = '';
        $amount_con = '';
        $gstin_con = '';
        $date_con = '';
        $gt_type_con = '';
        $farmer_con = '';
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        if (isset($farmer_name) && !empty($farmer_name)) {
            $farmer_con = "AND CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) LIKE '%" . $farmer_name . "%'";
        }
        if (isset($company) && !empty($company)) {
            $company_con = "AND company.`biz_name` LIKE '%" . $company . "%'";
        }
        if ($from_date == $date) {
            $date_con = " AND saller_invoice.si_add_date >= '$date'";
        } elseif (empty($company) && empty($from_date) && empty($to_date) && empty($amount) && empty($gst_tin) && empty($gt_type) && empty($farmer_name)) {
            $date_con = " AND saller_invoice.si_add_date >= '$date'";
        } else if (isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date)) {
            $date_con = " AND saller_invoice.si_add_date  >= '$from_date'
                 AND saller_invoice.si_add_date <= '$to_date'";
        }

        if (isset($amount) && !empty($amount)) {
            $amount_con = "AND (
            si_total LIKE '%" . $amount . "%'
            )";
        }

        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            seller_user.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) LIKE '%" . $search . "%'
            OR
            company.biz_name LIKE '%" . $search . "%'
            OR
            si_total LIKE '%" . $search . "%'
            )";
        }
        $sql = "
            SELECT
              count(users.id)as total
        FROM `users`
       left join saller_invoice on saller_invoice.si_saller_id=users.id
       LEFT JOIN `users` seller_user ON seller_user.id = saller_invoice.si_saller_id
       LEFT JOIN `users` company ON company.id = seller_user.biz_id
       WHERE users.role_id=2
       AND users.status='Active'
       AND saller_invoice.si_add_date IS NOT NULL
          $search_con
          $company_con
          $amount_con
          $date_con
          $con

          $farmer_con
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_pending_buyer_bill($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.spi_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {

            $search_con = "AND (
            buyer_user.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(buyer_user.`f_name`,' ',buyer_user.`m_name`,' ',buyer_user.`l_name`) LIKE '%" . $search . "%'
            OR
            buyer_user.biz_name LIKE '%" . $search . "%'
            OR
            spi_rate LIKE '%" . $search . "%'
            OR
            spi_id LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
            OR
            spi_weight LIKE '%" . $search . "%'
            OR
            goods_type.gt_type LIKE '%" . $search . "%'
            )";
        }
        $sql = "
        SELECT $this->table.spi_id,
                $this->table.spi_weight,
                $this->table.spi_rate,
                $this->table.spi_buyer_id,
                $this->table.spi_buyer_bill_generated,
                $this->table.spi_farmer_bill_generated,
                goods_type.`gt_type`,
                CONCAT(buyer_user.`f_name`,' ',buyer_user.`m_name`,' ',buyer_user.`l_name`) as buyer_name,
                buyer_user.mobile,
                buyer_user.biz_name
        FROM $this->table
        LEFT JOIN `users` buyer_user ON buyer_user.id = $this->table.spi_buyer_id
        LEFT JOIN `goods_type` ON goods_type.gt_id = $this->table.spi_gt_id
        WHERE $this->table.spi_buyer_bill_generated = 'No'
        AND $this->table.spi_farmer_bill_generated ='Yes'
          $con
          $search_con
          ORDER BY $order $dir
        LIMIT $start, $limit
        ";
        //echo "<pre>".$sql;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_pending_buyer_bill_count($role_id, $user_id, $search = '')
    {
        $con = '';
        $search_con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.spi_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            buyer_user.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(buyer_user.`f_name`,' ',buyer_user.`m_name`,' ',buyer_user.`l_name`) LIKE '%" . $search . "%'
            OR
            buyer_user.biz_name LIKE '%" . $search . "%'
            OR
            spi_rate LIKE '%" . $search . "%'
            OR
            spi_id LIKE '%" . $search . "%'
            OR
            mobile LIKE '%" . $search . "%'
            OR
            spi_weight LIKE '%" . $search . "%'
            OR
            goods_type.gt_type LIKE '%" . $search . "%'
            )";
        }
        $sql = "
        SELECT  count($this->table.spi_id) as total
        FROM $this->table
        LEFT JOIN `users` buyer_user ON buyer_user.id = $this->table.spi_buyer_id
        LEFT JOIN `goods_type` ON goods_type.gt_id = $this->table.spi_gt_id
        WHERE $this->table.spi_buyer_bill_generated ='No'
        AND $this->table.spi_farmer_bill_generated 	 ='Yes'
          $con
          $search_con
        ";
        //echo "<pre>".$sql;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_pending_bill_by_spi_id($spi_id)
    {
        $sql = "
        SELECT * FROM `users` join saller_product_invoice on users.id=saller_product_invoice.spi_buyer_id
left join goods_type on saller_product_invoice.spi_gt_id = goods_type.gt_id
WHERE saller_product_invoice.spi_buyer_id= '$spi_id' ";


        $results = DB::select(DB::raw($sql));
        return $results;
    }


    public function get_invoice_data_list_data($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $date = date('Y=m-d');
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            users.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(users.`f_name`,' ',users.`m_name`,' ',users.`l_name`) LIKE '%" . $search . "%'
            OR
            users.email LIKE '%" . $search . "%'
            OR
            users.mobile LIKE '%" . $search . "%'
            OR
            saller_invoice.si_invoice_no LIKE '%" . $search . "%'
            OR
            DATE_FORMAT(saller_invoice.si_add_date,'%Y-%m-%d') LIKE '%" . $search . "%'
            OR
            saller_invoice.si_payment_status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
      SELECT
              DISTINCT users.id,
              users.f_name ,
              users.biz_id,
              users.city,
               users.l_name ,
              users.m_name ,
               saller_invoice.si_invoice_no,
              users.biz_name,
              users.email,
              users.mobile,
              saller_invoice.si_add_date,
              users.l_name,
              users.nick_name,
              users.status,
              users.profile,
              users.pan_no,
              users.biz_subject_name,
              saller_invoice.si_payment_status,
              saller_invoice.si_total,
              DATE_FORMAT(saller_invoice.si_add_date,'%Y-%m-%d') as seller_date,
              DATE_FORMAT(saller_invoice.si_add_date,'%d-%m-%Y') as add_date,
             saller_invoice.si_id
        FROM `users`
       left join saller_invoice on saller_invoice.si_saller_id=users.id
       WHERE users.role_id=2 AND users.status='Active'
       AND (saller_invoice.si_payment_status = 'Pending' OR saller_invoice.si_payment_status = 'Approved')
       AND saller_invoice.si_status='Active'
        $search_con
        $con
        ORDER BY $order $dir
        LIMIT $start, $limit
        ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_invoice_data_list_count_data($role_id, $user_id, $search = '')
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND users.biz_id = $user_id";
        }
        $sql = "
      SELECT
              DISTINCT saller_invoice.si_id
        FROM `users`
       left join saller_invoice on saller_invoice.si_saller_id=users.id
       WHERE users.role_id=2 AND users.status='Active'
       AND (saller_invoice.si_payment_status = 'Pending' OR saller_invoice.si_payment_status = 'Approved')
         AND saller_invoice.si_status='Active'
         $con
        ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_faramer_data_for_payment($si_id, $date)
    {


        $sql = "
                   SELECT
                            saller_product_invoice.*,
                            byuer_user.*,
                            goods_type.*,
                            saller_invoice.*,
                             DATE_FORMAT(saller_invoice.si_add_date,'%Y-%m-%d') as seller_date
                    FROM `users`
                    left join saller_product_invoice on saller_product_invoice.spi_saller_id=users.id
                    left join goods_type on saller_product_invoice.spi_gt_id=goods_type.gt_id
                    left join users byuer_user on saller_product_invoice.spi_buyer_id=byuer_user.id
                    left join saller_invoice on saller_invoice.si_id= saller_product_invoice.spi_si_id
                    WHERE users.status='Active'
                    AND  saller_product_invoice.spi_saller_id= $si_id
                    AND  saller_product_invoice.spi_si_id IS NOT NULL
                    AND  saller_product_invoice.spi_si_id !=0
                    AND saller_invoice.si_status = 'Active'
                    AND  DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d') = '$date'
                     Group by saller_product_invoice.spi_id

                   /* Group by saller_product_invoice.spi_id having count(saller_product_invoice.spi_id)>=1*/
                ";
        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_faramer_details($si_id)
    {


        $sql = "
       SELECT
               *
           FROM `users`
           WHERE users.status='Active'
           AND  id= $si_id
       ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }


}
