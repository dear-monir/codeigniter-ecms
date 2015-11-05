<?php

class M_products_attributes extends CI_Model
{
        private $language_id;
        public function __construct()
        {
            parent::__construct();
            $this->db->query ("set character_set_results='utf8'");
            $this->language_id = $this->M_adminCommon->language_id;
        }
        public function getAllProduct()
        {
            $this->db->where('language_id',$this->language_id);
            $q = $this->db->get('products_description');
            if($q->num_rows()>0)
            {
                foreach($q->result() as $row)
                {
                    $data[] = $row;
                }
                return $data;
            }
        }

        public function getAllAttribute($product_id)
        {
            $this->db->where('product_id',$product_id);
            $q = $this->db->get('products_attributes');
            if($q->num_rows()>0)
            {
                foreach($q->result() as $row)
                {
                    $data[] = $row;
                }
                return $data;
            }
        }

        public function getAttributeInfo($opt_id,$opt_val_id)
        {
            $query = " select product_option_name,product_option_value_name,product_option_description.language_id
                      from product_option_description inner join products_options_values
                      on  products_options_values.product_option_id = product_option_description.product_option_id
                      and product_option_description.product_option_id = $opt_id
                      and product_option_description.language_id = products_options_values.language_id
                      and product_option_description.language_id = {$this->language_id} and product_option_value_id = $opt_val_id";
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
    public function insertAttribute($data)
    {
        $this->db->insert('products_attributes',$data);
    }

    public function deleteAttribute($product_attr_id)
    {
        $this->db->where('prodcut_attribute_id',$product_attr_id);
        $this->db->delete('products_attributes');
    }

    public function updateAttribute($product_attr_id,$data)
    {
        $this->db->where('prodcut_attribute_id',$product_attr_id);
        $this->db->update('products_attributes',$data);
    }
}