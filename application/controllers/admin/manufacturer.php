<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends CI_Controller {
    var $imagePath;
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/M_tax_rate');
       // $this->load->model('admin/m_country');
        $this->imagePath = realpath(APPPATH."../images/manufacturers/");
        $this->load->model('admin/M_manufacturer');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {

        if($this->uri->segment(3) == false)
        {
            $data['action'] = 'view';
            $data['rows'] = $this->M_manufacturer->getAll();
        }
        else
        {
            $data['action'] = $this->uri->segment(3);
        }
        $this->load->view('admin/manufacturer',$data);
    }

    public function add()
    {
        if(isset($_FILES['image_file']))
        {

            $ext = $this->getExtention($_FILES['image_file']['name']);
            $allowed_type = array('gif','jpg','png','jpeg');
            if(in_array($ext,$allowed_type))
            {
                $data = array(
                    'manufacturer_name'       => $_POST['manufacturer_name'],
                    'image_ext'               => $ext
                );
                $inserted_id = $this->M_manufacturer->insert($data);
                $file_name     = $inserted_id . "." . $ext;
                $this->do_upload($file_name);
                redirect('admin/manufacturer');

            }
            else
            {
                echo 'error by extention';
            }


        }
        else if( $this->uri->segment(3) == 'add')
        {

            $data['action'] = "add";
            $data['manufacturer_name'] = '';
            $data['rows'] = $this->M_manufacturer->getAll();
            $this->load->view('admin/manufacturer',$data);

        }

    }

    public function edit()
    {
        if(isset($_POST['manufacturer_name']))
        {
            $id = $this->uri->segment(4);
            $ext = $this->getExtention($_FILES['image_file']['name']);
            $allowed_type = array('gif','jpg','png','jpeg');
            $data = array(
                'manufacturer_name'       => $_POST['manufacturer_name'],
                'image_ext'     => $ext
            );
            if($_FILES['image_file']['name'] == '')
            {
                array_pop($data);
            }
            else if(in_array($ext,$allowed_type))
            {
                $file = $id . "." . $ext;
                $this->do_upload($file,$id);

            }
            else
            {
                echo 'error by extention';
            }
            $this->M_manufacturer->update($data,$id);
            redirect('admin/manufacturer');
        }
        else if( $this->uri->segment(3) == 'edit' && $this->uri->segment(4))
        {
            $id = $this->uri->segment(4);
            $records = $this->M_manufacturer->getById($id);
            $data['action'] = "edit/$id";
            $data['manufacturer_name'] = '';
            $data['rows'] = $this->M_manufacturer->getAll();
            if($records)
            {
                foreach($records as $r)
                {
                    $data['manufacturer_name'] = $r->manufacturer_name;
                    //$data['sort_order'] = $r->sort_order;
                    //$data['image'] = $r->image_ext;
                }
            }

            $this->load->view('admin/manufacturer',$data);
        }

    }

    public function delete()
    {
        if( $this->uri->segment(3) == 'delete' && $this->uri->segment(4))
        {
            $id =  $this->uri->segment(4);
            unlink($this->getFileById($id));
            $this->M_manufacturer->delete($id);
            redirect('admin/manufacturer');

        }
        else
        {
            $this->index();
        }
    }

    protected  function do_upload($file_name,$id=0)
    {
        $config['upload_path'] = $this->imagePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']	= '1000';
        $config['max_width']  = '2000';
        $config['max_height']  = '1000';
        $config['file_name'] = $file_name;

        $this->load->library('upload', $config);
        //$file = $this->path . "/" . $file_name;
        if($id!=0)
        {
            unlink($this->getFileById($id));
        }

        if ( ! $this->upload->do_upload('image_file'))
        {
            $error = array('error' => $this->upload->display_errors());

            //$this->load->view('upload_form', $error);
            print_r($error);
        }

        else
        {
            //$data = array('upload_data' => $this->upload->data());

            //redirect('admin/language');
        }

    }

    protected function getFileById($id)
    {
        $records = $this->M_manufacturer->getById($id);

        foreach($records as $r)
        {
            $file  = $this->imagePath . "/" . $id . "." . $r->image_ext;
            break;
        }
        return $file;
    }

    protected function getExtention($file)
    {
        $ext = end(explode('.',$file));
        return $ext;
    }

}