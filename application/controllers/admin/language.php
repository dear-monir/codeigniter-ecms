<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller {

    var $path;
    public function __construct()
    {
        parent::__construct();
        $this->path = realpath(APPPATH."../images/languages/");
        $this->load->model('admin/M_language');
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

	public function index()
	{

        if($this->uri->segment(3) == false)
        {
            $data['action'] = 'view';
            $data['rows'] = $this->M_language->getAll();
        }
        else
        {
            $data['action'] = $this->uri->segment(3);
        }
        $default_language_id = $this->M_adminCommon->getConfiguration('DEFAULT_LANGUAGE')->configuration_value;
        $data['default_language_id'] = $default_language_id;

		$this->load->view('admin/language',$data);
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
                    'name'       => $_POST['language_name'],
                    'code'       => $_POST['code'],
                    'sort_order' => $_POST['sort_order'],
                    'image_ext' => $ext
                );
                $inserted_id = $this->M_language->insert($data);
                $file_name     = $inserted_id . "." . $ext;
                $this->do_upload($file_name);
                ///////////////////
                $this->load->model('admin/M_categories_product');
                $categories = $this->M_categories_product->Get_All_Category();
                if(!empty($categories))
                {
                    foreach($categories as $cat)
                    {
                        $cat_des = array(
                            'category_id'=>$cat->category_id,
                            'language_id'=>$inserted_id,
                            'category_name'=>''
                        );
                        $this->M_categories_product->insert_catDescription($cat_des);
                    }
                }
                $this->load->model('admin/M_products');
                $products = $this->M_products->Get_All_Product();
                if(!empty($products))
                {
                    foreach($products as $product)
                    {
                        $pro_des = array(
                            'product_id'              => $product->product_id,
                            'language_id'             => $inserted_id,
                            'product_name'            => '',
                            'product_description'     => ''
                        );
                        $this->M_products->insertProductDescription($pro_des);
                    }
                }


                $this->load->model('admin/M_products_options');
                $options = $this->M_products_options->Get_All_Option();
                if(!empty($options))
                {
                    foreach($options as $option)
                    {
                        $opt_data = array(
                            'product_option_id'    => $option->product_option_id,
                            'language_id'          => $inserted_id,
                            'product_option_name'  =>  ''
                        );
                        $this->M_products_options->insertOptionDescription($opt_data);
                    }
                }

                $this->load->model('admin/M_option_values');
                $option_values = $this->M_option_values->Get_All_Option_Value();
                if(!empty($option_values))
                {
                    foreach($option_values as $opt_val)
                    {

                        $opt_data = array(
                            'product_option_id'          => $opt_val->product_option_id,
                            'language_id'                => $inserted_id,
                            'product_option_value_name'  => '',
                            'product_option_value_id'    => $opt_val->product_option_value_id
                        );
                        $this->M_option_values->insertOptionValues($opt_data);
                    }
                }
                //////////////////
                redirect('admin/language');
            }
            else
            {
                echo 'error by extention';
            }

        }
        else if( $this->uri->segment(3) == 'add')
        {

            $data['action'] = "add";
            $data['language_name'] = '';
            $data['code'] = '';
            $data['sort_order'] = '';
            $data['rows'] = $this->M_language->getAll();
            $this->load->view('admin/language',$data);

        }
    }

    public function edit()
    {
        if(isset($_POST['save']))
        {
            $id = $this->uri->segment(4);
            $ext = $this->getExtention($_FILES['image_file']['name']);
            $allowed_type = array('gif','jpg','png','jpeg');
            $data = array(
                'name'       => $_POST['language_name'],
                'code'       => $_POST['code'],
                'sort_order' => $_POST['sort_order'],
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
            $this->M_language->update($data,$id);
            redirect('admin/language');
        }
        else if( $this->uri->segment(3) == 'edit' && $this->uri->segment(4))
        {
            $id = $this->uri->segment(4);
            $records = $this->M_language->getById($id);
            $data['action'] = $data['action'] = "edit/$id";
            $data['language_name'] = '';
            $data['code'] = '';
            $data['sort_order'] = '';
            $data['image'] = '';
            $data['rows'] = $this->M_language->getAll();
            if($records)
            {
                foreach($records as $r)
                {
                    $data['language_name'] = $r->name;
                    $data['code'] = $r->code;
                    $data['sort_order'] = $r->sort_order;
                    //$data['image'] = $r->image_ext;
                }
            }

           $this->load->view('admin/language',$data);
        }

    }

    public function delete()
    {

        if( $this->uri->segment(3) == 'delete' && $this->uri->segment(4) && $this->uri->segment(4) != 4)
        {
            $id =  $this->uri->segment(4);
            unlink($this->getFileById($id));
            $this->M_language->delete($id);
            redirect('admin/language');

        }
        else
        {
           // $this->index();
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    protected  function do_upload($file_name,$id=0)
    {
        $config['upload_path'] = $this->path;
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
            //
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

    protected function getExtention($file)
    {
        $ext = end(explode('.',$file));
        return $ext;
    }

    protected function getFileById($id)
    {
        $records = $this->M_language->getById($id);

        foreach($records as $r)
        {
            $file  = $this->path . "/" . $id . "." . $r->image_ext;
            break;
        }
        return $file;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */