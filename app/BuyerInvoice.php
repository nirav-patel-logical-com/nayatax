<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuyerInvoice extends Model
{
    protected $table = 'buyer_invoice';

    protected $bi_id = '';
    protected $bi_invoice_no = '';
    protected $bi_bi_id = '';
    protected $bi_biz_id = '';
    protected $bi_buyer_id = '';
    protected $bi_comission = '';
    protected $bi_market_fee = '';
    protected $bi_amount = '';
    protected $bi_total = '';
    protected $bi_payment_status = '';
    protected $bi_add_date = '';
    protected $bi_add_by = '';
    protected $bi_modify_date = '';
    protected $bi_modify_by = '';
    protected $bi_commission_price = '';
    protected $bi_payment_type = '';
    protected $bi_cheque_no = '';
    protected $bi_invoice_pdf = '';
    protected $bi_market_fee_per = '';
    protected $bi_bank_name = '';
    protected $bi_ac_no = '';
    protected $bi_ifs_code = '';
    protected $bi_gst = '';


    public function set_bi_id($val)
    {
        $this->bi_id = $val;
    }

    public function set_bi_invoice_pdf($val)
    {
        $this->bi_invoice_pdf = $val;
    }

    public function set_bi_market_fee_per($val)
    {
        $this->bi_market_fee_per = $val;
    }

    public function set_bi_bpi_id($val)
    {
        $this->bi_bpi_id = $val;
    }

    public function set_bi_invoice_no($val)
    {
        $this->bi_invoice_no = $val;
    }

    public function set_bi_biz_id($val)
    {
        $this->bi_biz_id = $val;
    }

    public function set_bi_buyer_id($val)
    {
        $this->bi_buyer_id = $val;
    }

    public function set_bi_comission($val)
    {
        $this->bi_comission = $val;
    }

    public function set_bi_commission_price($val)
    {
        $this->bi_commission_price = $val;
    }

    public function set_bi_market_fee($val)
    {
        $this->bi_market_fee = $val;
    }

    public function set_bi_amount($val)
    {
        $this->bi_amount = $val;
    }

    public function set_bi_total($val)
    {
        $this->bi_total = $val;
    }

    public function set_bi_gst($val)
    {
        $this->bi_gst = $val;
    }

    public function set_bi_payment_status($val)
    {
        $this->bi_payment_status = $val;
    }

    public function set_bi_add_date($val)
    {
        $this->bi_add_date = $val;
    }

    public function set_bi_add_by($val)
    {
        $this->bi_add_by = $val;
    }

    public function set_bi_modify_date($val)
    {
        $this->bi_modify_date = $val;
    }

    public function set_bi_modify_by($val)
    {
        $this->bi_modify_by = $val;
    }

    public function set_bi_payment_type($val)
    {
        $this->bi_payment_type = $val;
    }

    public function set_bi_cheque_no($val)
    {
        $this->bi_cheque_no = $val;
    }

    public function set_bi_bank_name($val)
    {
        $this->bi_bank_name = $val;
    }

    public function set_bi_ac_no($val)
    {
        $this->bi_ac_no = $val;
    }

    public function set_bi_ifs_code($val)
    {
        $this->bi_ifs_code = $val;
    }


    public function insert_product_data($bi_si_id)
    {
        return DB::table($this->table)->insertGetId(
            [
                'bi_invoice_no' => $this->bi_invoice_no,
                'bi_biz_id' => $this->bi_biz_id,
                'bi_payment_status' => $this->bi_payment_status,
                'bi_buyer_id' => $this->bi_buyer_id,
                'bi_add_date' => $this->bi_add_date,
                'bi_add_by' => $this->bi_add_by,
                'bi_si_id' => $bi_si_id
            ]
        );
    }

    public function  add_buyer_product_invoice_data()
    {
        return DB::table($this->table)->insertGetId(
            [
                'bi_commission_price' => $this->bi_commission_price,
                'bi_market_fee' => $this->bi_market_fee,
                'bi_market_fee_per' => $this->bi_market_fee_per,
                'bi_comission' => $this->bi_comission,
                'bi_amount' => $this->bi_amount,
                'bi_total' => $this->bi_total,
                'bi_payment_status' => 'Pending',
                'bi_buyer_id' => $this->bi_buyer_id,
                'bi_add_date' => $this->bi_add_date,
                'bi_gst' => $this->bi_gst,
                'bi_add_by'=>$this->bi_add_by,
            ]
        );
    }

    public function update_buyer_product_invoice_data1()
    {
        return DB::table($this->table)
            ->where('bi_id', $this->bi_id)
            ->update(
                [
                    'bi_commission_price' => $this->bi_commission_price,
                    'bi_market_fee' => $this->bi_market_fee,
                    'bi_market_fee_per' => $this->bi_market_fee_per,
                    'bi_comission' => $this->bi_comission,
                    'bi_amount' => $this->bi_amount,
                    'bi_total' => $this->bi_total,
                    'bi_buyer_id' => $this->bi_buyer_id,
                    'bi_add_by' => $this->bi_add_by,
                ]
            );
    }

    public function insert_buyer_product_data($bi_si_id)
    {
        return DB::table($this->table)->insertGetId(
            [

                'bi_biz_id' => $this->bi_biz_id,
                'bi_payment_status' => $this->bi_payment_status,
                'bi_buyer_id' => $this->bi_buyer_id,
                'bi_add_date' => $this->bi_add_date,
                'bi_add_by' => $this->bi_add_by,
                'bi_si_id' => $bi_si_id,
                'bi_payment_type' => $this->bi_payment_type,
                'bi_cheque_no' => $this->bi_cheque_no,
                'bi_bank_name' => $this->bi_bank_name,
                'bi_ifs_code' => $this->bi_ifs_code,
                'bi_ac_no' => $this->bi_ac_no,
                'bi_commission_price' => $this->bi_commission_price,
                'bi_market_fee' => $this->bi_market_fee,
                'bi_market_fee_per' => $this->bi_market_fee_per,
                'bi_comission' => $this->bi_comission,
                'bi_amount' => $this->bi_amount,
                'bi_total' => $this->bi_total,
            ]
        );
    }

    public function update_invoice_number($bi_id)
    {
        return DB::table($this->table)
            ->where('bi_id', $bi_id)
            ->update(
                [
                    'bi_invoice_no' => $this->bi_invoice_no
                ]
            );

    }


    public function update_product_payment_status()
    {
        return DB::table($this->table)
            ->where('bi_id', $this->bi_id)
            ->update(
                [
                    'bi_bank_name' => $this->bi_bank_name,
                    'bi_cheque_no' => $this->bi_cheque_no,
                    'bi_payment_type' => $this->bi_payment_type,
                    'bi_ac_no' => $this->bi_ac_no,
                    'bi_ifs_code' => $this->bi_ifs_code,
                    'bi_payment_status' => $this->bi_payment_status,
                    'bi_modify_date' => $this->bi_modify_date,
                    'bi_modify_by' => $this->bi_modify_by
                ]
            );
    }

    public function update_product_data()
    {
        return DB::table($this->table)
            ->where('bi_id', $this->bi_id)
            ->update(
                [
                    'bi_payment_type' => $this->bi_payment_type,
                    'bi_cheque_no' => $this->bi_cheque_no,
                    'bi_bank_name' => $this->bi_bank_name,
                    'bi_ifs_code' => $this->bi_ifs_code,
                    'bi_ac_no' => $this->bi_ac_no,
                    'bi_biz_id' => $this->bi_biz_id,
                    'bi_buyer_id' => $this->bi_buyer_id,
                    'bi_commission_price' => $this->bi_commission_price,
                    'bi_market_fee' => $this->bi_market_fee,
                    'bi_market_fee_per' => $this->bi_market_fee_per,
                    'bi_comission' => $this->bi_comission,
                    'bi_amount' => $this->bi_amount,
                    'bi_total' => $this->bi_total,
                    'bi_payment_status' => $this->bi_payment_status
                ]
            );
    }

    public function update_invoice_pdf_data()
    {
        return DB::table($this->table)
            ->where('bi_id', $this->bi_id)
            ->update(
                [
                    'bi_invoice_pdf' => $this->bi_invoice_pdf,
                ]
            );
    }

    public function get_invoice_number($bi_biz_id, $bi_buyer_id)
    {
        $collection = DB::table($this->table)
            ->select('bi_id', 'bi_invoice_no')
            ->where('bi_biz_id', $bi_biz_id)
            ->where('bi_buyer_id', $bi_buyer_id)
            ->take(1)
            ->orderBy('bi_id', 'desc')
            ->get();
        return $collection->toArray();
    }

    public function get_invoice_number_by_bi_bi_is($bi_id)
    {
        $collection = DB::table($this->table)
            ->select('bi_id', 'bi_invoice_no')
            ->where('bi_bi_id', $bi_id)
            ->get();
        return $collection->toArray();
    }

    public function get_invoice_pdf_by_bi_bi_is($bi_id)
    {
        $collection = DB::table($this->table)
            ->select('bi_id', 'bi_invoice_pdf')
            ->where('bi_id', $bi_id)
            ->get();
        return $collection->toArray();
    }

    public function get_buyer_invoice_data_by_bi_id($bi_id, $date,$gst)
    {

        $sql = "
                 SELECT
                 users.id,
                 users.f_name ,
                 users.m_name ,
                 users.biz_id,
                 users.city,
                 users.biz_name,
                 users.email,
                 users.mobile,
                 users.l_name,
                 users.nick_name,
                 users.status,
                  DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d')as product_spi_add_date,
                   DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d') as buyer_date,
                  saller_product_invoice.spi_add_date,
                 users.profile,users.pan_no,users.biz_subject_name,saller_product_invoice.spi_payment_status,
 users.gstin_no,users.address1,users.address2,users.aadhar_no,users.hsn_no,users.city,users.taluko,users.district,users.state,
 users.biz_comission,users.biz_market_name,users.biz_subject_name,users.biz_tel_no,users.biz_mobile,users.biz_logo,
 users.biz_type,users.biz_nick_name,users.add_date,saller_product_invoice.spi_id,
 saller_product_invoice.spi_invoice_no, saller_product_invoice.spi_buyer_id, saller_product_invoice.spi_saller_id,
  saller_product_invoice.spi_no_of_bags, saller_product_invoice.spi_weight,
   saller_product_invoice.spi_rate, saller_product_invoice.spi_amount, saller_product_invoice.spi_total,

    saller_product_invoice.spi_payment_status,saller_product_invoice.spi_si_id,goods_type.gt_is_tax_apply,
 goods_type.gt_type,goods_type.gt_hsn_no,company.biz_name as company_biz_name,
 company.id as company_id, company.f_name as company_f_name,company.biz_id as company_biz_id,
 company.city as company_city,company.biz_name as company_biz_name,company.email as company_email,
 company.mobile as company_mobile,
 company.l_name as company_l_name,company.profile as company_profile,company.pan_no as company_pan_no,
 company.biz_subject_name as company_biz_subject_name,
 company.gstin_no as company_gstin_no,company.address1 as company_address1,
 company.address2 as company_address2,company.aadhar_no as company_aadhar_no,
 company.hsn_no as company_hsn_no,company.city as company_city,company.taluko as company_taluko,
 company.district as company_district,company.state as company_state,
 company.biz_comission as company_biz_comission,
 company.biz_market_name as company_biz_market_name,
 company.biz_subject_name as company_biz_subject_name,company.biz_tel_no as company_biz_tel_no,
 company.biz_mobile as company_biz_mobile,company.biz_logo as company_biz_logo,
  company.biz_tel_no as company_biz_tel_no,
 saller_invoice.si_invoice_no, saller_invoice.si_kg,
 company.biz_type as company_biz_type,
 company.biz_nick_name as company_biz_nick_name,
 farmer_detail.f_name as farmer_name
  FROM `users`
          join saller_product_invoice on saller_product_invoice.spi_buyer_id=users.id
          join users farmer_detail on farmer_detail.id=saller_product_invoice.spi_saller_id
          left join saller_invoice on saller_invoice.si_id=saller_product_invoice.spi_si_id
          join goods_type on saller_product_invoice.spi_gt_id=goods_type.gt_id
          join users company on company.id=users.biz_id
          WHERE users.role_id=3
          AND users.id=$bi_id
          AND  goods_type.gt_is_tax_apply = '$gst'
         AND  DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d')='$date'
          AND saller_product_invoice.spi_total IS NOT NULL
            AND saller_product_invoice.spi_total !=''
            AND saller_product_invoice.spi_status='Active'
        ";


        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_buyer_invoice_data_by_total_count_bi_id($bi_id,$gst)
    {

        $sql = "SELECT buyer_invoice.*
               FROM `users`
              join buyer_invoice on buyer_invoice.bi_buyer_id=users.id
              join users company on company.id=users.biz_id
              WHERE users.role_id=3
              AND buyer_invoice.bi_gst ='$gst'
               AND buyer_invoice.bi_buyer_id=$bi_id
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data($role_id, $user_id)
    {

        $sql = "
       SELECT * FROM `users`
       WHERE users.role_id=3 AND users.status='Active'
        ";

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
        SELECT count($this->table.bi_id) as total
                 FROM $this->table
              WHERE $this->table.bi_payment_status != ''
                $con
        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_count($role_id, $user_id, $search = '')
    {
        $con = '';
        $search_con = '';
        $search_qty = '';
        if ($role_id != 1) {
            $con = "AND $this->table.bi_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {

            if (is_numeric($search)) {
                $search_qty = "HAVING SUM(buyer_product_invoice.`bpi_weight`) like '%" . $search . "%'
                 OR
            bi_total LIKE '%" . $search . "%'
             OR
                bi_id LIKE '%" . $search . "%'";
            } else {
                $search_con = " And (

                bi_id LIKE '%" . $search . "%'
            OR
            buyer_user.f_name LIKE '%" . $search . "%'
            OR
            CONCAT(buyer_user.`f_name`,' ',buyer_user.`m_name`,' ',buyer_user.`l_name`) LIKE '%" . $search . "%'
            OR
            company.biz_name LIKE '%" . $search . "%'
            OR
            buyer_user.mobile LIKE '%" . $search . "%'
            OR
            bi_payment_type LIKE '%" . $search . "%'
            OR
            bi_payment_status LIKE '%" . $search . "%'
            OR
            gt_type LIKE '%" . $search . "%'
             OR
            bi_total LIKE '%" . $search . "%'
            )";
            }
        }
        $sql = "
        SELECT count($this->table.bi_id) as total,GROUP_CONCAT($this->table.bi_total) as bi_total,GROUP_CONCAT($this->table.bi_id) as bi_id
                 FROM $this->table
                LEFT JOIN `users` buyer_user ON buyer_user.id = $this->table.bi_buyer_id
                LEFT JOIN `users` company ON company.id = $this->table.bi_biz_id
                LEFT JOIN `buyer_product_invoice`  ON buyer_product_invoice.bpi_bi_id = $this->table.bi_id
                LEFT JOIN `goods_type` ON FIND_IN_SET(goods_type.gt_id,buyer_product_invoice.bpi_gt_id)
               WHERE $this->table.bi_payment_status != ''
                $con
                $search_con
                $search_qty


        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_by_bi_id($bi_id)
    {
        $sql = "
        SELECT $this->table.bi_total,$this->table.bi_id,
                company.`biz_name`,
                buyer_user.`mobile` as buyer_mobile,
                 goods_type.`gt_type`,
                CONCAT(buyer_user.`f_name`,' ',buyer_user.`m_name`,' ',buyer_user.`l_name`) as buyer_name
                 FROM $this->table
                LEFT JOIN `users` buyer_user ON buyer_user.id = $this->table.bi_buyer_id
                LEFT JOIN `users` company ON company.id = $this->table.bi_biz_id
                LEFT JOIN `buyer_product_invoice`  ON buyer_product_invoice.bpi_bi_id = $this->table.bi_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = buyer_product_invoice.bpi_gt_id
                WHERE $this->table.bi_id = $bi_id
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $ORDER = '';
        if (!empty($order)) {
            $ORDER = "ORDER BY $order $dir";
        }
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
             OR
            buyer_invoice.bi_payment_status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
           SELECT   users.id, users.f_name ,users.biz_id,users.city,users.biz_name,users.email,users.mobile,
     users.l_name,users.nick_name,users.status,users.profile,users.pan_no,users.biz_subject_name,buyer_invoice.*,
      DATE_FORMAT(buyer_invoice.bi_add_date,'%d-%m-%Y') as add_date,
     DATE_FORMAT(buyer_invoice.bi_add_date,'%Y-%m-%d') as buyer_date
     FROM `buyer_invoice` join users on users.id=buyer_invoice.bi_buyer_id
    WHERE users.role_id=3
    AND users.status='Active'
    AND buyer_invoice.bi_status='Active'

       $search_con
       $con
        $ORDER
        LIMIT $start, $limit
        ";


        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_list_count($role_id, $user_id, $search = '')
    {

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
             OR
            buyer_invoice.bi_payment_status LIKE '%" . $search . "%'
             OR
            DATE_FORMAT((buyer_invoice.bi_add_date,'%d-%m-%Y') LIKE '%" . $search . "%'
            )";
        }
        $sql = "
           SELECT   users.id, users.f_name ,users.biz_id,users.city,users.biz_name,users.email,users.mobile,
     users.l_name,users.nick_name,users.status,users.profile,users.pan_no,users.biz_subject_name,buyer_invoice.*,
      DATE_FORMAT(buyer_invoice.bi_add_date,'%d-%m-%Y') as add_date,
     DATE_FORMAT(buyer_invoice.bi_add_date,'%Y-%m-%d') as buyer_date
     FROM `buyer_invoice` join users on users.id=buyer_invoice.bi_buyer_id
    WHERE users.role_id=3
    AND users.status='Active'
    AND buyer_invoice.bi_status='Active'

       $search_con
       $con

        ";
        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_buyer_data_for_payment($bi_id, $date)
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
                    left join saller_invoice on saller_invoice.si_saller_id=users.id WHERE users.status='Active'
                    AND  saller_product_invoice.spi_buyer_id= $bi_id
                    AND  saller_product_invoice.spi_si_id IS NOT NULL
                    AND  saller_product_invoice.spi_si_id !=0
                    AND  DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d') = '$date'
                   /* Group by saller_product_invoice.spi_id having count(saller_product_invoice.spi_id)>=1*/
                ";
        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function get_buyer_details($bi_id)
    {
        $sql = "
       SELECT
               *
           FROM `users`
           WHERE users.status='Active'
           AND  id= $bi_id
       ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function select_buyer_data_for_invoice($bi_id, $date, $gt_is_tax_apply)
    {
        $sql = "
       SELECT
               *
           FROM `buyer_invoice`
           WHERE buyer_invoice.bi_buyer_id=$bi_id
           AND buyer_invoice.bi_gst = '$gt_is_tax_apply'
           AND  DATE_FORMAT(buyer_invoice.bi_add_date,'%Y-%m-%d') = '$date'
       ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function select_buyer_data_from_invoice($bi_id, $date, $gt_is_tax_apply)
    {
        $sql = "
            SELECT
               count(buyer_product_invoice.bpi_id) as total
           FROM `buyer_product_invoice`
           WHERE buyer_product_invoice.bpi_bi_id=$bi_id
           AND buyer_product_invoice.bpi_gst = '$gt_is_tax_apply'
           AND  DATE_FORMAT(buyer_product_invoice.bpi_add_date,'%Y-%m-%d') = '$date'
           AND buyer_product_invoice.bpi_status = 'Active'

       ";

        $results = DB::select(DB::raw($sql));

        return $results;
    }

    public function calculate_total($bpi_bi_id,$bpi_gst,$date){
        $sql = "
        SELECT
       sum(bpi_total) as total
        FROM buyer_product_invoice
        where  bpi_bi_id = $bpi_bi_id
        AND bpi_gst = '$bpi_gst'
         AND  DATE_FORMAT(buyer_product_invoice.bpi_add_date,'%Y-%m-%d') = '$date'
         AND buyer_product_invoice.bpi_status ='Active'
       ";

        $results = DB::select(DB::raw($sql));

        return $results;

    }


    public function find_max_id_for_buyer_invoice($biz_id){
        $sql = "
             SELECT
                max(bi_invoice_no) as max_id
             FROM buyer_invoice
             WHERE buyer_invoice.bi_add_by = $biz_id
              AND buyer_invoice.bi_status ='Active'";

        $results = DB::select(DB::raw($sql));

        return $results;

    }
    public function find_max_id_for_seller_invoice($biz_id){
        $sql = "
             SELECT
                max(si_invoice_no) as max_id
             FROM saller_invoice
             WHERE saller_invoice.si_add_by = $biz_id
              AND saller_invoice.si_status ='Active';
       ";

        $results = DB::select(DB::raw($sql));

        return $results;

    }

     public function select_bi_id_data($bi_id,$gst,$b_date){
         $sql = "
           SELECT
               buyer_invoice.bi_id
           FROM buyer_invoice
           where bi_buyer_id = $bi_id
           AND bi_gst ='$gst'
           AND DATE_FORMAT(buyer_invoice.bi_add_date,'%Y-%m-%d') ='$b_date';
       ";

         $results = DB::select(DB::raw($sql));

         return $results;

     }

    public function select_bi_id_data_count($date){
        $sql = "
           SELECT
              count(buyer_invoice.bi_id) as bill_count
           FROM buyer_invoice
           where DATE_FORMAT(buyer_invoice.bi_add_date,'%Y-%m-%d') ='$date';
       ";

        $results = DB::select(DB::raw($sql));

        return $results;

    }
}
