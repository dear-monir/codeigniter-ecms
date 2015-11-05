<?php
class M_manufacturer extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->insert('manufacturers', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->update('manufacturers',$data,"manufacturer_id = $id");
    }
    public function delete($id)
    {
        $sql = "delete from manufacturers where manufacturer_id = ?";
        $q     = $this->db->query($sql,$id);
    }

    public function getAll()
    {
        $q = $this->db->get('manufacturers');
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
        $query = "select * from manufacturers  where manufacturer_id = $id";
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