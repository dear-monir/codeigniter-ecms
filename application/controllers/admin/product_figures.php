
<?php
class Product_figures extends CI_Controller
{
    var $data;
    var $product_id;
    var $imagePath;
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/M_products_options');
        //$this->load->model('admin/M_option_values');
        $this->load->model('admin/M_products_attributes');
        $this->load->model('admin/M_product_figures');
        //$this->data['languages'] = $this->M_language->getAll();
        //$this->data['options']   = $this->M_products_options->getAllOption();
        $this->imagePath = realpath(APPPATH."../images/products_images/");
        $this->data['products']  = $this->M_products_attributes->getAllProduct();


        if($this->uri->segment(4) == false || $this->uri->segment(4) == 0)
        {
            if($this->data['products'])
            {
                foreach($this->data['products'] as $p)
                {
                    $this->option_id = $p->product_id;
                    redirect(base_url().'admin/product_figures/index/'.$this->option_id);
                    break;
                }
            }
        }
        else
        {
            $this->product_id = $this->uri->segment(4);
        }
        $this->data['selected_product_id']  = $this->product_id;
        //$this->data['options_values']   = $this->M_option_values->getAllOptionValues($this->option_id);
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {
        $this->data['figures'] = $this->M_product_figures->getAllProductFigure($this->product_id);
        $this->data['path']    = base_url().'images/products_images/';
        $this->load->view('admin/product_figures',$this->data);

    }

    public function add()
    {
        if(isset($_FILES['image_file']))
        {
            foreach($_FILES['image_file']['tmp_name'] as $key=>$tmp_name)
            {
                $ext = $this->getExtention($_FILES['image_file']['name'][$key]);
                $data  = array(
                    'product_id' => $this->product_id,
                    'image_ext'  => $ext
                );
                $id = $this->M_product_figures->insertFigure($data);
                $file_name = $id . '.' . $ext;
                //$this->do_upload($file_name,$tmp_name);
                $path = $this->imagePath ."/". $file_name;
                move_uploaded_file($tmp_name,$path);
            }
            redirect(base_url().'admin/product_figures/index/'.$this->product_id);
        }
        else
        {
            redirect(base_url().'admin/product_figures/index/'.$this->product_id);
        }

        /*
        $data = array(
            'product_option_id'           => $_POST['option'],
            'product_option_value_id'     => $_POST['option_name'],
            'product_id'                  => $this->product_id,
            'option_value_price '         => $_POST['option_price'],
            'price_prefix'                => $_POST['price_prefix']
        );
        */
       // $this->M_products_attributes->insertAttribute($data);
       // redirect(base_url().'admin/product_figures/index/'.$this->product_id);
    }

    public function delete()
    {
        $product_id = $this->uri->segment(4);
        $figureid = $this->uri->segment(5);
        $ext = '';
        $img_ext = $this->M_product_figures->getFigureExtById($figureid);
        foreach($img_ext as $img)
        {
            $ext = $img->image_ext;
            break;
        }
         $file_path = $this->imagePath.'/'.$figureid.'.'.$ext;
         $this->M_product_figures->deleteFigure($figureid);
         unlink($file_path);
         redirect(base_url().'admin/product_figures/index/'.$this->product_id);
    }

    protected  function do_upload($file_name,$tmp_name)
    {
        $config['upload_path'] = $this->imagePath;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']	= '1000';
        $config['max_width']  = '2000';
        $config['max_height']  = '1000';
        $config['file_name'] = $file_name;

        $this->load->library('upload', $config);
        //$file = $this->path . "/" . $file_name;
        if ( ! $this->upload->do_upload($tmp_name))
        {
            $error = array('error' => $this->upload->display_errors());

            //$this->load->view('upload_form', $error);
            print_r($error);
        }

    }
    protected function getExtention($file)
    {
        $ext = end(explode('.',$file));
        return $ext;
    }

}