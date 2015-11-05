<?php
class M_configure extends CI_Model
{
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
    }
    public function updateConfig($data,$config_id)
    {
        $this->db->set('last_modified','NOW()',false);
        $this->db->update('configuration',$data,"configuration_id = $config_id");
    }

    public function getAllConfig($group_id)
    {
        $this->db->where('configuration_group_id',$group_id);
        $q = $this->db->get('configuration');
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }


    public function getAllConfigMenu()
    {
        $q = $this->db->get('configuration_group');
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