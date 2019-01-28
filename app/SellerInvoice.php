<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SellerInvoice extends Model
{
    protected $table = 'saller_invoice';

    protected $si_id = '';
    protected $si_invoice_no = '';
    protected $si_si_id = '';
    protected $si_biz_id = '';
    protected $si_saller_id = '';
    protected $si_buyer_id = '';
    protected $si_no_of_bags = '';
    protected $si_weight = '';
    protected $si_bid_price = '';
    protected $si_comission = '';
    protected $si_wages = '';
    protected $si_amount = '';
    protected $si_total = '';
    protected $si_payment_status = '';
    protected $si_add_date = '';
    protected $si_add_by = '';
    protected $si_modify_date = '';
    protected $si_modify_by = '';
    protected $si_commission_price = '';
    protected $si_payment_type = '';
    protected $si_cheque_no = '';
    protected $si_invoice_pdf = '';
    protected $si_wages_total = '';
    protected $si_ac_no = '';
    protected $si_bank_name = '';
    protected $si_ifs_code = '';
    protected $si_other_charge='';
    protected $si_kg='';

    public function set_si_id($val)
    {
        $this->si_id = $val;
    }

    public function set_si_invoice_pdf($val)
    {
        $this->si_invoice_pdf = $val;
    }

    public function set_si_saller_id($val)
    {
        $this->si_saller_id = $val;
    }

    public function set_si_wages_total($val)
    {
        $this->si_wages_total = $val;
    }

    public function set_si_invoice_no($val)
    {
        $this->si_invoice_no = $val;
    }

    public function set_si_biz_id($val)
    {
        $this->si_biz_id = $val;
    }

    public function set_si_buyer_id($val)
    {
        $this->si_buyer_id = $val;
    }

    public function set_si_no_of_bags($val)
    {
        $this->si_no_of_bags = $val;
    }

    public function set_si_weight($val)
    {
        $this->si_weight = $val;
    }

    public function set_si_bid_price($val)
    {
        $this->si_bid_price = $val;
    }

    public function set_si_comission($val)
    {
        $this->si_comission = $val;
    }

    public function set_si_commission_price($val)
    {
        $this->si_commission_price = $val;
    }

    public function set_si_wages($val)
    {
        $this->si_wages = $val;
    }

    public function set_si_amount($val)
    {
        $this->si_amount = $val;
    }

    public function set_si_total($val)
    {
        $this->si_total = $val;
    }

    public function set_si_payment_status($val)
    {
        $this->si_payment_status = $val;
    }

    public function set_si_add_date($val)
    {
        $this->si_add_date = $val;
    }

    public function set_si_add_by($val)
    {
        $this->si_add_by = $val;
    }

    public function set_si_modify_date($val)
    {
        $this->si_modify_date = $val;
    }

    public function set_si_modify_by($val)
    {
        $this->si_modify_by = $val;
    }

    public function set_si_payment_type($val)
    {
        $this->si_payment_type = $val;
    }

    public function set_si_cheque_no($val)
    {
        $this->si_cheque_no = $val;
    }

    public function set_si_bank_name($val)
    {
        $this->si_bank_name = $val;
    }

    public function set_si_ac_no($val)
    {
        $this->si_ac_no = $val;
    }

    public function set_si_ifs_code($val)
    {
        $this->si_ifs_code = $val;
    }
    public function set_other_charge($val){
        $this->si_other_charge = $val;
    }

    public function set_si_kg($val){
        $this->si_kg = $val;
    }
    public function insert_product_data()
    {

        $this->si_biz_id = 0;

        return DB::table($this->table)->insertGetId([
           //'si_invoice_no' => $this->si_invoice_no,
            'si_saller_id' => $this->si_saller_id,
           // 'si_biz_id' => $this->si_biz_id,
            'si_add_date' => $this->si_add_date,
            'si_add_by' => $this->si_add_by,
            'si_payment_status' => $this->si_payment_status,
            'si_bank_name' => $this->si_bank_name,
            'si_cheque_no' => $this->si_cheque_no,
            'si_payment_type' => $this->si_payment_type,
            'si_ac_no' => $this->si_ac_no,
            'si_ifs_code' => $this->si_ifs_code,
            'si_amount' => $this->si_amount,
            'si_wages' => $this->si_wages,
            'si_total' => $this->si_total,
            'si_other_charge'=>$this->si_other_charge,
            'si_kg'=>$this->si_kg
        ]);

    }

    public function update_product_payment_status()
    {
        return DB::table($this->table)
            ->where('si_id', $this->si_id)
            ->update(
                [
                    'si_payment_status' => $this->si_payment_status,
                    'si_bank_name' => $this->si_bank_name,
                    'si_cheque_no' => $this->si_cheque_no,
                    'si_payment_type' => $this->si_payment_type,
                    'si_ac_no' => $this->si_ac_no,
                    'si_ifs_code' => $this->si_ifs_code,
                    'si_modify_date' => $this->si_modify_date,
                  //  'si_modify_by' => $this->si_modify_by
                ]
            );
    }

    public function update_product_data()
    {
        return DB::table($this->table)
            ->where('si_id', $this->si_id)
            ->update(
                [
                    'si_saller_id' => $this->si_saller_id,
                    'si_payment_type' => $this->si_payment_type,
                    'si_cheque_no' => $this->si_cheque_no,
                    'si_bank_name' => $this->si_bank_name,
                    'si_ac_no' => $this->si_ac_no,
                    'si_ifs_code' => $this->si_ifs_code,
                    'si_biz_id' => $this->si_biz_id,
                    'si_wages' => $this->si_wages,
                    'si_wages_total' => $this->si_wages_total,
                    'si_amount' => $this->si_amount,
                    'si_total' => $this->si_total,
                    'si_payment_status' => $this->si_payment_status,
                    'si_other_charge'=>$this->si_other_charge
                ]
            );
    }

    public function update_invoice_pdf_data()
    {
        return DB::table($this->table)
            ->where('si_id', $this->si_id)
            ->update(
                [
                    'si_invoice_pdf' => $this->si_invoice_pdf,
                ]
            );
    }
    public function update_invoice_no($invoice_no,$spi_si_id)
    {
        return DB::table($this->table)
            ->where('si_id', $spi_si_id)
            ->update(
                [
                    'si_invoice_no' => $invoice_no,
                ]
            );
    }

     public  function update_payment_status(){

         return DB::table($this->table)
             ->where('si_id', $this->si_id)
             ->update(
                 [
                     'si_payment_status' => $this->si_payment_status,
                 ]
             );
     }
    public function get_invoice_number( $si_seller_id)
    {
        $collection = DB::table($this->table)
            ->select('si_id', 'si_invoice_no')
           // ->where('si_biz_id', $si_biz_id)
            ->where('si_saller_id', $si_seller_id)
            ->take(1)
            ->orderBy('si_id', 'desc')
            ->get();
        return $collection->toArray();
    }

    public function get_invoice_number_by_si_si_is($si_id)
    {
        $collection = DB::table($this->table)
            ->select('si_id', 'si_invoice_no')
            ->where('si_si_id', $si_id)
            ->get();
        return $collection->toArray();
    }

    public function get_invoice_pdf_by_si_si_is($si_id)
    {
        $collection = DB::table($this->table)
            ->select('si_id', 'si_invoice_pdf')
            ->where('si_id', $si_id)
            ->get();
        return $collection->toArray();
    }

    public function get_seller_data_by_date($seller_id,$date)
    {

        $sql = "SELECT $this->table.*
         FROM $this->table
        WHERE $this->table.si_saller_id = $seller_id
        AND  DATE($this->table.si_add_date) = '$date'
        AND $this->table.si_status ='Active'
        ";
      //  echo $sql;exit;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_bzc_id_by_bzcp_id($si_id)
    {
        $sql = "
        SELECT $this->table.*,
        saller_product_invoice.spi_id
         FROM $this->table
         LEFT JOIN `saller_product_invoice` ON saller_product_invoice.spi_si_id = $this->table.si_id
        WHERE $this->table.si_id = $si_id
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_seller_invoice_data_by_si_id($si_id)
    {
        $sql = "
        SELECT $this->table.*,
                company.*,si_invoice_pdf,
                seller_user.`gstin_no` as seller_gstin_no,seller_user.`address1` as seller_address1,seller_user.`address2` as seller_address2,
                seller_user.`city` as seller_city,seller_user.`taluko` as seller_taluko,seller_user.`district` as seller_district,seller_user.`state` as seller_state,
                seller_user.`pan_no` as seller_pan_no,
                seller_user.`mobile` as seller_mobile,
                `site_settings`.setting_kg_price,
                CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) as seller_name
                 FROM $this->table
                LEFT JOIN `users` seller_user ON seller_user.id = $this->table.si_saller_id
                LEFT JOIN `users` company ON company.id = $this->table.si_biz_id
                LEFT JOIN `site_settings`ON site_settings.setting_add_by = $this->table.si_biz_id
                WHERE $this->table.si_id = $si_id


        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_seller_invoice_data_by_saller_id($saller_id,$date)
    {
        $sql = "
        SELECT $this->table.*,
                si_invoice_pdf,
                company.`gstin_no` as company_gstin_no,
                company.`address1` as company_address1,
                company.`address2` as company_address2,
                company.`city` as company_city,
                company.`taluko` as company_taluko,
                company.`district` as company_district,
                company.`state` as company_state,
                company.`id` as company_id,
                company.`pan_no` as company_pan_no,
                company.`mobile` as company_mobile,
                company.`biz_mobile` as company_biz_mobile,
                company.`biz_tel_no` as company_biz_tel_no,
                company.`biz_logo` as company_biz_logo,
                company.`biz_market_name` as company_biz_market_name,
                company.`biz_subject_name` as company_biz_subject_name,
                company.`nick_name` as company_nick_name,
                company.`biz_type` as company_biz_type,
                company.`biz_name` as company_biz_name,
                seller_user.`gstin_no` as seller_gstin_no,
                seller_user.`address1` as seller_address1,
                seller_user.`address2` as seller_address2,
                seller_user.`city` as seller_city,
                seller_user.`taluko` as seller_taluko,
                seller_user.`district` as seller_district,
                seller_user.`state` as seller_state,
                seller_user.`pan_no` as seller_pan_no,
                 seller_user.`hsn_no` as seller_hsn_no,
                seller_user.`mobile` as seller_mobile,
                `site_settings`.setting_kg_price,
                CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) as seller_name
                 FROM $this->table
                LEFT JOIN `users` seller_user ON seller_user.id = $this->table.si_saller_id
                LEFT JOIN `users` company ON company.id = seller_user.biz_id
                LEFT JOIN `site_settings`ON site_settings.setting_add_by = $this->table.si_biz_id
                WHERE $this->table.si_saller_id = $saller_id
                AND $this->table.si_status = 'Active'
                 AND DATE (si_add_date)='$date'

        ";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_invoice_data_by_si_id($si_id)
    {
        $sql = "
        SELECT $this->table.si_total,$this->table.si_id,
                company.`biz_name`,
                seller_user.`mobile` as seller_mobile,
                 goods_type.`gt_type`,
                CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) as seller_name
                 FROM $this->table
                LEFT JOIN `users` seller_user ON seller_user.id = $this->table.si_saller_id
                LEFT JOIN `users` company ON company.id = $this->table.si_biz_id
                LEFT JOIN `saller_product_invoice`  ON saller_product_invoice.spi_si_id = $this->table.si_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = saller_product_invoice.spi_gt_id
                WHERE $this->table.si_id = $si_id
        ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data($role_id, $user_id)
    {


        $sql = "
        SELECT $this->table.si_invoice_no,$this->table.si_id,$this->table.si_payment_status,$this->table.si_payment_type,$this->table.si_total,
                company.`biz_name`,
                seller_user.`mobile` as seller_mobile,
                seller_user.`id` as seller_id,

                CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) as seller_name
                 FROM $this->table
                LEFT JOIN `users` seller_user ON seller_user.id = $this->table.si_saller_id
                 LEFT JOIN `users` company ON company.id = $this->table.si_biz_id



        ";
//        echo $sql;
//        exit;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function get_invoice_data_list($role_id, $user_id, $start, $limit, $order, $dir, $search = '')
    {
        $con = '';
        $search_con = '';
        $search_qty = '';
        if ($role_id != 1) {
            $con = "AND $this->table.si_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {

            if(is_numeric($search)){
                $search_qty = "
                HAVING SUM(saller_product_invoice.`spi_weight`) like '%" . $search . "%'
                OR
                 $this->table.si_total LIKE '%" . $search . "%'
                 OR
                 $this->table.si_id LIKE '%" . $search . "%'";
            }else{
                $search_con = "  AND (

                si_id LIKE '%" . $search . "%'
            OR
            seller_user.f_name LIKE '%" . $search . "%'
            OR
            company.biz_name LIKE '%" . $search . "%'
            OR
            seller_user.mobile LIKE '%" . $search . "%'
            OR
            si_payment_type LIKE '%" . $search . "%'
            OR
            si_payment_status LIKE '%" . $search . "%'
            OR
            goods_type.gt_type LIKE '%" . $search . "%'
            OR
            spi_weight LIKE '%" . $search . "%'
             OR
            CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) LIKE '%" . $search . "%'
             OR
            si_total LIKE '%" . $search . "%'
            )";
            }

        }
        $sql = "
        SELECT SUM(saller_product_invoice.`spi_weight`) as spi_weight,
            $this->table.si_invoice_no,$this->table.si_id,$this->table.si_payment_status,$this->table.si_payment_type,$this->table.si_total,
                company.`biz_name`,
                seller_user.`mobile` as seller_mobile,
                seller_user.`id` as seller_id,
                goods_type.`gt_type`,
                CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) as seller_name
                 FROM $this->table
                LEFT JOIN `users` seller_user ON seller_user.id = $this->table.si_saller_id
                LEFT JOIN `saller_product_invoice`  ON saller_product_invoice.spi_si_id = $this->table.si_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = saller_product_invoice.spi_gt_id
                LEFT JOIN `users` company ON company.id = $this->table.si_biz_id
                 WHERE $this->table.si_payment_status != ''
                $con
                 $search_con
                 GROUP BY $this->table.si_id,$this->table.si_invoice_no,$this->table.si_id,$this->table.si_payment_status,$this->table.si_payment_type,$this->table.si_total,
                 company.`biz_name`,
                 seller_mobile,
                 seller_id,
                 seller_name,
                goods_type.`gt_type`
                  $search_qty
                 ORDER BY $order $dir
         	LIMIT $start, $limit
        "; //echo "<pre>".$sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function count_data($role_id, $user_id)
    {
        $con = '';
        if ($role_id != 1) {
            $con = "AND $this->table.si_biz_id = $user_id";
        }

        $sql = "
        SELECT count($this->table.si_id) as total
                 FROM $this->table
              WHERE $this->table.si_payment_status != ''
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
            $con = "AND $this->table.si_biz_id = $user_id";
        }
        if (isset($search) && !empty($search)) {

            if(is_numeric($search)){
                $search_qty = "
                HAVING SUM(saller_product_invoice.`spi_weight`) like '%" . $search . "%'
                OR
                 si_total LIKE '%" . $search . "%'
                 OR
                 si_id LIKE '%" . $search . "%'";
            }else{
                $search_con = "  AND (

                si_id LIKE '%" . $search . "%'
            OR
            seller_user.f_name LIKE '%" . $search . "%'
            OR
            company.biz_name LIKE '%" . $search . "%'
            OR
            seller_user.mobile LIKE '%" . $search . "%'
            OR
            si_payment_type LIKE '%" . $search . "%'
            OR
            si_payment_status LIKE '%" . $search . "%'
            OR
            goods_type.gt_type LIKE '%" . $search . "%'
            OR
            spi_weight LIKE '%" . $search . "%'
             OR
            CONCAT(seller_user.`f_name`,' ',seller_user.`m_name`,' ',seller_user.`l_name`) LIKE '%" . $search . "%'
             OR
            si_total LIKE '%" . $search . "%'
            )";
            }
        }
        $sql = "
        SELECT count($this->table.si_id) as total,GROUP_CONCAT(saller_invoice.si_total) as si_total,GROUP_CONCAT(saller_invoice.si_id) as si_id
                 FROM $this->table
                LEFT JOIN `users` seller_user ON seller_user.id = $this->table.si_saller_id
                LEFT JOIN `users` company ON company.id = $this->table.si_biz_id
                LEFT JOIN `saller_product_invoice`  ON saller_product_invoice.spi_si_id = $this->table.si_id
                LEFT JOIN `goods_type` ON goods_type.gt_id = saller_product_invoice.spi_gt_id
                WHERE $this->table.si_payment_status != ''
                $con
                $search_con
                $search_qty
        ";
        // echo "<pre>".$sql;die;
        $results = DB::select(DB::raw($sql));
        return $results;
    }

      /*--------------------------------Change Status---------------------------------------*/

    public function update_bi_status($bi_id,$date,$gt_is_tax_apply)
    {

        $sql = "
          UPDATE buyer_invoice SET bi_status= 'Inactive'
          WHERE buyer_invoice.bi_buyer_id = $bi_id
          AND DATE_FORMAT(buyer_invoice.bi_add_date,'%Y-%m-%d')= '$date'
          AND buyer_invoice.bi_status = '$gt_is_tax_apply' "
        ;

        $results = DB::update($sql);
        return $results;
    }

    public function update_bpi_status($bpi_saller_id,$date)
    {
        $sql = "
          UPDATE buyer_product_invoice SET bpi_status= 'Inactive'
          WHERE buyer_product_invoice.bpi_saller_id = $bpi_saller_id
          AND DATE_FORMAT(buyer_product_invoice.bpi_add_date,'%Y-%m-%d')= '$date' "
        ;

        $results = DB::update($sql);
        return $results;
    }

    public function update_si_status($si_saller_id,$date)
    {
        $sql = "
          UPDATE saller_invoice SET si_status= 'Inactive'
          WHERE saller_invoice.si_saller_id = $si_saller_id
          AND DATE_FORMAT(saller_invoice.si_add_date,'%Y-%m-%d')= '$date' "
        ;

        $results = DB::update($sql);
        return $results;

    }

    public function update_spi_status($spi_saller_id,$date)
    {

        $sql = "
          UPDATE saller_product_invoice SET spi_status= 'Inactive'
          WHERE saller_product_invoice.spi_saller_id = $spi_saller_id
          AND DATE_FORMAT(saller_product_invoice.spi_add_date,'%Y-%m-%d')= '$date' "
        ;

        $results = DB::update($sql);
        return $results;

    }
}
