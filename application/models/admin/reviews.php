<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 11:27 AM
 * To change this template use File | Settings | File Templates.
 */

class M_reviews extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $q = $this->db->insert('reviews', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->update('languages',$data,"language_id = $id");
    }


    public function delete($id)
    {
        $sql = "delete from languages where language_id = ?";
        $q     = $this->db->query($sql,$id);
    }


    public function getReviewById($id)
    {
        $query = "select * from reviews product_id = ?";
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

    public function getReviewDesById($id)
    {
        $query = "select * from reviews_description review_id = ?";
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

}