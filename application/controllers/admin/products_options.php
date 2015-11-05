
<?php
class Products_options extends CI_Controller
{
    var $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_products_options');
        $this->load->model('admin/M_language');
        $this->data['languages'] = $this->M_language->getAll();
        $this->data['options']   = $this->M_products_options->getAllOption();
        if ($this->session->userdata('admin_logged_in') !== 1) {
            redirect(base_url("admin/account/login"));
        }
    }

    public function index()
    {
        $this->data['action']  = "view";
        $this->load->view('admin/products_options',$this->data);
    }

    public function add()
    {
        $option_id = $this->M_products_options->insertOption();
        if( $this->data['languages'])
        {
            foreach($this->data['languages'] as $l)
            {
                $option_name = $_POST['option_'.$l->language_id];

                    $opt_data = array(
                        'product_option_id'    => $option_id,
                        'language_id'          => $l->language_id,
                        'product_option_name'  =>  $option_name
                    );
                    $this->M_products_options->insertOptionDescription($opt_data);

            }
        }
        redirect("admin/products_options/index");
    }

    public function edit()
    {
        $opt_id = $this->uri->segment(4);
        if(isset($_POST['submit']))
        {

            if( $this->data['languages'])
            {
                foreach($this->data['languages'] as $l)
                {
                    $option_name = $_POST['option_'.$l->language_id];
                    $opt_data = array(
                        'product_option_name'  =>  $option_name
                    );
                    $this->M_products_options->updateOptionDescription($opt_data,$opt_id,$l->language_id);
                }
            }
            redirect("admin/products_options/index");
        }
        else
        {
            $this->data['option_id'] = $opt_id;
            $editable_option = $this->M_products_options->getOptionById($opt_id);
            if($editable_option)
            {
                foreach($editable_option as $e_p)
                {
                    $this->data['option_'.$e_p->product_option_id.'_'.$e_p->language_id] = $e_p->product_option_name;
                }
            }
            $this->data['action']  = "edit";
            $this->load->view('admin/products_options',$this->data);
        }


    }

    public function delete()
    {
        $opt_id = $this->uri->segment(4);
        $this->M_products_options->deleteOption($opt_id);
        redirect($_SERVER['HTTP_REFERER']);
    }

}