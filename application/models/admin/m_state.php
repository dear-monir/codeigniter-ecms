<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/3/14
 * Time: 11:45 AM
 */

class M_state extends CI_Model
{
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $q = $this->db->insert('states', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {
        $this->db->update('states',$data,"id = $id");
    }
    public function delete($id)
    {
        $sql = "delete from states where id = ?";
        $q     = $this->db->query($sql,$id);
    }

    public function getAll($country_id)
    {
        $sql = "select * from states where country_id = $country_id order by name";
        $q = $this->db->query($sql);
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
        $query = "select * from states where id = ?";
        return $this->db->query($query,$id)->first_row();
    }

    public function getByRegion($region_id,$shipping_method_id)
    {
        $query = "select shipping_cost,configuration_title as shipping_method,configuration_key from shipping_region,configuration where region_id = $region_id and shipping_method_id = $shipping_method_id and configuration_id = shipping_method_id";
        return $this->db->query($query)->first_row();
    }

}