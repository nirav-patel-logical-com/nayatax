<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    protected $table = 'module';

    protected $mod_id = '';
    protected $mod_group = '';
    protected $mod_title = '';
    protected $mod_short_code = '';
    protected $mod_status = '';
    protected $mod_add_date = '';
    protected $mod_modify_date = '';
    protected $mod_add_by = '';
    public function set_mod_id($val)
    {
        $this->mod_id = $val;
    }

    public function set_mod_group($val)
    {
        $this->mod_group = $val;
    }

    public function set_mod_title($val)
    {
        $this->mod_title = $val;
    }

    public function set_mod_short_code($val)
    {
        $this->mod_short_code = $val;
    }

    public function set_mod_status($val)
    {
        $this->mod_status = $val;
    }

    public function set_mod_add_date($val)
    {
        $this->mod_add_date = $val;
    }

    public function set_mod_modify_date($val)
    {
        $this->mod_modify_date = $val;
    }

    public function set_mod_add_by($val)
    {
        $this->mod_add_by = $val;
    }

    public function set_fields($val)
    {
        $this->fields = $val;
    }

    public function change_status()
    {
        return DB::table($this->table)
            ->where('mod_id', $this->mod_id)
            ->update(['mod_status' => $this->mod_status
            ]);
    }

    public function select_all()
    {
        return DB::table($this->table)
            ->select('*')
            ->get();
    }

    public function module_list_count($search = '')
    {
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = "WHERE (
            mod_id LIKE '%" . $search . "%'
            OR
            mod_status LIKE '%" . $search . "%'
            OR
            mod_title LIKE '%" . $search . "%'
            OR
            mod_group LIKE '%" . $search . "%'
            OR
            mod_add_date LIKE '%" . $search . "%'
            )";
        }
        $sql = "
                SELECT
                    count(mod_id) as total
                FROM module
                $search_con;
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function module_list($start, $limit, $order, $dir, $search = '')
    {
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = " WHERE(
            mod_id LIKE '%" . $search . "%'
            OR
            mod_status LIKE '%" . $search . "%'
            OR
            mod_title LIKE '%" . $search . "%'
            OR
            mod_group LIKE '%" . $search . "%'
            OR
            mod_add_date LIKE '%" . $search . "%'
            )";
        }
        $sql = "
                SELECT
                    *
                FROM module
                $search_con
                  ORDER BY $order $dir
         	LIMIT $start, $limit
         	;
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function select_all_module_for_form()
    {
        $collection = DB::table($this->table)
            ->select('mod_id', 'mod_title', 'mod_short_code', 'mod_group')
            ->where('mod_status', 'Active')
            ->orderBy('mod_title')
            ->get();
        return $collection->toArray();
    }

    public function is_unique_module()
    {
        $collection = DB::table($this->table)
            ->select('mod_id', 'mod_title')
            ->where($this->table . '.mod_title', $this->mod_title)
            ->get();
        return $collection->toArray();
    }

    public function module_create_post()
    {
        return DB::table($this->table)->insertGetId(
            [
                'mod_group' => $this->mod_group,
                'mod_title' => $this->mod_title,
                'mod_short_code' => $this->mod_short_code,
                'mod_status' => $this->mod_status,
                'mod_add_date' => $this->mod_add_date,
                'mod_add_by' => $this->mod_add_by
            ]
        );
    }

    public function select_by_mod_short_code()
    {
        $collection = DB::table($this->table)
            ->select('mod_id', 'mod_title', 'mod_group')
            ->where('mod_short_code', $this->mod_short_code)
            ->get();
        return $collection->toArray();
    }

}