<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/3/14
 * Time: 5:02 PM
 */
class M_shipping_region extends CI_Model
{
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
    }
    public function insert($data)
    {
        $q = $this->db->insert('shipping_region', $data);
        if($q)
        {
            return $this->db->insert_id();
        }

    }
    public function update($data,$id)
    {

        $this->db->update('shipping_region',$data,"id = $id");
        echo $id;
    }
    public function delete($id)
    {
        $sql = "delete from shipping_region where id = ?";
        $q     = $this->db->query($sql,$id);
    }

    public function getAll($country_id,$shipping_method_id,$region_id=0)
    {
        /*$sql = "select * from states
                    where states.country_id = country_id
                            and id not in
                                (select region_id as id from shipping_region where shipping_method_id = $shipping_method_id)
                    order by name";*/
        if($region_id == 0)
        {
            $sql = "select * from states
                    where states.country_id = country_id
                            and id not in
                                (select region_id as id from shipping_region where shipping_method_id = $shipping_method_id)
                    order by name";
        }
        else
        {
            $sql = "select * from states
                    where states.country_id = country_id
                            and id not in
                                (select region_id as id from shipping_region where shipping_method_id = $shipping_method_id and shipping_region.id != $region_id)
                    order by name";
        }
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
    public function getAllById($country_id,$shipping_method_id)
    {
        $query = "select shipping_region.id as id,name,shipping_cost from shipping_region,states where shipping_method_id = $shipping_method_id and shipping_region.region_id = states.id and country_id = $country_id";
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
        $query = "select region_id, shipping_cost from shipping_region where id = $id";
        return $this->db->query($query)->first_row();
    }

    public function getByCountry($country_id)
    {
        $query = "select id,name from states where country_id = $country_id order by name";
        $q = $this->db->query($query);
        $data = array();
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getCountryRegion($country_id,$region_id)
    {
        $query = "select country_name, name as region_name from states,countries where states.country_id = countries.country_id and countries.country_id = $country_id and states.id = $region_id";
        return $this->db->query($query)->first_row();
    }

    public function getShippingMethodByRegion($region_id)
    {
        $query = "select configuration_key,shipping_method_id, shipping_cost,configuration_title from shipping_region,configuration where shipping_method_id = configuration_id and region_id = $region_id";
        $q = $this->db->query($query);
        $data = array();
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
        }
        return $data;
    }
}