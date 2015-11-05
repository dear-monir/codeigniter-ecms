<?php
class M_categories_product extends CI_Model{

    private $language_id;
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
        $this->language_id = $this->M_adminCommon->language_id;
    }
    public function getLanguage_Id(){
        $query = "select category_name,categories.category_id as category_id,parent_id,last_modified from categories,categories_description where language_id = {$this->language_id} and categories.category_id = categories_description.category_id";
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

    public function getAllCatDescription($c_id)
    {
        $query = "select * from categories_description where category_id = $c_id";
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
    public function insert_categories($data){
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->insert('categories', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }

    public function update_categories($data,$ca_id)
    {
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->update('categories', $data,"category_id = $ca_id");
    }

    public function insert_catDescription($data){
        //$this->db->update('categories_description', $data,"category_id = $cat_id","language_id = $lan_id");
        $this->db->insert('categories_description', $data);
    }

    public function update_catDescription($data,$cat_id,$lan_id)
    {
        $this->db->where("category_id",$cat_id);
        $this->db->where("language_id",$lan_id);
        $this->db->update('categories_description',$data);
    }

    public function getAllCategoryAndProduct($id=0)
    {
        /*$query = "select parent_id,c.category_id as category_id, category_name from categories as c, categories_description as c_d
        where c.category_id = c_d.category_id and language_id = {$this->language_id} and parent_id = $id";
        $q     = $this->db->query($query);
        $join_operatin = $q->num_rows()>0 ? "left" :"right";
        echo $query = "select parent_id,category_id, product_id,category_name,product_name from
        (select parent_id,c.category_id as category_id,category_name from categories as c, categories_description as c_d
        where c.category_id = c_d.category_id and language_id = {$this->language_id} and parent_id = $id) as t

        ". $join_operatin ." join

    (select  p.product_id as product_id,product_name,category_id as p_c_id from products as p,products_description as
        p_d where
        p.product_id = p_d.product_id  and category_id = $id and language_id = {$this->language_id}) as s
        on  parent_id = p_c_id";
        */
       $query = "select c.category_id as category_id,category_name from categories as c, categories_description as c_d
        where c.category_id = c_d.category_id and language_id = {$this->language_id} and parent_id = $id";
        //exit();
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

    public function getAllProduct($id=0)
    {
        $query = "select product_name,products.product_id as product_id from products,products_description where category_id = $id and products.product_id = products_description.product_id and language_id = {$this->language_id}";
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

    public function getById($id)
    {
        $query = "select * from categories_description where language_id = {$this->language_id} and category_id = ?";
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

    public  function getParentCategory($id)
    {
        $query = "select category_name,parent_id from categories,categories_description where language_id = {$this->language_id} and categories.category_id = $id and categories_description.category_id = $id ";
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

    public function getCatById($id)
    {
        $query = "select * from categories where category_id = $id";
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

    public function moveAbleCategory($cat_id)
    {
       /* if($is_product == true)
        {
            $query = "select categories.category_id as category_id,category_name
                      from categories,categories_description
                      where  language_id = {$this->language_id} and categories.category_id = categories_description.category_id ";
        }
        else
        {
            $query = "select categories.category_id as category_id,category_name
                      from categories,categories_description
                      where parent_id != $cat_id and $cat_id != 0 and language_id = {$this->language_id} and categories.category_id = categories_description.category_id ";
        }*/

        $query = "select categories.category_id as category_id,category_name
                      from categories,categories_description
                      where  language_id = {$this->language_id} and categories.category_id = categories_description.category_id and categories.category_id != $cat_id";

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

    public function getProductById($p_id)
    {
        $query = "select * from products_description where product_id = $p_id and language_id = {$this->language_id}";
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

    public function moveProduct($product_id,$data)
    {
        $this->db->where("product_id",$product_id);
        $this->db->update('products',$data);
    }

    public function deleteCategory($cat_id)
    {
        $query = "delete form category where category_id = $cat_id";
        $q     = $this->db->query($query,$id);
    }

    public function getSubCategory($cat_id)
    {
        $query = "select category_id from categories where parent_id = $cat_id";
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

    public function Get_All_Category()
    {
        $query = "select * from categories";
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