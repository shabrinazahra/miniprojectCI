<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    private $table = 'products';

    public function get_all()
    {
        return $this->db
            ->order_by('id', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }

    public function code_exists($code, $exclude_id = null)
    {
        $this->db->where('product_code', $code);

        if ($exclude_id !== null) {
            $this->db->where('id !=', $exclude_id);
        }

        return $this->db->count_all_results($this->table) > 0;
    }
}
