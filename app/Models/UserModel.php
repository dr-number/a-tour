<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class UserModel extends Model{
    protected $table = 'users';
    protected $allowedFields = ['user_name','user_email','user_password','user_created_at'];

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
        // OR $this->db = db_connect();
    }

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function delete_data($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }

    public function get_all_data()
    {
        $query = $this->db->query('select * from ' . $this->table);
        return $query->getResult();
    }
}
