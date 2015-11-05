<?php
class M_language extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $q = $this->db->insert('languages', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->update('languages',$data,"language_id = $id");
    }
    public function delete($lan_id)
    {
        $sql = "delete from languages where language_id = ?";
        $q     = $this->db->query($sql,$lan_id);

        $this->db->where('language_id',$lan_id);
        $this->db->delete('categories_description');
        $this->db->where('language_id',$lan_id);
        $this->db->delete('products_description');
        $this->db->where('language_id',$lan_id);
        $this->db->delete('products_options_values');
        $this->db->where('language_id',$lan_id);
        $this->db->delete('product_option_description');
    }

    public function getAll()
    {
        $q = $this->db->get('languages');
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
        $query = "select * from languages where language_id = ?";
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