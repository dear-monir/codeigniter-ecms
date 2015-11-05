<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/15/13
 * Time: 3:10 PM
 * To change this template use File | Settings | File Templates.
 */
class M_customers extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query("set character_set_results='utf8'");
    }

    public function getById($customer_id)
    {
        $query = "select customer_gender,customer_firstname,customer_lastname,customer_street,customer_city,customer_postcode,customer_mobile_no,customer_email,customer_state_id,customer_country_id,country_name,name from customers,countries,states where customer_id = $customer_id and customer_country_id = countries.country_id and customer_state_id = states.id";
        $row     = $this->db->query($query)->first_row();
        return $row;
    }

    public function insertCustomerInfo($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function confirm_key($table, $data)
    {
        $return_data = '';
        $this->db->select('customer_id,customer_firstname,customer_lastname,customer_email,active,key');
        $this->db->where('key', $data['key']);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_data = array(
                    'customer_id' => $row->customer_id,
                    'customer_firstname' => $row->customer_firstname,
                    'customer_lastname' => $row->customer_lastname,
                    'customer_email' => $row->customer_email,
                    'active' => $row->active,
                    'key' => $row->key
                );
            }
        } else {
            $return_data = null;
        }
        return $return_data;
    }

    public function getCustomerInfo($table, $data)
    {
        $return_data = '';
        $this->db->select('customer_id,customer_firstname,customer_lastname,customer_password,customer_email,key,active');
        $this->db->where('customer_email', $data['customer_email']);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_data = array(
                    'customer_id' => $row->customer_id,
                    'customer_firstname' => $row->customer_firstname,
                    'customer_lastname' => $row->customer_lastname,
                    'customer_password' => $row->customer_password,
                    'customer_email' => $row->customer_email,
                    'key' => $row->key,
                    'active' => $row->active
                );
            }
        }


        return $return_data;
    }

    public function customer_login_info($table, $data)
    {
        $return_data = '';
        $this->db->select('customer_id,customer_password,customer_firstname,customer_lastname,customer_email,active');
        $this->db->where('customer_email', $data['customer_email']);
        $this->db->where('customer_password', $data['customer_password']);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $return_data = array(
                    'customer_id' => $row->customer_id,
                    'customer_password' => $row->customer_password,
                    'customer_firstname' => $row->customer_firstname,
                    'customer_lastname' => $row->customer_lastname,
                    'customer_email' => $row->customer_email,
                    'active' => $row->active
                );
            }
        }


        return $return_data;
    }
    public function get_customer_account_info($data,$where){
        $returndata = '';
        $this->db->select($data);
        $this->db->where('customer_email', $where['customer_email']);
        $query = $this->db->get('customers');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $returndata = array(
                    'customer_id' => $row->customer_id,
                    'customer_gender' => $row->customer_gender,
                    'customer_firstname' => $row->customer_firstname,
                    'customer_lastname' => $row->customer_lastname,
                    'customer_dob' => $row->customer_dob,
                    'customer_email' => $row->customer_email,
                    'customer_mobile_no' => $row->customer_mobile_no,

                );
            }
        }


        return $returndata;
    }
    public function get_customer_address_info($data,$where){
        $returndata = '';
        $this->db->select($data);
        $this->db->where('customer_email', $where['customer_email']);
        $query = $this->db->get('customers');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $returndata = array(
                    'customer_id' => $row->customer_id,
                    'customer_company' => $row->customer_company,
                    'customer_street' => $row->customer_street,
                    'customer_suburb' => $row->customer_suburb,
                    'customer_postcode' => $row->customer_postcode,
                    'customer_city' => $row->customer_city,
                    'customer_state' => $row->customer_state,
                    'customer_country' => $row->customer_country,
                    'customer_telephone_no' => $row->customer_telephone_no,

                );
            }
        }


        return $returndata;
    }
    public function update_customer_info($data,$where){

        $this->db->where('customer_id', $where);
        $this->db->update('customers', $data);
    }

    public function getCustomerId($table, $data)
    {
        $customersId = '';
        $this->db->select('customer_id,customer_firstname,customer_lastname,customer_email,key,active');
        $this->db->where('customer_email', $data['customer_email']);
        $this->db->where('customer_password', $data['customer_password']);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $customersId = $row->customer_id;
            }

        } else {
            $customersId = null;
        }

        return $customersId;
    }

    public function activate_customer($table, $data)
    {
        $update_data = array(
            'active' => 1
        );
        $this->db->where('customer_id', $data['customer_id']);
        $this->db->where('customer_email', $data['customer_email']);
        $this->db->where('key', $data['key']);
        $this->db->update($table, $update_data);

    }
}
