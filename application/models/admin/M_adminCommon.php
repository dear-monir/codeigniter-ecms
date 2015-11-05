<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 12/9/13
 * Time: 4:09 PM
 * To change this template use File | Settings | File Templates.
 */

class M_adminCommon extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
        $this->language_id = $this->getConfiguration('DEFAULT_LANGUAGE')->configuration_value;
    }
    public function getConfiguration($config_key)
    {
        $q = "select * from configuration where configuration_key = '$config_key'";
        $query = $this->db->query($q);
        return  $query->first_row();
    }

    public function setConfiguration($config_key,$data)
    {
        $this->db->where('configuration_key', $config_key);
        $this->db->update('configuration', $data);
    }
}