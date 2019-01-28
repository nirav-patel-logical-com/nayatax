<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissions extends Model
{
    protected $table = 'permissions';

    protected $per_id = '';
    protected $per_rl_id = '';
    protected $per_mod_id = '';
    protected $per_permission = '';
    protected $per_status = '';
    protected $per_add_date = '';
    protected $per_modify_date = '';
    protected $per_add_by = '';
    protected $per_modify_by = '';

    public function set_per_id($val)
    {
        $this->per_id = $val;
    }

    public function set_per_rl_id($val)
    {
        $this->per_rl_id = $val;
    }

    public function set_per_mod_id($val)
    {
        $this->per_mod_id = $val;
    }

    public function set_per_permission($val)
    {
        $this->per_permission = $val;
    }

    public function set_per_status($val)
    {
        $this->per_status = $val;
    }

    public function set_per_add_date($val)
    {
        $this->per_add_date = $val;
    }

    public function set_per_modify_date($val)
    {
        $this->per_modify_date = $val;
    }

    public function set_per_add_by($val)
    {
        $this->per_add_by = $val;
    }

    public function set_per_modify_by($val)
    {
        $this->per_modify_by = $val;
    }

    protected $fields = '';

    function set_fields($val)
    {
        $this->fields = $val;
    }

    function get_table()
    {
        return $this->table;
    }

    public function select_field_by_id()
    {
        $collection = DB::table($this->table)
            ->select($this->fields)
            ->where('per_id', $this->per_id)
            ->get();
        return $collection->toArray();
    }

    public function check_by_module_and_role()
    {
        $collection = DB::table($this->table)
            ->select('per_id', 'per_permission')
            ->where('per_mod_id', $this->per_mod_id)
            ->where('per_rl_id', $this->per_rl_id)
            ->get();
        return $collection->toArray();
    }

    public function insert_module_permission_role()
    {
        return DB::table($this->table)->insertGetId(
            [
                'per_mod_id' => $this->per_mod_id,
                'per_rl_id' => $this->per_rl_id,
                'per_permission' => $this->per_permission,
                'per_add_by' => $this->per_add_by,
                'per_add_date' => $this->per_add_date
            ]
        );
    }

    public function update_module_permission_role()
    {
        return DB::table($this->table)
            ->where('per_id', $this->per_id)
            ->update(
                [
                    'per_permission' => $this->per_permission,
                    'per_modify_by' => $this->per_modify_by,
                    'per_modify_date' => $this->per_modify_date
                ]
            );
    }

    public function  select_permission_by_role()
    {
        $collection = DB::table($this->table)
            ->select('per_id', 'per_permission', 'module.mod_title','module.mod_short_code')
            ->leftJoin('module', 'module.mod_id', '=', 'permissions.per_mod_id')
            ->where('per_rl_id', $this->per_rl_id)
            ->where('mod_status', 'Active')
            ->get();
        return $collection->toArray();
    }

}

?>