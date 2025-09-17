<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 */
class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ✅ Get users with pagination and optional search filter
     *
     * @param int $limit
     * @param int $offset
     * @param string $search
     * @return array
     */
    public function getUsers($limit, $offset, $search = '') {
        $db = $this->db->table($this->table);

        if (!empty($search)) {
            $db->like('username', $search)
               ->or_like('email', $search);
        }

        return $db->limit($limit, $offset)->get_all();
    }

    /**
     * ✅ Count total users (with optional search filter)
     *
     * @param string $search
     * @return int
     */
    public function countUsers($search = '') {
        $db = $this->db->table($this->table);

        if (!empty($search)) {
            $db->like('username', $search)
               ->or_like('email', $search);
        }

        return $db->count();
    }
}
