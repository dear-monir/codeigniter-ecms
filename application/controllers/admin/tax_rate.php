<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_rate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_tax_rate');
        $this->load->model('admin/m_country');
        $this->load->model('admin/M_tax_class');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {

        if($this->uri->segment(3) == false)
        {
            $data['action'] = 'view';
            $data['rows'] = $this->M_tax_rate->getAll();
        }
        else
        {
            $data['action'] = $this->uri->segment(3);
        }
        $this->load->view('admin/tax_rate',$data);
    }

    public function add()
    {
        if(isset($_POST['tax_rate']))
        {
            $data['tax_rate'] = $_POST['tax_rate'];
            $data['tax_class_id'] = $_POST['tax_class_id'];
            $data['country_id'] = $_POST['country_id'];
            $this->M_tax_rate->insert($data);
            redirect('admin/tax_rate');
        }
        else
        {
            $data['tax_class_title'] = '';
            $data['action'] = 'add';
            $data['rows'] = $this->M_tax_rate->getAll();
            $data['tax_class'] = $this->M_tax_class->getAll();
            $data['country']   = $this->m_country->getAll();
            $data['tax_rate']  = '';
            $this->load->view('admin/tax_rate',$data);
        }


    }

    public function edit()
    {
        if(isset($_POST['tax_rate']))
        {
            $id = $this->uri->segment(4);
            $data['tax_rate'] = $_POST['tax_rate'];
            $data['tax_class_id'] = $_POST['tax_class_id'];
            $data['country_id'] = $_POST['country_id'];
            $this->M_tax_rate->update($data,$id);
            redirect('admin/tax_rate');
        }
        else
        {

            $id = $this->uri->segment(4);
            $records = $this->M_tax_rate->getById($id);
            $data['action'] = "edit/$id";
            $data['tax_class_id'] = '';
            $data['country_id'] = '';
            $data['tax_rate']  = '';
            $data['tax_class'] = $this->M_tax_class->getAll();
            $data['country']   = $this->m_country->getAll();

            $data['rows'] = $this->M_tax_rate->getAll();
            if($records)
            {
                foreach($records as $r)
                {
                    $data['tax_class_id'] = $r->tax_class_id;
                    $data['country_id'] = $r->country_id;
                    $data['tax_rate']   = $r->tax_rate;
                }
            }

            $this->load->view('admin/tax_rate',$data);
        }

    }

    public function delete()
    {
        $id =  $this->uri->segment(4);
        $this->M_tax_rate->delete($id);
        redirect('admin/tax_rate');
    }

}