<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainModel extends CI_Model
{

    public function get($table)
    {
        return $this->db->get($table)->result();
    }

    public function get_where($table, $where = [], $no_result = false)
    {
        $query = $this->db->get_where($table, $where);
        if ($no_result) {
            return $query;
        } else {
            if ($query->num_rows() > 1) {
                return $query->result();
            } else {
                return $query->row();
            }
        }
    }

    public function get_where_in($table, $field, $values = [])
    {
        $this->db->where_in($field, $values);
        return $this->db->get($table)->result();
    }

    public function getId($prefix = null, $table = null, $field = null)
    {
        $this->db->select_max($field);
        $this->db->like($field, $prefix, 'after');
        return $this->db->get($table)->row_array()[$field];
    }

    public function insert($table, $data = [])
    {
        return $this->db->insert($table, $data);
    }

    public function insert_batch($table, $data = [])
    {
        return $this->db->insert_batch($table, $data);
    }

    public function update($table, $data = [], $where = [])
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    
}