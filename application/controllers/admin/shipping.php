<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/2/14
 * Time: 12:40 AM
 */

class Shipping extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_mystore');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }
    public function index()
    {
        $config_group_id = $this->uri->segment(4);
        $data['action'] = 'view';
        $data['shipping_methods'] = $this->m_mystore->getAll($config_group_id);
        $this->load->view('admin/shipping',$data);
    }

    public function edit()
    {
        $config_id = $this->uri->segment(5);
        $config_group_id = $this->uri->segment(4);
        if(isset($_POST['display']))
        {
            $data['configuration_value'] = $_POST['display'];
            $this->m_mystore->update($data,$config_id);
            redirect(base_url().'admin/shipping/index/'.$config_group_id);
        }
        else
        {
            $data['action'] = 'edit';
            $shipping_method_info = $this->m_mystore->getById($config_id);
            foreach($shipping_method_info as $info)
            {
                $data['config_group_id'] = $info->configuration_group_id;
                $data['config_id'] = $info->configuration_id;
                $data['configuration_title'] = $info->configuration_title;
                $data['config_value'] = $info->configuration_value;
                break;
            }
            $this->load->view('admin/shipping',$data);
        }
    }
}
?>