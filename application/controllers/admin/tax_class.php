<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_class extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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
            $data['rows'] = $this->M_tax_class->getAll();
        }
        else
        {
            $data['action'] = $this->uri->segment(3);
        }
        $this->load->view('admin/tax_class',$data);
    }

    public function add()
    {
        if(isset($_POST['tax_class_title']))
        {
            $data['tax_class_title'] = $_POST['tax_class_title'];
            $data['tax_class_description'] = $_POST['tax_class_description'];
            $this->M_tax_class->insert($data);
            redirect('admin/tax_class');
        }
        else
        {
            $data['tax_class_title'] = '';
            $data['tax_class_description'] = '';
            $data['action'] = 'add';
            $data['rows'] = $this->M_tax_class->getAll();
            $this->load->view('admin/tax_class',$data);
        }


    }

    public function edit()
    {
        if(isset($_POST['tax_class_title']))
        {
            $id = $this->uri->segment(4);
            $data['tax_class_title'] = $_POST['tax_class_title'];
            $data['tax_class_description'] = $_POST['tax_class_description'];
            $this->M_tax_class->update($data,$id);
            redirect('admin/tax_class');
        }
        else
        {
            $data['rows'] = $this->M_tax_class->getAll();

            //echo $data['country_name'] . "  " . $data['country_code'];
            $id = $this->uri->segment(4);
            $records = $this->M_tax_class->getById($id);
            $data['action'] = "edit/$id";
            $data['tax_class_title'] = '';
            $data['tax_class_description'] = '';

            $data['rows'] = $this->M_tax_class->getAll();
            if($records)
            {
                foreach($records as $r)
                {
                    $data['tax_class_title'] = $r->tax_class_title;
                    $data['tax_class_description'] = $r->tax_class_description;
                }
            }

            $this->load->view('admin/tax_class',$data);
        }


    }

    public function delete()
    {
        $id =  $this->uri->segment(4);
        $this->M_tax_class->delete($id);
        redirect('admin/tax_class');
    }

}