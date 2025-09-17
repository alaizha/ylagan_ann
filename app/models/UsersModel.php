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

    // ✅ Get users with pagination + optional search
    public function getUsers($limit, $offset, $search = '') {
        $db = $this->db->table($this->table);

        if (!empty($search)) {
            $db->like('username', $search)
               ->or_like('email', $search);
        }

        return $db->limit($limit, $offset)->get_all();
    }

    // ✅ Count total users (for pagination)
    public function countUsers($search = '') {
        $db = $this->db->table($this->table);

        if (!empty($search)) {
            $db->like('username', $search)
               ->or_like('email', $search);
        }

        return $db->count();
    }
}
