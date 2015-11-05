<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/21/13
 * Time: 12:18 AM
 * To change this template use File | Settings | File Templates.
 */

class Boxes extends CI_Controller
{
    var $data;
    //var $config_group_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_boxes');
        $group_id = $this->uri->segment(4);
        $this->data['config_id'] = $this->M_boxes->getAllConfigById($group_id);
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {

        $this->data['action'] = "view";
        $this->load->view('admin/boxes',$this->data);
    }

    public function edit()
    {
        $config_id = $this->uri->segment(5);
        $group_id  = $this->uri->segment(4);
        if($_POST)
        {
            $data = array(
                'configuration_value' => $_POST['display'] . "_". $_POST['column'],
                'sort_order'   => $_POST['sort_order']
            );
            $this->M_boxes->update($data,$config_id);
            redirect("admin/boxes/index/$group_id");
        }
        else
        {

            $this->data['action'] = "edit";

            if(!empty($this->data['config_id']))
            {
                foreach($this->data['config_id'] as $con_id)
                {
                    if($con_id->configuration_id == $config_id)
                    {
                        $this->data['config'] = $con_id;
                        break;
                    }
                }
            }
            $this->load->view('admin/boxes',$this->data);
        }
    }
}