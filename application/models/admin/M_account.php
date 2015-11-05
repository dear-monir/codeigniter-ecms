<?php
class M_account extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->query("set character_set_results='utf8'");
    }

    public function get_admin_login_info($data)
    {
        $return_data = '';
        $this->db->select('id,first_name,last_name,email,password');
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_data = array(
                    'id' => $row->id,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'password' => $row->password,
                    'email' => $row->email,
                );
            }
        }


        return $return_data;
    }

    public function check_email_exist($where)
    {
        $return_data = '';
        $this->db->select('id,email');
        $this->db->where('email', $where['email']);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_data = array(
                    'id' => $row->id,
                    'email' => $row->email,
                );
            }
        }


        return $return_data;
    }

    public function check_key_exist($where){
        $return_data = '';
        $this->db->select('id,email,email_key');
        $this->db->where('email_key', $where['email_key']);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_data = array(
                    'id' => $row->id,
                    'email' => $row->email,
                    'email_key' => $row->email
                );
            }
        }


        return $return_data;
    }

    public function update_data($data, $where)
    {

        $this->db->where($where, $where);
        $update=$this->db->update('admin', $data);
        if($update){
            return true;
        }
    }


}