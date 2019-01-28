<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consignment extends Model
{
    protected $table = 'biz_consignment';

    protected $bzc_id='';
    protected $bzc_consignment_no='';
    protected $bzc_seller_user_id='';
    protected $bzc_total='';
    protected $bzc_add_date='';
    protected $bzc_add_by='';
    protected $bzc_modify_date='';
    protected $bzc_modify_by='';
    protected $bzc_biz_id='';


    public function set_bzc_id($val){ $this->bzc_id=$val; }
    public function set_bzc_biz_id($val){ $this->bzc_biz_id=$val; }
    public function set_bzc_consignment_no ($val){ $this->bzc_consignment_no =$val; }
    public function set_bzc_seller_user_id($val){ $this->bzc_seller_user_id=$val; }
    public function set_bzc_add_date($val){ $this->bzc_add_date=$val; }
    public function set_bzc_total($val){ $this->bzc_total=$val; }
    public function set_bzc_add_by($val){ $this->bzc_add_by=$val; }
    public function set_bzc_modify_date($val){ $this->bzc_modify_date=$val; }
    public function set_bzc_modify_by($val){ $this->bzc_modify_by=$val; }


    public function insert_consignment_data(){
        return DB::table($this->table)->insertGetId(
            [
                'bzc_consignment_no'=>$this->bzc_consignment_no,
                'bzc_biz_id'=>$this->bzc_biz_id,
                'bzc_seller_user_id'=>$this->bzc_seller_user_id,
                'bzc_add_date'=>$this->bzc_add_date,
                'bzc_total'=>$this->bzc_total,
                'bzc_add_by'=>$this->bzc_add_by

            ]
        );
    }

    public function update_consignment_data(){
        return DB::table($this->table)
            ->where('bzc_id', $this->bzc_id)
            ->update(
                [
                    'bzc_seller_user_id'=>$this->bzc_seller_user_id,
                    'bzc_biz_id'=>$this->bzc_biz_id,
                    'bzc_total'=>$this->bzc_total,
                    'bzc_modify_date'=>$this->bzc_modify_date,
                    'bzc_modify_by'=>$this->bzc_modify_by,
                    'bzc_consignment_no'=>$this->bzc_consignment_no
                ]
            );
    }

    public function get_consignment(){
        $collection = DB::table($this->table)
            ->get();
        return $collection->toArray();
    }
    public function get_goods_type_seller_id(){
        $collection = DB::table($this->table)
            ->where('bzc_seller_user_id', $this->bzc_seller_user_id)
            ->take(1)
            ->orderBy('bzc_id', 'desc')
            ->get();
        return $collection->toArray();
    }

    public function delete_consignment($consignment_id){
        return DB::table($this->table)
            ->where('bzc_id', $consignment_id)
            ->delete();
    }

}
