<?php

class Configure extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_configure');
        $this->data['config_menus'] = $this->M_configure->getAllConfigMenu();
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }
    public function index()
    {
        if($this->uri->segment(4))
        {
            $this->data['config_options'] = $this->M_configure->getAllConfig($this->uri->segment(4));
            $this->data['config_group_id'] = $this->uri->segment(4);

        }
        if($this->uri->segment(5))
        {
            $this->data['config_id'] = $this->uri->segment(5);
        }
        $this->load->view("admin/configuration",$this->data);
        //echo 'monir';
    }

    public function edit()
    {
        if(isset($_POST['config_value']))
        {
            $data = array(
                'configuration_value' => trim($_POST['config_value'])
            );
            $this->M_configure->updateConfig($data,$this->uri->segment(5));
        }
        redirect(base_url().'admin/configure/index/'.$this->uri->segment(4));
    }
}
?>