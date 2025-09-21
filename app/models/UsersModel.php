<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * Automatically generated via CLI.
 */
class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = null, $page = null) 
{
    if (is_null($page)) {
        return $this->db->table($this->table)->get_all();
    } else {
        $query = $this->db->table($this->table);

        // Build LIKE conditions (grouped properly)
        if (!empty($q)) {
            $query->like('id', '%'.$q.'%')
                  ->or_like('username', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%');
        }

        // Clone query for counting
        $countQuery = clone $query;
        $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

        // Calculate offset
        $offset = ($page - 1) * $records_per_page;

        // Fetch paginated records
        $data['records'] = $query->limit($records_per_page, $offset)->get_all();

        return $data;
    }
}
}