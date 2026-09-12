<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variation_model extends CI_Model
{
    public function get_colors($product_id)
    {
        return $this->db
            ->where('product_id', $product_id)
            ->get('product_colors')
            ->result();
    }

    public function get_sizes($color_id)
    {
        return $this->db
            ->where('color_id', $color_id)
            ->get('product_sizes')
            ->result();
    }

    public function insert_color($data)
    {
        $this->db->insert('product_colors', $data);
        return $this->db->insert_id();
    }

    public function insert_size($data)
    {
        return $this->db->insert('product_sizes', $data);
    }

    public function delete_color($color_id)
    {
        return $this->db
            ->where('id', $color_id)
            ->delete('product_colors');
    }
}