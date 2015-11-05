<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/21/13
 * Time: 12:23 AM
 * To change this template use File | Settings | File Templates.
 */

class M_boxes extends CI_Model
{
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
    }

    public function getAllConfigById($group_id)
    {
        $query = "select * from configuration where configuration_group_id = $group_id";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function update($data,$config_id)
    {
        $this->db->update('configuration',$data,"configuration_id = $config_id");
    }
}