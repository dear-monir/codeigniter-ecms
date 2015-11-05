<?php

class M_products extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }

    public function getById($id)
    {
        $query = "select * from products where product_id = ?";
        $q     = $this->db->query($query,$id);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductDescription($id)
    {
        $query = "select * from products_description where product_id = ?";
        $q     = $this->db->query($query,$id);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function insertProduct($data)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->set('date_added','NOW()',false);
        $q =  $this->db->insert('products', $data);
        if($q)
        {
            return $this->db->insert_id();
        }
    }

    public function updateProduct($p_id,$data)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->update('products',$data,"product_id = $p_id");
    }

    public function decreaseProduct($product_id,$qty)
    {
        $query = "update products set product_quantity = product_quantity - $qty where product_id = $product_id";
        $this->db->query($query);
    }

    public function insertProductDescription($data)
    {
        $this->db->insert('products_description', $data);
    }

    public function updateProductDescription($data,$p_id,$lan_id)
    {
        $this->db->where('product_id',$p_id);
        $this->db->where('language_id',$lan_id);
        $this->db->update('products_description',$data);
    }

    public function delete($product_id)
    {

    }

    public function Get_All_Product()
    {
        $query = "select * from products";
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