<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $table = 'role';

    protected $r_id = '';
    protected $r_type = '';
    protected $r_status = '';
    protected $r_add_date = '';
    protected $r_modify_date = '';
    protected $r_add_by = '';
    protected $r_modify_by = '';
    public function set_r_id($val)
    {
        $this->r_id = $val;
    }

    public function set_r_type($val)
    {
        $this->r_type = $val;
    }

    public function set_r_status($val)
    {
        $this->r_status = $val;
    }

    public function set_r_add_date($val)
    {
        $this->r_add_date = $val;
    }

    public function set_r_modify_date($val)
    {
        $this->r_modify_date = $val;
    }

    public function set_r_add_by($val)
    {
        $this->r_add_by = $val;
    }

    public function set_r_modify_by($val)
    {
        $this->r_modify_by = $val;
    }

    public function set_fields($val)
    {
        $this->fields = $val;
    }

    public function change_status()
    {
        return DB::table($this->table)
            ->where('r_id', $this->r_id)
            ->update(['r_status' => $this->r_status,
                'r_modify_date' => $this->r_modify_date
            ]);
    }

    public function select_all()
    {
        $collection = DB::table($this->table)
            ->select('*')
            ->get();
        return $collection->toArray();
    }

    public function select_all_without_member()
    {
        $collection = DB::table($this->table)
            ->select('r_id', 'r_type')
            ->where('r_status', '=', 'Active')
            ->get();
        return $collection->toArray();
    }

    public function role_list_count($search = '')
    {
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = "WHERE (
            r_id LIKE '%" . $search . "%'
            OR
            r_status LIKE '%" . $search . "%'
            OR
            r_type LIKE '%" . $search . "%'
            OR
             (SELECT count(users.role_id)
                  FROM users
                  WHERE users.role_id = role.r_id) LIKE '%" . $search . "%'
            )";
        }
        $sql = "
                SELECT count(role.r_id) as total

                FROM role
                 $search_con
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function role_list($start, $limit, $order, $dir, $search = '')
    {
        $search_con = '';
        if (isset($search) && !empty($search)) {
            $search_con = "WHERE (
            r_id LIKE '%" . $search . "%'
            OR
            r_status LIKE '%" . $search . "%'
            OR
            r_type LIKE '%" . $search . "%'
            OR
             (SELECT count(users.role_id)
                  FROM users
                  WHERE users.role_id = role.r_id) LIKE '%" . $search . "%'
            )";
        }
        $sql = "
                SELECT role.*,
                  (
                  SELECT count(users.role_id)
                  FROM users
                  WHERE users.role_id = role.r_id
                  ) as users_count

                FROM role
                 $search_con
                ORDER BY $order $dir
         	LIMIT $start, $limit
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function role_count_without_member()
    {
        $sql = "
                SELECT
                    DISTINCT users.role_id,
                    role.r_type,
                    count(users.role_id) as users_count
                FROM role
                LEFT JOIN users ON role.r_id = users.role_id
                WHERE role.r_status = 'Active'
                AND users.role_id NOT IN ('2','3')
                GROUP BY role.r_id
            ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }

    public function select_field_by_user_id_status()
    {
        $collection = DB::table($this->table)
            ->select($this->fields)
            ->where($this->table . '.r_id', $this->r_id)
            ->get();
        return $collection->toArray();

    }

    public function is_unique_role()
    {
        $collection = DB::table($this->table)
            ->select('r_id', 'r_type')
            ->where($this->table . '.r_type', $this->r_type)
            ->get();
        return $collection->toArray();
    }

    public function role_create_post()
    {
        return DB::table($this->table)->insertGetId(
            [
                'r_type' => $this->r_type,
                'r_status' => $this->r_status,
                'r_add_by' => $this->r_add_by,
                'r_add_date' => $this->r_add_date
            ]
        );
    }

}