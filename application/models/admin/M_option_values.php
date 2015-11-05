<?php

class M_option_values extends CI_Model
{
    private $language_id;
    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
        $this->language_id = $this->M_adminCommon->language_id;
    }

    public function getAllOptionValues($option_id,$option_value_id =0)
    {
        if($option_value_id == 0)
        {
            $this->db->where('language_id',$this->language_id);
        }
        else
        {
            $this->db->where('product_option_value_id',$option_value_id);
        }

        $this->db->where('product_option_id',$option_id);
        $q = $this->db->get('products_options_values');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
/*
    public function getOptionValuesById($option_id)
    {
        $this->db->where('product_option_id',$option_id);
        $q = $this->db->get('products_options_values');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }

    }
*/
    public function getOptionValuesById($option_id,$product_id)
    {
       $query = "select product_option_value_id,product_option_value_name
                  from products_options_values where product_option_id = $option_id and language_id = {$this->language_id} and product_option_value_id
                  not in
                  (select product_option_value_id from products_attributes where product_id = $product_id)";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }

    }


    public function insertOptionValues($data)
    {
        $this->db->insert('products_options_values',$data);
    }

    public function updateOptionValues($data,$option_id,$lan_id,$option_value_id)
    {
        $this->db->where('product_option_id',$option_id);
        $this->db->where('language_id',$lan_id);
        $this->db->where('product_option_value_id',$option_value_id);
        $this->db->update('products_options_values',$data);
    }

    public function insertOptionValue($data)
    {
        $q = $this->db->insert('options_to_values',$data);
        return $this->db->insert_id();
    }

    public function deleteOptionValue($opt_val_id)
    {
        $query = "delete from products_options_values where product_option_value_id = $opt_val_id";
        $this->db->query($query);
    }

    public function Get_All_Option_Value()
    {
        $query = "select * from products_options_values where language_id = {$this->language_id}";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
}