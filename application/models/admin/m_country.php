<?php
class M_country extends CI_Model
{
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $q = $this->db->insert('countries', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->update('countries',$data,"country_id = $id");
    }
    public function delete($id)
    {
        $sql = "delete from countries where country_id = ?";
        $q     = $this->db->query($sql,$id);
    }

    public function getAll()
    {
        $q = $this->db->get('countries');
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
        $query = "select * from countries where country_id = ?";
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