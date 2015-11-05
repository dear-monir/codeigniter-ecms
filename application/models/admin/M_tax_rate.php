<?php
class M_tax_rate extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $this->db->set('last_modified','NOW()',false);
        $q = $this->db->insert('tax_rates', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->update('tax_rates',$data,"tax_rate_id = $id");
    }
    public function delete($id)
    {
        $sql = "delete from tax_rates where tax_rate_id = ?";
        $q     = $this->db->query($sql,$id);
    }

    public function getAll()
    {
        $query = "select tax_rate_id ,tax_rate,tax_rates.last_modified,tax_classes.tax_class_title,country_name from tax_rates,tax_classes,countries where tax_rates.country_id = countries.country_id and tax_rates.tax_class_id = tax_classes.tax_class_id";
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
        $query = "select * from tax_rates  where tax_rate_id = $id";
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