<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/3/14
 * Time: 11:37 AM
 */
class States extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_state');
        $this->load->model('admin/m_country');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }
    public function index()
    {
        $country_id = $this->uri->segment(4);
        if($country_id != '')
        {
            $data['states'] = $this->m_state->getAll($country_id);
        }
        else
        {
            $country_id = 0;
        }
        $data['action'] = 'view';
        $data['country_id'] = $country_id;
        $data['countries'] = $this->m_country->getAll();
        $this->load->view('admin/states',$data);
    }

    public function add()
    {
        $country_id = $this->uri->segment(4);
        if(isset($_POST['state_name']))
        {
            $data = array(
                'country_id' => $country_id,
                'name'       => $_POST['state_name']
            );
            $this->m_state->insert($data);
            redirect(base_url().'admin/states/index/'.$country_id);
        }
        $data['action'] = 'add';
        $data['country_id'] = $country_id;
        $country_info = $this->m_country->getById($country_id);
        foreach($country_info as $c_info)
        {
            $data['country_name'] = $c_info->country_name;
            break;
        }
        $data['state_name'] = '';
        $this->load->view('admin/states',$data);
    }

    public function edit()
    {
        $country_id = $this->uri->segment(4);
        $state_id   = $this->uri->segment(5);
        if(isset($_POST['state_name']))
        {
            $data = array(
                'country_id' => $country_id,
                'name'       => $_POST['state_name']
            );
            $this->m_state->update($data,$state_id);
            redirect(base_url().'admin/states/index/'.$country_id);
        }
        $data['action'] = 'edit';
        $data['country_id'] = $country_id;
        $country_info = $this->m_country->getById($country_id);
        $state_info   = $this->m_state->getById($state_id);
        foreach($country_info as $c_info)
        {
            $data['country_name'] = $c_info->country_name;
            break;
        }
        $data['state_name'] = $state_info->name;
        $data['state_id']   = $state_id;
        $this->load->view('admin/states',$data);
    }

    public function delete()
    {
        $country_id = $this->uri->segment(4);
        $state_id   = $this->uri->segment(5);
        $this->m_state->delete($state_id);
        redirect(base_url().'admin/states/index/'.$country_id);
    }
}
?>