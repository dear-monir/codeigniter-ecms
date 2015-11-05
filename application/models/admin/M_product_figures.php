<?php

class M_product_figures extends CI_Model
{    public function __construct()
{
    parent::__construct();
    $this->db->query ("set character_set_results='utf8'");
}

    public function getAllProductFigure($product_id)
    {
        $this->db->where('product_id',$product_id);
        $q = $this->db->get('products_images');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }




    public function insertFigure($data)
    {
        $q = $this->db->insert('products_images',$data);
        if($q)
        {
            return $this->db->insert_id();
        }
    }

    public function deleteFigure($figure_id)
    {
        $query = "delete from products_images where image_id = $figure_id";
        $this->db->query($query);
    }

    public function getFigureExtById($figureid)
    {
        $query = "select image_ext from products_images where image_id = $figureid";
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