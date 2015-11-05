<?php

class M_specials extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
        $this->language_id = $this->M_adminCommon->language_id;
    }
    public function getAllSpecialProduct($product_id=0)
    {
        $query = "select p_d.product_id as product_id,product_name,product_price,special_price,status,expire_date
                  from products as p,products_description as p_d,specials as s
                  where p_d.product_id = s.product_id and p.product_id = s.product_id";
        if($product_id != 0 )
        {
            $query = $query . " and s.product_id = $product_id";
        }
        $query = $query ." and language_id = {$this->language_id}";
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


    public function insertSpecialProduct($data)
    {
        $this->db->set('date_added','NOW()',false);
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->insert('specials',$data);
        if($q)
        {
            return $this->db->insert_id();
        }
    }

    public function deleteSpecial($product_id)
    {
        $query = "delete from specials where product_id = $product_id";
        $this->db->query($query);
    }

    public function editSpecial($product_id,$data)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->where('product_id',$product_id);
        $this->db->update('specials',$data);
    }


    public function getAllProduct($id=0)
    {
        $query = "select p.product_id as product_id,product_name,product_price from products as p,products_description as p_d
                  where p.product_id = p_d.product_id  and language_id = {$this->language_id} ";

        if($id == 0)
        {
            $query = $query . " and p.product_id not in (select product_id from specials)";
        }
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

}