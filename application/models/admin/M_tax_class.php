<?php
class M_tax_class extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->insert('tax_classes', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->update('tax_classes',$data,"tax_class_id = $id");
    }
    public function delete($id)
    {
        $sql = "delete from tax_classes where tax_class_id = ?";
        $q     = $this->db->query($sql,$id);
    }

    public function getAll()
    {
        $q = $this->db->get('tax_classes');
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
        $query = "select * from tax_classes where tax_class_id = ?";
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