<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SiteSettings extends Model
{
    protected $table = 'site_settings';

    protected $setting_id = '';
    protected $setting_add_by = '';
    protected $setting_modify_by = '';
    protected $setting_add_date = '';
    protected $setting_modify_date = '';
    protected $fields = '';
    protected $setting_SGST = '';
    protected $setting_IGST = '';
    protected $setting_CGST = '';
    protected $setting_kg_price = '';

    function set_setting_id($val)
    {
        $this->setting_id = $val;
    }

    function set_setting_kg_price($val)
    {
        $this->setting_kg_price = $val;
    }

    function set_setting_SGST($val)
    {
        $this->setting_SGST = $val;
    }

    function set_setting_CGST($val)
    {
        $this->setting_CGST = $val;
    }

    function set_setting_IGST($val)
    {
        $this->setting_IGST = $val;
    }

    function set_setting_add_by($val)
    {
        $this->setting_add_by = $val;
    }

    function set_setting_modify_by($val)
    {
        $this->setting_modify_by = $val;
    }

    function set_setting_add_date($val)
    {
        $this->setting_add_date = $val;
    }

    function set_setting_modify_date($val)
    {
        $this->setting_modify_date = $val;
    }

    function set_fields($val)
    {
        $this->fields = $val;
    }


    public function get_fields_by_id()
    {
        return DB::table($this->table)
            ->select($this->fields)
            ->where('setting_id', $this->setting_id)
            ->get();
    }

    public function get_fields_by_add_by()
    {
        return DB::table($this->table)
            ->select($this->fields)
            ->where('setting_add_by', $this->setting_add_by)
            ->get();
    }

    public function select_site_settings($login_id)
    {

        $sql = "
         	SELECT  setting_id,setting_add_date, setting_SGST,setting_CGST,setting_IGST,setting_kg_price,market_fees,settings_wages,
         	      users.biz_comission,
         	      users.hsn_no,
         	      users.gstin_no,
         	      users.pan_no,
         	      users.aadhar_no
         	FROM site_settings
         	LEFT JOIN users ON users.id = site_settings.setting_add_by
         	ORDER BY setting_id
            limit 1

		";
        $results = DB::select(DB::raw($sql));
        return $results;

    }

    public function get_site_setting()
    {
        return DB::table($this->table)
            ->select('setting_SGST', 'setting_CGST', 'setting_IGST', 'setting_kg_price','market_fees','settings_wages')
            ->get();
    }


    public function insert_site_settings_gst($market_fees,$settings_wages)
    {
        return DB::table($this->table)->insertGetId([
            'setting_SGST' => $this->setting_SGST,
            'setting_CGST' => $this->setting_CGST,
            'setting_IGST' => $this->setting_IGST,
            'setting_kg_price' => $this->setting_kg_price,
            'setting_add_by' => $this->setting_add_by,
            'setting_add_date' => $this->setting_add_date,
            'market_fees'=>$market_fees,
            'settings_wages'=>$settings_wages
        ]);
    }

    public function update_site_settings_gst($market_fees,$settings_wages)
    {
        return DB::table($this->table)
            ->where('setting_id', $this->setting_id)
            ->update([
//                'setting_SGST' => $this->setting_SGST,
//                'setting_CGST' => $this->setting_CGST,
//                'setting_IGST' => $this->setting_IGST,
                'setting_kg_price' => $this->setting_kg_price,
                'setting_modify_by' => $this->setting_modify_by,
                'setting_modify_date' => $this->setting_modify_date,
                'market_fees'=>$market_fees,
                'settings_wages'=>$settings_wages
            ]);
    }

}