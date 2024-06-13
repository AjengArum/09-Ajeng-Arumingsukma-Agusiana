<?php
class User_model extends CI_Model {

    public function authenticate($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('tb_user');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tb_user');
        return $query->row_array();
    }

    public function get_all_users()
    {
        $query = $this->db->get('tb_user');
        return $query->result_array();
    }

    public function create_user($data)
    {
        $this->db->insert('tb_user', $data);
        return $this->db->insert_id();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user', $data);
        return $this->db->affected_rows();
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_user');
        return $this->db->affected_rows();
    }
}