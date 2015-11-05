<?php

class M_products_options extends CI_Model
{
    private $language_id;
    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
        $this->language_id = $this->M_adminCommon->language_id;
    }
    public function getAllOption()
    {
        $this->db->where('language_id',$this->language_id);
        $q = $this->db->get('product_option_description');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getOptionById($option_id)
    {
        $this->db->where('product_option_id',$option_id);
        $q = $this->db->get('product_option_description');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }

    }

    public function insertOptionDescription($data)
    {
        $this->db->insert('product_option_description',$data);
    }

        public function updateOptionDescription($data,$option_id,$lan_id)
        {
            $this->db->where('product_option_id',$option_id);
            $this->db->where('language_id',$lan_id);
            $this->db->update('product_option_description',$data);
        }

    public function insertOption()
    {
        $q = $this->db->query("insert into products_options values('')");
        return $this->db->insert_id();
    }

    public function deleteOption($opt_id)
    {
        $this->db->where('product_option_id',$opt_id);
        $this->db->delete('products_options');

        $this->db->where('product_option_id',$opt_id);
        $this->db->delete('products_options_values');

        $this->db->where('product_option_id',$opt_id);
        $this->db->delete('product_option_description');
    }

    public function Get_All_Option()
    {

        $query = "select * from products_options";
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