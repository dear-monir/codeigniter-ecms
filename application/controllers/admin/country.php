<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/m_country');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {

        if($this->uri->segment(3) == false)
        {
            $data['action'] = 'view';
            $data['rows'] = $this->m_country->getAll();
        }
        else
        {
            $data['action'] = $this->uri->segment(3);
        }

        $this->load->view('admin/countries',$data);
    }

    public function add()
    {
        if(isset($_POST['country_name']))
        {
            $data['country_name'] = $_POST['country_name'];
            $data['country_code'] = $_POST['country_code'];
            $this->m_country->insert($data);
            redirect('admin/country');
        }
        else
        {
            $data['country_name'] = '';
            $data['country_code'] = '';
            $data['action'] = 'add';
            $data['rows'] = $this->m_country->getAll();
            $this->load->view('admin/countries',$data);
        }


    }

    public function edit()
    {
        if(isset($_POST['country_name']))
        {
            $id = $this->uri->segment(4);
            $data['country_name'] = $_POST['country_name'];
            $data['country_code'] = $_POST['country_code'];
            $this->m_country->update($data,$id);
            redirect('admin/country');
        }
        else
        {
            $data['rows'] = $this->m_country->getAll();

            //echo $data['country_name'] . "  " . $data['country_code'];
            $id = $this->uri->segment(4);
            $records = $this->m_country->getById($id);
            $data['action'] = "edit/$id";
            $data['country_name'] = '';
            $data['country_code'] = '';

            $data['rows'] = $this->m_country->getAll();
            if($records)
            {
                foreach($records as $r)
                {
                    $data['country_name'] = $r->country_name;
                    $data['country_code'] = $r->country_code;
                }
            }

            $this->load->view('admin/countries',$data);
        }


    }

    public function delete()
    {
        $id =  $this->uri->segment(4);
        $this->m_country->delete($id);
        redirect('admin/country');
    }

}