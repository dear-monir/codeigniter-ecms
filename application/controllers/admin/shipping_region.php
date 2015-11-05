<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/3/14
 * Time: 2:11 PM
 */
class Shipping_region extends CI_Controller
{
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_shipping_region');
        $this->load->model('admin/m_country');
        $this->load->model('admin/m_mystore');

        $country_id = $this->uri->segment(4);
        $shippping_method_id = $this->uri->segment(5);
        if($country_id == '')
        {
            $country_id = 0;
        }
        if($shippping_method_id == '')
        {
            $shippping_method_id = 0;
        }
        $this->data['country_id'] = $country_id;
        $this->data['shippping_method_id'] = $shippping_method_id;
        $this->data['countries'] = $this->m_country->getAll();
        $this->data['shipping_methods'] = $this->m_mystore->getAll(7);
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {
        $this->data['action']  = 'view';
        $this->data['shipping_regions'] = $this->m_shipping_region->getAllById($this->data['country_id'],$this->data['shippping_method_id']);
        $this->load->view('admin/shipping_region',$this->data);
    }

    public function add()
    {
        if(isset($_POST['shipping_cost']))
        {
            $data = array(
                'shipping_cost'    => $_POST['shipping_cost'],
                'region_id'        => $_POST['shipping_region'],
                'shipping_method_id' => $this->data['shippping_method_id']
            );

            $this->m_shipping_region->insert($data);
            redirect(base_url().'admin/shipping_region/index/'.$this->data['country_id'].'/'.$this->data['shippping_method_id']);
        }
        $this->data['shipable_regions'] = $this->m_shipping_region->getAll($this->data['country_id'],$this->data['shippping_method_id']);
        $this->data['action']  = 'add';
        $this->data['shipping_cost']  = '';
        $this->data['region_id'] = 0;
        $this->load->view('admin/shipping_region',$this->data);
    }

    public function edit()
    {
        $region_id = $this->uri->segment(6);
        if(isset($_POST['shipping_cost']))
        {
            $data = array(
                'shipping_cost'    => $_POST['shipping_cost'],
                'region_id'        => $_POST['shipping_region'],
                'shipping_method_id' => $this->data['shippping_method_id']
            );

            $this->m_shipping_region->update($data,$region_id);
            redirect(base_url().'admin/shipping_region/index/'.$this->data['country_id'].'/'.$this->data['shippping_method_id']);

        }

        $this->data['shipable_regions'] = $this->m_shipping_region->getAll($this->data['country_id'],$this->data['shippping_method_id'],$region_id);
        $this->data['action']  = 'edit';
        $this->data['rid']  = $region_id;
        $region = $this->m_shipping_region->getById($region_id);
        $this->data['shipping_cost']  = $region->shipping_cost;
        $this->data['region_id'] = $region->region_id;
        $this->load->view('admin/shipping_region',$this->data);
    }

    public function delete()
    {
        $region_id = $this->uri->segment(6);
        $this->m_shipping_region->delete($region_id);
        redirect(base_url().'admin/shipping_region/index/'.$this->data['country_id'].'/'.$this->data['shippping_method_id']);
    }

}